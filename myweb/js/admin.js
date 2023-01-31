//패턴검색, 데이터 입력유무
function check_input(){
    if(!document.admin_con_form.title.value){
        alert("제목을 입력하세요");
        document.admin_con_form.title.focus();
        return;
    }

    if(!document.admin_con_form.artist.value){
        alert("아티스트를 입력하세요");
        document.admin_con_form.artist.focus();
        return;
    }
    
    if(!document.admin_con_form.genre.value){
        alert("장르를 입력하세요");
        document.admin_con_form.genre.focus();
        return;
    }

    if(!document.admin_con_form.content.value){
        alert("소개글을 입력하세요");
        document.admin_con_form.content.focus();
        return;
    }
    
    if(!document.admin_con_form.concerthall.value){
        alert("공연장을 입력하세요");
        document.admin_con_form.concerthall.focus();
        return;
    }

    if(!document.admin_con_form.price.value){
        alert("가격을 입력하세요");
        document.admin_con_form.price.focus();
        return;
    }

    document.admin_con_form.submit();
}


function reset_form(){
    document.admin_con_form.title.value = "";
    document.admin_con_form.artist.value = "";
    document.admin_con_form.genre.value = "";
    document.admin_con_form.content.value = "";
    document.admin_con_form.concerthall.value = "";
    document.admin_con_form.price.value = "";
    document.admin_con_form.title.focus();
    return;
}