$(document).ready(() => {

    $('#login-form').on("submit", (e) => {
        e.preventDefault();
    });

    $('#login').click(() => {
        $.ajax({
            url: 'php/login.php',
            type: 'POST',
            processData: false,
            contentType: false,
            data: new FormData(document.getElementById('login-form')),
            success: (response) => {
                let msg = JSON.parse(response);
                if(msg['error'] != null){
                    $('.error-txt').css("display", "block").html(`${msg['error']}`);
                }
                if(msg['success'] != null){
                    $('.success-txt').css("display", "block").html(`${msg['success']}`);
                    
                    var form = $(`
                        <form action='profile.php' method='POST' hidden>
                            <input type='text' name='user_id' value='${msg['user_id']}'>
                        </form>
                    `);
                    
                    $('body').append(form);
                    form.submit();
                }
            }
        })
    });

});