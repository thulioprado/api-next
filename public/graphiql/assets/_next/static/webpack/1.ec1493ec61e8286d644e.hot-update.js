webpackHotUpdate(1,{

/***/ "./components/Editor.jsx":
/*!*******************************!*\
  !*** ./components/Editor.jsx ***!
  \*******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* WEBPACK VAR INJECTION */(function(module) {/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ \"./node_modules/@babel/runtime/regenerator/index.js\");\n/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/esm/asyncToGenerator */ \"./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js\");\n/* harmony import */ var styled_jsx_style__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! styled-jsx/style */ \"./node_modules/styled-jsx/style.js\");\n/* harmony import */ var styled_jsx_style__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(styled_jsx_style__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ \"./node_modules/react/index.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var graphql__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! graphql */ \"./node_modules/graphql/index.mjs\");\n/* harmony import */ var graphiql__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! graphiql */ \"./node_modules/graphiql/dist/index.js\");\n/* harmony import */ var graphiql__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(graphiql__WEBPACK_IMPORTED_MODULE_5__);\n\n\nvar _jsxFileName = \"D:\\\\directus\\\\graphiql2\\\\components\\\\Editor.jsx\";\n\n\nvar __jsx = react__WEBPACK_IMPORTED_MODULE_3___default.a.createElement;\n\n\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (function (_ref) {\n  var server = _ref.server;\n\n  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])([]),\n      projects = _useState[0],\n      setProjects = _useState[1];\n\n  var _useState2 = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])(window.localStorage.getItem('directus:project')),\n      project = _useState2[0],\n      setProject = _useState2[1];\n\n  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])(window.localStorage.getItem(\"directus:\".concat(project, \":graphiql:query\")) || \"# Query\"),\n      query = _useState3[0],\n      setQuery = _useState3[1];\n\n  var _useState4 = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])(window.localStorage.getItem(\"directus:\".concat(project, \":graphiql:variables\")) || \"{}\"),\n      variables = _useState4[0],\n      setVariables = _useState4[1];\n\n  server = server || '';\n\n  if (server.endsWith('/')) {\n    server = server.substr(0, server.length - 1);\n  }\n\n  var fetchProjects = /*#__PURE__*/function () {\n    var _ref2 = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {\n      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {\n        while (1) {\n          switch (_context.prev = _context.next) {\n            case 0:\n              console.log();\n\n            case 1:\n            case \"end\":\n              return _context.stop();\n          }\n        }\n      }, _callee);\n    }));\n\n    return function fetchProjects() {\n      return _ref2.apply(this, arguments);\n    };\n  }();\n\n  var fetchQuery = /*#__PURE__*/function () {\n    var _ref3 = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2(params) {\n      var url, res, payload, formattedQuery, formattedVariables;\n      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {\n        while (1) {\n          switch (_context2.prev = _context2.next) {\n            case 0:\n              url = \"\".concat(server, \"/\").concat(project, \"/graphql\");\n              _context2.next = 3;\n              return fetch(url, {\n                method: \"post\",\n                headers: {\n                  Accept: \"application/json\",\n                  \"Content-Type\": \"application/json\"\n                },\n                body: JSON.stringify(params)\n              });\n\n            case 3:\n              res = _context2.sent;\n              _context2.next = 6;\n              return res.json();\n\n            case 6:\n              payload = _context2.sent;\n\n              if (res.ok && query) {\n                try {\n                  formattedQuery = Object(graphql__WEBPACK_IMPORTED_MODULE_4__[\"print\"])(Object(graphql__WEBPACK_IMPORTED_MODULE_4__[\"parse\"])(query));\n\n                  if (query !== formattedQuery) {\n                    setQuery(formattedQuery);\n                  }\n\n                  formattedVariables = JSON.stringify(JSON.parse(variables), null, 4);\n\n                  if (variables !== formattedVariables) {\n                    setVariables(formattedVariables);\n                  }\n                } catch (error) {}\n              }\n\n              return _context2.abrupt(\"return\", payload);\n\n            case 9:\n            case \"end\":\n              return _context2.stop();\n          }\n        }\n      }, _callee2);\n    }));\n\n    return function fetchQuery(_x) {\n      return _ref3.apply(this, arguments);\n    };\n  }();\n\n  Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useEffect\"])(function () {\n    fetchProjects().then(function (projects) {\n      setProjects(projects);\n    });\n  }, []);\n  return __jsx(react__WEBPACK_IMPORTED_MODULE_3___default.a.Fragment, null, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a, {\n    editorTheme: \"directus\",\n    query: query,\n    variables: variables,\n    onEditQuery: setQuery,\n    onEditVariables: setVariables,\n    fetcher: fetchQuery,\n    storage: {\n      getItem: function getItem(name) {\n        return window.localStorage.getItem(\"directus:\".concat(project, \":\").concat(name));\n      },\n      setItem: function setItem(name, value) {\n        return window.localStorage.setItem(\"directus:\".concat(project, \":\").concat(name), value);\n      },\n      removeItem: function removeItem(name) {\n        return window.localStorage.removeItem(\"directus:\".concat(project, \":\").concat(name));\n      }\n    },\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 59,\n      columnNumber: 7\n    }\n  }, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.Logo, {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 78,\n      columnNumber: 9\n    }\n  }, __jsx(\"div\", {\n    className: \"jsx-2949793544\" + \" \" + \"logo\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 79,\n      columnNumber: 11\n    }\n  }, __jsx(\"img\", {\n    src: \"images/logo.svg\",\n    className: \"jsx-2949793544\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 80,\n      columnNumber: 13\n    }\n  }), __jsx(\"span\", {\n    className: \"jsx-2949793544\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 81,\n      columnNumber: 13\n    }\n  }, \"Directus\")))), __jsx(styled_jsx_style__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    id: \"2949793544\",\n    __self: this\n  }, \".logo.jsx-2949793544{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-align-content:stretch;-ms-flex-line-pack:stretch;align-content:stretch;}.logo.jsx-2949793544 span.jsx-2949793544{margin-left:12px;font-family:Roboto;}.logo.jsx-2949793544 img.jsx-2949793544{height:24px;}\\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIkQ6XFxkaXJlY3R1c1xcZ3JhcGhpcWwyXFxjb21wb25lbnRzXFxFZGl0b3IuanN4Il0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQXNGa0IsQUFHd0IsQUFRSSxBQUlMLFlBQ2QsS0FKcUIsbUJBQ3JCLHNDQVRxQixxRUFDRiwrREFDTSxtR0FDSiw2RkFDRywrRUFDeEIiLCJmaWxlIjoiRDpcXGRpcmVjdHVzXFxncmFwaGlxbDJcXGNvbXBvbmVudHNcXEVkaXRvci5qc3giLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgeyB1c2VTdGF0ZSwgdXNlRWZmZWN0IH0gZnJvbSBcInJlYWN0XCI7XG5pbXBvcnQgeyBwYXJzZSwgcHJpbnQgfSBmcm9tIFwiZ3JhcGhxbFwiO1xuaW1wb3J0IEdyYXBoaVFMIGZyb20gXCJncmFwaGlxbFwiO1xuXG5leHBvcnQgZGVmYXVsdCBmdW5jdGlvbiAoeyBzZXJ2ZXIgfSkge1xuICBjb25zdCBbcHJvamVjdHMsIHNldFByb2plY3RzXSA9IHVzZVN0YXRlKFtdKTtcbiAgY29uc3QgW3Byb2plY3QsIHNldFByb2plY3RdID0gdXNlU3RhdGUod2luZG93LmxvY2FsU3RvcmFnZS5nZXRJdGVtKCdkaXJlY3R1czpwcm9qZWN0JykpO1xuICBjb25zdCBbcXVlcnksIHNldFF1ZXJ5XSA9IHVzZVN0YXRlKHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbShgZGlyZWN0dXM6JHtwcm9qZWN0fTpncmFwaGlxbDpxdWVyeWApIHx8IFwiIyBRdWVyeVwiKTtcbiAgY29uc3QgW3ZhcmlhYmxlcywgc2V0VmFyaWFibGVzXSA9IHVzZVN0YXRlKHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbShgZGlyZWN0dXM6JHtwcm9qZWN0fTpncmFwaGlxbDp2YXJpYWJsZXNgKSB8fCBcInt9XCIpO1xuXG4gIHNlcnZlciA9IHNlcnZlciB8fCAnJztcbiAgaWYgKHNlcnZlci5lbmRzV2l0aCgnLycpKSB7XG4gICAgc2VydmVyID0gc2VydmVyLnN1YnN0cigwLCBzZXJ2ZXIubGVuZ3RoIC0gMSk7XG4gIH1cblxuICBjb25zdCBmZXRjaFByb2plY3RzID0gYXN5bmMgKCkgPT4ge1xuICAgIGNvbnNvbGUubG9nKClcbiAgfTtcblxuICBjb25zdCBmZXRjaFF1ZXJ5ID0gYXN5bmMgKHBhcmFtcykgPT4ge1xuICAgIGNvbnN0IHVybCA9IGAke3NlcnZlcn0vJHtwcm9qZWN0fS9ncmFwaHFsYDtcblxuICAgIGNvbnN0IHJlcyA9IGF3YWl0IGZldGNoKHVybCwge1xuICAgICAgbWV0aG9kOiBcInBvc3RcIixcbiAgICAgIGhlYWRlcnM6IHtcbiAgICAgICAgQWNjZXB0OiBcImFwcGxpY2F0aW9uL2pzb25cIixcbiAgICAgICAgXCJDb250ZW50LVR5cGVcIjogXCJhcHBsaWNhdGlvbi9qc29uXCIsXG4gICAgICB9LFxuICAgICAgYm9keTogSlNPTi5zdHJpbmdpZnkocGFyYW1zKSxcbiAgICB9KTtcblxuICAgIGNvbnN0IHBheWxvYWQgPSBhd2FpdCByZXMuanNvbigpO1xuICAgIGlmIChyZXMub2sgJiYgcXVlcnkpIHtcbiAgICAgIHRyeSB7XG4gICAgICAgIGNvbnN0IGZvcm1hdHRlZFF1ZXJ5ID0gcHJpbnQocGFyc2UocXVlcnkpKTtcbiAgICAgICAgaWYgKHF1ZXJ5ICE9PSBmb3JtYXR0ZWRRdWVyeSkge1xuICAgICAgICAgIHNldFF1ZXJ5KGZvcm1hdHRlZFF1ZXJ5KTtcbiAgICAgICAgfVxuXG4gICAgICAgIGNvbnN0IGZvcm1hdHRlZFZhcmlhYmxlcyA9IEpTT04uc3RyaW5naWZ5KEpTT04ucGFyc2UodmFyaWFibGVzKSwgbnVsbCwgNCk7XG4gICAgICAgIGlmICh2YXJpYWJsZXMgIT09IGZvcm1hdHRlZFZhcmlhYmxlcykge1xuICAgICAgICAgIHNldFZhcmlhYmxlcyhmb3JtYXR0ZWRWYXJpYWJsZXMpO1xuICAgICAgICB9XG4gICAgICB9IGNhdGNoIChlcnJvcikge1xuICAgICAgfVxuICAgIH1cblxuICAgIHJldHVybiBwYXlsb2FkO1xuICB9O1xuXG4gIHVzZUVmZmVjdCgoKSA9PiB7XG4gICAgZmV0Y2hQcm9qZWN0cygpLnRoZW4oKHByb2plY3RzKSA9PiB7XG4gICAgICBzZXRQcm9qZWN0cyhwcm9qZWN0cyk7XG4gICAgfSk7XG4gIH0sIFtdKTtcblxuICByZXR1cm4gKFxuICAgIDw+XG4gICAgICA8R3JhcGhpUUxcbiAgICAgICAgZWRpdG9yVGhlbWU9XCJkaXJlY3R1c1wiXG4gICAgICAgIHF1ZXJ5PXtxdWVyeX1cbiAgICAgICAgdmFyaWFibGVzPXt2YXJpYWJsZXN9XG4gICAgICAgIG9uRWRpdFF1ZXJ5PXtzZXRRdWVyeX1cbiAgICAgICAgb25FZGl0VmFyaWFibGVzPXtzZXRWYXJpYWJsZXN9XG4gICAgICAgIGZldGNoZXI9e2ZldGNoUXVlcnl9XG4gICAgICAgIHN0b3JhZ2U9e3tcbiAgICAgICAgICBnZXRJdGVtKG5hbWUpIHtcbiAgICAgICAgICAgIHJldHVybiB3aW5kb3cubG9jYWxTdG9yYWdlLmdldEl0ZW0oYGRpcmVjdHVzOiR7cHJvamVjdH06JHtuYW1lfWApO1xuICAgICAgICAgIH0sXG4gICAgICAgICAgc2V0SXRlbShuYW1lLCB2YWx1ZSkge1xuICAgICAgICAgICAgcmV0dXJuIHdpbmRvdy5sb2NhbFN0b3JhZ2Uuc2V0SXRlbShgZGlyZWN0dXM6JHtwcm9qZWN0fToke25hbWV9YCwgdmFsdWUpO1xuICAgICAgICAgIH0sXG4gICAgICAgICAgcmVtb3ZlSXRlbShuYW1lKSB7XG4gICAgICAgICAgICByZXR1cm4gd2luZG93LmxvY2FsU3RvcmFnZS5yZW1vdmVJdGVtKGBkaXJlY3R1czoke3Byb2plY3R9OiR7bmFtZX1gKTtcbiAgICAgICAgICB9XG4gICAgICAgIH19XG4gICAgICA+XG4gICAgICAgIDxHcmFwaGlRTC5Mb2dvPlxuICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwibG9nb1wiPlxuICAgICAgICAgICAgPGltZyBzcmM9XCJpbWFnZXMvbG9nby5zdmdcIiAvPlxuICAgICAgICAgICAgPHNwYW4+XG4gICAgICAgICAgICAgIERpcmVjdHVzXG4gICAgICAgICAgICA8L3NwYW4+XG4gICAgICAgICAgPC9kaXY+XG4gICAgICAgIDwvR3JhcGhpUUwuTG9nbz5cbiAgICAgIDwvR3JhcGhpUUw+XG4gICAgICA8c3R5bGUganN4PntgXG4gICAgICAgIC5sb2dvIHtcbiAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xuICAgICAgICAgIGZsZXgtZGlyZWN0aW9uOiByb3c7XG4gICAgICAgICAgZmxleC13cmFwOiBub3dyYXA7XG4gICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgICAgICAgICBhbGlnbi1jb250ZW50OiBzdHJldGNoO1xuICAgICAgICB9XG4gICAgICAgIC5sb2dvIHNwYW4ge1xuICAgICAgICAgIG1hcmdpbi1sZWZ0OiAxMnB4O1xuICAgICAgICAgIGZvbnQtZmFtaWx5OiBSb2JvdG87XG4gICAgICAgIH1cbiAgICAgICAgLmxvZ28gaW1nIHtcbiAgICAgICAgICBoZWlnaHQ6IDI0cHg7XG4gICAgICAgIH1cbiAgICAgIGB9PC9zdHlsZT5cbiAgICA8Lz5cbiAgKTtcbn1cbiJdfQ== */\\n/*@ sourceURL=D:\\\\\\\\directus\\\\\\\\graphiql2\\\\\\\\components\\\\\\\\Editor.jsx */\"));\n});\n\n;\n    var _a, _b;\n    // Legacy CSS implementations will `eval` browser code in a Node.js context\n    // to extract CSS. For backwards compatibility, we need to check we're in a\n    // browser context before continuing.\n    if (typeof self !== 'undefined' &&\n        // AMP / No-JS mode does not inject these helpers:\n        '$RefreshHelpers$' in self) {\n        var currentExports_1 = module.__proto__.exports;\n        var prevExports = (_b = (_a = module.hot.data) === null || _a === void 0 ? void 0 : _a.prevExports) !== null && _b !== void 0 ? _b : null;\n        // This cannot happen in MainTemplate because the exports mismatch between\n        // templating and execution.\n        self.$RefreshHelpers$.registerExportsForReactRefresh(currentExports_1, module.i);\n        // A module can be accepted automatically based on its exports, e.g. when\n        // it is a Refresh Boundary.\n        if (self.$RefreshHelpers$.isReactRefreshBoundary(currentExports_1)) {\n            // Save the previous exports on update so we can compare the boundary\n            // signatures.\n            module.hot.dispose(function (data) {\n                data.prevExports = currentExports_1;\n            });\n            // Unconditionally accept an update to this module, we'll check if it's\n            // still a Refresh Boundary later.\n            module.hot.accept();\n            // This field is set when the previous version of this module was a\n            // Refresh Boundary, letting us know we need to check for invalidation or\n            // enqueue an update.\n            if (prevExports !== null) {\n                // A boundary can become ineligible if its exports are incompatible\n                // with the previous exports.\n                //\n                // For example, if you add/remove/change exports, we'll want to\n                // re-execute the importing modules, and force those components to\n                // re-render. Similarly, if you convert a class component to a\n                // function, we want to invalidate the boundary.\n                if (self.$RefreshHelpers$.shouldInvalidateReactRefreshBoundary(prevExports, currentExports_1)) {\n                    module.hot.invalidate();\n                }\n                else {\n                    self.$RefreshHelpers$.scheduleUpdate();\n                }\n            }\n        }\n        else {\n            // Since we just executed the code for the module, it's possible that the\n            // new exports made it ineligible for being a boundary.\n            // We only care about the case when we were _previously_ a boundary,\n            // because we already accepted this update (accidental side effect).\n            var isNoLongerABoundary = prevExports !== null;\n            if (isNoLongerABoundary) {\n                module.hot.invalidate();\n            }\n        }\n    }\n\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../node_modules/webpack/buildin/harmony-module.js */ \"./node_modules/webpack/buildin/harmony-module.js\")(module)))//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9jb21wb25lbnRzL0VkaXRvci5qc3g/ZDdkNiJdLCJuYW1lcyI6WyJzZXJ2ZXIiLCJ1c2VTdGF0ZSIsInByb2plY3RzIiwic2V0UHJvamVjdHMiLCJ3aW5kb3ciLCJsb2NhbFN0b3JhZ2UiLCJnZXRJdGVtIiwicHJvamVjdCIsInNldFByb2plY3QiLCJxdWVyeSIsInNldFF1ZXJ5IiwidmFyaWFibGVzIiwic2V0VmFyaWFibGVzIiwiZW5kc1dpdGgiLCJzdWJzdHIiLCJsZW5ndGgiLCJmZXRjaFByb2plY3RzIiwiY29uc29sZSIsImxvZyIsImZldGNoUXVlcnkiLCJwYXJhbXMiLCJ1cmwiLCJmZXRjaCIsIm1ldGhvZCIsImhlYWRlcnMiLCJBY2NlcHQiLCJib2R5IiwiSlNPTiIsInN0cmluZ2lmeSIsInJlcyIsImpzb24iLCJwYXlsb2FkIiwib2siLCJmb3JtYXR0ZWRRdWVyeSIsInByaW50IiwicGFyc2UiLCJmb3JtYXR0ZWRWYXJpYWJsZXMiLCJlcnJvciIsInVzZUVmZmVjdCIsInRoZW4iLCJuYW1lIiwic2V0SXRlbSIsInZhbHVlIiwicmVtb3ZlSXRlbSJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBQTtBQUNBO0FBQ0E7QUFFZSwrRUFBc0I7QUFBQSxNQUFWQSxNQUFVLFFBQVZBLE1BQVU7O0FBQUEsa0JBQ0hDLHNEQUFRLENBQUMsRUFBRCxDQURMO0FBQUEsTUFDNUJDLFFBRDRCO0FBQUEsTUFDbEJDLFdBRGtCOztBQUFBLG1CQUVMRixzREFBUSxDQUFDRyxNQUFNLENBQUNDLFlBQVAsQ0FBb0JDLE9BQXBCLENBQTRCLGtCQUE1QixDQUFELENBRkg7QUFBQSxNQUU1QkMsT0FGNEI7QUFBQSxNQUVuQkMsVUFGbUI7O0FBQUEsbUJBR1RQLHNEQUFRLENBQUNHLE1BQU0sQ0FBQ0MsWUFBUCxDQUFvQkMsT0FBcEIsb0JBQXdDQyxPQUF4Qyx5QkFBcUUsU0FBdEUsQ0FIQztBQUFBLE1BRzVCRSxLQUg0QjtBQUFBLE1B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QUFDbkIsZUFBT3RDLE1BQU0sQ0FBQ0MsWUFBUCxDQUFvQm9DLE9BQXBCLG9CQUF3Q2xDLE9BQXhDLGNBQW1EaUMsSUFBbkQsR0FBMkRFLEtBQTNELENBQVA7QUFDRCxPQU5NO0FBT1BDLGdCQVBPLHNCQU9JSCxJQVBKLEVBT1U7QUFDZixlQUFPcEMsTUFBTSxDQUFDQyxZQUFQLENBQW9Cc0MsVUFBcEIsb0JBQTJDcEMsT0FBM0MsY0FBc0RpQyxJQUF0RCxFQUFQO0FBQ0Q7QUFUTSxLQVBYO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsS0FtQkUsTUFBQywrQ0FBRCxDQUFVLElBQVY7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxLQUNFO0FBQUEsd0NBQWUsTUFBZjtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBLEtBQ0U7QUFBSyxPQUFHLEVBQUMsaUJBQVQ7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBLElBREYsRUFFRTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsZ0JBRkYsQ0FERixDQW5CRixDQURGO0FBQUE7QUFBQTtBQUFBLGsrSkFERjtBQWlERCIsImZpbGUiOiIuL2NvbXBvbmVudHMvRWRpdG9yLmpzeC5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCB7IHVzZVN0YXRlLCB1c2VFZmZlY3QgfSBmcm9tIFwicmVhY3RcIjtcbmltcG9ydCB7IHBhcnNlLCBwcmludCB9IGZyb20gXCJncmFwaHFsXCI7XG5pbXBvcnQgR3JhcGhpUUwgZnJvbSBcImdyYXBoaXFsXCI7XG5cbmV4cG9ydCBkZWZhdWx0IGZ1bmN0aW9uICh7IHNlcnZlciB9KSB7XG4gIGNvbnN0IFtwcm9qZWN0cywgc2V0UHJvamVjdHNdID0gdXNlU3RhdGUoW10pO1xuICBjb25zdCBbcHJvamVjdCwgc2V0UHJvamVjdF0gPSB1c2VTdGF0ZSh3aW5kb3cubG9jYWxTdG9yYWdlLmdldEl0ZW0oJ2RpcmVjdHVzOnByb2plY3QnKSk7XG4gIGNvbnN0IFtxdWVyeSwgc2V0UXVlcnldID0gdXNlU3RhdGUod2luZG93LmxvY2FsU3RvcmFnZS5nZXRJdGVtKGBkaXJlY3R1czoke3Byb2plY3R9OmdyYXBoaXFsOnF1ZXJ5YCkgfHwgXCIjIFF1ZXJ5XCIpO1xuICBjb25zdCBbdmFyaWFibGVzLCBzZXRWYXJpYWJsZXNdID0gdXNlU3RhdGUod2luZG93LmxvY2FsU3RvcmFnZS5nZXRJdGVtKGBkaXJlY3R1czoke3Byb2plY3R9OmdyYXBoaXFsOnZhcmlhYmxlc2ApIHx8IFwie31cIik7XG5cbiAgc2VydmVyID0gc2VydmVyIHx8ICcnO1xuICBpZiAoc2VydmVyLmVuZHNXaXRoKCcvJykpIHtcbiAgICBzZXJ2ZXIgPSBzZXJ2ZXIuc3Vic3RyKDAsIHNlcnZlci5sZW5ndGggLSAxKTtcbiAgfVxuXG4gIGNvbnN0IGZldGNoUHJvamVjdHMgPSBhc3luYyAoKSA9PiB7XG4gICAgY29uc29sZS5sb2coKVxuICB9O1xuXG4gIGNvbnN0IGZldGNoUXVlcnkgPSBhc3luYyAocGFyYW1zKSA9PiB7XG4gICAgY29uc3QgdXJsID0gYCR7c2VydmVyfS8ke3Byb2plY3R9L2dyYXBocWxgO1xuXG4gICAgY29uc3QgcmVzID0gYXdhaXQgZmV0Y2godXJsLCB7XG4gICAgICBtZXRob2Q6IFwicG9zdFwiLFxuICAgICAgaGVhZGVyczoge1xuICAgICAgICBBY2NlcHQ6IFwiYXBwbGljYXRpb24vanNvblwiLFxuICAgICAgICBcIkNvbnRlbnQtVHlwZVwiOiBcImFwcGxpY2F0aW9uL2pzb25cIixcbiAgICAgIH0sXG4gICAgICBib2R5OiBKU09OLnN0cmluZ2lmeShwYXJhbXMpLFxuICAgIH0pO1xuXG4gICAgY29uc3QgcGF5bG9hZCA9IGF3YWl0IHJlcy5qc29uKCk7XG4gICAgaWYgKHJlcy5vayAmJiBxdWVyeSkge1xuICAgICAgdHJ5IHtcbiAgICAgICAgY29uc3QgZm9ybWF0dGVkUXVlcnkgPSBwcmludChwYXJzZShxdWVyeSkpO1xuICAgICAgICBpZiAocXVlcnkgIT09IGZvcm1hdHRlZFF1ZXJ5KSB7XG4gICAgICAgICAgc2V0UXVlcnkoZm9ybWF0dGVkUXVlcnkpO1xuICAgICAgICB9XG5cbiAgICAgICAgY29uc3QgZm9ybWF0dGVkVmFyaWFibGVzID0gSlNPTi5zdHJpbmdpZnkoSlNPTi5wYXJzZSh2YXJpYWJsZXMpLCBudWxsLCA0KTtcbiAgICAgICAgaWYgKHZhcmlhYmxlcyAhPT0gZm9ybWF0dGVkVmFyaWFibGVzKSB7XG4gICAgICAgICAgc2V0VmFyaWFibGVzKGZvcm1hdHRlZFZhcmlhYmxlcyk7XG4gICAgICAgIH1cbiAgICAgIH0gY2F0Y2ggKGVycm9yKSB7XG4gICAgICB9XG4gICAgfVxuXG4gICAgcmV0dXJuIHBheWxvYWQ7XG4gIH07XG5cbiAgdXNlRWZmZWN0KCgpID0+IHtcbiAgICBmZXRjaFByb2plY3RzKCkudGhlbigocHJvamVjdHMpID0+IHtcbiAgICAgIHNldFByb2plY3RzKHByb2plY3RzKTtcbiAgICB9KTtcbiAgfSwgW10pO1xuXG4gIHJldHVybiAoXG4gICAgPD5cbiAgICAgIDxHcmFwaGlRTFxuICAgICAgICBlZGl0b3JUaGVtZT1cImRpcmVjdHVzXCJcbiAgICAgICAgcXVlcnk9e3F1ZXJ5fVxuICAgICAgICB2YXJpYWJsZXM9e3ZhcmlhYmxlc31cbiAgICAgICAgb25FZGl0UXVlcnk9e3NldFF1ZXJ5fVxuICAgICAgICBvbkVkaXRWYXJpYWJsZXM9e3NldFZhcmlhYmxlc31cbiAgICAgICAgZmV0Y2hlcj17ZmV0Y2hRdWVyeX1cbiAgICAgICAgc3RvcmFnZT17e1xuICAgICAgICAgIGdldEl0ZW0obmFtZSkge1xuICAgICAgICAgICAgcmV0dXJuIHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbShgZGlyZWN0dXM6JHtwcm9qZWN0fToke25hbWV9YCk7XG4gICAgICAgICAgfSxcbiAgICAgICAgICBzZXRJdGVtKG5hbWUsIHZhbHVlKSB7XG4gICAgICAgICAgICByZXR1cm4gd2luZG93LmxvY2FsU3RvcmFnZS5zZXRJdGVtKGBkaXJlY3R1czoke3Byb2plY3R9OiR7bmFtZX1gLCB2YWx1ZSk7XG4gICAgICAgICAgfSxcbiAgICAgICAgICByZW1vdmVJdGVtKG5hbWUpIHtcbiAgICAgICAgICAgIHJldHVybiB3aW5kb3cubG9jYWxTdG9yYWdlLnJlbW92ZUl0ZW0oYGRpcmVjdHVzOiR7cHJvamVjdH06JHtuYW1lfWApO1xuICAgICAgICAgIH1cbiAgICAgICAgfX1cbiAgICAgID5cbiAgICAgICAgPEdyYXBoaVFMLkxvZ28+XG4gICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJsb2dvXCI+XG4gICAgICAgICAgICA8aW1nIHNyYz1cImltYWdlcy9sb2dvLnN2Z1wiIC8+XG4gICAgICAgICAgICA8c3Bhbj5cbiAgICAgICAgICAgICAgRGlyZWN0dXNcbiAgICAgICAgICAgIDwvc3Bhbj5cbiAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgPC9HcmFwaGlRTC5Mb2dvPlxuICAgICAgPC9HcmFwaGlRTD5cbiAgICAgIDxzdHlsZSBqc3g+e2BcbiAgICAgICAgLmxvZ28ge1xuICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XG4gICAgICAgICAgZmxleC1kaXJlY3Rpb246IHJvdztcbiAgICAgICAgICBmbGV4LXdyYXA6IG5vd3JhcDtcbiAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgICAgICAgIGFsaWduLWNvbnRlbnQ6IHN0cmV0Y2g7XG4gICAgICAgIH1cbiAgICAgICAgLmxvZ28gc3BhbiB7XG4gICAgICAgICAgbWFyZ2luLWxlZnQ6IDEycHg7XG4gICAgICAgICAgZm9udC1mYW1pbHk6IFJvYm90bztcbiAgICAgICAgfVxuICAgICAgICAubG9nbyBpbWcge1xuICAgICAgICAgIGhlaWdodDogMjRweDtcbiAgICAgICAgfVxuICAgICAgYH08L3N0eWxlPlxuICAgIDwvPlxuICApO1xufVxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./components/Editor.jsx\n");

/***/ })

})