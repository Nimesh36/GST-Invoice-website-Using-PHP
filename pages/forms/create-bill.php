<?php
session_start();
include("../../functions.php");
if(isset($_SESSION["user_name"])){
	if(isLoginSessionExpired()){
		header("Location:../../logout.php?session_expired=1");
	}
}
else{
	header("Location:../404.php");
}
?>
<?php
include ("../../DBconfig.php");
$user_name = $_SESSION["user_name"];
$sub_total = $_GET['subtotal'];
$grand_total = $_GET['grandtotal'];
$round_off = $_GET['roundoff'];
$invoice_no = $_GET['invoice_no'];
$place_of_supply = $_GET['place_of_supply'];
?>
<?php
	require_once '../../dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();
	include ("../../DBconfig.php");
	$user_name = $_SESSION["user_name"];
	$sql = "SELECT * FROM user_detail WHERE username = '$user_name';";
	$result = mysqli_query($conn, $sql);

	function to_word($number) {
	    $no = round($number);
	    $decimal = round($number - ($no = floor($number)), 2) * 100;
	    $digits_length = strlen($no);
	    $i = 0;
	    $str = array();
	    $words = array(
	        0 => '',
	        1 => 'One',
	        2 => 'Two',
	        3 => 'Three',
	        4 => 'Four',
	        5 => 'Five',
	        6 => 'Six',
	        7 => 'Seven',
	        8 => 'Eight',
	        9 => 'Nine',
	        10 => 'Ten',
	        11 => 'Eleven',
	        12 => 'Twelve',
	        13 => 'Thirteen',
	        14 => 'Fourteen',
	        15 => 'Fifteen',
	        16 => 'Sixteen',
	        17 => 'Seventeen',
	        18 => 'Eighteen',
	        19 => 'Nineteen',
	        20 => 'Twenty',
	        30 => 'Thirty',
	        40 => 'Forty',
	        50 => 'Fifty',
	        60 => 'Sixty',
	        70 => 'Seventy',
	        80 => 'Eighty',
	        90 => 'Ninety');
	    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
	    while ($i < $digits_length) {
	        $divider = ($i == 2) ? 10 : 100;
	        $number = floor($no % $divider);
	        $no = floor($no / $divider);
	        $i += $divider == 10 ? 1 : 2;
	        if ($number) {
	            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
	            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
	        } else {
	            $str [] = null;
	        }
	    }
	    $Rupees = implode(' ', array_reverse($str));
	    $paise = ($decimal) ? "And " . ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10]) .' Paise '  : '';
	    return ($Rupees ? $Rupees . ' Rupees ' : '') . $paise . " Only";
	}
	$html = "<!DOCTYPE html><html><head>
			<style>
				@page { margin: 140px 25px 15px 25px; }
		  	    header {
					position: fixed;
		  	     	top: -130px;
		  	     	left: 0px;
		  	     	right: 0px;
		  	     	height: 100px;
					text-align: center;
			 	}
				header p{
					position: fixed;
		  	     	top: -70px;
				}
				#div_1{
					margin:0px;
					padding-top:-15px;
					padding-bottom:-15px;
					padding-left: 5px;
					padding-right: 5px;
				}
				#main_div{
					border: 1px solid black;
					height: 940px;
				}
				body{
					font-family: 'Times New Roman', Times, serif;
				}
				#a0{
					height: 23px;
					text-align: center;
					font-size:13px;
					position:absolute;
				}
				</style>
				</head><body onload='onload_fun();'>
			<header><h1 style='text-transform: uppercase;'>";
			if (mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				$html .= $row['company_name'];
			}
			$html .= "</h1><p>";
			$html .=  $row['addr'];
			$html .= "</p><p style='margin-top: 17px;'>MOBILE: ";
			$html .= $row['phone_no_1'];
			$html .= " / ";
			$html .= $row['phone_no_2'];
			$html .= "</p>
			</header>
			<div style='margin-top:-25px;'>
				<div style='float: left;' id='div_1'>
					<p><b>GSTIN No:</b> ";
			$html .= $row['gstin_no'];
			$html .= "</p>
				</div>
				<div style='float: right;' id='div_1'>
					<p style='text-align: right;'><b>PAN No:</b> ";
			$html .= $row['pan_no'];
			$html .= "</p>
				</div>
			</div>
			<div id='main_div'>
				<div style='border-bottom: 1px solid black; height: 23px;'>
					<div style='float: left;' id='div_1'>
						<p style='text-align: left;'><b>Debit memo</b></p>
					</div>
					<div style='float: left;' id='div_1'>
						<p style='text-align: center;'><b>TAX INVOICE</b></p>
					</div>
					<div style='float: left;' id='div_1'>
						<p style='text-align: right;'><b>Original</b></p>
					</div>
				</div>
				<div>
					<div style=' border-bottom: 1px solid black; border-right: 1px solid black; float: left; height: 140px; width: 400px;'>
						<div style='height: 92px;'>
							<div style='margin:5px; width:70px; height: 69px; position:fixed; top:23px;'><b>M/s :</b>
							</div>
							<div style='height: 69px; position:fixed; top:23px; left:70px; '>
								<div style='height: 20px; margin:5px; text-transform: capitalize;'>
									<b>";
							if(isset($_GET['id'])){
								$id = $_GET['id'];
								$sql_ = "SELECT cust_id,DATE_FORMAT(date, '%d/%m/%Y') date FROM bill_list WHERE bill_id = $id;";
								$result_ = mysqli_query($conn, $sql_);
								if (mysqli_num_rows($result_) > 0){
									$row_ = mysqli_fetch_assoc($result_);
									$cust_id = $row_['cust_id'];
									$date = $row_['date'];
									$sql_ = "SELECT * FROM customers WHERE username = '$user_name' and cust_id = $cust_id";
									$res = mysqli_query($conn, $sql_);
									if (mysqli_num_rows($res) > 0){
										$row_ = mysqli_fetch_assoc($res);
									}
								}
							}else {
								$sql_ = "SELECT MAX(cust_id) cust_id FROM bill_data WHERE username = '$user_name';";
							    $result_ = mysqli_query($conn, $sql_);
							    if (mysqli_num_rows($result_) > 0){
							       	$row_ = mysqli_fetch_assoc($result_);
							        $cust_id = $row_['cust_id'];
									$date = date("d/m/Y");
									$sql_ = "SELECT * FROM customers WHERE username = '$user_name' and cust_id = $cust_id";
							        $res = mysqli_query($conn, $sql_);
							        if (mysqli_num_rows($res) > 0){
							            $row_ = mysqli_fetch_assoc($res);
									}
								}
							}
							$html .= $row_['customer_name'];
							$html .= "</b>
								</div>
								<div style='height: 70px; margin:5px; padding-top:-5px;font-size: 15px;'>";
						$html .= $row_['addr'];
						$html .= "</div>
							</div>
						</div>
						<div style='height: 48px;'>
							<div style='height: 23px;'>
								<div style='width: 200px; margin:5px; padding-top:-5px; height: 26px;'>
									<b>Place of supply:</b><span style='font-size: 15px;'> ";
							$html .= $place_of_supply;
							$html .= " </span>
								</div>
								<div style='width: 200px; position:fixed; top:115px; left: 201px; height: 30px;'>
									<div style='margin: 5px;'><b>PAN No:</b><span style='font-size: 15px;'> ";
							$html .= $row_['pan_no'];
							$html .= "</span></div>
								</div>
							</div>
							<div style='height: 30px; margin:5px;' id='gst_cus'>
								<b>GSTIN No:</b><span style='font-size: 15px;'> ";
						$html .= $row_['gstin_no'];
						$html .= "</span>
							</div>
						</div>
					</div>
					<div style='border-bottom: 1px solid black; height: 140px; float: left; width: 340px;'>
						<div style='height: 23px; border-bottom: 1px solid black; background-color: #D3D3D3;'>
							<div style='width: 170px; height: 23px; padding-left:5px; padding-top: 1px;'><b>Invoice No. : ";
					$html .= $invoice_no;
					$html .= "</b>
							</div>
							<div style='width: 170px; text-align: right; position:fixed; top:26px; left: 170px; height: 23px;'><b>Date: ";
					$html .= $date;
					$html .= "</b>
							</div>
						</div>
						<div style='height: 177px;'>
							<div style='width: 170px; height: 23px; padding-left:5px; padding-top: 1px;'><b>Challan No. :</b>
							</div>
							<div style='width: 170px; text-align: center; position:fixed; top:49px; left: 161px; height: 23px;'><b>Date:</b>
							</div>
						</div>
					</div>
					<div style='border-bottom: 1px solid black; width:742px; height: 18px; position:relative; top:141px;'>
						<div style=' border-right: 1px solid black; float: left; height: 18px; width: 60px;'>
							<div style='text-align: center; font-size:13px;'><b>Sr No.</b></div>
						</div>
						<div style=' border-right: 1px solid black; float: left; height: 18px; width: 250px;'>
							<div style='text-align: center; font-size:13px;'><b>Description</b></div>
						</div>
						<div style='border-right: 1px solid black; float: left; height: 18px; width: 65px;'>
							<div style='text-align: center; font-size:13px;'><b>HSN</b></div>
						</div>
						<div style='border-right: 1px solid black; float: left; height: 18px; width: 80px;'>
							<div style='text-align: center; font-size:13px;'><b>TAKA No.</b></div>
						</div>
						<div style='border-right: 1px solid black; float: left; height: 18px; width: 80px;'>
							<div style='text-align: center; font-size:13px;'><b>Quantity</b></div>
						</div>
						<div style='border-right: 1px solid black;float: left; height: 18px; width: 70px;'>
							<div style='text-align: center; font-size:13px;'><b>Rate</b></div>
						</div>
						<div style='float: left; height: 18px; width: 130px;'>
							<div style='text-align: center; font-size:13px;'><b>Amount</b></div>
						</div>
					</div>
					<div style='border-bottom: 1px solid black; width:742px; height: 553px; position:relative; top:141px;'>
						<div style=' border-right: 1px solid black; float: left; height: 553px; width: 60px;'>
							<div style='text-align: center; font-size:13px;'></div>
						</div>
						<div style=' border-right: 1px solid black; float: left; height: 553px; width: 250px;'>
							<div style='text-align: center; font-size:13px;'></div>
						</div>
						<div style='border-right: 1px solid black; float: left; height: 553px; width: 65px;'>
							<div style='text-align: center; font-size:13px;'></div>
						</div>
						<div style='border-right: 1px solid black; float: left; height: 553px; width: 80px;'>
							<div style='text-align: center; font-size:13px;'></div>
						</div>
						<div style='border-right: 1px solid black; float: left; height: 553px; width: 80px;'>
							<div style='text-align: center; font-size:13px;'></div>
						</div>
						<div style='border-right: 1px solid black;float: left; height: 553px; width: 70px;'>
							<div style='text-align: center; font-size:13px;'></div>
						</div>
						<div style='float: left; height: 553px; width: 130px;'>
							<div style='text-align: center; font-size:13px;'></div>
						</div>
					</div>";
				if(isset($_GET['id'])){
					$sql_ = "SELECT * FROM billdetail WHERE bill_id = $id;";
					$result_ = mysqli_query($conn, $sql_);
					$total_quantity = 0.0;
					if (mysqli_num_rows($result_) > 0){
						$i=0;
							while($row_ = mysqli_fetch_assoc($result_)){
								$product_id = $row_['product_id'];
								$_sql = "SELECT product_name, hsn_no FROM products WHERE username = '$user_name' and product_id = $product_id;";
								$_result = mysqli_query($conn, $_sql);
								if (mysqli_num_rows($_result) > 0){
									$_row = mysqli_fetch_assoc($_result);
									$html .= "<div style='width: 60px; top: " . (159 + (23*$i)) . "px; ' id='a0'>";
									$html .= ($i+1);
									$html .= "</div><div style='width: 250px; top: " . (184 + (23*$i)) . "px; left: 65px; text-align: left;' id='a0'>";
									$html .= $_row['product_name'];
									$html .= "</div><div style='width: 65px; top: " . (184 + (23*$i)) . "px; left: 313px;' id='a0'>";
									$html .= $_row['hsn_no'];
									$html .= "</div><div style='width: 80px; top: " . (184 + (23*$i)) . "px; left: 379px;' id='a0'>";
									$html .= $row_['taka_no'];
									$html .= "</div><div style='width: 80px; top: " . (184 + (23*$i)) . "px; left: 460px;' id='a0'>";
									$html .= $row_['quantity'];
									$html .= "</div><div style='width: 70px; top: " . (184 + (23*$i)) . "px; left: 541px;' id='a0'>";
									$html .= $row_['rate'];
									$html .= "</div><div style='width: 131px; top: " . (184 + (23*$i)) . "px; left: 612px;' id='a0'>";
									$html .= (floatval($row_['quantity'])*floatval($row_['rate']));
									$html .= "</div>";
									$i++;
									$total_quantity+=floatval($row_['quantity']);
								}
						}
					}
				}else{
					$sql_ = "SELECT * FROM bill_data WHERE username = '$user_name';";
					$result_ = mysqli_query($conn, $sql_);
					$total_quantity = 0.0;
					if (mysqli_num_rows($result_) > 0){
						$i=0;
							while($row_ = mysqli_fetch_assoc($result_)){
								$product_id = $row_['product_id'];
								$_sql = "SELECT product_name, hsn_no FROM products WHERE username = '$user_name' and product_id = $product_id;";
								$_result = mysqli_query($conn, $_sql);
								if (mysqli_num_rows($_result) > 0){
									$_row = mysqli_fetch_assoc($_result);
									$html .= "<div style='width: 60px; top: " . (159 + (23*$i)) . "px; ' id='a0'>";
									$html .= ($i+1);
									$html .= "</div><div style='width: 250px; top: " . (184 + (23*$i)) . "px; left: 65px; text-align: left;' id='a0'>";
									$html .= $_row['product_name'];
									$html .= "</div><div style='width: 65px; top: " . (184 + (23*$i)) . "px; left: 313px;' id='a0'>";
									$html .= $_row['hsn_no'];
									$html .= "</div><div style='width: 80px; top: " . (184 + (23*$i)) . "px; left: 379px;' id='a0'>";
									$html .= $row_['taka_no'];
									$html .= "</div><div style='width: 80px; top: " . (184 + (23*$i)) . "px; left: 460px;' id='a0'>";
									$html .= $row_['quantity'];
									$html .= "</div><div style='width: 70px; top: " . (184 + (23*$i)) . "px; left: 541px;' id='a0'>";
									$html .= $row_['rate'];
									$html .= "</div><div style='width: 131px; top: " . (184 + (23*$i)) . "px; left: 612px;' id='a0'>";
									$html .= (floatval($row_['quantity'])*floatval($row_['rate']));
									$html .= "</div>";
									$i++;
									$total_quantity+=floatval($row_['quantity']);
								}
						}
					}
				}
				$html .= "</div>
				<div style='border-bottom: 1px solid black; width:742px; height: 18px; position:relative; top:140px; font-size: 12px;'>
					<div style='border-right: 1px solid black; height: 18px; width: 540px;'>
						<div style='text-align:left; padding-left: 5px; padding-top: 1px; height: 18px; width: 100px;'>
						<b>Note:</b>
						</div>
						<div style='text-align:right; padding-right: 5px; padding-top: 1px; height: 18px; width: 435px; position:relative; top:-18px; left:100px;'>
						<b>";
				$html .= $total_quantity;
				$html .= "</b>
						</div>
					</div>
					<div style='height: 18px; width: 201px; position:relative; top:-18px; left:540px;'>
						<div style='text-align:left; padding-left: 5px; padding-top: 1px; height: 18px; width: 90px;'>
						<b>Sub Total:</b>
						</div>
						<div style='text-align:right; padding-right: 5px; padding-top: 1px; height: 18px; width: 106px; position:relative; top:-18px; left:90px;'>
						<b>";
				$html .= $sub_total;
				$html .= "</b>
						</div>
					</div>
				</div>
				<div style='width:742px; height: 187px; position:relative; top:137px;'>
					<div style='border-right: 1px solid black; float: left; height: 187px; width: 540px; font-size: 12px;'>
						<div style='border-bottom: 1px solid black; height:35px;'>
							<div style='height:17px;'>
								<div style=' height:17px; width: 270px;'>
									<div style=' height:17px; width: 80px; padding-left:5px; padding-top: 2px;'>
										<b>Bank Name</b>
									</div>
									<div style=' height:17px; width: 190px; position:relative; left: 80px; top:-17px; padding-top: 2px;'>
										<b>:</b>";
										$html .= $row['bank_name'];
										$html .= "</div>
								</div>
								<div style=' height:17px; width: 270px; position:relative; left: 270px; top:-17px;'>
									<div style=' height:17px; width: 80px; padding-top: 2px;' >
										<b>A/c No.</b>
									</div>
									<div style=' height:17px; width: 190px; position:relative; left: 80px; top:-17px; padding-top: 2px;'>
										<b>:</b>";
										$html .= $row['bank_ac_number'];
										$html .= "</div>
								</div>
							</div>
							<div style='height:17px;'>
								<div style=' height:17px; width: 270px;'>
									<div style=' height:17px; width: 80px; padding-left:5px; padding-top: 2px;'>
										<b>Branch</b>
									</div>
									<div style=' height:17px; width: 190px; position:relative; left: 80px; top:-17px; padding-top: 2px;'>
										<b>:</b>";
										$html .= $row['bank_branch_name'];
										$html .= "</div>
								</div>
								<div style=' height:17px; width: 270px; position:relative; left: 270px; top:-17px;'>
									<div style=' height:17px; width: 80px; padding-top: 2px;'>
										<b>IFSC Code.</b>
									</div>
									<div style=' height:17px; width: 190px; position:relative; left: 80px; top:-17px; padding-top: 2px;'>
										<b>:</b>";
										$html .= $row['ifsc_code'];
										$html .= "</div>
								</div>
							</div>
						</div>
						<div style='border-bottom: 1px solid black; height:53px; font-size: 12px;'>
							<div style='height:26px; width: 540px;'>
								<div style='width: 70px; height:26px;'>
									<div style=' height:26px; width: 70px; padding-left:5px;'>
										<b>Totle GST</b>
									</div>
								</div>
								<div style='width: 470px; height:26px; position:relative; left: 70px; top:-26px;'>
									<div style=' height:26px; width: 470px; text-transform: capitalize;'>
										<b> : </b><i>";
										$html .= to_word(round(floatval($sub_total)*0.05, 2));
										$html .= "</i>
									</div>
								</div>
							</div>
							<div style='height:26px; width: 540px;'>
								<div style='width: 90px; height:26px;'>
									<div style=' height:26px; width: 90px; padding-left:5px;'>
										<b>Rs. (in words)</b>
									</div>
								</div>
								<div style='width: 450px; height:26px; position:relative; left: 90px; top:-26px;'>
									<div style=' height:26px; width: 450px; text-transform: capitalize;'>
										<b> : <i>";
										$html .= to_word(floatval($grand_total));
										$html .= "</i></b>
									</div>
								</div>
							</div>
						</div>
						<div style='height: 99px; width: 540px; font-size: 12px;'>
							<div style='border-right: 1px solid black; height: 98px; width: 300px; float: left; padding-left:5px;'>
								<b>Terms & Condition :</b><br>
								<ol style='margin-top:0px; margin-bottom:5px;'>
									<li>Goods Once Sold Will Not Be Accepted.</li>
									<li>Interest @ 24% will be charged from the due date.</li>
									<li>Any claims for quality must be made within 3 days.</li>
									<li>Subject to SURAT Jurisdiction Only. E.&.O.E</li>
								</ol>
							(Receiver Signatory _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ )
							</div>
							<div style='border-bottom: 1px solid black; width: 229px; height:18px; position:relative; left: 306px; padding-left:5px;'>
								<div style=' height:19px; width: 229px;'>
									<b>Date :</b>
								</div>
							</div>
							<div style='border-bottom: 1px solid black; width: 229px; height:19px; position:relative; left: 306px; padding-left:5px;'>
								<div style=' height:19px; width: 229px;'>
									<b>Chaque No. :</b>
								</div>
							</div>
							<div style='border-bottom: 1px solid black; width: 229px; height:19px; position:relative; left: 306px; padding-left:5px;'>
								<div style=' height:19px; width: 229px;'>
									<b>Bank :</b>
								</div>
							</div>
							<div style='border-bottom: 1px solid black; width: 229px; height:19px; position:relative; left: 306px; padding-left:5px;'>
								<div style=' height:19px; width: 229px;'>
									<b>Amount :</b>
								</div>
							</div>
							<div style='border-bottom: 1px solid black; width: 229px; height:18px; position:relative; left: 306px; padding-left:5px;'>
								<div style=' height:19px; width: 229px;'>
									<b>Bill No. :</b>
								</div>
							</div>
						</div>
					</div>
					<div style='border-bottom: 1px solid black; width: 202px; height: 187px; position:relative; left: 540px;'>
						<div style='border-bottom: 1px solid black; width: 202px; height:60px; font-size: 12px;'>
							<div style='width: 202px; height:18px; padding-top: 2px;'>
								<div style='width: 65px; height:18px; float: left; padding-left: 5px;'>
									CGST
								</div>
								<div style='width: 65px; height:18px; position:relative; left: 65px; text-align: center;'>
									2.5%
								</div>
								<div style='width: 67px; height:18px; position:relative; left: 130px; top:-18px; text-align: right; margin-right: 5px;'>";
								$html .= round(floatval($sub_total)*0.025, 2);
								$html .= "</div>
							</div>
							<div style='width: 202px; height:18px;'>
								<div style='width: 65px; height:18px; float: left; padding-left: 5px;'>
									SGST
								</div>
								<div style='width: 65px; height:18px; position:relative; left: 65px; text-align: center;'>
									2.5%
								</div>
								<div style='width: 67px; height:18px; position:relative; left: 130px; top:-18px; text-align: right; margin-right: 5px;'>";
								$html .= round(floatval($sub_total)*0.025, 2);
								$html .= "</div>
							</div>
							<div style='width: 202px; height:24px; margin-top: 3px;'>
								<div style='width: 80px; height:18px; float: left; padding-left: 5px;'>
									Round Of
								</div>
								<div style='width: 117px; height:18px; position:relative; left: 80px; text-align: right; margin-right: 5px;'>";
								$html .= $round_off;
								$html .= "</div>
							</div>
						</div>
						<div style='border-bottom: 1px solid black; width: 202px; height:24px; font-size: 14px; margin-top: 5px;'>
							<div style='width: 90px; height:18px; float: left; padding-left: 5px;'>
								<b>Grand Total</b>
							</div>
							<div style='width: 107px; height:18px; position:relative; left: 90px; text-align: right; margin-right: 5px;'><b>";
							$html .= $grand_total;
							$html .= "</b></div>
						</div>
						<div style='height:24px; font-size: 14px; margin-top: 5px; font-size: 13px; text-align: right; margin-right: 5px; text-transform: uppercase;'>
							<b>For, ";
							$html .= $row['company_name'];
							$html .= "</b>
						</div>
						<div style='height:24px; font-size: 14px; margin-top: 5px;'>
						</div>
						<div style='height:24px; font-size: 14px; margin-top: 5px; text-align: right; margin-right: 5px; margin-top: 10px;'>
						<i>(Authorised Signatory)</i>
						</div>
					</div>
				</div>
			</div>
		</body></html>";
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4','portrait');
    $dompdf->render();
    $dompdf->stream("Weblesson",array("Attachment"=>0));
?>
