webpackHotUpdate(1,{

/***/ "./components/Editor.jsx":
/*!*******************************!*\
  !*** ./components/Editor.jsx ***!
  \*******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* WEBPACK VAR INJECTION */(function(module) {/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ \"./node_modules/@babel/runtime/regenerator/index.js\");\n/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/esm/asyncToGenerator */ \"./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js\");\n/* harmony import */ var styled_jsx_style__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! styled-jsx/style */ \"./node_modules/styled-jsx/style.js\");\n/* harmony import */ var styled_jsx_style__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(styled_jsx_style__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ \"./node_modules/react/index.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var graphql__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! graphql */ \"./node_modules/graphql/index.mjs\");\n/* harmony import */ var graphiql__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! graphiql */ \"./node_modules/graphiql/dist/index.js\");\n/* harmony import */ var graphiql__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(graphiql__WEBPACK_IMPORTED_MODULE_5__);\n\n\nvar _jsxFileName = \"D:\\\\directus\\\\graphiql2\\\\components\\\\Editor.jsx\";\n\n\nvar __jsx = react__WEBPACK_IMPORTED_MODULE_3___default.a.createElement;\n\n\n\n\nfunction gql(_x, _x2) {\n  return _gql.apply(this, arguments);\n}\n\nfunction _gql() {\n  _gql = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(url, params) {\n    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {\n      while (1) {\n        switch (_context3.prev = _context3.next) {\n          case 0:\n            _context3.next = 2;\n            return fetch(url, {\n              method: \"post\",\n              headers: {\n                Accept: \"application/json\",\n                \"Content-Type\": \"application/json\"\n              },\n              body: JSON.stringify(params)\n            });\n\n          case 2:\n            return _context3.abrupt(\"return\", _context3.sent);\n\n          case 3:\n          case \"end\":\n            return _context3.stop();\n        }\n      }\n    }, _callee3);\n  }));\n  return _gql.apply(this, arguments);\n}\n\nfunction createStorage(_ref) {\n  var project = _ref.project;\n  return {\n    getItem: function getItem(name) {\n      return window.localStorage.getItem(\"directus:\".concat(project, \":\").concat(name));\n    },\n    setItem: function setItem(name, value) {\n      return window.localStorage.setItem(\"directus:\".concat(project, \":\").concat(name), value);\n    },\n    removeItem: function removeItem(name) {\n      return window.localStorage.removeItem(\"directus:\".concat(project, \":\").concat(name));\n    }\n  };\n}\n\nfunction createFetcher(_ref2) {\n  var server = _ref2.server,\n      project = _ref2.project,\n      query = _ref2.query,\n      variables = _ref2.variables;\n  return /*#__PURE__*/function () {\n    var _ref3 = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(params) {\n      var res, payload, formattedQuery, formattedVariables;\n      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {\n        while (1) {\n          switch (_context.prev = _context.next) {\n            case 0:\n              _context.next = 2;\n              return gql(\"\".concat(server, \"/\").concat(project, \"/graphql\"), params);\n\n            case 2:\n              res = _context.sent;\n              _context.next = 5;\n              return res.json();\n\n            case 5:\n              payload = _context.sent;\n\n              if (res.ok && query) {\n                try {\n                  formattedQuery = Object(graphql__WEBPACK_IMPORTED_MODULE_4__[\"print\"])(Object(graphql__WEBPACK_IMPORTED_MODULE_4__[\"parse\"])(query));\n\n                  if (query !== formattedQuery) {\n                    setQuery(formattedQuery);\n                  }\n\n                  formattedVariables = JSON.stringify(JSON.parse(variables), null, 4);\n\n                  if (variables !== formattedVariables) {\n                    setVariables(formattedVariables);\n                  }\n                } catch (error) {}\n              }\n\n              return _context.abrupt(\"return\", payload);\n\n            case 8:\n            case \"end\":\n              return _context.stop();\n          }\n        }\n      }, _callee);\n    }));\n\n    return function (_x3) {\n      return _ref3.apply(this, arguments);\n    };\n  }();\n}\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (function (_ref4) {\n  var server = _ref4.server;\n\n  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])([]),\n      projects = _useState[0],\n      setProjects = _useState[1];\n\n  var _useState2 = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])(window.localStorage.getItem(\"directus:project\") || \"directus\"),\n      project = _useState2[0],\n      setProject = _useState2[1];\n\n  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])(window.localStorage.getItem(\"directus:\".concat(project, \":graphiql:query\")) || \"# Query\"),\n      query = _useState3[0],\n      setQuery = _useState3[1];\n\n  var _useState4 = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])(window.localStorage.getItem(\"directus:\".concat(project, \":graphiql:variables\")) || \"{}\"),\n      variables = _useState4[0],\n      setVariables = _useState4[1];\n\n  var targetServer = server || \"\";\n\n  if (targetServer.endsWith(\"/\")) {\n    targetServer = targetServer.substr(0, targetServer.length - 1);\n  }\n\n  var targetProject = \"\".concat(targetServer, \"/\").concat(project);\n\n  var fetchProjects = /*#__PURE__*/function () {\n    var _ref5 = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {\n      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {\n        while (1) {\n          switch (_context2.prev = _context2.next) {\n            case 0:\n              _context2.next = 2;\n              return gql(\"\".concat(targetProject, \"/graphql\"), {\n                query: \"\\n        query {\\n          projects {\\n            id\\n            name\\n          }\\n        }\\n      \"\n              });\n\n            case 2:\n              return _context2.abrupt(\"return\", _context2.sent);\n\n            case 3:\n            case \"end\":\n              return _context2.stop();\n          }\n        }\n      }, _callee2);\n    }));\n\n    return function fetchProjects() {\n      return _ref5.apply(this, arguments);\n    };\n  }();\n\n  Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useEffect\"])(function () {\n    fetchProjects().then(function (projects) {\n      setProjects(projects);\n    });\n  }, []);\n  return __jsx(react__WEBPACK_IMPORTED_MODULE_3___default.a.Fragment, null, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a, {\n    editorTheme: \"directus\",\n    query: query,\n    variables: variables,\n    onEditQuery: setQuery,\n    onEditVariables: setVariables,\n    fetcher: createFetcher({\n      server: server,\n      project: project,\n      query: query,\n      variables: variables\n    }),\n    storage: createStorage({\n      project: project\n    }),\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 103,\n      columnNumber: 7\n    }\n  }, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.Logo, {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 112,\n      columnNumber: 9\n    }\n  }, __jsx(\"div\", {\n    className: \"jsx-2949793544\" + \" \" + \"logo\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 113,\n      columnNumber: 11\n    }\n  }, __jsx(\"img\", {\n    src: \"images/logo.svg\",\n    className: \"jsx-2949793544\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 114,\n      columnNumber: 13\n    }\n  }), __jsx(\"span\", {\n    className: \"jsx-2949793544\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 115,\n      columnNumber: 13\n    }\n  }, \"Directus\")))), __jsx(styled_jsx_style__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    id: \"2949793544\",\n    __self: this\n  }, \".logo.jsx-2949793544{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-align-content:stretch;-ms-flex-line-pack:stretch;align-content:stretch;}.logo.jsx-2949793544 span.jsx-2949793544{margin-left:12px;font-family:Roboto;}.logo.jsx-2949793544 img.jsx-2949793544{height:24px;}\\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIkQ6XFxkaXJlY3R1c1xcZ3JhcGhpcWwyXFxjb21wb25lbnRzXFxFZGl0b3IuanN4Il0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQXNIa0IsQUFHd0IsQUFRSSxBQUlMLFlBQ2QsS0FKcUIsbUJBQ3JCLHNDQVRxQixxRUFDRiwrREFDTSxtR0FDSiw2RkFDRywrRUFDeEIiLCJmaWxlIjoiRDpcXGRpcmVjdHVzXFxncmFwaGlxbDJcXGNvbXBvbmVudHNcXEVkaXRvci5qc3giLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgeyB1c2VTdGF0ZSwgdXNlRWZmZWN0IH0gZnJvbSBcInJlYWN0XCI7XG5pbXBvcnQgeyBwYXJzZSwgcHJpbnQgfSBmcm9tIFwiZ3JhcGhxbFwiO1xuaW1wb3J0IEdyYXBoaVFMIGZyb20gXCJncmFwaGlxbFwiO1xuXG5hc3luYyBmdW5jdGlvbiBncWwodXJsLCBwYXJhbXMpIHtcbiAgcmV0dXJuIGF3YWl0IGZldGNoKHVybCwge1xuICAgIG1ldGhvZDogXCJwb3N0XCIsXG4gICAgaGVhZGVyczoge1xuICAgICAgQWNjZXB0OiBcImFwcGxpY2F0aW9uL2pzb25cIixcbiAgICAgIFwiQ29udGVudC1UeXBlXCI6IFwiYXBwbGljYXRpb24vanNvblwiLFxuICAgIH0sXG4gICAgYm9keTogSlNPTi5zdHJpbmdpZnkocGFyYW1zKSxcbiAgfSk7XG59XG5cbmZ1bmN0aW9uIGNyZWF0ZVN0b3JhZ2UoeyBwcm9qZWN0IH0pIHtcbiAgcmV0dXJuIHtcbiAgICBnZXRJdGVtKG5hbWUpIHtcbiAgICAgIHJldHVybiB3aW5kb3cubG9jYWxTdG9yYWdlLmdldEl0ZW0oYGRpcmVjdHVzOiR7cHJvamVjdH06JHtuYW1lfWApO1xuICAgIH0sXG4gICAgc2V0SXRlbShuYW1lLCB2YWx1ZSkge1xuICAgICAgcmV0dXJuIHdpbmRvdy5sb2NhbFN0b3JhZ2Uuc2V0SXRlbShcbiAgICAgICAgYGRpcmVjdHVzOiR7cHJvamVjdH06JHtuYW1lfWAsXG4gICAgICAgIHZhbHVlXG4gICAgICApO1xuICAgIH0sXG4gICAgcmVtb3ZlSXRlbShuYW1lKSB7XG4gICAgICByZXR1cm4gd2luZG93LmxvY2FsU3RvcmFnZS5yZW1vdmVJdGVtKFxuICAgICAgICBgZGlyZWN0dXM6JHtwcm9qZWN0fToke25hbWV9YFxuICAgICAgKTtcbiAgICB9LFxuICB9O1xufVxuXG5mdW5jdGlvbiBjcmVhdGVGZXRjaGVyKHsgc2VydmVyLCBwcm9qZWN0LCBxdWVyeSwgdmFyaWFibGVzIH0pIHtcbiAgcmV0dXJuIGFzeW5jIChwYXJhbXMpID0+IHtcbiAgICBjb25zdCByZXMgPSBhd2FpdCBncWwoYCR7c2VydmVyfS8ke3Byb2plY3R9L2dyYXBocWxgLCBwYXJhbXMpO1xuICAgIGNvbnN0IHBheWxvYWQgPSBhd2FpdCByZXMuanNvbigpO1xuICAgIGlmIChyZXMub2sgJiYgcXVlcnkpIHtcbiAgICAgIHRyeSB7XG4gICAgICAgIGNvbnN0IGZvcm1hdHRlZFF1ZXJ5ID0gcHJpbnQocGFyc2UocXVlcnkpKTtcbiAgICAgICAgaWYgKHF1ZXJ5ICE9PSBmb3JtYXR0ZWRRdWVyeSkge1xuICAgICAgICAgIHNldFF1ZXJ5KGZvcm1hdHRlZFF1ZXJ5KTtcbiAgICAgICAgfVxuXG4gICAgICAgIGNvbnN0IGZvcm1hdHRlZFZhcmlhYmxlcyA9IEpTT04uc3RyaW5naWZ5KFxuICAgICAgICAgIEpTT04ucGFyc2UodmFyaWFibGVzKSxcbiAgICAgICAgICBudWxsLFxuICAgICAgICAgIDRcbiAgICAgICAgKTtcbiAgICAgICAgaWYgKHZhcmlhYmxlcyAhPT0gZm9ybWF0dGVkVmFyaWFibGVzKSB7XG4gICAgICAgICAgc2V0VmFyaWFibGVzKGZvcm1hdHRlZFZhcmlhYmxlcyk7XG4gICAgICAgIH1cbiAgICAgIH0gY2F0Y2ggKGVycm9yKSB7fVxuICAgIH1cblxuICAgIHJldHVybiBwYXlsb2FkO1xuICB9O1xufVxuXG5leHBvcnQgZGVmYXVsdCBmdW5jdGlvbiAoeyBzZXJ2ZXIgfSkge1xuICBjb25zdCBbcHJvamVjdHMsIHNldFByb2plY3RzXSA9IHVzZVN0YXRlKFtdKTtcbiAgY29uc3QgW3Byb2plY3QsIHNldFByb2plY3RdID0gdXNlU3RhdGUoXG4gICAgd2luZG93LmxvY2FsU3RvcmFnZS5nZXRJdGVtKFwiZGlyZWN0dXM6cHJvamVjdFwiKSB8fCBcImRpcmVjdHVzXCJcbiAgKTtcbiAgY29uc3QgW3F1ZXJ5LCBzZXRRdWVyeV0gPSB1c2VTdGF0ZShcbiAgICB3aW5kb3cubG9jYWxTdG9yYWdlLmdldEl0ZW0oYGRpcmVjdHVzOiR7cHJvamVjdH06Z3JhcGhpcWw6cXVlcnlgKSB8fFxuICAgICAgXCIjIFF1ZXJ5XCJcbiAgKTtcbiAgY29uc3QgW3ZhcmlhYmxlcywgc2V0VmFyaWFibGVzXSA9IHVzZVN0YXRlKFxuICAgIHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbShgZGlyZWN0dXM6JHtwcm9qZWN0fTpncmFwaGlxbDp2YXJpYWJsZXNgKSB8fFxuICAgICAgXCJ7fVwiXG4gICk7XG5cbiAgbGV0IHRhcmdldFNlcnZlciA9IHNlcnZlciB8fCBcIlwiO1xuICBpZiAodGFyZ2V0U2VydmVyLmVuZHNXaXRoKFwiL1wiKSkge1xuICAgIHRhcmdldFNlcnZlciA9IHRhcmdldFNlcnZlci5zdWJzdHIoMCwgdGFyZ2V0U2VydmVyLmxlbmd0aCAtIDEpO1xuICB9XG5cbiAgbGV0IHRhcmdldFByb2plY3QgPSBgJHt0YXJnZXRTZXJ2ZXJ9LyR7cHJvamVjdH1gO1xuXG4gIGNvbnN0IGZldGNoUHJvamVjdHMgPSBhc3luYyAoKSA9PiB7XG4gICAgcmV0dXJuIGF3YWl0IGdxbChgJHt0YXJnZXRQcm9qZWN0fS9ncmFwaHFsYCwge1xuICAgICAgcXVlcnk6IGBcbiAgICAgICAgcXVlcnkge1xuICAgICAgICAgIHByb2plY3RzIHtcbiAgICAgICAgICAgIGlkXG4gICAgICAgICAgICBuYW1lXG4gICAgICAgICAgfVxuICAgICAgICB9XG4gICAgICBgLFxuICAgIH0pO1xuICB9O1xuXG4gIHVzZUVmZmVjdCgoKSA9PiB7XG4gICAgZmV0Y2hQcm9qZWN0cygpLnRoZW4oKHByb2plY3RzKSA9PiB7XG4gICAgICBzZXRQcm9qZWN0cyhwcm9qZWN0cyk7XG4gICAgfSk7XG4gIH0sIFtdKTtcblxuICByZXR1cm4gKFxuICAgIDw+XG4gICAgICA8R3JhcGhpUUxcbiAgICAgICAgZWRpdG9yVGhlbWU9XCJkaXJlY3R1c1wiXG4gICAgICAgIHF1ZXJ5PXtxdWVyeX1cbiAgICAgICAgdmFyaWFibGVzPXt2YXJpYWJsZXN9XG4gICAgICAgIG9uRWRpdFF1ZXJ5PXtzZXRRdWVyeX1cbiAgICAgICAgb25FZGl0VmFyaWFibGVzPXtzZXRWYXJpYWJsZXN9XG4gICAgICAgIGZldGNoZXI9e2NyZWF0ZUZldGNoZXIoeyBzZXJ2ZXIsIHByb2plY3QsIHF1ZXJ5LCB2YXJpYWJsZXMgfSl9XG4gICAgICAgIHN0b3JhZ2U9e2NyZWF0ZVN0b3JhZ2UoeyBwcm9qZWN0IH0pfVxuICAgICAgPlxuICAgICAgICA8R3JhcGhpUUwuTG9nbz5cbiAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImxvZ29cIj5cbiAgICAgICAgICAgIDxpbWcgc3JjPVwiaW1hZ2VzL2xvZ28uc3ZnXCIgLz5cbiAgICAgICAgICAgIDxzcGFuPkRpcmVjdHVzPC9zcGFuPlxuICAgICAgICAgIDwvZGl2PlxuICAgICAgICA8L0dyYXBoaVFMLkxvZ28+XG4gICAgICA8L0dyYXBoaVFMPlxuICAgICAgPHN0eWxlIGpzeD57YFxuICAgICAgICAubG9nbyB7XG4gICAgICAgICAgZGlzcGxheTogZmxleDtcbiAgICAgICAgICBmbGV4LWRpcmVjdGlvbjogcm93O1xuICAgICAgICAgIGZsZXgtd3JhcDogbm93cmFwO1xuICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gICAgICAgICAgYWxpZ24tY29udGVudDogc3RyZXRjaDtcbiAgICAgICAgfVxuICAgICAgICAubG9nbyBzcGFuIHtcbiAgICAgICAgICBtYXJnaW4tbGVmdDogMTJweDtcbiAgICAgICAgICBmb250LWZhbWlseTogUm9ib3RvO1xuICAgICAgICB9XG4gICAgICAgIC5sb2dvIGltZyB7XG4gICAgICAgICAgaGVpZ2h0OiAyNHB4O1xuICAgICAgICB9XG4gICAgICBgfTwvc3R5bGU+XG4gICAgPC8+XG4gICk7XG59XG4iXX0= */\\n/*@ sourceURL=D:\\\\\\\\directus\\\\\\\\graphiql2\\\\\\\\components\\\\\\\\Editor.jsx */\"));\n});\n\n;\n    var _a, _b;\n    // Legacy CSS implementations will `eval` browser code in a Node.js context\n    // to extract CSS. For backwards compatibility, we need to check we're in a\n    // browser context before continuing.\n    if (typeof self !== 'undefined' &&\n        // AMP / No-JS mode does not inject these helpers:\n        '$RefreshHelpers$' in self) {\n        var currentExports_1 = module.__proto__.exports;\n        var prevExports = (_b = (_a = module.hot.data) === null || _a === void 0 ? void 0 : _a.prevExports) !== null && _b !== void 0 ? _b : null;\n        // This cannot happen in MainTemplate because the exports mismatch between\n        // templating and execution.\n        self.$RefreshHelpers$.registerExportsForReactRefresh(currentExports_1, module.i);\n        // A module can be accepted automatically based on its exports, e.g. when\n        // it is a Refresh Boundary.\n        if (self.$RefreshHelpers$.isReactRefreshBoundary(currentExports_1)) {\n            // Save the previous exports on update so we can compare the boundary\n            // signatures.\n            module.hot.dispose(function (data) {\n                data.prevExports = currentExports_1;\n            });\n            // Unconditionally accept an update to this module, we'll check if it's\n            // still a Refresh Boundary later.\n            module.hot.accept();\n            // This field is set when the previous version of this module was a\n            // Refresh Boundary, letting us know we need to check for invalidation or\n            // enqueue an update.\n            if (prevExports !== null) {\n                // A boundary can become ineligible if its exports are incompatible\n                // with the previous exports.\n                //\n                // For example, if you add/remove/change exports, we'll want to\n                // re-execute the importing modules, and force those components to\n                // re-render. Similarly, if you convert a class component to a\n                // function, we want to invalidate the boundary.\n                if (self.$RefreshHelpers$.shouldInvalidateReactRefreshBoundary(prevExports, currentExports_1)) {\n                    module.hot.invalidate();\n                }\n                else {\n                    self.$RefreshHelpers$.scheduleUpdate();\n                }\n            }\n        }\n        else {\n            // Since we just executed the code for the module, it's possible that the\n            // new exports made it ineligible for being a boundary.\n            // We only care about the case when we were _previously_ a boundary,\n            // because we already accepted this update (accidental side effect).\n            var isNoLongerABoundary = prevExports !== null;\n            if (isNoLongerABoundary) {\n                module.hot.invalidate();\n            }\n        }\n    }\n\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../node_modules/webpack/buildin/harmony-module.js */ \"./node_modules/webpack/buildin/harmony-module.js\")(module)))//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9jb21wb25lbnRzL0VkaXRvci5qc3g/ZDdkNiJdLCJuYW1lcyI6WyJncWwiLCJ1cmwiLCJwYXJhbXMiLCJmZXRjaCIsIm1ldGhvZCIsImhlYWRlcnMiLCJBY2NlcHQiLCJib2R5IiwiSlNPTiIsInN0cmluZ2lmeSIsImNyZWF0ZVN0b3JhZ2UiLCJwcm9qZWN0IiwiZ2V0SXRlbSIsIm5hbWUiLCJ3aW5kb3ciLCJsb2NhbFN0b3JhZ2UiLCJzZXRJdGVtIiwidmFsdWUiLCJyZW1vdmVJdGVtIiwiY3JlYXRlRmV0Y2hlciIsInNlcnZlciIsInF1ZXJ5IiwidmFyaWFibGVzIiwicmVzIiwianNvbiIsInBheWxvYWQiLCJvayIsImZvcm1hdHRlZFF1ZXJ5IiwicHJpbnQiLCJwYXJzZSIsInNldFF1ZXJ5IiwiZm9ybWF0dGVkVmFyaWFibGVzIiwic2V0VmFyaWFibGVzIiwiZXJyb3IiLCJ1c2VTdGF0ZSIsInByb2plY3RzIiwic2V0UHJvamVjdHMiLCJzZXRQcm9qZWN0IiwidGFyZ2V0U2VydmVyIiwiZW5kc1dpdGgiLCJzdWJzdHIiLCJsZW5ndGgiLCJ0YXJnZXRQcm9qZWN0IiwiZmV0Y2hQcm9qZWN0cyIsInVzZUVmZmVjdCIsInRoZW4iXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBQUE7QUFDQTtBQUNBOztTQUVlQSxHOzs7OzswTEFBZixrQkFBbUJDLEdBQW5CLEVBQXdCQyxNQUF4QjtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxtQkFDZUMsS0FBSyxDQUFDRixHQUFELEVBQU07QUFDdEJHLG9CQUFNLEVBQUUsTUFEYztBQUV0QkMscUJBQU8sRUFBRTtBQUNQQyxzQkFBTSxFQUFFLGtCQUREO0FBRVAsZ0NBQWdCO0FBRlQsZUFGYTtBQU10QkMsa0JBQUksRUFBRUMsSUFBSSxDQUFDQyxTQUFMLENBQWVQLE1BQWY7QUFOZ0IsYUFBTixDQURwQjs7QUFBQTtBQUFBOztBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFB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QUFVLElBQVY7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxLQUNFO0FBQUEsd0NBQWUsTUFBZjtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBLEtBQ0U7QUFBSyxPQUFHLEVBQUMsaUJBQVQ7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBLElBREYsRUFFRTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsZ0JBRkYsQ0FERixDQVRGLENBREY7QUFBQTtBQUFBO0FBQUEsOHBMQURGO0FBcUNEIiwiZmlsZSI6Ii4vY29tcG9uZW50cy9FZGl0b3IuanN4LmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IHsgdXNlU3RhdGUsIHVzZUVmZmVjdCB9IGZyb20gXCJyZWFjdFwiO1xuaW1wb3J0IHsgcGFyc2UsIHByaW50IH0gZnJvbSBcImdyYXBocWxcIjtcbmltcG9ydCBHcmFwaGlRTCBmcm9tIFwiZ3JhcGhpcWxcIjtcblxuYXN5bmMgZnVuY3Rpb24gZ3FsKHVybCwgcGFyYW1zKSB7XG4gIHJldHVybiBhd2FpdCBmZXRjaCh1cmwsIHtcbiAgICBtZXRob2Q6IFwicG9zdFwiLFxuICAgIGhlYWRlcnM6IHtcbiAgICAgIEFjY2VwdDogXCJhcHBsaWNhdGlvbi9qc29uXCIsXG4gICAgICBcIkNvbnRlbnQtVHlwZVwiOiBcImFwcGxpY2F0aW9uL2pzb25cIixcbiAgICB9LFxuICAgIGJvZHk6IEpTT04uc3RyaW5naWZ5KHBhcmFtcyksXG4gIH0pO1xufVxuXG5mdW5jdGlvbiBjcmVhdGVTdG9yYWdlKHsgcHJvamVjdCB9KSB7XG4gIHJldHVybiB7XG4gICAgZ2V0SXRlbShuYW1lKSB7XG4gICAgICByZXR1cm4gd2luZG93LmxvY2FsU3RvcmFnZS5nZXRJdGVtKGBkaXJlY3R1czoke3Byb2plY3R9OiR7bmFtZX1gKTtcbiAgICB9LFxuICAgIHNldEl0ZW0obmFtZSwgdmFsdWUpIHtcbiAgICAgIHJldHVybiB3aW5kb3cubG9jYWxTdG9yYWdlLnNldEl0ZW0oXG4gICAgICAgIGBkaXJlY3R1czoke3Byb2plY3R9OiR7bmFtZX1gLFxuICAgICAgICB2YWx1ZVxuICAgICAgKTtcbiAgICB9LFxuICAgIHJlbW92ZUl0ZW0obmFtZSkge1xuICAgICAgcmV0dXJuIHdpbmRvdy5sb2NhbFN0b3JhZ2UucmVtb3ZlSXRlbShcbiAgICAgICAgYGRpcmVjdHVzOiR7cHJvamVjdH06JHtuYW1lfWBcbiAgICAgICk7XG4gICAgfSxcbiAgfTtcbn1cblxuZnVuY3Rpb24gY3JlYXRlRmV0Y2hlcih7IHNlcnZlciwgcHJvamVjdCwgcXVlcnksIHZhcmlhYmxlcyB9KSB7XG4gIHJldHVybiBhc3luYyAocGFyYW1zKSA9PiB7XG4gICAgY29uc3QgcmVzID0gYXdhaXQgZ3FsKGAke3NlcnZlcn0vJHtwcm9qZWN0fS9ncmFwaHFsYCwgcGFyYW1zKTtcbiAgICBjb25zdCBwYXlsb2FkID0gYXdhaXQgcmVzLmpzb24oKTtcbiAgICBpZiAocmVzLm9rICYmIHF1ZXJ5KSB7XG4gICAgICB0cnkge1xuICAgICAgICBjb25zdCBmb3JtYXR0ZWRRdWVyeSA9IHByaW50KHBhcnNlKHF1ZXJ5KSk7XG4gICAgICAgIGlmIChxdWVyeSAhPT0gZm9ybWF0dGVkUXVlcnkpIHtcbiAgICAgICAgICBzZXRRdWVyeShmb3JtYXR0ZWRRdWVyeSk7XG4gICAgICAgIH1cblxuICAgICAgICBjb25zdCBmb3JtYXR0ZWRWYXJpYWJsZXMgPSBKU09OLnN0cmluZ2lmeShcbiAgICAgICAgICBKU09OLnBhcnNlKHZhcmlhYmxlcyksXG4gICAgICAgICAgbnVsbCxcbiAgICAgICAgICA0XG4gICAgICAgICk7XG4gICAgICAgIGlmICh2YXJpYWJsZXMgIT09IGZvcm1hdHRlZFZhcmlhYmxlcykge1xuICAgICAgICAgIHNldFZhcmlhYmxlcyhmb3JtYXR0ZWRWYXJpYWJsZXMpO1xuICAgICAgICB9XG4gICAgICB9IGNhdGNoIChlcnJvcikge31cbiAgICB9XG5cbiAgICByZXR1cm4gcGF5bG9hZDtcbiAgfTtcbn1cblxuZXhwb3J0IGRlZmF1bHQgZnVuY3Rpb24gKHsgc2VydmVyIH0pIHtcbiAgY29uc3QgW3Byb2plY3RzLCBzZXRQcm9qZWN0c10gPSB1c2VTdGF0ZShbXSk7XG4gIGNvbnN0IFtwcm9qZWN0LCBzZXRQcm9qZWN0XSA9IHVzZVN0YXRlKFxuICAgIHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbShcImRpcmVjdHVzOnByb2plY3RcIikgfHwgXCJkaXJlY3R1c1wiXG4gICk7XG4gIGNvbnN0IFtxdWVyeSwgc2V0UXVlcnldID0gdXNlU3RhdGUoXG4gICAgd2luZG93LmxvY2FsU3RvcmFnZS5nZXRJdGVtKGBkaXJlY3R1czoke3Byb2plY3R9OmdyYXBoaXFsOnF1ZXJ5YCkgfHxcbiAgICAgIFwiIyBRdWVyeVwiXG4gICk7XG4gIGNvbnN0IFt2YXJpYWJsZXMsIHNldFZhcmlhYmxlc10gPSB1c2VTdGF0ZShcbiAgICB3aW5kb3cubG9jYWxTdG9yYWdlLmdldEl0ZW0oYGRpcmVjdHVzOiR7cHJvamVjdH06Z3JhcGhpcWw6dmFyaWFibGVzYCkgfHxcbiAgICAgIFwie31cIlxuICApO1xuXG4gIGxldCB0YXJnZXRTZXJ2ZXIgPSBzZXJ2ZXIgfHwgXCJcIjtcbiAgaWYgKHRhcmdldFNlcnZlci5lbmRzV2l0aChcIi9cIikpIHtcbiAgICB0YXJnZXRTZXJ2ZXIgPSB0YXJnZXRTZXJ2ZXIuc3Vic3RyKDAsIHRhcmdldFNlcnZlci5sZW5ndGggLSAxKTtcbiAgfVxuXG4gIGxldCB0YXJnZXRQcm9qZWN0ID0gYCR7dGFyZ2V0U2VydmVyfS8ke3Byb2plY3R9YDtcblxuICBjb25zdCBmZXRjaFByb2plY3RzID0gYXN5bmMgKCkgPT4ge1xuICAgIHJldHVybiBhd2FpdCBncWwoYCR7dGFyZ2V0UHJvamVjdH0vZ3JhcGhxbGAsIHtcbiAgICAgIHF1ZXJ5OiBgXG4gICAgICAgIHF1ZXJ5IHtcbiAgICAgICAgICBwcm9qZWN0cyB7XG4gICAgICAgICAgICBpZFxuICAgICAgICAgICAgbmFtZVxuICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICAgYCxcbiAgICB9KTtcbiAgfTtcblxuICB1c2VFZmZlY3QoKCkgPT4ge1xuICAgIGZldGNoUHJvamVjdHMoKS50aGVuKChwcm9qZWN0cykgPT4ge1xuICAgICAgc2V0UHJvamVjdHMocHJvamVjdHMpO1xuICAgIH0pO1xuICB9LCBbXSk7XG5cbiAgcmV0dXJuIChcbiAgICA8PlxuICAgICAgPEdyYXBoaVFMXG4gICAgICAgIGVkaXRvclRoZW1lPVwiZGlyZWN0dXNcIlxuICAgICAgICBxdWVyeT17cXVlcnl9XG4gICAgICAgIHZhcmlhYmxlcz17dmFyaWFibGVzfVxuICAgICAgICBvbkVkaXRRdWVyeT17c2V0UXVlcnl9XG4gICAgICAgIG9uRWRpdFZhcmlhYmxlcz17c2V0VmFyaWFibGVzfVxuICAgICAgICBmZXRjaGVyPXtjcmVhdGVGZXRjaGVyKHsgc2VydmVyLCBwcm9qZWN0LCBxdWVyeSwgdmFyaWFibGVzIH0pfVxuICAgICAgICBzdG9yYWdlPXtjcmVhdGVTdG9yYWdlKHsgcHJvamVjdCB9KX1cbiAgICAgID5cbiAgICAgICAgPEdyYXBoaVFMLkxvZ28+XG4gICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJsb2dvXCI+XG4gICAgICAgICAgICA8aW1nIHNyYz1cImltYWdlcy9sb2dvLnN2Z1wiIC8+XG4gICAgICAgICAgICA8c3Bhbj5EaXJlY3R1czwvc3Bhbj5cbiAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgPC9HcmFwaGlRTC5Mb2dvPlxuICAgICAgPC9HcmFwaGlRTD5cbiAgICAgIDxzdHlsZSBqc3g+e2BcbiAgICAgICAgLmxvZ28ge1xuICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XG4gICAgICAgICAgZmxleC1kaXJlY3Rpb246IHJvdztcbiAgICAgICAgICBmbGV4LXdyYXA6IG5vd3JhcDtcbiAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgICAgICAgIGFsaWduLWNvbnRlbnQ6IHN0cmV0Y2g7XG4gICAgICAgIH1cbiAgICAgICAgLmxvZ28gc3BhbiB7XG4gICAgICAgICAgbWFyZ2luLWxlZnQ6IDEycHg7XG4gICAgICAgICAgZm9udC1mYW1pbHk6IFJvYm90bztcbiAgICAgICAgfVxuICAgICAgICAubG9nbyBpbWcge1xuICAgICAgICAgIGhlaWdodDogMjRweDtcbiAgICAgICAgfVxuICAgICAgYH08L3N0eWxlPlxuICAgIDwvPlxuICApO1xufVxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./components/Editor.jsx\n");

/***/ })

})