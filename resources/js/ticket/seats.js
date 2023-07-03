$(()=>{
    $('input[type=checkbox]').on('change', function (e) {
        if ($('input[type=checkbox]:checked').length > 6) {
            $(this).prop('checked', false);
            alert("You can only book 6 Tickets");
        } else if ($('input[type=checkbox]:checked').length <= 0){
            $('input[type=submit]').prop('disabled', true);
        } else {
            $('input[type=submit]').prop('disabled', false);
        }
    });

    if ($('input[type=checkbox]:checked').length <= 0){
        $('input[type=submit]').prop('disabled', true);
    } else {
        $('input[type=submit]').prop('disabled', false);
    }
})