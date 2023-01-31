function check_input(){

    if(!document.reservation_main.card.value){
        alert("결제방법을 선택하세요");
        document.reservation_main.card.focus();
        return;
    }

    document.reservation_main.submit();
}