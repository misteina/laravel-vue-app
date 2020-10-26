/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/SignIn.js":
/*!********************************!*\
  !*** ./resources/js/SignIn.js ***!
  \********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var SignIn = {
  data: function data() {
    return {
      email: '',
      password: '',
      showError: false
    };
  },
  methods: {
    submitData: function submitData(event) {
      if (event) {
        event.preventDefault();
      }

      if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email) && this.password.length > 4) {
        this.$refs.signin.submit();
      } else {
        this.showError = true;
      }
    }
  },
  mounted: function mounted() {
    this.email = this.$refs.oldEmail.value;
  }
};
/* harmony default export */ __webpack_exports__["default"] = (SignIn);

/***/ }),

/***/ "./resources/js/SignUp.js":
/*!********************************!*\
  !*** ./resources/js/SignUp.js ***!
  \********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var SignUp = {
  data: function data() {
    return {
      name: '',
      email: '',
      password: '',
      verifyPassword: '',
      showError: false,
      errors: []
    };
  },
  methods: {
    submitData: function submitData(event) {
      if (event) {
        event.preventDefault();
      }

      this.errors = [];

      if (!/^[a-zA-Z ]+$/.test(this.name)) {
        this.errors.push('Invalid name');
      }

      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email)) {
        this.errors.push('Invalid email');
      }

      if (this.password.length < 4) {
        this.errors.push('Invalid password');
      }

      if (this.password !== this.verifyPassword) {
        this.errors.push('Password mismatch');
      }

      if (this.errors.length === 0) {
        this.$refs.signup.submit();
      } else {
        this.showError = true;
      }
    }
  },
  mounted: function mounted() {
    this.email = this.$refs.oldEmail.value;
    this.name = this.$refs.oldName.value;
  }
};
/* harmony default export */ __webpack_exports__["default"] = (SignUp);

/***/ }),

/***/ "./resources/js/ToDo.js":
/*!******************************!*\
  !*** ./resources/js/ToDo.js ***!
  \******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

var ToDo = {
  data: function data() {
    return {
      dateFrom: '',
      dateTo: '',
      category: 'all',
      showCategories: [],
      addDay: '',
      addHour: '00',
      addMinute: '00',
      addCategory: '',
      addTitle: '',
      addBody: '',
      todoData: true,
      todos: [],
      errors: [],
      showErrors: false,
      confirmDelete: false,
      deleteItemId: ''
    };
  },
  methods: {
    getTodos: function getTodos() {
      var url = '/todo?' + new URLSearchParams({
        "from": this.dateFrom,
        "to": this.dateTo,
        "category": this.category
      });
      var x = this;
      var xhttp = new XMLHttpRequest();

      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          x.todos = JSON.parse(this.responseText)[0] || [];
          x.showCategories = JSON.parse(this.responseText)[1] || [];
        }
      };

      xhttp.open("GET", url, true);
      xhttp.setRequestHeader("Request-Medium", "ajax");
      xhttp.send();
    },
    addTodo: function addTodo() {
      this.showErrors = false;
      this.errors = [];

      if (!/^[a-z]+$/.test(this.addCategory)) {
        this.errors.push('Invalid category');
      }

      if (this.addTitle.length === 0) {
        this.errors.push('Empty title field');
      }

      if (this.addBody.length === 0) {
        this.errors.push('Empty body field');
      }

      if (this.addDay.length === 0) {
        this.errors.push('No schedule date selected');
      }

      var addTime = "".concat(this.addDay, " ").concat(this.addHour, ":").concat(this.addMinute);

      if (isNaN(new Date(addTime).getTime()) || new Date().getTime() > new Date(addTime).getTime()) {
        this.errors.push('Invalid schedule date or behind time');
      }

      if (this.errors.length === 0) {
        var token = document.getElementsByName("csrf-token")[0].getAttribute("content");
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);

            if (data.hasOwnProperty('success')) {
              location.reload();
            } else if (data.hasOwnProperty('error')) {
              this.errors = data.error;
              this.showErrors = true;
            } else {
              this.errors = ['An error was encountered'];
              this.showErrors = true;
            }
          }
        };

        xhttp.open("POST", '/todo/add', true);
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.setRequestHeader("X-CSRF-TOKEN", token);
        xhttp.setRequestHeader("Request-Medium", "ajax");
        xhttp.send(JSON.stringify({
          "category": this.addCategory,
          "title": this.addTitle,
          "body": this.addBody,
          "time": addTime
        }));
      } else {
        this.showErrors = true;
      }
    },
    confirmDeleteItem: function confirmDeleteItem(itemId) {
      this.confirmDelete = true;
      this.deleteItemId = itemId;
    },
    deleteTodo: function deleteTodo() {
      this.confirmDelete = false;
      console.log(this.deleteItemId);

      for (var _i = 0, _Object$entries = Object.entries(this.todos); _i < _Object$entries.length; _i++) {
        var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
            key = _Object$entries$_i[0],
            value = _Object$entries$_i[1];

        if (key == this.deleteItemId) {
          delete this.todos[key];
          break;
        }
      }

      var xhttp = new XMLHttpRequest();
      xhttp.open("POST", "/todo/delete", true);
      xhttp.setRequestHeader("X-CSRF-TOKEN", document.getElementsByName("csrf-token")[0].getAttribute("content"));
      xhttp.setRequestHeader("Content-Type", "application/json");
      xhttp.send(JSON.stringify({
        "id": this.deleteItemId
      }));
    },
    getHour: function getHour(hour) {
      hour = (parseInt(hour) - 1).toString();
      return hour.length === 1 ? "0".concat(hour) : hour;
    },
    getMinute: function getMinute(minute) {
      minute = (parseInt(minute) - 1).toString();
      return minute.length === 1 ? "0".concat(minute) : minute;
    }
  },
  mounted: function mounted() {
    this.dateFrom = this.$refs.dateFrom.dataset.from;
    this.dateTo = this.$refs.dateTo.dataset.to;
    this.todos = JSON.parse(this.$refs.todoData.value)[0] || [];
    this.showCategories = JSON.parse(this.$refs.todoData.value)[1] || [];
    this.todoData = false;
  }
};
/* harmony default export */ __webpack_exports__["default"] = (ToDo);

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SignIn__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SignIn */ "./resources/js/SignIn.js");
/* harmony import */ var _ToDo__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ToDo */ "./resources/js/ToDo.js");
/* harmony import */ var _SignUp__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./SignUp */ "./resources/js/SignUp.js");



var Routes = {
  '/signin': _SignIn__WEBPACK_IMPORTED_MODULE_0__["default"],
  '/signup': _SignUp__WEBPACK_IMPORTED_MODULE_2__["default"],
  '/todo': _ToDo__WEBPACK_IMPORTED_MODULE_1__["default"]
};
var Template = Routes[window.location.pathname] || null;
Vue.createApp(Template).mount('#app');

/***/ }),

/***/ 0:
/*!***********************************!*\
  !*** multi ./resources/js/app.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/enyinna/laravel-vue-app/resources/js/app.js */"./resources/js/app.js");


/***/ })

/******/ });