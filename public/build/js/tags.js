"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["js/tags"],{

/***/ "./assets/js/tags/tags.js":
/*!********************************!*\
  !*** ./assets/js/tags/tags.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _yaireo_tagify__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @yaireo/tagify */ "./node_modules/@yaireo/tagify/dist/tagify.min.js");
/* harmony import */ var _yaireo_tagify__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_yaireo_tagify__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _yaireo_tagify_dist_tagify_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @yaireo/tagify/dist/tagify.css */ "./node_modules/@yaireo/tagify/dist/tagify.css");


var tagifyInput = document.querySelector('[data-role="tagify"]');
console.log(document.querySelector('[data-role="tagify"]'));

if (tagifyInput) {
  var autocompleteOptions = tagifyInput.dataset.autocompleteTags;
  console.log(autocompleteOptions);
  var tagify = new (_yaireo_tagify__WEBPACK_IMPORTED_MODULE_0___default())(tagifyInput);
}

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_yaireo_tagify_dist_tagify_min_js-node_modules_yaireo_tagify_dist_tagify_css"], () => (__webpack_exec__("./assets/js/tags/tags.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);