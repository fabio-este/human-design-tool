(self["webpackChunk"] = self["webpackChunk"] || []).push([["js/autoTOC"],{

/***/ "./assets/js/autoTOC.js":
/*!******************************!*\
  !*** ./assets/js/autoTOC.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/**
 * Automatically create a Table Of Contents in the Report View
 */
$(document).ready(function () {
  var documentRef = documentRef || document;
  var toc = documentRef.getElementById("toc");
  var report = documentRef.getElementById("reportDisplay");
  var headings = [].slice.call(documentRef.body.querySelectorAll("h1, h2, h3"));
  var tocToggle = documentRef.getElementById("toggle-toc-button");
  var darkModeToggle = documentRef.getElementById("dark-light-mode-button");
  $(tocToggle).on("click", function () {
    $(toc).toggle("slow", function () {
      // Animation complete.
    });
  });
  $(darkModeToggle).on("click", function () {
    $("body").toggleClass("dark-mode");
  });

  /**
   * Parse Headers
   */
  var buttonList = [];
  headings.forEach(function (heading, index) {
    // skip if this header is hidden via the 'data-toc-hide="1"' tag
    var tocHide = $(heading).data("toc-hide") === 1;
    if (tocHide) return;
    var anchor = documentRef.createElement("a");
    anchor.setAttribute("name", "toc" + index);
    anchor.setAttribute("id", "toc" + index);
    var link = documentRef.createElement("a");
    link.setAttribute("href", "#toc" + index);
    link.textContent = heading.textContent.split(" - ")[0];
    var div = documentRef.createElement("div");
    div.setAttribute("class", heading.tagName.toLowerCase());

    // Create button menu from H1 Tags
    if (heading.tagName.toLowerCase() === "h1") {
      var button = documentRef.createElement("a");
      button.setAttribute("href", "#toc" + index);
      button.classList.add("btn");
      var buttonTextContent = heading.textContent;
      var buttonText = buttonTextContent;
      var number = buttonText.match(/(\d+)/);
      if (number !== null && number[0] !== undefined) {
        button.textContent = "E " + number[0];
        var buttonListItem = documentRef.createElement("li");
        buttonListItem.append(button);
        buttonList.push(buttonListItem);
      }
    }
    div.appendChild(link);
    toc.appendChild(div);
    heading.parentNode.insertBefore(anchor, heading);
  });

  // Build button list
  var buttonListHTML = documentRef.createElement("ul");
  buttonListHTML.classList.add("button-list");
  buttonList.forEach(function (listItem) {
    buttonListHTML.append(listItem);
  });
  toc.prepend(buttonListHTML);
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_jquery_dist_jquery_js"], () => (__webpack_exec__("./assets/js/autoTOC.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);