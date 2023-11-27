/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ ((module) => {

module.exports = jQuery;

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!********************************!*\
  !*** ./src/js/blocks-admin.js ***!
  \********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
// bundle.js

var createHigherOrderComponent = wp.compose.createHigherOrderComponent;
var Fragment = wp.element.Fragment;
var InspectorControls = wp.editor.InspectorControls;
var _wp$components = wp.components,
  PanelBody = _wp$components.PanelBody,
  SelectControl = _wp$components.SelectControl;
var addFilter = wp.hooks.addFilter;
var __ = wp.i18n.__;
jquery__WEBPACK_IMPORTED_MODULE_0___default()(document).on('ready', function () {
  if (window.acf) {
    window.acf.addAction('render_block_preview/type=image', function ($block) {
      if (!$block[0].querySelector('img')) {
        var inner = $block[0].querySelector('.block-image');
        var img = document.createElement('img');
        img.classList.add('placeholder-image');
        img.src = theme.templateURL + '/dist/images/img-placeholder-16x9.svg';
        inner.appendChild(img);
      } else {
        var _inner = $block[0].querySelector('.block-image');
        var placeholder = _inner.querySelector('.placeholder-image');
        if (placeholder) placeholder.remove();
      }
    });
  }
});
var blocksWithSpacingControl = ['core/paragraph', 'core/list', 'core/heading'];
var spacingOptions = [{
  label: __('None'),
  value: 'none'
}, {
  label: __('XS'),
  value: 'xs'
}, {
  label: __('SM'),
  value: 'sm'
}, {
  label: __('MD'),
  value: 'md'
}, {
  label: __('LG'),
  value: 'lg'
}, {
  label: __('XL'),
  value: 'xl'
}];
var addSpacingControlAttribute = function addSpacingControlAttribute(settings, blockName) {
  if (!blocksWithSpacingControl.includes(blockName)) return settings;
  settings.attributes.spacing = {
    type: 'string',
    "default": spacingOptions[2].value
  };
  settings.supports.className = true;
  return settings;
};
addFilter('blocks.registerBlockType', 'pgn/attribute/spacing', addSpacingControlAttribute);

// Filter out spacing css classes to preserve other additional classes
var removeFromClassName = function removeFromClassName() {
  var className = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
  var classArray = arguments.length > 1 ? arguments[1] : undefined;
  return className.split(' ').filter(function (classString) {
    return !classArray.includes(classString);
  }).join(' ').replace(/\s+/g, ' ') // Remove superfluous whitespace
  .trimStart();
};
var withSpacingControl = createHigherOrderComponent(function (BlockEdit) {
  return function (props) {
    // Do nothing if it's another block than our defined ones.
    if (!blocksWithSpacingControl.includes(props.name)) {
      return /*#__PURE__*/React.createElement(BlockEdit, props);
    }
    var _props$attributes = props.attributes,
      spacing = _props$attributes.spacing,
      className = _props$attributes.className;
    var spacingClasses = spacingOptions.map(function (opt) {
      return 'mt-' + opt.value;
    });
    var classNameWithoutSpacing = removeFromClassName(className, spacingClasses);
    props.attributes.className = spacing ? "mt-".concat(spacing, " ").concat(classNameWithoutSpacing) : classNameWithoutSpacing;
    return /*#__PURE__*/React.createElement(Fragment, null, /*#__PURE__*/React.createElement(BlockEdit, props), /*#__PURE__*/React.createElement(InspectorControls, null, /*#__PURE__*/React.createElement(PanelBody, {
      title: __('Space Above'),
      initialOpen: true
    }, /*#__PURE__*/React.createElement(SelectControl, {
      value: spacing,
      options: spacingOptions,
      onChange: function onChange(selectedSpacingOption) {
        props.setAttributes({
          spacing: selectedSpacingOption
        });
      }
    }))));
  };
}, 'withSpacingControl');
addFilter('editor.BlockEdit', 'pgn/with-spacing-control', withSpacingControl);
})();

/******/ })()
;
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QUUyQyxrQkFBa0IsQ0FBRSxDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vcGduL2V4dGVybmFsIHZhciBcImpRdWVyeVwiIiwid2VicGFjazovL3Bnbi93ZWJwYWNrL2Jvb3RzdHJhcCIsIndlYnBhY2s6Ly9wZ24vd2VicGFjay9ydW50aW1lL2NvbXBhdCBnZXQgZGVmYXVsdCBleHBvcnQiLCJ3ZWJwYWNrOi8vcGduL3dlYnBhY2svcnVudGltZS9kZWZpbmUgcHJvcGVydHkgZ2V0dGVycyIsIndlYnBhY2s6Ly9wZ24vd2VicGFjay9ydW50aW1lL2hhc093blByb3BlcnR5IHNob3J0aGFuZCIsIndlYnBhY2s6Ly9wZ24vd2VicGFjay9ydW50aW1lL21ha2UgbmFtZXNwYWNlIG9iamVjdCIsIndlYnBhY2s6Ly9wZ24vLi9zcmMvanMvYmxvY2tzLWFkbWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIm1vZHVsZS5leHBvcnRzID0galF1ZXJ5OyIsIi8vIFRoZSBtb2R1bGUgY2FjaGVcbnZhciBfX3dlYnBhY2tfbW9kdWxlX2NhY2hlX18gPSB7fTtcblxuLy8gVGhlIHJlcXVpcmUgZnVuY3Rpb25cbmZ1bmN0aW9uIF9fd2VicGFja19yZXF1aXJlX18obW9kdWxlSWQpIHtcblx0Ly8gQ2hlY2sgaWYgbW9kdWxlIGlzIGluIGNhY2hlXG5cdHZhciBjYWNoZWRNb2R1bGUgPSBfX3dlYnBhY2tfbW9kdWxlX2NhY2hlX19bbW9kdWxlSWRdO1xuXHRpZiAoY2FjaGVkTW9kdWxlICE9PSB1bmRlZmluZWQpIHtcblx0XHRyZXR1cm4gY2FjaGVkTW9kdWxlLmV4cG9ydHM7XG5cdH1cblx0Ly8gQ3JlYXRlIGEgbmV3IG1vZHVsZSAoYW5kIHB1dCBpdCBpbnRvIHRoZSBjYWNoZSlcblx0dmFyIG1vZHVsZSA9IF9fd2VicGFja19tb2R1bGVfY2FjaGVfX1ttb2R1bGVJZF0gPSB7XG5cdFx0Ly8gbm8gbW9kdWxlLmlkIG5lZWRlZFxuXHRcdC8vIG5vIG1vZHVsZS5sb2FkZWQgbmVlZGVkXG5cdFx0ZXhwb3J0czoge31cblx0fTtcblxuXHQvLyBFeGVjdXRlIHRoZSBtb2R1bGUgZnVuY3Rpb25cblx0X193ZWJwYWNrX21vZHVsZXNfX1ttb2R1bGVJZF0obW9kdWxlLCBtb2R1bGUuZXhwb3J0cywgX193ZWJwYWNrX3JlcXVpcmVfXyk7XG5cblx0Ly8gUmV0dXJuIHRoZSBleHBvcnRzIG9mIHRoZSBtb2R1bGVcblx0cmV0dXJuIG1vZHVsZS5leHBvcnRzO1xufVxuXG4iLCIvLyBnZXREZWZhdWx0RXhwb3J0IGZ1bmN0aW9uIGZvciBjb21wYXRpYmlsaXR5IHdpdGggbm9uLWhhcm1vbnkgbW9kdWxlc1xuX193ZWJwYWNrX3JlcXVpcmVfXy5uID0gKG1vZHVsZSkgPT4ge1xuXHR2YXIgZ2V0dGVyID0gbW9kdWxlICYmIG1vZHVsZS5fX2VzTW9kdWxlID9cblx0XHQoKSA9PiAobW9kdWxlWydkZWZhdWx0J10pIDpcblx0XHQoKSA9PiAobW9kdWxlKTtcblx0X193ZWJwYWNrX3JlcXVpcmVfXy5kKGdldHRlciwgeyBhOiBnZXR0ZXIgfSk7XG5cdHJldHVybiBnZXR0ZXI7XG59OyIsIi8vIGRlZmluZSBnZXR0ZXIgZnVuY3Rpb25zIGZvciBoYXJtb255IGV4cG9ydHNcbl9fd2VicGFja19yZXF1aXJlX18uZCA9IChleHBvcnRzLCBkZWZpbml0aW9uKSA9PiB7XG5cdGZvcih2YXIga2V5IGluIGRlZmluaXRpb24pIHtcblx0XHRpZihfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZGVmaW5pdGlvbiwga2V5KSAmJiAhX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIGtleSkpIHtcblx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBrZXksIHsgZW51bWVyYWJsZTogdHJ1ZSwgZ2V0OiBkZWZpbml0aW9uW2tleV0gfSk7XG5cdFx0fVxuXHR9XG59OyIsIl9fd2VicGFja19yZXF1aXJlX18ubyA9IChvYmosIHByb3ApID0+IChPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwob2JqLCBwcm9wKSkiLCIvLyBkZWZpbmUgX19lc01vZHVsZSBvbiBleHBvcnRzXG5fX3dlYnBhY2tfcmVxdWlyZV9fLnIgPSAoZXhwb3J0cykgPT4ge1xuXHRpZih0eXBlb2YgU3ltYm9sICE9PSAndW5kZWZpbmVkJyAmJiBTeW1ib2wudG9TdHJpbmdUYWcpIHtcblx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgU3ltYm9sLnRvU3RyaW5nVGFnLCB7IHZhbHVlOiAnTW9kdWxlJyB9KTtcblx0fVxuXHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgJ19fZXNNb2R1bGUnLCB7IHZhbHVlOiB0cnVlIH0pO1xufTsiLCIvLyBidW5kbGUuanNcclxuaW1wb3J0ICQgZnJvbSAnanF1ZXJ5JztcclxuY29uc3QgeyBjcmVhdGVIaWdoZXJPcmRlckNvbXBvbmVudCB9ID0gd3AuY29tcG9zZTtcclxuY29uc3QgeyBGcmFnbWVudCB9ID0gd3AuZWxlbWVudDtcclxuY29uc3QgeyBJbnNwZWN0b3JDb250cm9scyB9ID0gd3AuZWRpdG9yO1xyXG5jb25zdCB7IFBhbmVsQm9keSwgU2VsZWN0Q29udHJvbCB9ID0gd3AuY29tcG9uZW50cztcclxuY29uc3QgeyBhZGRGaWx0ZXIgfSA9IHdwLmhvb2tzO1xyXG5jb25zdCB7IF9fIH0gPSB3cC5pMThuO1xyXG5cclxuJChkb2N1bWVudCkub24oJ3JlYWR5JywgKCkgPT4ge1xyXG4gICAgaWYod2luZG93LmFjZil7XHJcbiAgICAgICAgd2luZG93LmFjZi5hZGRBY3Rpb24oJ3JlbmRlcl9ibG9ja19wcmV2aWV3L3R5cGU9aW1hZ2UnLCAoJGJsb2NrKSA9PiB7XHJcbiAgICAgICAgICAgIGlmKCEkYmxvY2tbMF0ucXVlcnlTZWxlY3RvcignaW1nJykpe1xyXG4gICAgICAgICAgICAgICAgbGV0IGlubmVyID0gJGJsb2NrWzBdLnF1ZXJ5U2VsZWN0b3IoJy5ibG9jay1pbWFnZScpO1xyXG4gICAgICAgICAgICAgICAgbGV0IGltZyA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2ltZycpO1xyXG4gICAgICAgICAgICAgICAgaW1nLmNsYXNzTGlzdC5hZGQoJ3BsYWNlaG9sZGVyLWltYWdlJyk7XHJcbiAgICAgICAgICAgICAgICBpbWcuc3JjID0gdGhlbWUudGVtcGxhdGVVUkwgKyAnL2Rpc3QvaW1hZ2VzL2ltZy1wbGFjZWhvbGRlci0xNng5LnN2Zyc7XHJcbiAgICAgICAgICAgICAgICBpbm5lci5hcHBlbmRDaGlsZChpbWcpO1xyXG4gICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgICAgbGV0IGlubmVyID0gJGJsb2NrWzBdLnF1ZXJ5U2VsZWN0b3IoJy5ibG9jay1pbWFnZScpO1xyXG4gICAgICAgICAgICAgICAgbGV0IHBsYWNlaG9sZGVyID0gaW5uZXIucXVlcnlTZWxlY3RvcignLnBsYWNlaG9sZGVyLWltYWdlJyk7XHJcbiAgICAgICAgICAgICAgICBpZihwbGFjZWhvbGRlcikgcGxhY2Vob2xkZXIucmVtb3ZlKCk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH1cclxufSk7XHJcblxyXG5jb25zdCBibG9ja3NXaXRoU3BhY2luZ0NvbnRyb2wgPSBbXHJcbiAgICAnY29yZS9wYXJhZ3JhcGgnLFxyXG4gICAgJ2NvcmUvbGlzdCcsXHJcbiAgICAnY29yZS9oZWFkaW5nJ1xyXG5dO1xyXG5cclxuY29uc3Qgc3BhY2luZ09wdGlvbnMgPSBbXHJcbiAgICB7XHJcbiAgICAgICAgbGFiZWw6IF9fKCAnTm9uZScgKSxcclxuICAgICAgICB2YWx1ZTogJ25vbmUnXHJcbiAgICB9LFxyXG4gICAge1xyXG4gICAgICAgIGxhYmVsOiBfXyggJ1hTJyApLFxyXG4gICAgICAgIHZhbHVlOiAneHMnXHJcbiAgICB9LFxyXG4gICAge1xyXG4gICAgICAgIGxhYmVsOiBfXyggJ1NNJyApLFxyXG4gICAgICAgIHZhbHVlOiAnc20nXHJcbiAgICB9LFxyXG4gICAge1xyXG4gICAgICAgIGxhYmVsOiBfXyggJ01EJyApLFxyXG4gICAgICAgIHZhbHVlOiAnbWQnXHJcbiAgICB9LFxyXG4gICAge1xyXG4gICAgICAgIGxhYmVsOiBfXyggJ0xHJyApLFxyXG4gICAgICAgIHZhbHVlOiAnbGcnXHJcbiAgICB9LFxyXG4gICAge1xyXG4gICAgICAgIGxhYmVsOiBfXyggJ1hMJyApLFxyXG4gICAgICAgIHZhbHVlOiAneGwnXHJcbiAgICB9LFxyXG5dO1xyXG5cclxuY29uc3QgYWRkU3BhY2luZ0NvbnRyb2xBdHRyaWJ1dGUgPSAoc2V0dGluZ3MsIGJsb2NrTmFtZSkgPT4ge1xyXG4gICAgaWYoIWJsb2Nrc1dpdGhTcGFjaW5nQ29udHJvbC5pbmNsdWRlcyhibG9ja05hbWUpKSByZXR1cm4gc2V0dGluZ3M7XHJcbiAgICBzZXR0aW5ncy5hdHRyaWJ1dGVzLnNwYWNpbmcgPSB7XHJcbiAgICAgICAgdHlwZTogJ3N0cmluZycsXHJcbiAgICAgICAgZGVmYXVsdDogc3BhY2luZ09wdGlvbnNbMl0udmFsdWVcclxuICAgIH07XHJcbiAgICBzZXR0aW5ncy5zdXBwb3J0cy5jbGFzc05hbWUgPSB0cnVlO1xyXG4gICAgcmV0dXJuIHNldHRpbmdzO1xyXG59O1xyXG5cclxuYWRkRmlsdGVyKFxyXG4gICAgJ2Jsb2Nrcy5yZWdpc3RlckJsb2NrVHlwZScsXHJcbiAgICAncGduL2F0dHJpYnV0ZS9zcGFjaW5nJyxcclxuICAgIGFkZFNwYWNpbmdDb250cm9sQXR0cmlidXRlXHJcbik7XHJcblxyXG4vLyBGaWx0ZXIgb3V0IHNwYWNpbmcgY3NzIGNsYXNzZXMgdG8gcHJlc2VydmUgb3RoZXIgYWRkaXRpb25hbCBjbGFzc2VzXHJcbmNvbnN0IHJlbW92ZUZyb21DbGFzc05hbWUgPSAoIGNsYXNzTmFtZSA9ICcnLCBjbGFzc0FycmF5ICkgPT4ge1xyXG5cdHJldHVybiBjbGFzc05hbWUuc3BsaXQoICcgJyApXHJcblx0XHQuZmlsdGVyKCBjbGFzc1N0cmluZyA9PiAhIGNsYXNzQXJyYXkuaW5jbHVkZXMoIGNsYXNzU3RyaW5nICkgKVxyXG5cdFx0LmpvaW4oICcgJyApXHJcblx0XHQucmVwbGFjZSggL1xccysvZywgJyAnICkgLy8gUmVtb3ZlIHN1cGVyZmx1b3VzIHdoaXRlc3BhY2VcclxuXHRcdC50cmltU3RhcnQoKTtcclxufTtcclxuXHJcbmNvbnN0IHdpdGhTcGFjaW5nQ29udHJvbCA9IGNyZWF0ZUhpZ2hlck9yZGVyQ29tcG9uZW50KEJsb2NrRWRpdCA9PiB7XHJcbiAgICByZXR1cm4gcHJvcHMgPT4ge1xyXG4gICAgICAgIC8vIERvIG5vdGhpbmcgaWYgaXQncyBhbm90aGVyIGJsb2NrIHRoYW4gb3VyIGRlZmluZWQgb25lcy5cclxuICAgICAgICBpZiAoIWJsb2Nrc1dpdGhTcGFjaW5nQ29udHJvbC5pbmNsdWRlcyhwcm9wcy5uYW1lKSkge1xyXG4gICAgICAgICAgICByZXR1cm4gKFxyXG4gICAgICAgICAgICAgICAgPEJsb2NrRWRpdCB7IC4uLnByb3BzIH0gLz5cclxuICAgICAgICAgICAgKTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGNvbnN0IHtzcGFjaW5nLCBjbGFzc05hbWV9ID0gcHJvcHMuYXR0cmlidXRlcztcclxuICAgICAgICBjb25zdCBzcGFjaW5nQ2xhc3NlcyA9IHNwYWNpbmdPcHRpb25zLm1hcChvcHQgPT4gJ210LScgKyBvcHQudmFsdWUpXHJcbiAgICAgICAgY29uc3QgY2xhc3NOYW1lV2l0aG91dFNwYWNpbmcgPSByZW1vdmVGcm9tQ2xhc3NOYW1lKGNsYXNzTmFtZSwgc3BhY2luZ0NsYXNzZXMpO1xyXG4gICAgICAgIHByb3BzLmF0dHJpYnV0ZXMuY2xhc3NOYW1lID0gc3BhY2luZyA/XHJcblx0XHRcdFx0YG10LSR7IHNwYWNpbmcgfSAkeyBjbGFzc05hbWVXaXRob3V0U3BhY2luZyB9YCA6XHJcblx0XHRcdFx0Y2xhc3NOYW1lV2l0aG91dFNwYWNpbmc7XHJcblxyXG4gICAgICAgIHJldHVybiAoXHJcbiAgICAgICAgICAgIDxGcmFnbWVudD5cclxuICAgICAgICAgICAgICAgIDxCbG9ja0VkaXQgey4uLnByb3BzfSAvPlxyXG4gICAgICAgICAgICAgICAgPEluc3BlY3RvckNvbnRyb2xzPlxyXG4gICAgICAgICAgICAgICAgICAgIDxQYW5lbEJvZHkgdGl0bGU9eyBfXygnU3BhY2UgQWJvdmUnKX0gaW5pdGlhbE9wZW4gPSB7dHJ1ZX0+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIDxTZWxlY3RDb250cm9sXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB2YWx1ZT17IHNwYWNpbmcgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgb3B0aW9ucz17IHNwYWNpbmdPcHRpb25zIH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG9uQ2hhbmdlPXsgKCBzZWxlY3RlZFNwYWNpbmdPcHRpb24gKSA9PiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgcHJvcHMuc2V0QXR0cmlidXRlcygge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBzcGFjaW5nOiBzZWxlY3RlZFNwYWNpbmdPcHRpb24sXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfSApO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfSB9XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIC8+XHJcbiAgICAgICAgICAgICAgICAgICAgPC9QYW5lbEJvZHk+XHJcbiAgICAgICAgICAgICAgICA8L0luc3BlY3RvckNvbnRyb2xzPlxyXG4gICAgICAgICAgICA8L0ZyYWdtZW50PlxyXG4gICAgICAgICk7XHJcbiAgICB9XHJcbn0sICd3aXRoU3BhY2luZ0NvbnRyb2wnKTtcclxuXHJcbmFkZEZpbHRlciggJ2VkaXRvci5CbG9ja0VkaXQnLCAncGduL3dpdGgtc3BhY2luZy1jb250cm9sJywgd2l0aFNwYWNpbmdDb250cm9sICk7Il0sIm5hbWVzIjpbIiQiLCJjcmVhdGVIaWdoZXJPcmRlckNvbXBvbmVudCIsIndwIiwiY29tcG9zZSIsIkZyYWdtZW50IiwiZWxlbWVudCIsIkluc3BlY3RvckNvbnRyb2xzIiwiZWRpdG9yIiwiY29tcG9uZW50cyIsIlBhbmVsQm9keSIsIlNlbGVjdENvbnRyb2wiLCJhZGRGaWx0ZXIiLCJob29rcyIsIl9fIiwiaTE4biIsImRvY3VtZW50Iiwib24iLCJ3aW5kb3ciLCJhY2YiLCJhZGRBY3Rpb24iLCIkYmxvY2siLCJxdWVyeVNlbGVjdG9yIiwiaW5uZXIiLCJpbWciLCJjcmVhdGVFbGVtZW50IiwiY2xhc3NMaXN0IiwiYWRkIiwic3JjIiwidGhlbWUiLCJ0ZW1wbGF0ZVVSTCIsImFwcGVuZENoaWxkIiwicGxhY2Vob2xkZXIiLCJyZW1vdmUiLCJibG9ja3NXaXRoU3BhY2luZ0NvbnRyb2wiLCJzcGFjaW5nT3B0aW9ucyIsImxhYmVsIiwidmFsdWUiLCJhZGRTcGFjaW5nQ29udHJvbEF0dHJpYnV0ZSIsInNldHRpbmdzIiwiYmxvY2tOYW1lIiwiaW5jbHVkZXMiLCJhdHRyaWJ1dGVzIiwic3BhY2luZyIsInR5cGUiLCJzdXBwb3J0cyIsImNsYXNzTmFtZSIsInJlbW92ZUZyb21DbGFzc05hbWUiLCJjbGFzc0FycmF5Iiwic3BsaXQiLCJmaWx0ZXIiLCJjbGFzc1N0cmluZyIsImpvaW4iLCJyZXBsYWNlIiwidHJpbVN0YXJ0Iiwid2l0aFNwYWNpbmdDb250cm9sIiwiQmxvY2tFZGl0IiwicHJvcHMiLCJuYW1lIiwic3BhY2luZ0NsYXNzZXMiLCJtYXAiLCJvcHQiLCJjbGFzc05hbWVXaXRob3V0U3BhY2luZyIsInNlbGVjdGVkU3BhY2luZ09wdGlvbiIsInNldEF0dHJpYnV0ZXMiXSwic291cmNlUm9vdCI6IiJ9