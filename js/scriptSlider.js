$(document).ready(function () {
  $(".content-slider").each(function (i, e) {
    var id = "adaptive";
    $(e).attr("id", id + i);
    var selector = "#" + id + i;
    var slider = $(selector).lightSlider({
      item: 5,
      loop: false,
      slideMove: 1,
      enableDrag: false,
      slideMargin: 30,
      pager: false,
      controls: false,
      easing: "cubic-bezier(0.25, 0, 0.25, 1)",
      speed: 300,
    });

    $("#goToPrevSlide" + i).on("click", function () {
      slider.goToPrevSlide();
    });
    $("#goToNextSlide" + i).on("click", function () {
      slider.goToNextSlide();
    });
  });
});
