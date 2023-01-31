const button = document.querySelector('.mybutton');
const loginmenu = document.querySelector('.login_menu');


document.querySelector("body").addEventListener("click", function(e) {
    if(e.target.className == e.currentTarget.querySelector(".mybutton").className) {
        loginmenu.classList.toggle('login_active');
    } else {
        loginmenu.classList.remove('login_active');
    }
})
