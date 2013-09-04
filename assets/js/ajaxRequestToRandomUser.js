$(document).ready(function() {
    // And start logging
    startLogging();
});

function startLogging() {
    $.ajax({
        url: 'http://randomuser.me/g/?results=5',
        dataType: 'JSON',
        success: function(user) {
            $.ajax({
                url: '?addUser=true',
                dataType: 'JSON',
                type: 'POST',
                data: user,
                success: function(answer) {
                    if (answer.status == 'success') {
                        startLogging();
                        $('.generated').css('display', 'block');
                        $('.generatedUsers').val(parseInt($('.generatedUsers').val()) + parseInt(5));
                        $('.generated').html($('.generatedUsers').val() + ' Users generated.');
                    }
                }
            });
        }
    });
}