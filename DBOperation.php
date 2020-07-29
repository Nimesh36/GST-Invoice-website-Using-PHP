<?php
    include ("DBconfig.php");
    if(isset($_GET['log1'])){
        $user_name = $_REQUEST['Message'];
        $company_name = $_POST['company_name'];
        $addr = $_POST['addr'];
        $phone_no_1 = $_POST['phone_no_1'];
        $phone_no_2 = $_POST['phone_no_2'];
        $gstin_no = $_POST['gstin_no'];
        $pan_no = $_POST['pan_no'];
        $email = $_POST['email'];
        $bank_name = $_POST['bank_name'];
        $bank_branch_name = $_POST['bank_branch_name'];
        $bank_ac_number = $_POST['bank_ac_number'];
        $ifsc_code = $_POST['ifsc_code'];
        $sql = "SELECT * FROM user_detail where username = '$user_name';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) <= 0){
            $sql = "INSERT INTO user_detail VALUES('$user_name','$company_name','$addr',
                '$phone_no_1','$phone_no_2','$gstin_no','$pan_no','$email','$bank_name',
                '$bank_branch_name','$bank_ac_number','$ifsc_code');";
            if ($res = mysqli_query($conn, $sql))
                header("Location:dashboard.php");
            else
                die(mysqli_error($conn));
        }else {
            $sql = "UPDATE user_detail SET company_name = '$company_name', addr='$addr',
                phone_no_1 = '$phone_no_1', phone_no_2 = '$phone_no_2' , gstin_no = '$gstin_no',
                pan_no = '$pan_no', email = '$email', bank_name = '$bank_name' , bank_branch_name = '$bank_branch_name',
                bank_ac_number = '$bank_ac_number', ifsc_code = '$ifsc_code' WHERE user_detail.username = '$user_name';";
            if ($res = mysqli_query($conn, $sql))
                header("Location:dashboard.php");
            else
                die(mysqli_error($conn));
        }
    }
    elseif (isset($_GET['log2'])) {
        $user_name = $_REQUEST['Message'];
        $customer_name = $_POST['customer_name'];
        $addr = $_POST['addr'];
        $phone_no = $_POST['phone_no'];
        $gstin_no = $_POST['gstin_no'];
        $pan_no = $_POST['pan_no'];
        $sql = "SELECT MAX(cust_id)+1 cust_id FROM customers WHERE username = '$user_name';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $sql = "INSERT INTO customers VALUES({$row['cust_id']},
                '$customer_name', '$addr', '$gstin_no', '$pan_no', '$phone_no', '$user_name');";
            if ($res = mysqli_query($conn, $sql))
                header("Location:pages/forms/customer-forms.php");
            else
                die(mysqli_error($conn));
        }
        else
           die(mysqli_error($conn));
    }
    elseif (isset($_GET['log3'])) {
        $user_name = $_REQUEST['Message'];
        $cust_id = $_REQUEST['cust_id'];
        $customer_name = $_POST['customer_name'];
        $addr = $_POST['addr'];
        $phone_no = $_POST['phone_no'];
        $gstin_no = $_POST['gstin_no'];
        $pan_no = $_POST['pan_no'];
        $sql = "UPDATE customers SET customer_name = '$customer_name', addr = '$addr', gstin_no = '$gstin_no', pan_no = '$pan_no', phone_no = '$phone_no'
            where cust_id = $cust_id AND username = '$user_name';";
        if ($res = mysqli_query($conn, $sql))
            header("Location:pages/forms/customer-forms.php");
        else
            die(mysqli_error($conn));
    }
    elseif (isset($_GET['log4'])) {
        $user_name = $_REQUEST['Message'];
        $cust_id = $_REQUEST['cust_id'];
        $sql = "DELETE FROM customers WHERE cust_id = $cust_id AND username = '$user_name';";
        if ($res = mysqli_query($conn, $sql))
            header("Location:pages/forms/customer-forms.php");
        else
            die(mysqli_error($conn));
    }
    elseif (isset($_GET['log5'])) {
        $user_name = $_REQUEST['Message'];
        $product_name = $_POST['product_name'];
        $available_quantity = $_POST['available_quantity'];
        $rate = $_POST['rate'];
        $hsn = $_POST['hsn'];
        $dealer_name = $_POST['dealer_name'];
        $sql = "SELECT MAX(product_id)+1 product_id FROM products WHERE username = '$user_name';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            if($hsn!=NULL){
            $sql = "INSERT INTO products (product_id, product_name, available_quantity, hsn_no, rate, dealer_name, username) VALUES({$row['product_id']},
                '$product_name', '$available_quantity', $hsn, '$rate', '$dealer_name', '$user_name');";
            }
            else{
                $sql = "INSERT INTO products (product_id, product_name, available_quantity, rate, dealer_name, username) VALUES({$row['product_id']},
                    '$product_name', '$available_quantity', '$rate', '$dealer_name', '$user_name');";
            }
            if ($res = mysqli_query($conn, $sql))
                header("Location:pages/forms/product-forms.php");
            else
                die(mysqli_error($conn));
        }
        else
           die(mysqli_error($conn));
    }
    elseif (isset($_GET['log6'])) {
        $user_name = $_REQUEST['Message'];
        $product_id = $_REQUEST['product_id'];
        $product_name = $_POST['product_name'];
        $rate = $_POST['rate'];
        $hsn = $_POST['hsn'];
        $available_quantity = $_POST['available_quantity'];
        $dealer_name = $_POST['dealer_name'];
        if($hsn!=NULL){
            $sql = "UPDATE products SET product_name = '$product_name', available_quantity = '$available_quantity', hsn_no = $hsn, dealer_name = '$dealer_name' , rate = '$rate'
            WHERE product_id = $product_id AND username = '$user_name';";
        }
        else{
            $sql = "UPDATE products SET product_name = '$product_name', available_quantity = '$available_quantity', dealer_name = '$dealer_name' , rate = '$rate'
                WHERE product_id = $product_id AND username = '$user_name';";
        }
        if ($res = mysqli_query($conn, $sql))
            header("Location:pages/forms/product-forms.php");
        else
            die(mysqli_error($conn));
    }
    elseif (isset($_GET['log7'])) {
        $user_name = $_REQUEST['Message'];
        $product_id = $_REQUEST['product_id'];
        $sql = "DELETE FROM products WHERE product_id = $product_id AND username = '$user_name';";
        if ($res = mysqli_query($conn, $sql))
            header("Location:pages/forms/product-forms.php");
        else
            die(mysqli_error($conn));
    }
    elseif (isset($_POST['log8'])) {
        $user_name = $_POST['Message'];
        $product_id = $_POST['product_id'];
        $sql = "SELECT rate FROM products WHERE product_id = $product_id AND username = '$user_name';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo $row["rate"];
        } else {
            echo "0.00";
        }
    }
    elseif (isset($_POST['log9'])) {
        $user_name = $_POST['Message'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $rate = $_POST['rate'];
        $taka_no = $_POST['taka_no'];
        $sql = "SELECT MAX(id)+1 id FROM bill_data WHERE username = '$user_name'; ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if($row['id']==NULL)
                $id = 1;
            else {
                $id = $row['id'];
            }
        }
        if($taka_no){
            $sql = "INSERT INTO bill_data (id, product_id, quantity, taka_no, username, rate) VALUES($id, $product_id, '$quantity', $taka_no, '$user_name', '$rate'); ";
        }else {
            $sql = "INSERT INTO bill_data (id, product_id, quantity, username, rate) VALUES($id, $product_id, '$quantity', '$user_name', '$rate'); ";
        }
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $sql = "SELECT COUNT(id) count FROM bill_data WHERE username = '$user_name';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo $row["count"];
            }else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }
    elseif (isset($_POST['log10'])) {
        $user_name = $_POST['Message'];
        $id = $_POST['id'];
        $rate = $_POST['rate'];
        $taka_no = $_POST['taka_no'];
        if($taka_no!=NULL){
            $sql = "UPDATE bill_data SET rate = '$rate', taka_no = $taka_no WHERE id = $id AND username = '$user_name';";
        }
        else {
            $sql = "UPDATE bill_data SET rate = '$rate' WHERE id = $id AND username = '$user_name';";
        }
        if ($res = mysqli_query($conn, $sql))
            echo 1;
        else
            echo 0;
    }
    elseif (isset($_POST['log11'])) {
        $user_name = $_POST['Message'];
        $id = $_POST['id'];
        $sql = "DELETE FROM bill_data WHERE id = $id AND username = '$user_name';";
        if ($res = mysqli_query($conn, $sql))
            echo 1;
        else
            echo 0;
    }
    elseif (isset($_POST['log12'])) {
        $user_name = $_POST['Message'];
        $id = $_POST['cust_id'];
        $sql = "UPDATE bill_data SET cust_id = $id WHERE username = '$user_name';";
        if ($res = mysqli_query($conn, $sql))
            echo 1;
        else
            echo 0;
    }
    elseif (isset($_POST['log13'])) {
        $user_name = $_POST['Message'];
        $sql = "SELECT cust_id FROM bill_data WHERE username = '$user_name';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            while( $row = mysqli_fetch_assoc($result)){
                if($row["cust_id"]==""){
                    echo 0;
                }
            }
        }
        else {
            echo 0;
        }
    }
    elseif (isset($_POST['log14'])) {
        $user_name = $_POST['Message'];
        $sub_total = $_POST['subtotal'];
        $grand_total = $_POST['grandtotal'];
        $round_off = $_POST['roundoff'];
        $invoice_no = $_POST['invoice_no'];
        $place_of_supply = $_POST['place_of_supply'];
        $sql = "SELECT MAX(cust_id) cust_id FROM bill_data WHERE username = '$user_name';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $cust_id = $row['cust_id'];
            $sql = "SELECT * FROM bill_list WHERE username = '$user_name' and invoice_no = '$invoice_no';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0){
                date_default_timezone_set("Asia/Calcutta");
                $date = date('Y-m-d');
                $time = date("H:i:s");
                $sql = "INSERT INTO bill_list (username, invoice_no, sub_total, grand_total, round_off, cust_id, place_of_supply, date, time) VALUES('$user_name', '$invoice_no', '$sub_total', '$grand_total', '$round_off', $cust_id, '$place_of_supply', '$date', '$time');";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $sql = "SELECT bill_id FROM bill_list WHERE username = '$user_name' and invoice_no = '$invoice_no';";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_assoc($result);
                        $bill_id = $row['bill_id'];
                        $sql = "SELECT * FROM bill_data WHERE username = '$user_name';";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0){
                            while( $row = mysqli_fetch_assoc($result)){
                                $product_id = $row['product_id'];
                                $quantity = $row['quantity'];
                                $taka_no = $row['taka_no'];
                                $rate = $row['rate'];
                                $sqlq = "SELECT available_quantity FROM products WHERE username = '$user_name' and product_id = $product_id;";
                                $res = mysqli_query($conn, $sqlq);
                                if (mysqli_num_rows($res) > 0){
                                    $rowq = mysqli_fetch_assoc($res);
                                    $available_quantity = $rowq['available_quantity'];
                                    if($taka_no){
                                        $sql_ = "INSERT INTO billdetail (bill_id, product_id, quantity, taka_no, rate) VALUES($bill_id, $product_id, '$quantity', $taka_no, '$rate');";
                                    }
                                    else {
                                        $sql_ = "INSERT INTO billdetail (bill_id, product_id, quantity, rate) VALUES($bill_id, $product_id, '$quantity', '$rate');";
                                    }
                                    $result_ = mysqli_query($conn, $sql_);
                                    if($result_){
                                        $available_quantity = floatval($available_quantity)-floatval($quantity);
                                        $sql_ = "UPDATE products SET available_quantity = '$available_quantity' WHERE username = '$user_name' and product_id = $product_id;";
                                        $result_ = mysqli_query($conn, $sql_);
                                        if(!$result_){
                                            echo 0;
                                        }
                                    }
                                    else {
                                        echo 0;
                                    }
                                }
                                else {
                                    echo 0;
                                }
                            }
                            $sql = "DELETE FROM bill_data WHERE username = '$user_name';";
                            $result = mysqli_query($conn, $sql);
                            if(!$result){
                                echo 0;
                            }
                        }
                        else {
                            echo 0;
                        }
                    }
                    else {
                        echo 0;
                    }
                }
                else {
                    echo 0;
                }
            }
            else {
                echo 0;
            }
        }
        else {
            echo 0;
        }
    }
    elseif (isset($_POST['log15'])) {
        $user_name = $_POST['Message'];
        $sql = "SELECT id FROM bill_data WHERE username = '$user_name';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            while( $row = mysqli_fetch_assoc($result)){
                if($row["id"]==""){
                    echo 0;
                }
            }
        }
        else {
            echo 0;
        }
    }
    elseif (isset($_POST['log16'])) {
        $user_name = $_POST['Message'];
        $sql = "DELETE FROM bill_data WHERE username = '$user_name';";
        $result = mysqli_query($conn, $sql);
        if (!$result){
            echo 0;
        }
    }
    elseif (isset($_POST['log17'])) {
        $user_name = $_POST['Message'];
        $sql = "SELECT DATE_FORMAT(MIN(date), '%d/%m/%Y') date, time FROM bill_list where username = '$user_name';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            echo $row['date'];
        }
    }
    elseif (isset($_POST['log18'])) {
        $user_name = $_POST['Message'];
        if(isset($_POST['from'])){
            $from = $_POST['from'];
        }
        else {
            $sql = "SELECT DATE_FORMAT(MIN(date), '%d/%m/%Y') date, time FROM bill_list where username = '$user_name';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $from = $row['date'];
            }
            else{
                $from = date("d/m/Y");
            }
        }
        if(isset($_POST['to'])){
            $to = $_POST['to'];
        }
        else {
            $to = date("d/m/Y");
        }
        $date = DateTime::createFromFormat('d/m/Y', $from);
        $from = $date->format('Y-m-d');
        $date = DateTime::createFromFormat('d/m/Y', $to);
        $to = $date->format('Y-m-d');

        $sql = "SELECT bill_id, cust_id, invoice_no, sub_total, grand_total, DATE_FORMAT(date, '%d/%m/%Y') date, time FROM bill_list where username = '$user_name' AND date >= '$from' AND date <= '$to';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $sql = "SELECT customer_name, addr FROM customers WHERE username = '$user_name' AND cust_id = $row[cust_id];";
                $result_ = mysqli_query($conn, $sql);
                $row_ = mysqli_fetch_assoc($result_);
                $data[] = array(
                	"bill_id"=>$row['bill_id'],
                	"invoice_no"=>$row['invoice_no'],
                    "customer_name"=>$row_['customer_name'],
                    "addr"=>$row_['addr'],
                    "sub_total"=>$row['sub_total'],
                    "grand_total"=>$row['grand_total'],
                	"date"=>$row['date'],
                    "time"=>$row['time'],
                    'data'=>"<div class='mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3'><div class='mdc-layout-grid__cell mdc-layout-grid__cell--span-1-desktop'><div onclick='open_onclick(this);' style='padding: 0px 12px 0px 12px' class='mdc-toolbar__icon toggle mdc-ripple-surface' data-mdc-auto-init='MDCRipple'><i class='material-icons' style='color:#00a9f4'>open_in_browser</i></div></div><div class='mdc-layout-grid__cell mdc-layout-grid__cell--span-1-desktop'><div class='mdc-toolbar__icon toggle mdc-ripple-surface' onclick='delete_onclick(this);' style='padding: 0px 12px 0px 12px' data-mdc-auto-init='MDCRipple'><i class='material-icons' style='color:#00a9f4'>delete</i></div></div></div>"
                );
            }
            file_put_contents("json/json_file.json", "{\"data\":" . json_encode($data) . "}");
        }
        else{
            echo 'No data found';
        }
    }
    elseif (isset($_POST['log19'])) {
        $user_name = $_POST['Message'];
        $sql = "SELECT * FROM bill_data where username = '$user_name';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $sql = "SELECT product_name FROM products WHERE username = '$user_name' AND product_id = $row[product_id];";
                $result_ = mysqli_query($conn, $sql);
                $row_ = mysqli_fetch_assoc($result_);
                $data[] = array(
                	"id"=>$row['id'],
                	"product_id"=>$row['product_id'],
                    "product_name"=>$row_['product_name'],
                    "quantity"=>$row['quantity'],
                    "taka_no"=>$row['taka_no'],
                	"rate"=>$row['rate'],
                    'data'=>"<div class='mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3'><div class='mdc-layout-grid__cell mdc-layout-grid__cell--span-1-desktop'><div onclick='edit_onclick(this);' style='padding: 0px 24px 0px 24px' class='mdc-toolbar__icon toggle mdc-ripple-surface' data-mdc-auto-init='MDCRipple'><i class='material-icons' style='color:#00a9f4'>edit</i></div></div><div class='mdc-layout-grid__cell mdc-layout-grid__cell--span-1-desktop'><div class='mdc-toolbar__icon toggle mdc-ripple-surface' data-mdc-auto-init='MDCRipple' onclick='save_onclick(this);' style='padding: 0px 24px 0px 24px'><i class='material-icons' style='color:#00a9f4'>save</i></div></div><div class='mdc-layout-grid__cell mdc-layout-grid__cell--span-1-desktop'><div class='mdc-toolbar__icon toggle mdc-ripple-surface' onclick='delete_onclick(this);' style='padding: 0px 24px 0px 24px' data-mdc-auto-init='MDCRipple'><i class='material-icons' style='color:#00a9f4'>delete</i></div></div></div>"
                );
            }
            file_put_contents("json/json_file.json", "{\"data\":" . json_encode($data) . "}");
        }
        else{
            echo '0';
            file_put_contents("json/json_file.json", "{\"data\":[]}");
        }
        $sql = "SELECT COUNT(id) count FROM bill_data WHERE username = '$user_name';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo $row["count"];
        }else {
            echo '0';
        }
    }
    elseif (isset($_POST['log20'])) {
        $user_name = $_POST['Message'];
        $sql = "DELETE FROM bill_data WHERE username = '$user_name';";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $id = $_POST['id'];
            $sql = "SELECT * FROM billdetail WHERE bill_id = $id;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $id = 1;
                while($row = mysqli_fetch_assoc($result)){
                    $product_id  = $row['product_id'];
                    $quantity = $row['quantity'];
                    $taka_no = $row['taka_no'];
                    $rate = $row['rate'];
                    if($taka_no){
                        $sql_ = "INSERT INTO bill_data (id, product_id, quantity, taka_no, username, rate, cust_id) VALUES($id, $product_id, '$quantity', $taka_no, '$user_name', '$rate', 6); ";
                    }
                    else {
                        $sql_ = "INSERT INTO bill_data (id, product_id, quantity, username, rate, cust_id) VALUES($id, $product_id, '$quantity', '$user_name', '$rate', 6); ";
                    }
                    $result_ = mysqli_query($conn, $sql_);
                    if (!$result_) {
                        echo 0;
                    }
                    $id++;
                }
            }
        }
        else {
            echo 0;
        }
    }
    elseif (isset($_POST['log21'])) {
        $user_name = $_POST['Message'];
        $id = $_POST['id'];
        $sql = "SELECT * FROM bill_list WHERE bill_id = $id;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "create-bill.php?subtotal=" . $row['sub_total'] . "&grandtotal=" . $row['grand_total'] . "&roundoff=" . $row['round_off'] . "&invoice_no=" .$row['invoice_no'] . "&place_of_supply=" . $row['place_of_supply'] . "&id=" . $id;
        }
    }

    elseif (isset($_POST['log22'])) {
        $user_name = $_POST['Message'];
        $id = $_POST['id'];
        $sql = "SELECT * FROM billdetail WHERE bill_id = $id;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $product_id = $row['product_id'];
                $sqlq = "SELECT available_quantity FROM products WHERE username = '$user_name' and product_id = $product_id;";
                $res = mysqli_query($conn, $sqlq);
                if (mysqli_num_rows($res) > 0){
                    $rowq = mysqli_fetch_assoc($res);
                    $available_quantity = floatval($rowq['available_quantity']);
                    $available_quantity += floatval($row['quantity']);
                    $sqlq = "UPDATE products set available_quantity = $available_quantity WHERE username = '$user_name' and product_id = $product_id;";
                    $res = mysqli_query($conn, $sqlq);
                    if($res){
                        $sqlq = "DELETE FROM bill_list WHERE bill_id = $id";
                        $res = mysqli_query($conn, $sqlq);
                        $sqlq = "DELETE FROM billdetail WHERE bill_id = $id";
                        $res = mysqli_query($conn, $sqlq);
                    }else{
                        echo 0;
                    }
                }
                else {
                    echo 0;
                }
            }
        }
        else {
            echo 0;
        }
    }
    mysqli_close($conn);
?>
