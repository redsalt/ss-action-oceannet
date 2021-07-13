let email = $('#email');
let pw = $('#pw');
let pw_check = $('#pw_check')
let btn = $('#btn');

// var password = document.getElementById("pw");
var confirm_pw = document.getElementById("pw_check");

$(email).blur(function() {
    if($(email).val() != "") {
        // alert("invalid-email");
        // document.forms[0].classList.add("invalid-email");
        $(email).next('label').addClass('invalid-email');
    }
    else {
        // document.forms[0].classList.remove("invalid-email");
        $(email).next('label').removeClass('invalid-email');
    }
});

$(pw_check).keypress(function() {
    // alert("invalid-pw-confirm");
    confirm_pw.setCustomValidity('');
});

$(btn).on('click', function() {
    if($(email).val() == "") {
        $(email).next('label').addClass('warning');
        setTimeout(function() {
            $('label').removeClass('warning');
        },1500);
    }
    else if ($(pw).val() == "") {
        $(pw).next('label').addClass('warning');
        setTimeout(function() {
            $('label').removeClass('warning')
        },1500);
    }
    else if($(pw).val() != $(pw_check).val()){
        $(pw_check).next('label').addClass('warning');
        setTimeout(function() {
            $('label').removeClass('warning')
        },1500);
        $(pw_check).next('label').addClass('invalid-pw-confirm');
        confirm_pw.setCustomValidity("입력하신 비밀번호와 맞지 않습니다.");
    }
});

// function validatePassword(){
// 	if(pw.value != confirm_pw.value) {
// 		confirm_pw.setCustomValidity("Passwords Don't Match");
// 	} else {
// 		confirm_pw.setCustomValidity('');
// 	}
// }

// pw.onchange = validatePassword;
// confirm_pw.onkeyup = validatePassword;