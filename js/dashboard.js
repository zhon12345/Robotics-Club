document.addEventListener("DOMContentLoaded", function () {
  var toggles = document.querySelectorAll(".toggle");
  toggles.forEach(function (toggle) {
    toggle.addEventListener("click", function () {
      var subnav = this.nextElementSibling;
      subnav.classList.toggle("active");
    });
  });
});
