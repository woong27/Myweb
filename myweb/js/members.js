//패턴검색, 데이터 입력유무, 패스워드 체크
function check_input(){
    if(!document.sign_up_form.user_id.value){
        alert("아이디를 입력하세요");
        document.sign_up_form.user_id.focus();
        return;
    }

    if(!document.sign_up_form.user_nick.value){
        alert("닉네임을 입력하세요");
        document.sign_up_form.user_nick.focus();
        return;
    }
    
    if(!document.sign_up_form.pass1.value){
        alert("패스워드를 입력하세요");
        document.sign_up_form.pass1.focus();
        return;
    }
    
    if(!document.sign_up_form.pass2.value){
        alert("패스워드를 입력하세요");
        document.sign_up_form.pass2.focus();
        return;
    }

    if(!document.sign_up_form.email.value){
        alert("이메일을 입력하세요");
        document.sign_up_form.email.focus();
        return;
    }

    if(!document.sign_up_form.phone.value){
        alert("전화번호를 입력하세요");
        document.sign_up_form.phone.focus();
        return;
    }

    if(document.sign_up_form.pass1.value !== document.sign_up_form.pass2.value){
        alert("비밀번호가 일치하지 않아요");
        document.sign_up_form.pass1.value = "";
        document.sign_up_form.pass2.value = "";
        document.sign_up_form.pass1.focus();
        return;
    }

    //서버에 전송하는 기능
    document.sign_up_form.submit();
}

//회원관리폼 내용지우기
function reset_form(){
    document.sign_up_form.user_id.value = "";
    document.sign_up_form.user_nick.value = "";
    document.sign_up_form.pass1.value = "";
    document.sign_up_form.pass2.value = "";
    document.sign_up_form.email.value = "";
    document.sign_up_form.phone.value = "";
    document.sign_up_form.user_id.focus();
    return;
}