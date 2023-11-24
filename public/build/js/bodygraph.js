(self["webpackChunk"] = self["webpackChunk"] || []).push([["js/bodygraph"],{

/***/ "./assets/js/bodygraph.js":
/*!********************************!*\
  !*** ./assets/js/bodygraph.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var fabric__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! fabric */ "./node_modules/fabric/dist/fabric.js");
/* harmony import */ var fabric__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(fabric__WEBPACK_IMPORTED_MODULE_0__);
// v5

var el = document.getElementById('canvas');
var canvas = window.canvas = new fabric__WEBPACK_IMPORTED_MODULE_0__.fabric.Canvas(el);

//  edit from here
canvas.setDimensions({
  width: 500,
  height: 500
});
var textValue = 'fabric.js sandbox';
var text = new fabric__WEBPACK_IMPORTED_MODULE_0__.fabric.Textbox(textValue, {
  originX: 'center',
  splitByGrapheme: true,
  width: 200,
  top: 20,
  styles: fabric__WEBPACK_IMPORTED_MODULE_0__.fabric.util.stylesFromArray([{
    style: {
      fontWeight: 'bold',
      fontSize: 64
    },
    start: 0,
    end: 9
  }], textValue)
});
canvas.add(text);
canvas.centerObjectH(text);
function animate(toState) {
  text.animate({
    scaleX: Math.max(toState, 0.1) * 2
  }, {
    onChange: function onChange() {
      return canvas.renderAll();
    },
    onComplete: function onComplete() {
      return animate(!toState);
    },
    duration: 1000,
    easing: toState ? fabric__WEBPACK_IMPORTED_MODULE_0__.fabric.util.ease.easeInOutQuad : fabric__WEBPACK_IMPORTED_MODULE_0__.fabric.util.ease.easeInOutSine
  });
}

/***/ }),

/***/ "?7b10":
/*!***********************!*\
  !*** jsdom (ignored) ***!
  \***********************/
/***/ (() => {

/* (ignored) */

/***/ }),

/***/ "?6799":
/*!********************************************************!*\
  !*** jsdom/lib/jsdom/living/generated/utils (ignored) ***!
  \********************************************************/
/***/ (() => {

/* (ignored) */

/***/ }),

/***/ "?9748":
/*!***************************************!*\
  !*** jsdom/lib/jsdom/utils (ignored) ***!
  \***************************************/
/***/ (() => {

/* (ignored) */

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_fabric_dist_fabric_js"], () => (__webpack_exec__("./assets/js/bodygraph.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);