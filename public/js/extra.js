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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/extra.js":
/*!**************************************!*\
  !*** ./resources/assets/js/extra.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

//Auto-Dark mode
// async function lookOutside() {
//     const location = await (await fetch('https://ipapi.co/json/')).json();
//     const time = await (await fetch(`https://api.sunrise-sunset.org/json?lat=${location.latitude}&lng=${location.longitude}&formatted=0`)).json();
//
//     return await new Date().toUTCString() > Date.parse(time.results.sunrise) && new Date().toUTCString() < Date.parse(time.results.sunset);
// }
//
// lookOutside().then(lightOutside => {
//     if (!lightOutside && document.querySelector("meta[name=daylight]").getAttribute("content").length == 0){
//         document.getElementById('change_dream_theme').submit();
//     }
// });
//Click to discover
window.onload = function () {
  var cards = Array.from(document.getElementsByClassName('card')),
      top = cards[0].getBoundingClientRect().top + window.scrollY;
  document.getElementById('click-discover').addEventListener('click', function () {
    //Scroll to first card
    window.scroll({
      top: top,
      behavior: 'smooth'
    });
  }); //Emphasize hovered card

  cards.forEach(function (item, index) {
    var baseIndex = index;
    item.addEventListener('mouseenter', function () {
      cards.forEach(function (item, index) {
        if (index !== baseIndex) {
          item.style = "filter: blur(2px); transition: 1s;";
        } else {
          item.style = "transform: scale(1.025); transition: 1s;";
          item.children[0].style = "filter: saturate(1.15); transition: 1s;";
        }

        setTimeout(function () {
          item.style = "transform: scale(1); filter: blur(0px) saturate(1); transition: 1s;";
        }, 3000);
      });
    });
  });
};

/***/ }),

/***/ 1:
/*!********************************************!*\
  !*** multi ./resources/assets/js/extra.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/sebastiaanhols/Coding/PhpstormProjects/sebastiaan-hols.com/resources/assets/js/extra.js */"./resources/assets/js/extra.js");


/***/ })

/******/ });