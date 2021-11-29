let script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);


function validate_login(email,password,callback) {
    $.ajax({
        url: 'login/validate_login',
        type: 'post',
        dataType: 'html',
        data: {
            email: email,
            password: password,
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

function upload_image(fd,callback) {
    $.ajax({
        url: 'create_auction/upload_image',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function (response) {
            callback(response);
        },
    });
}
function getTimer(end_time,element){
    let x =setInterval(function () {
        let countDownDate = new Date(end_time).getTime();
        let now = new Date().getTime();
        let distance = countDownDate - now;
        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        element.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
        if (distance < 0) {
            clearInterval(x);
            element.innerHTML = "Ended";
        }
    },1000);
}


