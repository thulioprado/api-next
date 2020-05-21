webpackHotUpdate(1,{

/***/ "./components/Editor.jsx":
/*!*******************************!*\
  !*** ./components/Editor.jsx ***!
  \*******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* WEBPACK VAR INJECTION */(function(module) {/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ \"./node_modules/@babel/runtime/regenerator/index.js\");\n/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/esm/asyncToGenerator */ \"./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js\");\n/* harmony import */ var styled_jsx_style__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! styled-jsx/style */ \"./node_modules/styled-jsx/style.js\");\n/* harmony import */ var styled_jsx_style__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(styled_jsx_style__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ \"./node_modules/react/index.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var graphql__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! graphql */ \"./node_modules/graphql/index.mjs\");\n/* harmony import */ var graphiql__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! graphiql */ \"./node_modules/graphiql/dist/index.js\");\n/* harmony import */ var graphiql__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(graphiql__WEBPACK_IMPORTED_MODULE_5__);\n\n\nvar _jsxFileName = \"D:\\\\directus\\\\graphiql2\\\\components\\\\Editor.jsx\";\n\n\nvar __jsx = react__WEBPACK_IMPORTED_MODULE_3___default.a.createElement;\n\n\n\n\nfunction gql(_x, _x2) {\n  return _gql.apply(this, arguments);\n}\n\nfunction _gql() {\n  _gql = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(url, params) {\n    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {\n      while (1) {\n        switch (_context3.prev = _context3.next) {\n          case 0:\n            _context3.next = 2;\n            return fetch(url, {\n              method: \"post\",\n              headers: {\n                Accept: \"application/json\",\n                \"Content-Type\": \"application/json\"\n              },\n              body: JSON.stringify(params)\n            });\n\n          case 2:\n            return _context3.abrupt(\"return\", _context3.sent);\n\n          case 3:\n          case \"end\":\n            return _context3.stop();\n        }\n      }\n    }, _callee3);\n  }));\n  return _gql.apply(this, arguments);\n}\n\nfunction createStorage(_ref) {\n  var project = _ref.project;\n  return {\n    getItem: function getItem(name) {\n      return window.localStorage.getItem(\"directus:\".concat(project, \":\").concat(name));\n    },\n    setItem: function setItem(name, value) {\n      return window.localStorage.setItem(\"directus:\".concat(project, \":\").concat(name), value);\n    },\n    removeItem: function removeItem(name) {\n      return window.localStorage.removeItem(\"directus:\".concat(project, \":\").concat(name));\n    }\n  };\n}\n\nfunction createFetcher(_ref2) {\n  var server = _ref2.server;\n  return /*#__PURE__*/function () {\n    var _ref3 = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(params) {\n      var res, payload, formattedQuery, formattedVariables;\n      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {\n        while (1) {\n          switch (_context.prev = _context.next) {\n            case 0:\n              _context.next = 2;\n              return gql(\"\".concat(server, \"/graphql\"), params);\n\n            case 2:\n              res = _context.sent;\n              _context.next = 5;\n              return res.json();\n\n            case 5:\n              payload = _context.sent;\n\n              if (res.ok && query) {\n                try {\n                  formattedQuery = Object(graphql__WEBPACK_IMPORTED_MODULE_4__[\"print\"])(Object(graphql__WEBPACK_IMPORTED_MODULE_4__[\"parse\"])(query));\n\n                  if (query !== formattedQuery) {\n                    setQuery(formattedQuery);\n                  }\n\n                  formattedVariables = JSON.stringify(JSON.parse(variables), null, 4);\n\n                  if (variables !== formattedVariables) {\n                    setVariables(formattedVariables);\n                  }\n                } catch (error) {}\n              }\n\n              return _context.abrupt(\"return\", payload);\n\n            case 8:\n            case \"end\":\n              return _context.stop();\n          }\n        }\n      }, _callee);\n    }));\n\n    return function (_x3) {\n      return _ref3.apply(this, arguments);\n    };\n  }();\n}\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (function (_ref4) {\n  var server = _ref4.server;\n\n  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])([]),\n      projects = _useState[0],\n      setProjects = _useState[1];\n\n  var _useState2 = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])(window.localStorage.getItem(\"directus:project\") || \"directus\"),\n      project = _useState2[0],\n      setProject = _useState2[1];\n\n  server = server || \"\";\n\n  if (server.endsWith(\"/\")) {\n    server = server.substr(0, server.length - 1);\n  }\n\n  server = \"\".concat(server);\n\n  var fetchProjects = /*#__PURE__*/function () {\n    var _ref5 = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {\n      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {\n        while (1) {\n          switch (_context2.prev = _context2.next) {\n            case 0:\n              _context2.next = 2;\n              return gql(\"\".concat(server, \"/graphql\"), {\n                query: \"\\n        query {\\n          server {\\n            projects\\n          }\\n        }\\n      \"\n              });\n\n            case 2:\n              return _context2.abrupt(\"return\", _context2.sent);\n\n            case 3:\n            case \"end\":\n              return _context2.stop();\n          }\n        }\n      }, _callee2);\n    }));\n\n    return function fetchProjects() {\n      return _ref5.apply(this, arguments);\n    };\n  }();\n\n  Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useEffect\"])(function () {\n    fetchProjects().then(function (projects) {\n      setProjects(projects);\n    });\n  }, []);\n  return __jsx(react__WEBPACK_IMPORTED_MODULE_3___default.a.Fragment, null, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a, {\n    editorTheme: \"directus\",\n    fetcher: createFetcher({\n      server: server,\n      query: query,\n      variables: variables\n    }),\n    storage: createStorage({\n      project: project\n    }),\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 87,\n      columnNumber: 7\n    }\n  }, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.Logo, {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 92,\n      columnNumber: 9\n    }\n  }, __jsx(\"div\", {\n    className: \"jsx-2949793544\" + \" \" + \"logo\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 93,\n      columnNumber: 11\n    }\n  }, __jsx(\"img\", {\n    src: \"images/logo.svg\",\n    className: \"jsx-2949793544\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 94,\n      columnNumber: 13\n    }\n  }), __jsx(\"span\", {\n    className: \"jsx-2949793544\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 95,\n      columnNumber: 13\n    }\n  }, \"Directus\")))), __jsx(styled_jsx_style__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    id: \"2949793544\",\n    __self: this\n  }, \".logo.jsx-2949793544{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-align-content:stretch;-ms-flex-line-pack:stretch;align-content:stretch;}.logo.jsx-2949793544 span.jsx-2949793544{margin-left:12px;font-family:Roboto;}.logo.jsx-2949793544 img.jsx-2949793544{height:24px;}\\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIkQ6XFxkaXJlY3R1c1xcZ3JhcGhpcWwyXFxjb21wb25lbnRzXFxFZGl0b3IuanN4Il0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQWtHa0IsQUFHd0IsQUFRSSxBQUlMLFlBQ2QsS0FKcUIsbUJBQ3JCLHNDQVRxQixxRUFDRiwrREFDTSxtR0FDSiw2RkFDRywrRUFDeEIiLCJmaWxlIjoiRDpcXGRpcmVjdHVzXFxncmFwaGlxbDJcXGNvbXBvbmVudHNcXEVkaXRvci5qc3giLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgeyB1c2VTdGF0ZSwgdXNlRWZmZWN0IH0gZnJvbSBcInJlYWN0XCI7XG5pbXBvcnQgeyBwYXJzZSwgcHJpbnQgfSBmcm9tIFwiZ3JhcGhxbFwiO1xuaW1wb3J0IEdyYXBoaVFMIGZyb20gXCJncmFwaGlxbFwiO1xuXG5hc3luYyBmdW5jdGlvbiBncWwodXJsLCBwYXJhbXMpIHtcbiAgcmV0dXJuIGF3YWl0IGZldGNoKHVybCwge1xuICAgIG1ldGhvZDogXCJwb3N0XCIsXG4gICAgaGVhZGVyczoge1xuICAgICAgQWNjZXB0OiBcImFwcGxpY2F0aW9uL2pzb25cIixcbiAgICAgIFwiQ29udGVudC1UeXBlXCI6IFwiYXBwbGljYXRpb24vanNvblwiLFxuICAgIH0sXG4gICAgYm9keTogSlNPTi5zdHJpbmdpZnkocGFyYW1zKSxcbiAgfSk7XG59XG5cbmZ1bmN0aW9uIGNyZWF0ZVN0b3JhZ2UoeyBwcm9qZWN0IH0pIHtcbiAgcmV0dXJuIHtcbiAgICBnZXRJdGVtKG5hbWUpIHtcbiAgICAgIHJldHVybiB3aW5kb3cubG9jYWxTdG9yYWdlLmdldEl0ZW0oYGRpcmVjdHVzOiR7cHJvamVjdH06JHtuYW1lfWApO1xuICAgIH0sXG4gICAgc2V0SXRlbShuYW1lLCB2YWx1ZSkge1xuICAgICAgcmV0dXJuIHdpbmRvdy5sb2NhbFN0b3JhZ2Uuc2V0SXRlbShgZGlyZWN0dXM6JHtwcm9qZWN0fToke25hbWV9YCwgdmFsdWUpO1xuICAgIH0sXG4gICAgcmVtb3ZlSXRlbShuYW1lKSB7XG4gICAgICByZXR1cm4gd2luZG93LmxvY2FsU3RvcmFnZS5yZW1vdmVJdGVtKGBkaXJlY3R1czoke3Byb2plY3R9OiR7bmFtZX1gKTtcbiAgICB9LFxuICB9O1xufVxuXG5mdW5jdGlvbiBjcmVhdGVGZXRjaGVyKHsgc2VydmVyIH0pIHtcbiAgcmV0dXJuIGFzeW5jIChwYXJhbXMpID0+IHtcbiAgICBjb25zdCByZXMgPSBhd2FpdCBncWwoYCR7c2VydmVyfS9ncmFwaHFsYCwgcGFyYW1zKTtcbiAgICBjb25zdCBwYXlsb2FkID0gYXdhaXQgcmVzLmpzb24oKTtcbiAgICBpZiAocmVzLm9rICYmIHF1ZXJ5KSB7XG4gICAgICB0cnkge1xuICAgICAgICBjb25zdCBmb3JtYXR0ZWRRdWVyeSA9IHByaW50KHBhcnNlKHF1ZXJ5KSk7XG4gICAgICAgIGlmIChxdWVyeSAhPT0gZm9ybWF0dGVkUXVlcnkpIHtcbiAgICAgICAgICBzZXRRdWVyeShmb3JtYXR0ZWRRdWVyeSk7XG4gICAgICAgIH1cblxuICAgICAgICBjb25zdCBmb3JtYXR0ZWRWYXJpYWJsZXMgPSBKU09OLnN0cmluZ2lmeShcbiAgICAgICAgICBKU09OLnBhcnNlKHZhcmlhYmxlcyksXG4gICAgICAgICAgbnVsbCxcbiAgICAgICAgICA0XG4gICAgICAgICk7XG4gICAgICAgIGlmICh2YXJpYWJsZXMgIT09IGZvcm1hdHRlZFZhcmlhYmxlcykge1xuICAgICAgICAgIHNldFZhcmlhYmxlcyhmb3JtYXR0ZWRWYXJpYWJsZXMpO1xuICAgICAgICB9XG4gICAgICB9IGNhdGNoIChlcnJvcikge31cbiAgICB9XG5cbiAgICByZXR1cm4gcGF5bG9hZDtcbiAgfTtcbn1cblxuZXhwb3J0IGRlZmF1bHQgZnVuY3Rpb24gKHsgc2VydmVyIH0pIHtcbiAgY29uc3QgW3Byb2plY3RzLCBzZXRQcm9qZWN0c10gPSB1c2VTdGF0ZShbXSk7XG4gIGNvbnN0IFtwcm9qZWN0LCBzZXRQcm9qZWN0XSA9IHVzZVN0YXRlKFxuICAgIHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbShcImRpcmVjdHVzOnByb2plY3RcIikgfHwgXCJkaXJlY3R1c1wiXG4gICk7XG5cbiAgc2VydmVyID0gc2VydmVyIHx8IFwiXCI7XG4gIGlmIChzZXJ2ZXIuZW5kc1dpdGgoXCIvXCIpKSB7XG4gICAgc2VydmVyID0gc2VydmVyLnN1YnN0cigwLCBzZXJ2ZXIubGVuZ3RoIC0gMSk7XG4gIH1cbiAgc2VydmVyID0gYCR7c2VydmVyfWA7XG5cbiAgY29uc3QgZmV0Y2hQcm9qZWN0cyA9IGFzeW5jICgpID0+XG4gICAgYXdhaXQgZ3FsKGAke3NlcnZlcn0vZ3JhcGhxbGAsIHtcbiAgICAgIHF1ZXJ5OiBgXG4gICAgICAgIHF1ZXJ5IHtcbiAgICAgICAgICBzZXJ2ZXIge1xuICAgICAgICAgICAgcHJvamVjdHNcbiAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICAgIGAsXG4gICAgfSk7XG5cbiAgdXNlRWZmZWN0KCgpID0+IHtcbiAgICBmZXRjaFByb2plY3RzKCkudGhlbigocHJvamVjdHMpID0+IHtcbiAgICAgIHNldFByb2plY3RzKHByb2plY3RzKTtcbiAgICB9KTtcbiAgfSwgW10pO1xuXG4gIHJldHVybiAoXG4gICAgPD5cbiAgICAgIDxHcmFwaGlRTFxuICAgICAgICBlZGl0b3JUaGVtZT1cImRpcmVjdHVzXCJcbiAgICAgICAgZmV0Y2hlcj17Y3JlYXRlRmV0Y2hlcih7IHNlcnZlciwgcXVlcnksIHZhcmlhYmxlcyB9KX1cbiAgICAgICAgc3RvcmFnZT17Y3JlYXRlU3RvcmFnZSh7IHByb2plY3QgfSl9XG4gICAgICA+XG4gICAgICAgIDxHcmFwaGlRTC5Mb2dvPlxuICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwibG9nb1wiPlxuICAgICAgICAgICAgPGltZyBzcmM9XCJpbWFnZXMvbG9nby5zdmdcIiAvPlxuICAgICAgICAgICAgPHNwYW4+RGlyZWN0dXM8L3NwYW4+XG4gICAgICAgICAgPC9kaXY+XG4gICAgICAgIDwvR3JhcGhpUUwuTG9nbz5cbiAgICAgIDwvR3JhcGhpUUw+XG4gICAgICA8c3R5bGUganN4PntgXG4gICAgICAgIC5sb2dvIHtcbiAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xuICAgICAgICAgIGZsZXgtZGlyZWN0aW9uOiByb3c7XG4gICAgICAgICAgZmxleC13cmFwOiBub3dyYXA7XG4gICAgICAgICAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gICAgICAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbiAgICAgICAgICBhbGlnbi1jb250ZW50OiBzdHJldGNoO1xuICAgICAgICB9XG4gICAgICAgIC5sb2dvIHNwYW4ge1xuICAgICAgICAgIG1hcmdpbi1sZWZ0OiAxMnB4O1xuICAgICAgICAgIGZvbnQtZmFtaWx5OiBSb2JvdG87XG4gICAgICAgIH1cbiAgICAgICAgLmxvZ28gaW1nIHtcbiAgICAgICAgICBoZWlnaHQ6IDI0cHg7XG4gICAgICAgIH1cbiAgICAgIGB9PC9zdHlsZT5cbiAgICA8Lz5cbiAgKTtcbn1cbiJdfQ== */\\n/*@ sourceURL=D:\\\\\\\\directus\\\\\\\\graphiql2\\\\\\\\components\\\\\\\\Editor.jsx */\"));\n});\n\n;\n    var _a, _b;\n    // Legacy CSS implementations will `eval` browser code in a Node.js context\n    // to extract CSS. For backwards compatibility, we need to check we're in a\n    // browser context before continuing.\n    if (typeof self !== 'undefined' &&\n        // AMP / No-JS mode does not inject these helpers:\n        '$RefreshHelpers$' in self) {\n        var currentExports_1 = module.__proto__.exports;\n        var prevExports = (_b = (_a = module.hot.data) === null || _a === void 0 ? void 0 : _a.prevExports) !== null && _b !== void 0 ? _b : null;\n        // This cannot happen in MainTemplate because the exports mismatch between\n        // templating and execution.\n        self.$RefreshHelpers$.registerExportsForReactRefresh(currentExports_1, module.i);\n        // A module can be accepted automatically based on its exports, e.g. when\n        // it is a Refresh Boundary.\n        if (self.$RefreshHelpers$.isReactRefreshBoundary(currentExports_1)) {\n            // Save the previous exports on update so we can compare the boundary\n            // signatures.\n            module.hot.dispose(function (data) {\n                data.prevExports = currentExports_1;\n            });\n            // Unconditionally accept an update to this module, we'll check if it's\n            // still a Refresh Boundary later.\n            module.hot.accept();\n            // This field is set when the previous version of this module was a\n            // Refresh Boundary, letting us know we need to check for invalidation or\n            // enqueue an update.\n            if (prevExports !== null) {\n                // A boundary can become ineligible if its exports are incompatible\n                // with the previous exports.\n                //\n                // For example, if you add/remove/change exports, we'll want to\n                // re-execute the importing modules, and force those components to\n                // re-render. Similarly, if you convert a class component to a\n                // function, we want to invalidate the boundary.\n                if (self.$RefreshHelpers$.shouldInvalidateReactRefreshBoundary(prevExports, currentExports_1)) {\n                    module.hot.invalidate();\n                }\n                else {\n                    self.$RefreshHelpers$.scheduleUpdate();\n                }\n            }\n        }\n        else {\n            // Since we just executed the code for the module, it's possible that the\n            // new exports made it ineligible for being a boundary.\n            // We only care about the case when we were _previously_ a boundary,\n            // because we already accepted this update (accidental side effect).\n            var isNoLongerABoundary = prevExports !== null;\n            if (isNoLongerABoundary) {\n                module.hot.invalidate();\n            }\n        }\n    }\n\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../node_modules/webpack/buildin/harmony-module.js */ \"./node_modules/webpack/buildin/harmony-module.js\")(module)))//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9jb21wb25lbnRzL0VkaXRvci5qc3g/ZDdkNiJdLCJuYW1lcyI6WyJncWwiLCJ1cmwiLCJwYXJhbXMiLCJmZXRjaCIsIm1ldGhvZCIsImhlYWRlcnMiLCJBY2NlcHQiLCJib2R5IiwiSlNPTiIsInN0cmluZ2lmeSIsImNyZWF0ZVN0b3JhZ2UiLCJwcm9qZWN0IiwiZ2V0SXRlbSIsIm5hbWUiLCJ3aW5kb3ciLCJsb2NhbFN0b3JhZ2UiLCJzZXRJdGVtIiwidmFsdWUiLCJyZW1vdmVJdGVtIiwiY3JlYXRlRmV0Y2hlciIsInNlcnZlciIsInJlcyIsImpzb24iLCJwYXlsb2FkIiwib2siLCJxdWVyeSIsImZvcm1hdHRlZFF1ZXJ5IiwicHJpbnQiLCJwYXJzZSIsInNldFF1ZXJ5IiwiZm9ybWF0dGVkVmFyaWFibGVzIiwidmFyaWFibGVzIiwic2V0VmFyaWFibGVzIiwiZXJyb3IiLCJ1c2VTdGF0ZSIsInByb2plY3RzIiwic2V0UHJvamVjdHMiLCJzZXRQcm9qZWN0IiwiZW5kc1dpdGgiLCJzdWJzdHIiLCJsZW5ndGgiLCJmZXRjaFByb2plY3RzIiwidXNlRWZmZWN0IiwidGhlbiJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBQTtBQUNBO0FBQ0E7O1NBRWVBLEc7Ozs7OzBMQUFmLGtCQUFtQkMsR0FBbkIsRUFBd0JDLE1BQXhCO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBLG1CQUNlQyxLQUFLLENBQUNGLEdBQUQsRUFBTTtBQUN0Qkcsb0JBQU0sRUFBRSxNQURjO0FBRXRCQyxxQkFBTyxFQUFFO0FBQ1BDLHNCQUFNLEVBQUUsa0JBREQ7QUFFUCxnQ0FBZ0I7QUFGVCxlQUZhO0FBTXRCQyxrQkFBSSxFQUFFQyxJQUFJLENBQUNDLFNBQUwsQ0FBZVAsTUFBZjtBQU5nQixhQUFOLENBRHBCOztBQUFBO0FBQUE7O0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsRzs7OztBQVdBLFNBQVNRLGFBQVQsT0FB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Qyx5REFBUyxDQUFDLFlBQU07QUFDZEQsaUJBQWEsR0FBR0UsSUFBaEIsQ0FBcUIsVUFBQ1IsUUFBRCxFQUFjO0FBQ2pDQyxpQkFBVyxDQUFDRCxRQUFELENBQVg7QUFDRCxLQUZEO0FBR0QsR0FKUSxFQUlOLEVBSk0sQ0FBVDtBQU1BLFNBQ0UsbUVBQ0UsTUFBQywrQ0FBRDtBQUNFLGVBQVcsRUFBQyxVQURkO0FBRUUsV0FBTyxFQUFFaEIsYUFBYSxDQUFDO0FBQUVDLFlBQU0sRUFBTkEsTUFBRjtBQUFVSyxXQUFLLEVBQUxBLEtBQVY7QUFBaUJNLGVBQVMsRUFBVEE7QUFBakIsS0FBRCxDQUZ4QjtBQUdFLFdBQU8sRUFBRXJCLGFBQWEsQ0FBQztBQUFFQyxhQUFPLEVBQVBBO0FBQUYsS0FBRCxDQUh4QjtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBLEtBS0UsTUFBQywrQ0FBRCxDQUFVLElBQVY7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxLQUNFO0FBQUEsd0NBQWUsTUFBZjtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBLEtBQ0U7QUFBSyxPQUFHLEVBQUMsaUJBQVQ7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBLElBREYsRUFFRTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsZ0JBRkYsQ0FERixDQUxGLENBREY7QUFBQTtBQUFBO0FBQUEsODNKQURGO0FBaUNEIiwiZmlsZSI6Ii4vY29tcG9uZW50cy9FZGl0b3IuanN4LmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IHsgdXNlU3RhdGUsIHVzZUVmZmVjdCB9IGZyb20gXCJyZWFjdFwiO1xuaW1wb3J0IHsgcGFyc2UsIHByaW50IH0gZnJvbSBcImdyYXBocWxcIjtcbmltcG9ydCBHcmFwaGlRTCBmcm9tIFwiZ3JhcGhpcWxcIjtcblxuYXN5bmMgZnVuY3Rpb24gZ3FsKHVybCwgcGFyYW1zKSB7XG4gIHJldHVybiBhd2FpdCBmZXRjaCh1cmwsIHtcbiAgICBtZXRob2Q6IFwicG9zdFwiLFxuICAgIGhlYWRlcnM6IHtcbiAgICAgIEFjY2VwdDogXCJhcHBsaWNhdGlvbi9qc29uXCIsXG4gICAgICBcIkNvbnRlbnQtVHlwZVwiOiBcImFwcGxpY2F0aW9uL2pzb25cIixcbiAgICB9LFxuICAgIGJvZHk6IEpTT04uc3RyaW5naWZ5KHBhcmFtcyksXG4gIH0pO1xufVxuXG5mdW5jdGlvbiBjcmVhdGVTdG9yYWdlKHsgcHJvamVjdCB9KSB7XG4gIHJldHVybiB7XG4gICAgZ2V0SXRlbShuYW1lKSB7XG4gICAgICByZXR1cm4gd2luZG93LmxvY2FsU3RvcmFnZS5nZXRJdGVtKGBkaXJlY3R1czoke3Byb2plY3R9OiR7bmFtZX1gKTtcbiAgICB9LFxuICAgIHNldEl0ZW0obmFtZSwgdmFsdWUpIHtcbiAgICAgIHJldHVybiB3aW5kb3cubG9jYWxTdG9yYWdlLnNldEl0ZW0oYGRpcmVjdHVzOiR7cHJvamVjdH06JHtuYW1lfWAsIHZhbHVlKTtcbiAgICB9LFxuICAgIHJlbW92ZUl0ZW0obmFtZSkge1xuICAgICAgcmV0dXJuIHdpbmRvdy5sb2NhbFN0b3JhZ2UucmVtb3ZlSXRlbShgZGlyZWN0dXM6JHtwcm9qZWN0fToke25hbWV9YCk7XG4gICAgfSxcbiAgfTtcbn1cblxuZnVuY3Rpb24gY3JlYXRlRmV0Y2hlcih7IHNlcnZlciB9KSB7XG4gIHJldHVybiBhc3luYyAocGFyYW1zKSA9PiB7XG4gICAgY29uc3QgcmVzID0gYXdhaXQgZ3FsKGAke3NlcnZlcn0vZ3JhcGhxbGAsIHBhcmFtcyk7XG4gICAgY29uc3QgcGF5bG9hZCA9IGF3YWl0IHJlcy5qc29uKCk7XG4gICAgaWYgKHJlcy5vayAmJiBxdWVyeSkge1xuICAgICAgdHJ5IHtcbiAgICAgICAgY29uc3QgZm9ybWF0dGVkUXVlcnkgPSBwcmludChwYXJzZShxdWVyeSkpO1xuICAgICAgICBpZiAocXVlcnkgIT09IGZvcm1hdHRlZFF1ZXJ5KSB7XG4gICAgICAgICAgc2V0UXVlcnkoZm9ybWF0dGVkUXVlcnkpO1xuICAgICAgICB9XG5cbiAgICAgICAgY29uc3QgZm9ybWF0dGVkVmFyaWFibGVzID0gSlNPTi5zdHJpbmdpZnkoXG4gICAgICAgICAgSlNPTi5wYXJzZSh2YXJpYWJsZXMpLFxuICAgICAgICAgIG51bGwsXG4gICAgICAgICAgNFxuICAgICAgICApO1xuICAgICAgICBpZiAodmFyaWFibGVzICE9PSBmb3JtYXR0ZWRWYXJpYWJsZXMpIHtcbiAgICAgICAgICBzZXRWYXJpYWJsZXMoZm9ybWF0dGVkVmFyaWFibGVzKTtcbiAgICAgICAgfVxuICAgICAgfSBjYXRjaCAoZXJyb3IpIHt9XG4gICAgfVxuXG4gICAgcmV0dXJuIHBheWxvYWQ7XG4gIH07XG59XG5cbmV4cG9ydCBkZWZhdWx0IGZ1bmN0aW9uICh7IHNlcnZlciB9KSB7XG4gIGNvbnN0IFtwcm9qZWN0cywgc2V0UHJvamVjdHNdID0gdXNlU3RhdGUoW10pO1xuICBjb25zdCBbcHJvamVjdCwgc2V0UHJvamVjdF0gPSB1c2VTdGF0ZShcbiAgICB3aW5kb3cubG9jYWxTdG9yYWdlLmdldEl0ZW0oXCJkaXJlY3R1czpwcm9qZWN0XCIpIHx8IFwiZGlyZWN0dXNcIlxuICApO1xuXG4gIHNlcnZlciA9IHNlcnZlciB8fCBcIlwiO1xuICBpZiAoc2VydmVyLmVuZHNXaXRoKFwiL1wiKSkge1xuICAgIHNlcnZlciA9IHNlcnZlci5zdWJzdHIoMCwgc2VydmVyLmxlbmd0aCAtIDEpO1xuICB9XG4gIHNlcnZlciA9IGAke3NlcnZlcn1gO1xuXG4gIGNvbnN0IGZldGNoUHJvamVjdHMgPSBhc3luYyAoKSA9PlxuICAgIGF3YWl0IGdxbChgJHtzZXJ2ZXJ9L2dyYXBocWxgLCB7XG4gICAgICBxdWVyeTogYFxuICAgICAgICBxdWVyeSB7XG4gICAgICAgICAgc2VydmVyIHtcbiAgICAgICAgICAgIHByb2plY3RzXG4gICAgICAgICAgfVxuICAgICAgICB9XG4gICAgICBgLFxuICAgIH0pO1xuXG4gIHVzZUVmZmVjdCgoKSA9PiB7XG4gICAgZmV0Y2hQcm9qZWN0cygpLnRoZW4oKHByb2plY3RzKSA9PiB7XG4gICAgICBzZXRQcm9qZWN0cyhwcm9qZWN0cyk7XG4gICAgfSk7XG4gIH0sIFtdKTtcblxuICByZXR1cm4gKFxuICAgIDw+XG4gICAgICA8R3JhcGhpUUxcbiAgICAgICAgZWRpdG9yVGhlbWU9XCJkaXJlY3R1c1wiXG4gICAgICAgIGZldGNoZXI9e2NyZWF0ZUZldGNoZXIoeyBzZXJ2ZXIsIHF1ZXJ5LCB2YXJpYWJsZXMgfSl9XG4gICAgICAgIHN0b3JhZ2U9e2NyZWF0ZVN0b3JhZ2UoeyBwcm9qZWN0IH0pfVxuICAgICAgPlxuICAgICAgICA8R3JhcGhpUUwuTG9nbz5cbiAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImxvZ29cIj5cbiAgICAgICAgICAgIDxpbWcgc3JjPVwiaW1hZ2VzL2xvZ28uc3ZnXCIgLz5cbiAgICAgICAgICAgIDxzcGFuPkRpcmVjdHVzPC9zcGFuPlxuICAgICAgICAgIDwvZGl2PlxuICAgICAgICA8L0dyYXBoaVFMLkxvZ28+XG4gICAgICA8L0dyYXBoaVFMPlxuICAgICAgPHN0eWxlIGpzeD57YFxuICAgICAgICAubG9nbyB7XG4gICAgICAgICAgZGlzcGxheTogZmxleDtcbiAgICAgICAgICBmbGV4LWRpcmVjdGlvbjogcm93O1xuICAgICAgICAgIGZsZXgtd3JhcDogbm93cmFwO1xuICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gICAgICAgICAgYWxpZ24tY29udGVudDogc3RyZXRjaDtcbiAgICAgICAgfVxuICAgICAgICAubG9nbyBzcGFuIHtcbiAgICAgICAgICBtYXJnaW4tbGVmdDogMTJweDtcbiAgICAgICAgICBmb250LWZhbWlseTogUm9ib3RvO1xuICAgICAgICB9XG4gICAgICAgIC5sb2dvIGltZyB7XG4gICAgICAgICAgaGVpZ2h0OiAyNHB4O1xuICAgICAgICB9XG4gICAgICBgfTwvc3R5bGU+XG4gICAgPC8+XG4gICk7XG59XG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./components/Editor.jsx\n");

/***/ })

})