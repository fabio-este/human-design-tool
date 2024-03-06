import "bootstrap";
import "bootstrap/js/dist/tab";

import Glide from "@glidejs/glide";

window.addEventListener("load", function () {
  new Glide(".glide", {
    type: "slider",
    rewind: false,
    startAt: 0,
    perView: 5,
    gap: 1,
    breakpoints: {
      800: {
        perView: 4,
      },
      600: {
        perView: 3,
      },
    },
  }).mount();
});
