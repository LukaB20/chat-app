$(document).ready(() => {

    $('#register-form').on('submit', (e) => {
        e.preventDefault();
    })

    $('#register').click(function () {
        $.ajax({
            url: "php/register.php",
            type: "POST",
            processData: false,
            contentType: false,
            data: new FormData(document.getElementById("register-form")),
            success: (response) => {
                let msg = JSON.parse(response);
                if(msg['error'] != null){
                    $('.error-txt').css("display", "block").html("All fields are required.");
                }
                if(msg['success'] != null){
                    $('.success-txt').css("display", "block").html("You have successfuly signed up. <a href='index.php'>Login now</a>")
                    $('.error-txt').css("display", "none");
                }
                if(msg['emailerror'] != null){
                    $('.error-txt').css("display", "block").html(`${msg['emailerror']}`);
                }
                if(msg['imageexterror'] != null){
                    $('.error-txt').css("display", "block").html(`${msg['imageexterror']}`);
                }
                if(msg['imagesizeerror'] != null){
                    $('.error-txt').css("display", "block").html(`${msg['imagesizeerror']}`);
                }
                if(msg['failedupload'] != null){
                    $('.error-txt').css("display", "block").html(`${msg['failed']}`);
                }
                if(msg['failed'] != null){
                    $('.error-txt').css("display", "block").html(`${msg['failed']}`);
                }
                if(msg['faildberrored'] != null){
                    $('.error-txt').css("display", "block").html(`${msg['dberror']}`);
                }
            }
        });
    })
});