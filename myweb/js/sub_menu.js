const button = document.querySelector('.mybutton');
const loginmenu = document.querySelector('.login_menu');


// button.addEventListener('click', ()=>{
//     loginmenu.classList.toggle('login_active');
// });


document.querySelector("body").addEventListener("click", function(e) {
    if(e.target.className == e.currentTarget.querySelector(".mybutton").className) {
        loginmenu.classList.toggle('login_active');
    } else {
        loginmenu.classList.remove('login_active');
    }
})
