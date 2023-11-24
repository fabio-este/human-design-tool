"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["js/dataTables"],{

/***/ "./assets/js/dataTables.js":
/*!*********************************!*\
  !*** ./assets/js/dataTables.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var datatables_net__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! datatables.net */ "./node_modules/datatables.net/js/jquery.dataTables.js");
/* harmony import */ var datatables_net__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(datatables_net__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var datatables_net_dt_css_jquery_dataTables_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! datatables.net-dt/css/jquery.dataTables.css */ "./node_modules/datatables.net-dt/css/jquery.dataTables.css");
/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");


$(document).ready(function () {
  var table = $('table.datatables').DataTable({
    ordering: true,
    searching: true,
    pageLength: 10,
    responsive: {
      details: {
        type: 'column'
      }
    },
    //order: [[7, 'asc']],
    columnDefs: [{
      orderable: false,
      targets: 0
    }, {
      className: 'dtr-control',
      orderable: false,
      targets: 1
    }, {
      orderable: true,
      targets: 7
    }],
    language: {
      search: "",
      searchPlaceholder: "Suchen",
      lengthMenu: "_MENU_ Freelancer pro Seite",
      zeroRecords: "Nicht gefunden...",
      info: "Seite _PAGE_ von _PAGES_",
      infoEmpty: "Keine Datensätze verfügbar",
      infoFiltered: "(von insgesamt _MAX_ Datensätzen)",
      paginate: {
        first: "<<",
        last: ">>",
        next: ">",
        previous: "<"
      }
    }
  }); // Add event listener for opening and closing details

  $('table.datatables tbody').on('click', 'td.dt-control', function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);
    var id = tr.data('id');
    var childContent = $('.detail-rows div[data-detail-id="' + id + '"]').clone();

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide();
      tr.removeClass('shown');
    } else {
      // Open this row
      row.child(childContent).show();
      tr.addClass('shown');
    }
  });
});

/***/ }),

/***/ "./node_modules/datatables.net-dt/css/jquery.dataTables.css":
/*!******************************************************************!*\
  !*** ./node_modules/datatables.net-dt/css/jquery.dataTables.css ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_datatables_net_js_jquery_dataTables_js","vendors-node_modules_datatables_net-dt_css_jquery_dataTables_css"], () => (__webpack_exec__("./assets/js/dataTables.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);