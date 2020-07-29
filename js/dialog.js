$(document).ready(function(){
    $.fn.myFunction = function(){
    var dialog = new mdc.dialog.MDCDialog(document.querySelector('#' + $(this).attr("target-dialog")));
    dialog.show();
    }
});
