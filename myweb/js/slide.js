function call_js() {
    let slide = document.querySelector(".slide");
    let slideshow = document.querySelector(".slideshow");
    let slides = document.querySelectorAll(".slideshow a");
    let prev = document.querySelector(".prev");
    let next = document.querySelector(".next");
    let indicators = document.querySelectorAll(".slideshow a");
    let currentIndex = 0;
    let timer = "";
    let slideCount = slides.length;
  
    for (let i = 0; i < slides.length; i++) {
      let newleft = i * 100 + "%";
      slides[i].style.left = newleft;
    }
  
    function gotoSlide(index) {
      currentIndex = index;
      let newleft = index * -250 + "px";
      slideshow.style.left = newleft;
  
      indicators.forEach((obj) => {
        obj.classList.remove("active");
      });
      indicators[index].classList.add("active");
    }
  
    // 3초마다 함수를 부른다.
    function startTimer() {
      timer = setInterval(function () {
        let nextIndex = (currentIndex + 1) % slideCount;
        gotoSlide(nextIndex);
      }, 4000);
    }
  
    startTimer();
  
    // 마우스가 slideshow 에 들어가면 타이머 정지
    slideshow.addEventListener("mouseenter", () => {
      clearInterval(timer);
    });
    slideshow.addEventListener("mouseleave", () => {
      startTimer();
    });
  
    prev.addEventListener("mouseenter", () => {
      clearInterval(timer);
    });
  
    next.addEventListener("mouseenter", () => {
      clearInterval(timer);
    });
  
    // prev , next 이벤트 설정
    prev.addEventListener("click", (e) => {
      e.preventDefault(); // a tag 가 가지고있는 기본기능을 막는다.
      currentIndex = currentIndex - 1;
      if (currentIndex < 0) {
        currentIndex = 11;
      }
      gotoSlide(currentIndex);
    });
  
    next.addEventListener("click", (e) => {
      e.preventDefault(); // a tag 가 가지고있는 기본기능을 막는다.
      currentIndex = currentIndex + 1;
      if (currentIndex > 11) {
        currentIndex = 0;
      }
      gotoSlide(currentIndex);
    });
  
    // indicator click 해당화면으로 이동
    indicators.forEach((obj) => {
      obj.addEventListener("mouseenter", () => {
        clearInterval(timer);
      });
    });
  
    for (let i = 0; i < indicators.length; i++) {
      indicators[i].addEventListener("click", (e) => {
        gotoSlide(i);
      });
    }
}
  