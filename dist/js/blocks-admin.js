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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QUUyQyxrQkFBa0IsQ0FBRSxDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vcGduL2V4dGVybmFsIHZhciBcImpRdWVyeVwiIiwid2VicGFjazovL3Bnbi93ZWJwYWNrL2Jvb3RzdHJhcCIsIndlYnBhY2s6Ly9wZ24vd2VicGFjay9ydW50aW1lL2NvbXBhdCBnZXQgZGVmYXVsdCBleHBvcnQiLCJ3ZWJwYWNrOi8vcGduL3dlYnBhY2svcnVudGltZS9kZWZpbmUgcHJvcGVydHkgZ2V0dGVycyIsIndlYnBhY2s6Ly9wZ24vd2VicGFjay9ydW50aW1lL2hhc093blByb3BlcnR5IHNob3J0aGFuZCIsIndlYnBhY2s6Ly9wZ24vd2VicGFjay9ydW50aW1lL21ha2UgbmFtZXNwYWNlIG9iamVjdCIsIndlYnBhY2s6Ly9wZ24vLi9zcmMvanMvYmxvY2tzLWFkbWluLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIm1vZHVsZS5leHBvcnRzID0galF1ZXJ5OyIsIi8vIFRoZSBtb2R1bGUgY2FjaGVcbnZhciBfX3dlYnBhY2tfbW9kdWxlX2NhY2hlX18gPSB7fTtcblxuLy8gVGhlIHJlcXVpcmUgZnVuY3Rpb25cbmZ1bmN0aW9uIF9fd2VicGFja19yZXF1aXJlX18obW9kdWxlSWQpIHtcblx0Ly8gQ2hlY2sgaWYgbW9kdWxlIGlzIGluIGNhY2hlXG5cdHZhciBjYWNoZWRNb2R1bGUgPSBfX3dlYnBhY2tfbW9kdWxlX2NhY2hlX19bbW9kdWxlSWRdO1xuXHRpZiAoY2FjaGVkTW9kdWxlICE9PSB1bmRlZmluZWQpIHtcblx0XHRyZXR1cm4gY2FjaGVkTW9kdWxlLmV4cG9ydHM7XG5cdH1cblx0Ly8gQ3JlYXRlIGEgbmV3IG1vZHVsZSAoYW5kIHB1dCBpdCBpbnRvIHRoZSBjYWNoZSlcblx0dmFyIG1vZHVsZSA9IF9fd2VicGFja19tb2R1bGVfY2FjaGVfX1ttb2R1bGVJZF0gPSB7XG5cdFx0Ly8gbm8gbW9kdWxlLmlkIG5lZWRlZFxuXHRcdC8vIG5vIG1vZHVsZS5sb2FkZWQgbmVlZGVkXG5cdFx0ZXhwb3J0czoge31cblx0fTtcblxuXHQvLyBFeGVjdXRlIHRoZSBtb2R1bGUgZnVuY3Rpb25cblx0X193ZWJwYWNrX21vZHVsZXNfX1ttb2R1bGVJZF0obW9kdWxlLCBtb2R1bGUuZXhwb3J0cywgX193ZWJwYWNrX3JlcXVpcmVfXyk7XG5cblx0Ly8gUmV0dXJuIHRoZSBleHBvcnRzIG9mIHRoZSBtb2R1bGVcblx0cmV0dXJuIG1vZHVsZS5leHBvcnRzO1xufVxuXG4iLCIvLyBnZXREZWZhdWx0RXhwb3J0IGZ1bmN0aW9uIGZvciBjb21wYXRpYmlsaXR5IHdpdGggbm9uLWhhcm1vbnkgbW9kdWxlc1xuX193ZWJwYWNrX3JlcXVpcmVfXy5uID0gKG1vZHVsZSkgPT4ge1xuXHR2YXIgZ2V0dGVyID0gbW9kdWxlICYmIG1vZHVsZS5fX2VzTW9kdWxlID9cblx0XHQoKSA9PiAobW9kdWxlWydkZWZhdWx0J10pIDpcblx0XHQoKSA9PiAobW9kdWxlKTtcblx0X193ZWJwYWNrX3JlcXVpcmVfXy5kKGdldHRlciwgeyBhOiBnZXR0ZXIgfSk7XG5cdHJldHVybiBnZXR0ZXI7XG59OyIsIi8vIGRlZmluZSBnZXR0ZXIgZnVuY3Rpb25zIGZvciBoYXJtb255IGV4cG9ydHNcbl9fd2VicGFja19yZXF1aXJlX18uZCA9IChleHBvcnRzLCBkZWZpbml0aW9uKSA9PiB7XG5cdGZvcih2YXIga2V5IGluIGRlZmluaXRpb24pIHtcblx0XHRpZihfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZGVmaW5pdGlvbiwga2V5KSAmJiAhX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIGtleSkpIHtcblx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBrZXksIHsgZW51bWVyYWJsZTogdHJ1ZSwgZ2V0OiBkZWZpbml0aW9uW2tleV0gfSk7XG5cdFx0fVxuXHR9XG59OyIsIl9fd2VicGFja19yZXF1aXJlX18ubyA9IChvYmosIHByb3ApID0+IChPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwob2JqLCBwcm9wKSkiLCIvLyBkZWZpbmUgX19lc01vZHVsZSBvbiBleHBvcnRzXG5fX3dlYnBhY2tfcmVxdWlyZV9fLnIgPSAoZXhwb3J0cykgPT4ge1xuXHRpZih0eXBlb2YgU3ltYm9sICE9PSAndW5kZWZpbmVkJyAmJiBTeW1ib2wudG9TdHJpbmdUYWcpIHtcblx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgU3ltYm9sLnRvU3RyaW5nVGFnLCB7IHZhbHVlOiAnTW9kdWxlJyB9KTtcblx0fVxuXHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgJ19fZXNNb2R1bGUnLCB7IHZhbHVlOiB0cnVlIH0pO1xufTsiLCIvLyBidW5kbGUuanNcbmltcG9ydCAkIGZyb20gJ2pxdWVyeSc7XG5jb25zdCB7IGNyZWF0ZUhpZ2hlck9yZGVyQ29tcG9uZW50IH0gPSB3cC5jb21wb3NlO1xuY29uc3QgeyBGcmFnbWVudCB9ID0gd3AuZWxlbWVudDtcbmNvbnN0IHsgSW5zcGVjdG9yQ29udHJvbHMgfSA9IHdwLmVkaXRvcjtcbmNvbnN0IHsgUGFuZWxCb2R5LCBTZWxlY3RDb250cm9sIH0gPSB3cC5jb21wb25lbnRzO1xuY29uc3QgeyBhZGRGaWx0ZXIgfSA9IHdwLmhvb2tzO1xuY29uc3QgeyBfXyB9ID0gd3AuaTE4bjtcblxuJChkb2N1bWVudCkub24oJ3JlYWR5JywgKCkgPT4ge1xuICAgIGlmKHdpbmRvdy5hY2Ype1xuICAgICAgICB3aW5kb3cuYWNmLmFkZEFjdGlvbigncmVuZGVyX2Jsb2NrX3ByZXZpZXcvdHlwZT1pbWFnZScsICgkYmxvY2spID0+IHtcbiAgICAgICAgICAgIGlmKCEkYmxvY2tbMF0ucXVlcnlTZWxlY3RvcignaW1nJykpe1xuICAgICAgICAgICAgICAgIGxldCBpbm5lciA9ICRibG9ja1swXS5xdWVyeVNlbGVjdG9yKCcuYmxvY2staW1hZ2UnKTtcbiAgICAgICAgICAgICAgICBsZXQgaW1nID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnaW1nJyk7XG4gICAgICAgICAgICAgICAgaW1nLmNsYXNzTGlzdC5hZGQoJ3BsYWNlaG9sZGVyLWltYWdlJyk7XG4gICAgICAgICAgICAgICAgaW1nLnNyYyA9IHRoZW1lLnRlbXBsYXRlVVJMICsgJy9kaXN0L2ltYWdlcy9pbWctcGxhY2Vob2xkZXItMTZ4OS5zdmcnO1xuICAgICAgICAgICAgICAgIGlubmVyLmFwcGVuZENoaWxkKGltZyk7XG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgIGxldCBpbm5lciA9ICRibG9ja1swXS5xdWVyeVNlbGVjdG9yKCcuYmxvY2staW1hZ2UnKTtcbiAgICAgICAgICAgICAgICBsZXQgcGxhY2Vob2xkZXIgPSBpbm5lci5xdWVyeVNlbGVjdG9yKCcucGxhY2Vob2xkZXItaW1hZ2UnKTtcbiAgICAgICAgICAgICAgICBpZihwbGFjZWhvbGRlcikgcGxhY2Vob2xkZXIucmVtb3ZlKCk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH1cbn0pO1xuXG5jb25zdCBibG9ja3NXaXRoU3BhY2luZ0NvbnRyb2wgPSBbXG4gICAgJ2NvcmUvcGFyYWdyYXBoJyxcbiAgICAnY29yZS9saXN0JyxcbiAgICAnY29yZS9oZWFkaW5nJ1xuXTtcblxuY29uc3Qgc3BhY2luZ09wdGlvbnMgPSBbXG4gICAge1xuICAgICAgICBsYWJlbDogX18oICdOb25lJyApLFxuICAgICAgICB2YWx1ZTogJ25vbmUnXG4gICAgfSxcbiAgICB7XG4gICAgICAgIGxhYmVsOiBfXyggJ1hTJyApLFxuICAgICAgICB2YWx1ZTogJ3hzJ1xuICAgIH0sXG4gICAge1xuICAgICAgICBsYWJlbDogX18oICdTTScgKSxcbiAgICAgICAgdmFsdWU6ICdzbSdcbiAgICB9LFxuICAgIHtcbiAgICAgICAgbGFiZWw6IF9fKCAnTUQnICksXG4gICAgICAgIHZhbHVlOiAnbWQnXG4gICAgfSxcbiAgICB7XG4gICAgICAgIGxhYmVsOiBfXyggJ0xHJyApLFxuICAgICAgICB2YWx1ZTogJ2xnJ1xuICAgIH0sXG4gICAge1xuICAgICAgICBsYWJlbDogX18oICdYTCcgKSxcbiAgICAgICAgdmFsdWU6ICd4bCdcbiAgICB9LFxuXTtcblxuY29uc3QgYWRkU3BhY2luZ0NvbnRyb2xBdHRyaWJ1dGUgPSAoc2V0dGluZ3MsIGJsb2NrTmFtZSkgPT4ge1xuICAgIGlmKCFibG9ja3NXaXRoU3BhY2luZ0NvbnRyb2wuaW5jbHVkZXMoYmxvY2tOYW1lKSkgcmV0dXJuIHNldHRpbmdzO1xuICAgIHNldHRpbmdzLmF0dHJpYnV0ZXMuc3BhY2luZyA9IHtcbiAgICAgICAgdHlwZTogJ3N0cmluZycsXG4gICAgICAgIGRlZmF1bHQ6IHNwYWNpbmdPcHRpb25zWzJdLnZhbHVlXG4gICAgfTtcbiAgICBzZXR0aW5ncy5zdXBwb3J0cy5jbGFzc05hbWUgPSB0cnVlO1xuICAgIHJldHVybiBzZXR0aW5ncztcbn07XG5cbmFkZEZpbHRlcihcbiAgICAnYmxvY2tzLnJlZ2lzdGVyQmxvY2tUeXBlJyxcbiAgICAncGduL2F0dHJpYnV0ZS9zcGFjaW5nJyxcbiAgICBhZGRTcGFjaW5nQ29udHJvbEF0dHJpYnV0ZVxuKTtcblxuLy8gRmlsdGVyIG91dCBzcGFjaW5nIGNzcyBjbGFzc2VzIHRvIHByZXNlcnZlIG90aGVyIGFkZGl0aW9uYWwgY2xhc3Nlc1xuY29uc3QgcmVtb3ZlRnJvbUNsYXNzTmFtZSA9ICggY2xhc3NOYW1lID0gJycsIGNsYXNzQXJyYXkgKSA9PiB7XG5cdHJldHVybiBjbGFzc05hbWUuc3BsaXQoICcgJyApXG5cdFx0LmZpbHRlciggY2xhc3NTdHJpbmcgPT4gISBjbGFzc0FycmF5LmluY2x1ZGVzKCBjbGFzc1N0cmluZyApIClcblx0XHQuam9pbiggJyAnIClcblx0XHQucmVwbGFjZSggL1xccysvZywgJyAnICkgLy8gUmVtb3ZlIHN1cGVyZmx1b3VzIHdoaXRlc3BhY2Vcblx0XHQudHJpbVN0YXJ0KCk7XG59O1xuXG5jb25zdCB3aXRoU3BhY2luZ0NvbnRyb2wgPSBjcmVhdGVIaWdoZXJPcmRlckNvbXBvbmVudChCbG9ja0VkaXQgPT4ge1xuICAgIHJldHVybiBwcm9wcyA9PiB7XG4gICAgICAgIC8vIERvIG5vdGhpbmcgaWYgaXQncyBhbm90aGVyIGJsb2NrIHRoYW4gb3VyIGRlZmluZWQgb25lcy5cbiAgICAgICAgaWYgKCFibG9ja3NXaXRoU3BhY2luZ0NvbnRyb2wuaW5jbHVkZXMocHJvcHMubmFtZSkpIHtcbiAgICAgICAgICAgIHJldHVybiAoXG4gICAgICAgICAgICAgICAgPEJsb2NrRWRpdCB7IC4uLnByb3BzIH0gLz5cbiAgICAgICAgICAgICk7XG4gICAgICAgIH1cblxuICAgICAgICBjb25zdCB7c3BhY2luZywgY2xhc3NOYW1lfSA9IHByb3BzLmF0dHJpYnV0ZXM7XG4gICAgICAgIGNvbnN0IHNwYWNpbmdDbGFzc2VzID0gc3BhY2luZ09wdGlvbnMubWFwKG9wdCA9PiAnbXQtJyArIG9wdC52YWx1ZSlcbiAgICAgICAgY29uc3QgY2xhc3NOYW1lV2l0aG91dFNwYWNpbmcgPSByZW1vdmVGcm9tQ2xhc3NOYW1lKGNsYXNzTmFtZSwgc3BhY2luZ0NsYXNzZXMpO1xuICAgICAgICBwcm9wcy5hdHRyaWJ1dGVzLmNsYXNzTmFtZSA9IHNwYWNpbmcgP1xuXHRcdFx0XHRgbXQtJHsgc3BhY2luZyB9ICR7IGNsYXNzTmFtZVdpdGhvdXRTcGFjaW5nIH1gIDpcblx0XHRcdFx0Y2xhc3NOYW1lV2l0aG91dFNwYWNpbmc7XG5cbiAgICAgICAgcmV0dXJuIChcbiAgICAgICAgICAgIDxGcmFnbWVudD5cbiAgICAgICAgICAgICAgICA8QmxvY2tFZGl0IHsuLi5wcm9wc30gLz5cbiAgICAgICAgICAgICAgICA8SW5zcGVjdG9yQ29udHJvbHM+XG4gICAgICAgICAgICAgICAgICAgIDxQYW5lbEJvZHkgdGl0bGU9eyBfXygnU3BhY2UgQWJvdmUnKX0gaW5pdGlhbE9wZW4gPSB7dHJ1ZX0+XG4gICAgICAgICAgICAgICAgICAgICAgICA8U2VsZWN0Q29udHJvbFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHZhbHVlPXsgc3BhY2luZyB9XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgb3B0aW9ucz17IHNwYWNpbmdPcHRpb25zIH1cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBvbkNoYW5nZT17ICggc2VsZWN0ZWRTcGFjaW5nT3B0aW9uICkgPT4ge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBwcm9wcy5zZXRBdHRyaWJ1dGVzKCB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBzcGFjaW5nOiBzZWxlY3RlZFNwYWNpbmdPcHRpb24sXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0gKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9IH1cbiAgICAgICAgICAgICAgICAgICAgICAgIC8+XG4gICAgICAgICAgICAgICAgICAgIDwvUGFuZWxCb2R5PlxuICAgICAgICAgICAgICAgIDwvSW5zcGVjdG9yQ29udHJvbHM+XG4gICAgICAgICAgICA8L0ZyYWdtZW50PlxuICAgICAgICApO1xuICAgIH1cbn0sICd3aXRoU3BhY2luZ0NvbnRyb2wnKTtcblxuYWRkRmlsdGVyKCAnZWRpdG9yLkJsb2NrRWRpdCcsICdwZ24vd2l0aC1zcGFjaW5nLWNvbnRyb2wnLCB3aXRoU3BhY2luZ0NvbnRyb2wgKTsiXSwibmFtZXMiOlsiJCIsImNyZWF0ZUhpZ2hlck9yZGVyQ29tcG9uZW50Iiwid3AiLCJjb21wb3NlIiwiRnJhZ21lbnQiLCJlbGVtZW50IiwiSW5zcGVjdG9yQ29udHJvbHMiLCJlZGl0b3IiLCJjb21wb25lbnRzIiwiUGFuZWxCb2R5IiwiU2VsZWN0Q29udHJvbCIsImFkZEZpbHRlciIsImhvb2tzIiwiX18iLCJpMThuIiwiZG9jdW1lbnQiLCJvbiIsIndpbmRvdyIsImFjZiIsImFkZEFjdGlvbiIsIiRibG9jayIsInF1ZXJ5U2VsZWN0b3IiLCJpbm5lciIsImltZyIsImNyZWF0ZUVsZW1lbnQiLCJjbGFzc0xpc3QiLCJhZGQiLCJzcmMiLCJ0aGVtZSIsInRlbXBsYXRlVVJMIiwiYXBwZW5kQ2hpbGQiLCJwbGFjZWhvbGRlciIsInJlbW92ZSIsImJsb2Nrc1dpdGhTcGFjaW5nQ29udHJvbCIsInNwYWNpbmdPcHRpb25zIiwibGFiZWwiLCJ2YWx1ZSIsImFkZFNwYWNpbmdDb250cm9sQXR0cmlidXRlIiwic2V0dGluZ3MiLCJibG9ja05hbWUiLCJpbmNsdWRlcyIsImF0dHJpYnV0ZXMiLCJzcGFjaW5nIiwidHlwZSIsInN1cHBvcnRzIiwiY2xhc3NOYW1lIiwicmVtb3ZlRnJvbUNsYXNzTmFtZSIsImNsYXNzQXJyYXkiLCJzcGxpdCIsImZpbHRlciIsImNsYXNzU3RyaW5nIiwiam9pbiIsInJlcGxhY2UiLCJ0cmltU3RhcnQiLCJ3aXRoU3BhY2luZ0NvbnRyb2wiLCJCbG9ja0VkaXQiLCJwcm9wcyIsIm5hbWUiLCJzcGFjaW5nQ2xhc3NlcyIsIm1hcCIsIm9wdCIsImNsYXNzTmFtZVdpdGhvdXRTcGFjaW5nIiwic2VsZWN0ZWRTcGFjaW5nT3B0aW9uIiwic2V0QXR0cmlidXRlcyJdLCJzb3VyY2VSb290IjoiIn0=