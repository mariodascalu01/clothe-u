
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


var swiper = new Swiper(".new-arrival", {
  spaceBetween: 20,
  loop: true,
  autoplay:{
      delay: 5500,
      disableOnInteraction: false,
  },
  centeredslides: true,
  breakpoints: {
      0: {
      slidesPerView: 0,
      },
      568: {
      slidesPerView: 2,
      },
      768:{
          slidesPerView: 2,
      },
      1020:{
          slidesPerView: 3,
      },
  },
});