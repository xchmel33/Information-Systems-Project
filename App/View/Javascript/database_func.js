let script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);


function validate_login(email,password,callback) {
    $.ajax({
        url: 'login/validate',
        type: 'post',
        dataType: 'html',
        data: {
            email: email,
            password: password
        },
        success: function (response){
            callback(response);
        }
    });
}

function register(username,password,email,address,callback){
    $.ajax({
        url: 'login/register',
        type: 'post',
        dataType: 'html',
        data: {
            email: email,
            password: password,
            username: username,
            address: address
        },
        success: function (response){
            callback(response);
        }
    });
}



