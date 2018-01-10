$(document).ready(function () {
    $('input[type="checkbox"]').click(function () {
        if($(this).prop('checked') == true){
            console.log('checked');
            //$(this).parent().closest('input[type="hidden"]').val(1);
            $(this).next('input[type="hidden"]').val(1);
        }else {
            console.log('not checked');
            $(this).next('input[type="hidden"]').val(0);
        }
    });
});