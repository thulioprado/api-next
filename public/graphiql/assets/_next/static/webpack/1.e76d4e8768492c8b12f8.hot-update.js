webpackHotUpdate(1,{

/***/ "./components/Editor.jsx":
/*!*******************************!*\
  !*** ./components/Editor.jsx ***!
  \*******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* WEBPACK VAR INJECTION */(function(module) {/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ \"./node_modules/@babel/runtime/regenerator/index.js\");\n/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/esm/asyncToGenerator */ \"./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js\");\n/* harmony import */ var styled_jsx_style__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! styled-jsx/style */ \"./node_modules/styled-jsx/style.js\");\n/* harmony import */ var styled_jsx_style__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(styled_jsx_style__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ \"./node_modules/react/index.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var graphql__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! graphql */ \"./node_modules/graphql/index.mjs\");\n/* harmony import */ var graphiql__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! graphiql */ \"./node_modules/graphiql/dist/index.js\");\n/* harmony import */ var graphiql__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(graphiql__WEBPACK_IMPORTED_MODULE_5__);\n\n\nvar _jsxFileName = \"D:\\\\directus\\\\graphiql\\\\components\\\\Editor.jsx\";\n\n\nvar __jsx = react__WEBPACK_IMPORTED_MODULE_3___default.a.createElement;\n\n\n\n\nfunction gql(_x, _x2) {\n  return _gql.apply(this, arguments);\n}\n\nfunction _gql() {\n  _gql = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(url, params) {\n    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {\n      while (1) {\n        switch (_context3.prev = _context3.next) {\n          case 0:\n            _context3.next = 2;\n            return fetch(url, {\n              method: \"post\",\n              headers: {\n                Accept: \"application/json\",\n                \"Content-Type\": \"application/json\"\n              },\n              body: JSON.stringify(params)\n            });\n\n          case 2:\n            return _context3.abrupt(\"return\", _context3.sent);\n\n          case 3:\n          case \"end\":\n            return _context3.stop();\n        }\n      }\n    }, _callee3);\n  }));\n  return _gql.apply(this, arguments);\n}\n\nfunction createStorage(_ref) {\n  var project = _ref.project;\n  return {\n    getItem: function getItem(name) {\n      return window.localStorage.getItem(\"directus:\".concat(project, \":\").concat(name));\n    },\n    setItem: function setItem(name, value) {\n      return window.localStorage.setItem(\"directus:\".concat(project, \":\").concat(name), value);\n    },\n    removeItem: function removeItem(name) {\n      return window.localStorage.removeItem(\"directus:\".concat(project, \":\").concat(name));\n    }\n  };\n}\n\nfunction createFetcher(_ref2) {\n  var server = _ref2.server;\n  return /*#__PURE__*/function () {\n    var _ref3 = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(params) {\n      var res;\n      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {\n        while (1) {\n          switch (_context.prev = _context.next) {\n            case 0:\n              _context.next = 2;\n              return gql(\"\".concat(server, \"/graphql\"), params);\n\n            case 2:\n              res = _context.sent;\n              _context.next = 5;\n              return res.json();\n\n            case 5:\n              return _context.abrupt(\"return\", _context.sent);\n\n            case 6:\n            case \"end\":\n              return _context.stop();\n          }\n        }\n      }, _callee);\n    }));\n\n    return function (_x3) {\n      return _ref3.apply(this, arguments);\n    };\n  }();\n}\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (function (_ref4) {\n  var _this = this;\n\n  var server = _ref4.server;\n\n  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])([]),\n      projects = _useState[0],\n      setProjects = _useState[1];\n\n  var _useState2 = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])(window.localStorage.getItem(\"directus:project\") || null),\n      project = _useState2[0],\n      setProject = _useState2[1];\n\n  server = server || \"\";\n\n  if (server.endsWith(\"/\")) {\n    server = server.substr(0, server.length - 1);\n  }\n\n  server = \"\".concat(server);\n\n  var fetchProjects = /*#__PURE__*/function () {\n    var _ref5 = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {\n      var response, _yield$response$json, data;\n\n      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {\n        while (1) {\n          switch (_context2.prev = _context2.next) {\n            case 0:\n              _context2.next = 2;\n              return gql(\"\".concat(server, \"/graphql\"), {\n                query: \"\\n        query {\\n          projects {\\n            id\\n            name\\n          }\\n        }\\n      \"\n              });\n\n            case 2:\n              response = _context2.sent;\n              _context2.next = 5;\n              return response.json();\n\n            case 5:\n              _yield$response$json = _context2.sent;\n              data = _yield$response$json.data;\n              console.log(data);\n              return _context2.abrupt(\"return\", data.projects);\n\n            case 9:\n            case \"end\":\n              return _context2.stop();\n          }\n        }\n      }, _callee2);\n    }));\n\n    return function fetchProjects() {\n      return _ref5.apply(this, arguments);\n    };\n  }();\n\n  Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useEffect\"])(function () {\n    fetchProjects().then(function (projects) {\n      console.log('got projects', projects);\n      setProjects(projects);\n    });\n  }, []);\n  return __jsx(react__WEBPACK_IMPORTED_MODULE_3___default.a.Fragment, null, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a, {\n    editorTheme: \"directus\",\n    fetcher: createFetcher({\n      server: server\n    }),\n    storage: createStorage({\n      project: project\n    }),\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 74,\n      columnNumber: 7\n    }\n  }, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.Logo, {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 79,\n      columnNumber: 9\n    }\n  }, __jsx(\"div\", {\n    className: \"jsx-2632086112\" + \" \" + \"logo\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 80,\n      columnNumber: 11\n    }\n  }, __jsx(\"img\", {\n    src: \"images/logo.svg\",\n    className: \"jsx-2632086112\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 81,\n      columnNumber: 13\n    }\n  }), __jsx(\"span\", {\n    className: \"jsx-2632086112\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 82,\n      columnNumber: 13\n    }\n  }, \"Directus\"))), __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.Toolbar, {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 85,\n      columnNumber: 9\n    }\n  }, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.Group, {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 86,\n      columnNumber: 11\n    }\n  }, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.Select, {\n    onSelect: function onSelect(project) {\n      return setProject(project);\n    },\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 87,\n      columnNumber: 13\n    }\n  }, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.SelectOption, {\n    className: \"cu\",\n    label: \"Server\",\n    selected: !project,\n    value: null,\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 88,\n      columnNumber: 15\n    }\n  }), projects.map(function (proj, index) {\n    return __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.SelectOption, {\n      key: proj,\n      label: proj,\n      selected: project === proj,\n      value: proj,\n      __self: _this,\n      __source: {\n        fileName: _jsxFileName,\n        lineNumber: 89,\n        columnNumber: 46\n      }\n    });\n  }))))), __jsx(styled_jsx_style__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    id: \"2632086112\",\n    __self: this\n  }, \".logo.jsx-2632086112{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-align-content:stretch;-ms-flex-line-pack:stretch;align-content:stretch;}.logo.jsx-2632086112 span.jsx-2632086112{margin-left:12px;font-family:Roboto;}.logo.jsx-2632086112 img.jsx-2632086112{height:24px;}li[data-selector].jsx-2632086112{height:1px;background:#888;padding:0;margin:0;}\\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIkQ6XFxkaXJlY3R1c1xcZ3JhcGhpcWxcXGNvbXBvbmVudHNcXEVkaXRvci5qc3giXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBNkZrQixBQUd3QixBQVFJLEFBSUwsQUFHRCxXQUNLLENBSGxCLEtBSnFCLFVBUVQsU0FQWixDQVFXLFNBQ1gsNEJBbEJxQixxRUFDRiwrREFDTSxtR0FDSiw2RkFDRywrRUFDeEIiLCJmaWxlIjoiRDpcXGRpcmVjdHVzXFxncmFwaGlxbFxcY29tcG9uZW50c1xcRWRpdG9yLmpzeCIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCB7IHVzZVN0YXRlLCB1c2VFZmZlY3QgfSBmcm9tIFwicmVhY3RcIjtcbmltcG9ydCB7IHBhcnNlLCBwcmludCB9IGZyb20gXCJncmFwaHFsXCI7XG5pbXBvcnQgR3JhcGhpUUwgZnJvbSBcImdyYXBoaXFsXCI7XG5cbmFzeW5jIGZ1bmN0aW9uIGdxbCh1cmwsIHBhcmFtcykge1xuICByZXR1cm4gYXdhaXQgZmV0Y2godXJsLCB7XG4gICAgbWV0aG9kOiBcInBvc3RcIixcbiAgICBoZWFkZXJzOiB7XG4gICAgICBBY2NlcHQ6IFwiYXBwbGljYXRpb24vanNvblwiLFxuICAgICAgXCJDb250ZW50LVR5cGVcIjogXCJhcHBsaWNhdGlvbi9qc29uXCIsXG4gICAgfSxcbiAgICBib2R5OiBKU09OLnN0cmluZ2lmeShwYXJhbXMpLFxuICB9KTtcbn1cblxuZnVuY3Rpb24gY3JlYXRlU3RvcmFnZSh7IHByb2plY3QgfSkge1xuICByZXR1cm4ge1xuICAgIGdldEl0ZW0obmFtZSkge1xuICAgICAgcmV0dXJuIHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbShgZGlyZWN0dXM6JHtwcm9qZWN0fToke25hbWV9YCk7XG4gICAgfSxcbiAgICBzZXRJdGVtKG5hbWUsIHZhbHVlKSB7XG4gICAgICByZXR1cm4gd2luZG93LmxvY2FsU3RvcmFnZS5zZXRJdGVtKGBkaXJlY3R1czoke3Byb2plY3R9OiR7bmFtZX1gLCB2YWx1ZSk7XG4gICAgfSxcbiAgICByZW1vdmVJdGVtKG5hbWUpIHtcbiAgICAgIHJldHVybiB3aW5kb3cubG9jYWxTdG9yYWdlLnJlbW92ZUl0ZW0oYGRpcmVjdHVzOiR7cHJvamVjdH06JHtuYW1lfWApO1xuICAgIH0sXG4gIH07XG59XG5cbmZ1bmN0aW9uIGNyZWF0ZUZldGNoZXIoeyBzZXJ2ZXIgfSkge1xuICByZXR1cm4gYXN5bmMgKHBhcmFtcykgPT4ge1xuICAgIGNvbnN0IHJlcyA9IGF3YWl0IGdxbChgJHtzZXJ2ZXJ9L2dyYXBocWxgLCBwYXJhbXMpO1xuICAgIHJldHVybiBhd2FpdCByZXMuanNvbigpO1xuICB9O1xufVxuXG5leHBvcnQgZGVmYXVsdCBmdW5jdGlvbiAoeyBzZXJ2ZXIgfSkge1xuICBjb25zdCBbcHJvamVjdHMsIHNldFByb2plY3RzXSA9IHVzZVN0YXRlKFtdKTtcbiAgY29uc3QgW3Byb2plY3QsIHNldFByb2plY3RdID0gdXNlU3RhdGUoXG4gICAgd2luZG93LmxvY2FsU3RvcmFnZS5nZXRJdGVtKFwiZGlyZWN0dXM6cHJvamVjdFwiKSB8fCBudWxsXG4gICk7XG5cbiAgc2VydmVyID0gc2VydmVyIHx8IFwiXCI7XG4gIGlmIChzZXJ2ZXIuZW5kc1dpdGgoXCIvXCIpKSB7XG4gICAgc2VydmVyID0gc2VydmVyLnN1YnN0cigwLCBzZXJ2ZXIubGVuZ3RoIC0gMSk7XG4gIH1cbiAgc2VydmVyID0gYCR7c2VydmVyfWA7XG5cbiAgY29uc3QgZmV0Y2hQcm9qZWN0cyA9IGFzeW5jICgpID0+IHtcbiAgICBjb25zdCByZXNwb25zZSA9IGF3YWl0IGdxbChgJHtzZXJ2ZXJ9L2dyYXBocWxgLCB7XG4gICAgICBxdWVyeTogYFxuICAgICAgICBxdWVyeSB7XG4gICAgICAgICAgcHJvamVjdHMge1xuICAgICAgICAgICAgaWRcbiAgICAgICAgICAgIG5hbWVcbiAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICAgIGAsXG4gICAgfSk7XG4gICAgY29uc3QgeyBkYXRhIH0gPSBhd2FpdCByZXNwb25zZS5qc29uKCk7XG4gICAgY29uc29sZS5sb2coZGF0YSk7XG4gICAgcmV0dXJuIGRhdGEucHJvamVjdHM7XG4gIH07XG5cbiAgdXNlRWZmZWN0KCgpID0+IHtcbiAgICBmZXRjaFByb2plY3RzKCkudGhlbigocHJvamVjdHMpID0+IHtcbiAgICAgIGNvbnNvbGUubG9nKCdnb3QgcHJvamVjdHMnLCBwcm9qZWN0cyk7XG4gICAgICBzZXRQcm9qZWN0cyhwcm9qZWN0cyk7XG4gICAgfSk7XG4gIH0sIFtdKTtcblxuICByZXR1cm4gKFxuICAgIDw+XG4gICAgICA8R3JhcGhpUUxcbiAgICAgICAgZWRpdG9yVGhlbWU9XCJkaXJlY3R1c1wiXG4gICAgICAgIGZldGNoZXI9e2NyZWF0ZUZldGNoZXIoeyBzZXJ2ZXIgfSl9XG4gICAgICAgIHN0b3JhZ2U9e2NyZWF0ZVN0b3JhZ2UoeyBwcm9qZWN0IH0pfVxuICAgICAgPlxuICAgICAgICA8R3JhcGhpUUwuTG9nbz5cbiAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImxvZ29cIj5cbiAgICAgICAgICAgIDxpbWcgc3JjPVwiaW1hZ2VzL2xvZ28uc3ZnXCIgLz5cbiAgICAgICAgICAgIDxzcGFuPkRpcmVjdHVzPC9zcGFuPlxuICAgICAgICAgIDwvZGl2PlxuICAgICAgICA8L0dyYXBoaVFMLkxvZ28+XG4gICAgICAgIDxHcmFwaGlRTC5Ub29sYmFyPlxuICAgICAgICAgIDxHcmFwaGlRTC5Hcm91cD5cbiAgICAgICAgICAgIDxHcmFwaGlRTC5TZWxlY3Qgb25TZWxlY3Q9eyhwcm9qZWN0KSA9PiBzZXRQcm9qZWN0KHByb2plY3QpfT5cbiAgICAgICAgICAgICAgPEdyYXBoaVFMLlNlbGVjdE9wdGlvbiBjbGFzc05hbWU9XCJjdVwiIGxhYmVsPVwiU2VydmVyXCIgc2VsZWN0ZWQ9eyFwcm9qZWN0fSB2YWx1ZT17bnVsbH0gLz5cbiAgICAgICAgICAgICAge3Byb2plY3RzLm1hcCgocHJvaiwgaW5kZXgpID0+IDxHcmFwaGlRTC5TZWxlY3RPcHRpb24ga2V5PXtwcm9qfSBsYWJlbD17cHJvan0gc2VsZWN0ZWQ9e3Byb2plY3Q9PT1wcm9qfSB2YWx1ZT17cHJvan0gLz4pfVxuICAgICAgICAgICAgPC9HcmFwaGlRTC5TZWxlY3Q+XG4gICAgICAgICAgPC9HcmFwaGlRTC5Hcm91cD5cbiAgICAgICAgPC9HcmFwaGlRTC5Ub29sYmFyPlxuICAgICAgPC9HcmFwaGlRTD5cbiAgICAgIDxzdHlsZSBqc3g+e2BcbiAgICAgICAgLmxvZ28ge1xuICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XG4gICAgICAgICAgZmxleC1kaXJlY3Rpb246IHJvdztcbiAgICAgICAgICBmbGV4LXdyYXA6IG5vd3JhcDtcbiAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgICAgICAgIGFsaWduLWNvbnRlbnQ6IHN0cmV0Y2g7XG4gICAgICAgIH1cbiAgICAgICAgLmxvZ28gc3BhbiB7XG4gICAgICAgICAgbWFyZ2luLWxlZnQ6IDEycHg7XG4gICAgICAgICAgZm9udC1mYW1pbHk6IFJvYm90bztcbiAgICAgICAgfVxuICAgICAgICAubG9nbyBpbWcge1xuICAgICAgICAgIGhlaWdodDogMjRweDtcbiAgICAgICAgfVxuICAgICAgICBsaVtkYXRhLXNlbGVjdG9yXSB7XG4gICAgICAgICAgaGVpZ2h0OiAxcHg7XG4gICAgICAgICAgYmFja2dyb3VuZDogIzg4ODtcbiAgICAgICAgICBwYWRkaW5nOiAwO1xuICAgICAgICAgIG1hcmdpbjogMDtcbiAgICAgICAgfVxuICAgICAgYH08L3N0eWxlPlxuICAgIDwvPlxuICApO1xufVxuIl19 */\\n/*@ sourceURL=D:\\\\\\\\directus\\\\\\\\graphiql\\\\\\\\components\\\\\\\\Editor.jsx */\"));\n});\n\n;\n    var _a, _b;\n    // Legacy CSS implementations will `eval` browser code in a Node.js context\n    // to extract CSS. For backwards compatibility, we need to check we're in a\n    // browser context before continuing.\n    if (typeof self !== 'undefined' &&\n        // AMP / No-JS mode does not inject these helpers:\n        '$RefreshHelpers$' in self) {\n        var currentExports_1 = module.__proto__.exports;\n        var prevExports = (_b = (_a = module.hot.data) === null || _a === void 0 ? void 0 : _a.prevExports) !== null && _b !== void 0 ? _b : null;\n        // This cannot happen in MainTemplate because the exports mismatch between\n        // templating and execution.\n        self.$RefreshHelpers$.registerExportsForReactRefresh(currentExports_1, module.i);\n        // A module can be accepted automatically based on its exports, e.g. when\n        // it is a Refresh Boundary.\n        if (self.$RefreshHelpers$.isReactRefreshBoundary(currentExports_1)) {\n            // Save the previous exports on update so we can compare the boundary\n            // signatures.\n            module.hot.dispose(function (data) {\n                data.prevExports = currentExports_1;\n            });\n            // Unconditionally accept an update to this module, we'll check if it's\n            // still a Refresh Boundary later.\n            module.hot.accept();\n            // This field is set when the previous version of this module was a\n            // Refresh Boundary, letting us know we need to check for invalidation or\n            // enqueue an update.\n            if (prevExports !== null) {\n                // A boundary can become ineligible if its exports are incompatible\n                // with the previous exports.\n                //\n                // For example, if you add/remove/change exports, we'll want to\n                // re-execute the importing modules, and force those components to\n                // re-render. Similarly, if you convert a class component to a\n                // function, we want to invalidate the boundary.\n                if (self.$RefreshHelpers$.shouldInvalidateReactRefreshBoundary(prevExports, currentExports_1)) {\n                    module.hot.invalidate();\n                }\n                else {\n                    self.$RefreshHelpers$.scheduleUpdate();\n                }\n            }\n        }\n        else {\n            // Since we just executed the code for the module, it's possible that the\n            // new exports made it ineligible for being a boundary.\n            // We only care about the case when we were _previously_ a boundary,\n            // because we already accepted this update (accidental side effect).\n            var isNoLongerABoundary = prevExports !== null;\n            if (isNoLongerABoundary) {\n                module.hot.invalidate();\n            }\n        }\n    }\n\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../node_modules/webpack/buildin/harmony-module.js */ \"./node_modules/webpack/buildin/harmony-module.js\")(module)))//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9jb21wb25lbnRzL0VkaXRvci5qc3g/ZDdkNiJdLCJuYW1lcyI6WyJncWwiLCJ1cmwiLCJwYXJhbXMiLCJmZXRjaCIsIm1ldGhvZCIsImhlYWRlcnMiLCJBY2NlcHQiLCJib2R5IiwiSlNPTiIsInN0cmluZ2lmeSIsImNyZWF0ZVN0b3JhZ2UiLCJwcm9qZWN0IiwiZ2V0SXRlbSIsIm5hbWUiLCJ3aW5kb3ciLCJsb2NhbFN0b3JhZ2UiLCJzZXRJdGVtIiwidmFsdWUiLCJyZW1vdmVJdGVtIiwiY3JlYXRlRmV0Y2hlciIsInNlcnZlciIsInJlcyIsImpzb24iLCJ1c2VTdGF0ZSIsInByb2plY3RzIiwic2V0UHJvamVjdHMiLCJzZXRQcm9qZWN0IiwiZW5kc1dpdGgiLCJzdWJzdHIiLCJsZW5ndGgiLCJmZXRjaFByb2plY3RzIiwicXVlcnkiLCJyZXNwb25zZSIsImRhdGEiLCJjb25zb2xlIiwibG9nIiwidXNlRWZmZWN0IiwidGhlbiIsIm1hcCIsInByb2oiLCJpbmRleCJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBQTtBQUNBO0FBQ0E7O1NBRWVBLEc7Ozs7OzBMQUFmLGtCQUFtQkMsR0FBbkIsRUFBd0JDLE1BQXhCO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBLG1CQUNlQyxLQUFLLENBQUNGLEdBQUQsRUFBTTtBQUN0Qkcsb0JBQU0sRUFBRSxNQURjO0FBRXRCQyxxQkFBTyxFQUFFO0FBQ1BDLHNCQUFNLEVBQUUsa0JBREQ7QUFFUCxnQ0FBZ0I7QUFGVCxlQUZhO0FBTXRCQyxrQkFBSSxFQUFFQyxJQUFJLENBQUNDLFNBQUwsQ0FBZVAsTUFBZjtBQU5nQixhQUFOLENBRHBCOztBQUFBO0FBQUE7O0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUEsRzs7OztBQVdBLFNBQVNRLGFBQVQsT0FBb0M7QUFBQSxNQUFYQyxPQUFXLFFBQVhBLE9BQVc7QUFDbEMsU0FBTztBQUNMQyxXQURLLG1CQUNHQyxJ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QUFBLE1BQWpCO0FBQUEsR0FBYixDQUZILENBREYsQ0FERixDQVhGLENBREY7QUFBQTtBQUFBO0FBQUEseTFLQURGO0FBK0NEIiwiZmlsZSI6Ii4vY29tcG9uZW50cy9FZGl0b3IuanN4LmpzIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IHsgdXNlU3RhdGUsIHVzZUVmZmVjdCB9IGZyb20gXCJyZWFjdFwiO1xuaW1wb3J0IHsgcGFyc2UsIHByaW50IH0gZnJvbSBcImdyYXBocWxcIjtcbmltcG9ydCBHcmFwaGlRTCBmcm9tIFwiZ3JhcGhpcWxcIjtcblxuYXN5bmMgZnVuY3Rpb24gZ3FsKHVybCwgcGFyYW1zKSB7XG4gIHJldHVybiBhd2FpdCBmZXRjaCh1cmwsIHtcbiAgICBtZXRob2Q6IFwicG9zdFwiLFxuICAgIGhlYWRlcnM6IHtcbiAgICAgIEFjY2VwdDogXCJhcHBsaWNhdGlvbi9qc29uXCIsXG4gICAgICBcIkNvbnRlbnQtVHlwZVwiOiBcImFwcGxpY2F0aW9uL2pzb25cIixcbiAgICB9LFxuICAgIGJvZHk6IEpTT04uc3RyaW5naWZ5KHBhcmFtcyksXG4gIH0pO1xufVxuXG5mdW5jdGlvbiBjcmVhdGVTdG9yYWdlKHsgcHJvamVjdCB9KSB7XG4gIHJldHVybiB7XG4gICAgZ2V0SXRlbShuYW1lKSB7XG4gICAgICByZXR1cm4gd2luZG93LmxvY2FsU3RvcmFnZS5nZXRJdGVtKGBkaXJlY3R1czoke3Byb2plY3R9OiR7bmFtZX1gKTtcbiAgICB9LFxuICAgIHNldEl0ZW0obmFtZSwgdmFsdWUpIHtcbiAgICAgIHJldHVybiB3aW5kb3cubG9jYWxTdG9yYWdlLnNldEl0ZW0oYGRpcmVjdHVzOiR7cHJvamVjdH06JHtuYW1lfWAsIHZhbHVlKTtcbiAgICB9LFxuICAgIHJlbW92ZUl0ZW0obmFtZSkge1xuICAgICAgcmV0dXJuIHdpbmRvdy5sb2NhbFN0b3JhZ2UucmVtb3ZlSXRlbShgZGlyZWN0dXM6JHtwcm9qZWN0fToke25hbWV9YCk7XG4gICAgfSxcbiAgfTtcbn1cblxuZnVuY3Rpb24gY3JlYXRlRmV0Y2hlcih7IHNlcnZlciB9KSB7XG4gIHJldHVybiBhc3luYyAocGFyYW1zKSA9PiB7XG4gICAgY29uc3QgcmVzID0gYXdhaXQgZ3FsKGAke3NlcnZlcn0vZ3JhcGhxbGAsIHBhcmFtcyk7XG4gICAgcmV0dXJuIGF3YWl0IHJlcy5qc29uKCk7XG4gIH07XG59XG5cbmV4cG9ydCBkZWZhdWx0IGZ1bmN0aW9uICh7IHNlcnZlciB9KSB7XG4gIGNvbnN0IFtwcm9qZWN0cywgc2V0UHJvamVjdHNdID0gdXNlU3RhdGUoW10pO1xuICBjb25zdCBbcHJvamVjdCwgc2V0UHJvamVjdF0gPSB1c2VTdGF0ZShcbiAgICB3aW5kb3cubG9jYWxTdG9yYWdlLmdldEl0ZW0oXCJkaXJlY3R1czpwcm9qZWN0XCIpIHx8IG51bGxcbiAgKTtcblxuICBzZXJ2ZXIgPSBzZXJ2ZXIgfHwgXCJcIjtcbiAgaWYgKHNlcnZlci5lbmRzV2l0aChcIi9cIikpIHtcbiAgICBzZXJ2ZXIgPSBzZXJ2ZXIuc3Vic3RyKDAsIHNlcnZlci5sZW5ndGggLSAxKTtcbiAgfVxuICBzZXJ2ZXIgPSBgJHtzZXJ2ZXJ9YDtcblxuICBjb25zdCBmZXRjaFByb2plY3RzID0gYXN5bmMgKCkgPT4ge1xuICAgIGNvbnN0IHJlc3BvbnNlID0gYXdhaXQgZ3FsKGAke3NlcnZlcn0vZ3JhcGhxbGAsIHtcbiAgICAgIHF1ZXJ5OiBgXG4gICAgICAgIHF1ZXJ5IHtcbiAgICAgICAgICBwcm9qZWN0cyB7XG4gICAgICAgICAgICBpZFxuICAgICAgICAgICAgbmFtZVxuICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICAgYCxcbiAgICB9KTtcbiAgICBjb25zdCB7IGRhdGEgfSA9IGF3YWl0IHJlc3BvbnNlLmpzb24oKTtcbiAgICBjb25zb2xlLmxvZyhkYXRhKTtcbiAgICByZXR1cm4gZGF0YS5wcm9qZWN0cztcbiAgfTtcblxuICB1c2VFZmZlY3QoKCkgPT4ge1xuICAgIGZldGNoUHJvamVjdHMoKS50aGVuKChwcm9qZWN0cykgPT4ge1xuICAgICAgY29uc29sZS5sb2coJ2dvdCBwcm9qZWN0cycsIHByb2plY3RzKTtcbiAgICAgIHNldFByb2plY3RzKHByb2plY3RzKTtcbiAgICB9KTtcbiAgfSwgW10pO1xuXG4gIHJldHVybiAoXG4gICAgPD5cbiAgICAgIDxHcmFwaGlRTFxuICAgICAgICBlZGl0b3JUaGVtZT1cImRpcmVjdHVzXCJcbiAgICAgICAgZmV0Y2hlcj17Y3JlYXRlRmV0Y2hlcih7IHNlcnZlciB9KX1cbiAgICAgICAgc3RvcmFnZT17Y3JlYXRlU3RvcmFnZSh7IHByb2plY3QgfSl9XG4gICAgICA+XG4gICAgICAgIDxHcmFwaGlRTC5Mb2dvPlxuICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwibG9nb1wiPlxuICAgICAgICAgICAgPGltZyBzcmM9XCJpbWFnZXMvbG9nby5zdmdcIiAvPlxuICAgICAgICAgICAgPHNwYW4+RGlyZWN0dXM8L3NwYW4+XG4gICAgICAgICAgPC9kaXY+XG4gICAgICAgIDwvR3JhcGhpUUwuTG9nbz5cbiAgICAgICAgPEdyYXBoaVFMLlRvb2xiYXI+XG4gICAgICAgICAgPEdyYXBoaVFMLkdyb3VwPlxuICAgICAgICAgICAgPEdyYXBoaVFMLlNlbGVjdCBvblNlbGVjdD17KHByb2plY3QpID0+IHNldFByb2plY3QocHJvamVjdCl9PlxuICAgICAgICAgICAgICA8R3JhcGhpUUwuU2VsZWN0T3B0aW9uIGNsYXNzTmFtZT1cImN1XCIgbGFiZWw9XCJTZXJ2ZXJcIiBzZWxlY3RlZD17IXByb2plY3R9IHZhbHVlPXtudWxsfSAvPlxuICAgICAgICAgICAgICB7cHJvamVjdHMubWFwKChwcm9qLCBpbmRleCkgPT4gPEdyYXBoaVFMLlNlbGVjdE9wdGlvbiBrZXk9e3Byb2p9IGxhYmVsPXtwcm9qfSBzZWxlY3RlZD17cHJvamVjdD09PXByb2p9IHZhbHVlPXtwcm9qfSAvPil9XG4gICAgICAgICAgICA8L0dyYXBoaVFMLlNlbGVjdD5cbiAgICAgICAgICA8L0dyYXBoaVFMLkdyb3VwPlxuICAgICAgICA8L0dyYXBoaVFMLlRvb2xiYXI+XG4gICAgICA8L0dyYXBoaVFMPlxuICAgICAgPHN0eWxlIGpzeD57YFxuICAgICAgICAubG9nbyB7XG4gICAgICAgICAgZGlzcGxheTogZmxleDtcbiAgICAgICAgICBmbGV4LWRpcmVjdGlvbjogcm93O1xuICAgICAgICAgIGZsZXgtd3JhcDogbm93cmFwO1xuICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xuICAgICAgICAgIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG4gICAgICAgICAgYWxpZ24tY29udGVudDogc3RyZXRjaDtcbiAgICAgICAgfVxuICAgICAgICAubG9nbyBzcGFuIHtcbiAgICAgICAgICBtYXJnaW4tbGVmdDogMTJweDtcbiAgICAgICAgICBmb250LWZhbWlseTogUm9ib3RvO1xuICAgICAgICB9XG4gICAgICAgIC5sb2dvIGltZyB7XG4gICAgICAgICAgaGVpZ2h0OiAyNHB4O1xuICAgICAgICB9XG4gICAgICAgIGxpW2RhdGEtc2VsZWN0b3JdIHtcbiAgICAgICAgICBoZWlnaHQ6IDFweDtcbiAgICAgICAgICBiYWNrZ3JvdW5kOiAjODg4O1xuICAgICAgICAgIHBhZGRpbmc6IDA7XG4gICAgICAgICAgbWFyZ2luOiAwO1xuICAgICAgICB9XG4gICAgICBgfTwvc3R5bGU+XG4gICAgPC8+XG4gICk7XG59XG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./components/Editor.jsx\n");

/***/ })

})