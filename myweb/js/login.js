function check_input(){
    if(!document.login_form.user_id.value){
        alert("아이디를 입력하세요");
        document.login_form.user_id.focus();
        return;
    }

    if(!document.login_form.pass.value){
        alert("비밀번호를 입력하세요");
        document.login_form.pass.focus();
        return;
    }

    document.login_form.submit();
}

function check_pass(){
    if(!document.info_check.pass.value){
        alert("비밀번호를 입력하세요");
        document.info_check.pass.focus();
        return;
    }

    document.info_check.submit();
}