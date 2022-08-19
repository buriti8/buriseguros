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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/js/contact-form.js":
/*!*****************************************!*\
  !*** ./resources/js/js/contact-form.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

(function (root, factory) {
  "use strict";

  if (true) {
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else {}
})(this, function () {
  "use strict";

  var ContactForm = function ContactForm(form, options) {
    if (!this || !(this instanceof ContactForm)) {
      return new ContactForm(form, options);
    }

    if (!form || !options) {
      return;
    }

    this.form = form instanceof Node ? form : document.querySelector(form);
    this.endpoint = options.endpoint;
    this.send();
  };

  ContactForm.prototype = {
    hasClass: function hasClass(el, name) {
      return new RegExp('(\\s|^)' + name + '(\\s|$)').test(el.className);
    },
    addClass: function addClass(el, name) {
      if (!this.hasClass(el, name)) {
        el.className += (el.className ? ' ' : '') + name;
      }
    },
    removeClass: function removeClass(el, name) {
      if (this.hasClass(el, name)) {
        el.className = el.className.replace(new RegExp('(\\s|^)' + name + '(\\s|$)'), ' ').replace(/^\s+|\s+$/g, '');
      }
    },
    each: function each(collection, iterator) {
      var i, len;

      for (i = 0, len = collection.length; i < len; i += 1) {
        iterator(collection[i], i, collection);
      }
    },
    template: function template(string, data) {
      var piece;

      for (piece in data) {
        if (Object.prototype.hasOwnProperty.call(data, piece)) {
          string = string.replace(new RegExp('{' + piece + '}', 'g'), data[piece]);
        }
      }

      return string;
    },
    empty: function empty(el) {
      while (el.firstChild) {
        el.removeChild(el.firstChild);
      }
    },
    removeElementsByClass: function removeElementsByClass(className) {
      var elements = document.getElementsByClassName(className);

      while (elements.length > 0) {
        elements[0].parentNode.removeChild(elements[0]);
      }
    },
    post: function post(path, data, success, fail) {
      var xhttp = new XMLHttpRequest();
      xhttp.open('POST', path, true);
      xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

      xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
          if (this.status === 200) {
            var response = '';

            try {
              response = JSON.parse(this.responseText);
            } catch (err) {
              response = this.responseText;
            }

            success.call(this, response);
          } else {
            fail.call(this, this.responseText);
          }
        }
      };

      xhttp.send(data);
      xhttp = null;
    },
    param: function param(data) {
      var params = typeof data === 'string' ? data : Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
      }).join('&');
      return params;
    },
    send: function send() {
      this.form.addEventListener('submit', function (e) {
        e.preventDefault();
        var elements = document.querySelectorAll('.form-control'),
            formData;
        this.each(elements, function (el, i) {
          if (this.hasClass(el.parentNode, 'has-error')) {
            this.removeClass(el.parentNode, 'has-error');
            this.removeElementsByClass('help-block');
          }
        }.bind(this));
        formData = {
          'name': document.querySelector('input[name="form-name"]').value,
          'email': document.querySelector('input[name="form-email"]').value,
          'number': document.querySelector('input[name="form-number"]').value,
          'subject': document.querySelector('input[name="form-subject"]').value,
          'message': document.querySelector('textarea[name="form-message"]').value
        };
        this.post(this.endpoint, this.param(formData), this.feedback.bind(this), this.fail.bind(this));
      }.bind(this), false);
    },
    feedback: function feedback(data) {
      if (!data.success) {
        if (data.errors.name) {
          var name = document.querySelector('input[name="form-name"]').parentNode,
              error;
          this.addClass(name, 'has-error');
          error = this.template('<span class="help-block">{report}</span>', {
            report: data.errors.name
          });
          name.insertAdjacentHTML('beforeend', error);
        }

        if (data.errors.email) {
          var email = document.querySelector('input[name="form-email"]').parentNode,
              error;
          this.addClass(email, 'has-error');
          error = this.template('<span class="help-block">{report}</span>', {
            report: data.errors.email
          });
          email.insertAdjacentHTML('beforeend', error);
        }

        if (data.errors.subject) {
          var subject = document.querySelector('input[name="form-subject"]').parentNode,
              error;
          this.addClass(subject, 'has-error');
          error = this.template('<span class="help-block">{report}</span>', {
            report: data.errors.subject
          });
          subject.insertAdjacentHTML('beforeend', error);
        }

        if (data.errors.message) {
          var message = document.querySelector('textarea[name="form-message"]').parentNode,
              error;
          this.addClass(message, 'has-error');
          error = this.template('<span class="help-block">{report}</span>', {
            report: data.errors.message
          });
          message.insertAdjacentHTML('beforeend', error);
        }
      } else {
        var success = this.template('<div class="alert alert-success">{report}</div>', {
          report: data.message
        });
        this.empty(this.form);
        this.form.insertAdjacentHTML('beforeend', success);
      }
    },
    fail: function fail(data) {
      console.log(data);
    }
  };
  return ContactForm;
});

/***/ }),

/***/ 2:
/*!***********************************************!*\
  !*** multi ./resources/js/js/contact-form.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\test\php\buriseguros\resources\js\js\contact-form.js */"./resources/js/js/contact-form.js");


/***/ })

/******/ });