
const slidermin = document.querySelector('#min-price');
const slidermax = document.querySelector('#max-price');
const valoreSlidermin = document.querySelector('#min-value');
const valoreSlidermax = document.querySelector('#max-value');
slidermin.addEventListener('input', function() {
    valoreSlidermin.textContent = this.value;
  });
slidermax.addEventListener('input', function() {
    valoreSlidermax.textContent = this.value;
});


/*var slider1 = document.getElementById("min-price");
var slider2 = document.getElementById("max-price");

slider1.onmouseup = function () {
  document.getElementById("scelta_prezzo").submit();
}
slider2.onmouseup = function () {
    document.getElementById("scelta_prezzo").submit();
  }*/
  // Swiper
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




  