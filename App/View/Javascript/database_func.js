let script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);


function validate_login(user_type,email,password,callback) {
    $.ajax({
        url: 'login/validate_login',
        type: 'post',
        dataType: 'html',
        data: {
            email: email,
            password: password,
            user_type: user_type
        },
        success: function (response){
            callback(response);
        }
    });
}

function validate_register(username,password,email,country,city,callback){
    $.ajax({
        url: 'login/validate_register',
        type: 'post',
        dataType: 'html',
        data: {
            email: email,
            password: password,
            username: username,
            country: country,
            city: city,
        },
        success: function (response){
            callback(response);
        }
    });
}
function logout(){
    $.ajax({
        url: 'login/logout',
        type: 'post',
        dataType: 'html',
        success: function (response){
            document.location = 'home';
        }
    });
}



