webpackHotUpdate(1,{

/***/ "./components/Editor.jsx":
/*!*******************************!*\
  !*** ./components/Editor.jsx ***!
  \*******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* WEBPACK VAR INJECTION */(function(module) {/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ \"./node_modules/@babel/runtime/regenerator/index.js\");\n/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @babel/runtime/helpers/esm/asyncToGenerator */ \"./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js\");\n/* harmony import */ var styled_jsx_style__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! styled-jsx/style */ \"./node_modules/styled-jsx/style.js\");\n/* harmony import */ var styled_jsx_style__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(styled_jsx_style__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ \"./node_modules/react/index.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var graphql__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! graphql */ \"./node_modules/graphql/index.mjs\");\n/* harmony import */ var graphiql__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! graphiql */ \"./node_modules/graphiql/dist/index.js\");\n/* harmony import */ var graphiql__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(graphiql__WEBPACK_IMPORTED_MODULE_5__);\n\n\nvar _jsxFileName = \"D:\\\\directus\\\\graphiql\\\\components\\\\Editor.jsx\";\n\n\nvar __jsx = react__WEBPACK_IMPORTED_MODULE_3___default.a.createElement;\n\n\n\n\nfunction gql(_x, _x2) {\n  return _gql.apply(this, arguments);\n}\n\nfunction _gql() {\n  _gql = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3(url, params) {\n    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {\n      while (1) {\n        switch (_context3.prev = _context3.next) {\n          case 0:\n            _context3.next = 2;\n            return fetch(url, {\n              method: \"post\",\n              headers: {\n                Accept: \"application/json\",\n                \"Content-Type\": \"application/json\"\n              },\n              body: JSON.stringify(params)\n            });\n\n          case 2:\n            return _context3.abrupt(\"return\", _context3.sent);\n\n          case 3:\n          case \"end\":\n            return _context3.stop();\n        }\n      }\n    }, _callee3);\n  }));\n  return _gql.apply(this, arguments);\n}\n\nfunction createStorage(_ref) {\n  var project = _ref.project;\n  return {\n    getItem: function getItem(name) {\n      return window.localStorage.getItem(\"directus:\".concat(project, \":\").concat(name));\n    },\n    setItem: function setItem(name, value) {\n      return window.localStorage.setItem(\"directus:\".concat(project, \":\").concat(name), value);\n    },\n    removeItem: function removeItem(name) {\n      return window.localStorage.removeItem(\"directus:\".concat(project, \":\").concat(name));\n    }\n  };\n}\n\nfunction createFetcher(_ref2) {\n  var url = _ref2.url;\n  return /*#__PURE__*/function () {\n    var _ref3 = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(params) {\n      var res;\n      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {\n        while (1) {\n          switch (_context.prev = _context.next) {\n            case 0:\n              _context.next = 2;\n              return gql(\"\".concat(url, \"/graphql\"), params);\n\n            case 2:\n              res = _context.sent;\n              _context.next = 5;\n              return res.json();\n\n            case 5:\n              return _context.abrupt(\"return\", _context.sent);\n\n            case 6:\n            case \"end\":\n              return _context.stop();\n          }\n        }\n      }, _callee);\n    }));\n\n    return function (_x3) {\n      return _ref3.apply(this, arguments);\n    };\n  }();\n}\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (function (_ref4) {\n  var _this = this;\n\n  var server = _ref4.server;\n\n  var _useState = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])(true),\n      loading = _useState[0],\n      setLoading = _useState[1];\n\n  var _useState2 = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])([]),\n      projects = _useState2[0],\n      setProjects = _useState2[1];\n\n  var _useState3 = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])(\"\"),\n      sourceQuery = _useState3[0],\n      setQuery = _useState3[1];\n\n  var _useState4 = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])(\"\"),\n      sourceVariables = _useState4[0],\n      setVariables = _useState4[1];\n\n  var _useState5 = Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useState\"])(window.localStorage.getItem(\"directus:project\") || null),\n      project = _useState5[0],\n      setProject = _useState5[1];\n\n  server = server || \"\";\n\n  if (server.endsWith(\"/\")) {\n    server = server.substr(0, server.length - 1);\n  }\n\n  server = \"\".concat(server);\n  var projectUrl = null;\n\n  if (project !== null) {\n    projectUrl = \"\".concat(server, \"/\").concat(project);\n  }\n\n  var fetchProjects = /*#__PURE__*/function () {\n    var _ref5 = Object(_babel_runtime_helpers_esm_asyncToGenerator__WEBPACK_IMPORTED_MODULE_1__[\"default\"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {\n      var response, _yield$response$json, data;\n\n      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {\n        while (1) {\n          switch (_context2.prev = _context2.next) {\n            case 0:\n              _context2.next = 2;\n              return gql(\"\".concat(server, \"/graphql\"), {\n                query: \"\\n        query {\\n          projects {\\n            id\\n            name\\n          }\\n        }\\n      \"\n              });\n\n            case 2:\n              response = _context2.sent;\n              _context2.next = 5;\n              return response.json();\n\n            case 5:\n              _yield$response$json = _context2.sent;\n              data = _yield$response$json.data;\n              return _context2.abrupt(\"return\", data.projects);\n\n            case 8:\n            case \"end\":\n              return _context2.stop();\n          }\n        }\n      }, _callee2);\n    }));\n\n    return function fetchProjects() {\n      return _ref5.apply(this, arguments);\n    };\n  }();\n\n  Object(react__WEBPACK_IMPORTED_MODULE_3__[\"useEffect\"])(function () {\n    console.log(\"fetching projects\");\n    fetchProjects().then(function (projects) {\n      setProjects(projects);\n      setLoading(false);\n    });\n  }, []);\n\n  if (loading) {\n    return __jsx(\"div\", {\n      className: \"loading\",\n      __self: this,\n      __source: {\n        fileName: _jsxFileName,\n        lineNumber: 84,\n        columnNumber: 7\n      }\n    }, __jsx(\"span\", {\n      __self: this,\n      __source: {\n        fileName: _jsxFileName,\n        lineNumber: 85,\n        columnNumber: 9\n      }\n    }, \"Fetching projects\"), __jsx(\"div\", {\n      className: \"loader\",\n      __self: this,\n      __source: {\n        fileName: _jsxFileName,\n        lineNumber: 86,\n        columnNumber: 9\n      }\n    }));\n  }\n\n  return __jsx(react__WEBPACK_IMPORTED_MODULE_3___default.a.Fragment, null, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a, {\n    editorTheme: \"directus\",\n    fetcher: createFetcher({\n      url: projectUrl || server\n    }),\n    storage: createStorage({\n      project: project\n    }),\n    query: sourceQuery,\n    variables: sourceVariables,\n    onEditQuery: function onEditQuery(query) {\n      return setQuery(query);\n    },\n    onEditVariables: function onEditVariables(variables) {\n      return setVariables(variables);\n    },\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 93,\n      columnNumber: 7\n    }\n  }, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.Logo, {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 102,\n      columnNumber: 9\n    }\n  }, __jsx(\"div\", {\n    className: \"jsx-2632086112\" + \" \" + \"logo\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 103,\n      columnNumber: 11\n    }\n  }, __jsx(\"img\", {\n    src: \"images/logo.svg\",\n    className: \"jsx-2632086112\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 104,\n      columnNumber: 13\n    }\n  }), __jsx(\"span\", {\n    className: \"jsx-2632086112\",\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 105,\n      columnNumber: 13\n    }\n  }, \"Directus\"))), __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.Toolbar, {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 108,\n      columnNumber: 9\n    }\n  }, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.Group, {\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 109,\n      columnNumber: 11\n    }\n  }, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.Select, {\n    onSelect: function onSelect(project) {\n      return setProject(project);\n    },\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 110,\n      columnNumber: 13\n    }\n  }, __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.SelectOption, {\n    className: \"cu\",\n    label: \"Server\",\n    selected: !project,\n    value: null,\n    __self: this,\n    __source: {\n      fileName: _jsxFileName,\n      lineNumber: 111,\n      columnNumber: 15\n    }\n  }), projects.map(function (proj) {\n    return __jsx(graphiql__WEBPACK_IMPORTED_MODULE_5___default.a.SelectOption, {\n      key: proj.id,\n      label: \"\".concat(proj.name, \" (\").concat(proj.id, \")\"),\n      selected: project === proj.id,\n      value: proj.id,\n      __self: _this,\n      __source: {\n        fileName: _jsxFileName,\n        lineNumber: 112,\n        columnNumber: 39\n      }\n    });\n  }))))), __jsx(styled_jsx_style__WEBPACK_IMPORTED_MODULE_2___default.a, {\n    id: \"2632086112\",\n    __self: this\n  }, \".logo.jsx-2632086112{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-align-content:stretch;-ms-flex-line-pack:stretch;align-content:stretch;}.logo.jsx-2632086112 span.jsx-2632086112{margin-left:12px;font-family:Roboto;}.logo.jsx-2632086112 img.jsx-2632086112{height:24px;}li[data-selector].jsx-2632086112{height:1px;background:#888;padding:0;margin:0;}\\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIkQ6XFxkaXJlY3R1c1xcZ3JhcGhpcWxcXGNvbXBvbmVudHNcXEVkaXRvci5qc3giXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBb0hrQixBQUd3QixBQVFJLEFBSUwsQUFHRCxXQUNLLENBSGxCLEtBSnFCLFVBUVQsU0FQWixDQVFXLFNBQ1gsNEJBbEJxQixxRUFDRiwrREFDTSxtR0FDSiw2RkFDRywrRUFDeEIiLCJmaWxlIjoiRDpcXGRpcmVjdHVzXFxncmFwaGlxbFxcY29tcG9uZW50c1xcRWRpdG9yLmpzeCIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCB7IHVzZVN0YXRlLCB1c2VFZmZlY3QgfSBmcm9tIFwicmVhY3RcIjtcbmltcG9ydCB7IHBhcnNlLCBwcmludCB9IGZyb20gXCJncmFwaHFsXCI7XG5pbXBvcnQgR3JhcGhpUUwgZnJvbSBcImdyYXBoaXFsXCI7XG5cbmFzeW5jIGZ1bmN0aW9uIGdxbCh1cmwsIHBhcmFtcykge1xuICByZXR1cm4gYXdhaXQgZmV0Y2godXJsLCB7XG4gICAgbWV0aG9kOiBcInBvc3RcIixcbiAgICBoZWFkZXJzOiB7XG4gICAgICBBY2NlcHQ6IFwiYXBwbGljYXRpb24vanNvblwiLFxuICAgICAgXCJDb250ZW50LVR5cGVcIjogXCJhcHBsaWNhdGlvbi9qc29uXCIsXG4gICAgfSxcbiAgICBib2R5OiBKU09OLnN0cmluZ2lmeShwYXJhbXMpLFxuICB9KTtcbn1cblxuZnVuY3Rpb24gY3JlYXRlU3RvcmFnZSh7IHByb2plY3QgfSkge1xuICByZXR1cm4ge1xuICAgIGdldEl0ZW0obmFtZSkge1xuICAgICAgcmV0dXJuIHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbShgZGlyZWN0dXM6JHtwcm9qZWN0fToke25hbWV9YCk7XG4gICAgfSxcbiAgICBzZXRJdGVtKG5hbWUsIHZhbHVlKSB7XG4gICAgICByZXR1cm4gd2luZG93LmxvY2FsU3RvcmFnZS5zZXRJdGVtKGBkaXJlY3R1czoke3Byb2plY3R9OiR7bmFtZX1gLCB2YWx1ZSk7XG4gICAgfSxcbiAgICByZW1vdmVJdGVtKG5hbWUpIHtcbiAgICAgIHJldHVybiB3aW5kb3cubG9jYWxTdG9yYWdlLnJlbW92ZUl0ZW0oYGRpcmVjdHVzOiR7cHJvamVjdH06JHtuYW1lfWApO1xuICAgIH0sXG4gIH07XG59XG5cbmZ1bmN0aW9uIGNyZWF0ZUZldGNoZXIoeyB1cmwgfSkge1xuICByZXR1cm4gYXN5bmMgKHBhcmFtcykgPT4ge1xuICAgIGNvbnN0IHJlcyA9IGF3YWl0IGdxbChgJHt1cmx9L2dyYXBocWxgLCBwYXJhbXMpO1xuICAgIHJldHVybiBhd2FpdCByZXMuanNvbigpO1xuICB9O1xufVxuXG5leHBvcnQgZGVmYXVsdCBmdW5jdGlvbiAoeyBzZXJ2ZXIgfSkge1xuICBjb25zdCBbbG9hZGluZywgc2V0TG9hZGluZ10gPSB1c2VTdGF0ZSh0cnVlKTtcbiAgY29uc3QgW3Byb2plY3RzLCBzZXRQcm9qZWN0c10gPSB1c2VTdGF0ZShbXSk7XG5cbiAgY29uc3QgW3NvdXJjZVF1ZXJ5LCBzZXRRdWVyeV0gPSB1c2VTdGF0ZShcIlwiKTtcbiAgY29uc3QgW3NvdXJjZVZhcmlhYmxlcywgc2V0VmFyaWFibGVzXSA9IHVzZVN0YXRlKFwiXCIpO1xuXG4gIGNvbnN0IFtwcm9qZWN0LCBzZXRQcm9qZWN0XSA9IHVzZVN0YXRlKFxuICAgIHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbShcImRpcmVjdHVzOnByb2plY3RcIikgfHwgbnVsbFxuICApO1xuXG4gIHNlcnZlciA9IHNlcnZlciB8fCBcIlwiO1xuICBpZiAoc2VydmVyLmVuZHNXaXRoKFwiL1wiKSkge1xuICAgIHNlcnZlciA9IHNlcnZlci5zdWJzdHIoMCwgc2VydmVyLmxlbmd0aCAtIDEpO1xuICB9XG4gIHNlcnZlciA9IGAke3NlcnZlcn1gO1xuXG4gIGxldCBwcm9qZWN0VXJsID0gbnVsbDtcbiAgaWYgKHByb2plY3QgIT09IG51bGwpIHtcbiAgICBwcm9qZWN0VXJsID0gYCR7c2VydmVyfS8ke3Byb2plY3R9YDtcbiAgfVxuXG4gIGNvbnN0IGZldGNoUHJvamVjdHMgPSBhc3luYyAoKSA9PiB7XG4gICAgY29uc3QgcmVzcG9uc2UgPSBhd2FpdCBncWwoYCR7c2VydmVyfS9ncmFwaHFsYCwge1xuICAgICAgcXVlcnk6IGBcbiAgICAgICAgcXVlcnkge1xuICAgICAgICAgIHByb2plY3RzIHtcbiAgICAgICAgICAgIGlkXG4gICAgICAgICAgICBuYW1lXG4gICAgICAgICAgfVxuICAgICAgICB9XG4gICAgICBgLFxuICAgIH0pO1xuICAgIGNvbnN0IHsgZGF0YSB9ID0gYXdhaXQgcmVzcG9uc2UuanNvbigpO1xuICAgIHJldHVybiBkYXRhLnByb2plY3RzO1xuICB9O1xuXG4gIHVzZUVmZmVjdCgoKSA9PiB7XG4gICAgY29uc29sZS5sb2coXCJmZXRjaGluZyBwcm9qZWN0c1wiKTtcbiAgICBmZXRjaFByb2plY3RzKCkudGhlbigocHJvamVjdHMpID0+IHtcbiAgICAgIHNldFByb2plY3RzKHByb2plY3RzKTtcbiAgICAgIHNldExvYWRpbmcoZmFsc2UpO1xuICAgIH0pO1xuICB9LCBbXSk7XG5cbiAgaWYgKGxvYWRpbmcpIHtcbiAgICByZXR1cm4gKFxuICAgICAgPGRpdiBjbGFzc05hbWU9XCJsb2FkaW5nXCI+XG4gICAgICAgIDxzcGFuPkZldGNoaW5nIHByb2plY3RzPC9zcGFuPlxuICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImxvYWRlclwiPjwvZGl2PlxuICAgICAgPC9kaXY+XG4gICAgKTtcbiAgfVxuXG4gIHJldHVybiAoXG4gICAgPD5cbiAgICAgIDxHcmFwaGlRTFxuICAgICAgICBlZGl0b3JUaGVtZT1cImRpcmVjdHVzXCJcbiAgICAgICAgZmV0Y2hlcj17Y3JlYXRlRmV0Y2hlcih7IHVybDogcHJvamVjdFVybCB8fCBzZXJ2ZXIgfSl9XG4gICAgICAgIHN0b3JhZ2U9e2NyZWF0ZVN0b3JhZ2UoeyBwcm9qZWN0IH0pfVxuICAgICAgICBxdWVyeT17c291cmNlUXVlcnl9XG4gICAgICAgIHZhcmlhYmxlcz17c291cmNlVmFyaWFibGVzfVxuICAgICAgICBvbkVkaXRRdWVyeT17KHF1ZXJ5KSA9PiBzZXRRdWVyeShxdWVyeSl9XG4gICAgICAgIG9uRWRpdFZhcmlhYmxlcz17KHZhcmlhYmxlcykgPT4gc2V0VmFyaWFibGVzKHZhcmlhYmxlcyl9XG4gICAgICA+XG4gICAgICAgIDxHcmFwaGlRTC5Mb2dvPlxuICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwibG9nb1wiPlxuICAgICAgICAgICAgPGltZyBzcmM9XCJpbWFnZXMvbG9nby5zdmdcIiAvPlxuICAgICAgICAgICAgPHNwYW4+RGlyZWN0dXM8L3NwYW4+XG4gICAgICAgICAgPC9kaXY+XG4gICAgICAgIDwvR3JhcGhpUUwuTG9nbz5cbiAgICAgICAgPEdyYXBoaVFMLlRvb2xiYXI+XG4gICAgICAgICAgPEdyYXBoaVFMLkdyb3VwPlxuICAgICAgICAgICAgPEdyYXBoaVFMLlNlbGVjdCBvblNlbGVjdD17KHByb2plY3QpID0+IHNldFByb2plY3QocHJvamVjdCl9PlxuICAgICAgICAgICAgICA8R3JhcGhpUUwuU2VsZWN0T3B0aW9uIGNsYXNzTmFtZT1cImN1XCIgbGFiZWw9XCJTZXJ2ZXJcIiBzZWxlY3RlZD17IXByb2plY3R9IHZhbHVlPXtudWxsfSAvPlxuICAgICAgICAgICAgICB7cHJvamVjdHMubWFwKChwcm9qKSA9PiA8R3JhcGhpUUwuU2VsZWN0T3B0aW9uIGtleT17cHJvai5pZH0gbGFiZWw9e2Ake3Byb2oubmFtZX0gKCR7cHJvai5pZH0pYH0gc2VsZWN0ZWQ9e3Byb2plY3Q9PT1wcm9qLmlkfSB2YWx1ZT17cHJvai5pZH0gLz4pfVxuICAgICAgICAgICAgPC9HcmFwaGlRTC5TZWxlY3Q+XG4gICAgICAgICAgPC9HcmFwaGlRTC5Hcm91cD5cbiAgICAgICAgPC9HcmFwaGlRTC5Ub29sYmFyPlxuICAgICAgPC9HcmFwaGlRTD5cbiAgICAgIDxzdHlsZSBqc3g+e2BcbiAgICAgICAgLmxvZ28ge1xuICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XG4gICAgICAgICAgZmxleC1kaXJlY3Rpb246IHJvdztcbiAgICAgICAgICBmbGV4LXdyYXA6IG5vd3JhcDtcbiAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgICAgICAgIGFsaWduLWNvbnRlbnQ6IHN0cmV0Y2g7XG4gICAgICAgIH1cbiAgICAgICAgLmxvZ28gc3BhbiB7XG4gICAgICAgICAgbWFyZ2luLWxlZnQ6IDEycHg7XG4gICAgICAgICAgZm9udC1mYW1pbHk6IFJvYm90bztcbiAgICAgICAgfVxuICAgICAgICAubG9nbyBpbWcge1xuICAgICAgICAgIGhlaWdodDogMjRweDtcbiAgICAgICAgfVxuICAgICAgICBsaVtkYXRhLXNlbGVjdG9yXSB7XG4gICAgICAgICAgaGVpZ2h0OiAxcHg7XG4gICAgICAgICAgYmFja2dyb3VuZDogIzg4ODtcbiAgICAgICAgICBwYWRkaW5nOiAwO1xuICAgICAgICAgIG1hcmdpbjogMDtcbiAgICAgICAgfVxuICAgICAgYH08L3N0eWxlPlxuICAgIDwvPlxuICApO1xufVxuIl19 */\\n/*@ sourceURL=D:\\\\\\\\directus\\\\\\\\graphiql\\\\\\\\components\\\\\\\\Editor.jsx */\"));\n});\n\n;\n    var _a, _b;\n    // Legacy CSS implementations will `eval` browser code in a Node.js context\n    // to extract CSS. For backwards compatibility, we need to check we're in a\n    // browser context before continuing.\n    if (typeof self !== 'undefined' &&\n        // AMP / No-JS mode does not inject these helpers:\n        '$RefreshHelpers$' in self) {\n        var currentExports_1 = module.__proto__.exports;\n        var prevExports = (_b = (_a = module.hot.data) === null || _a === void 0 ? void 0 : _a.prevExports) !== null && _b !== void 0 ? _b : null;\n        // This cannot happen in MainTemplate because the exports mismatch between\n        // templating and execution.\n        self.$RefreshHelpers$.registerExportsForReactRefresh(currentExports_1, module.i);\n        // A module can be accepted automatically based on its exports, e.g. when\n        // it is a Refresh Boundary.\n        if (self.$RefreshHelpers$.isReactRefreshBoundary(currentExports_1)) {\n            // Save the previous exports on update so we can compare the boundary\n            // signatures.\n            module.hot.dispose(function (data) {\n                data.prevExports = currentExports_1;\n            });\n            // Unconditionally accept an update to this module, we'll check if it's\n            // still a Refresh Boundary later.\n            module.hot.accept();\n            // This field is set when the previous version of this module was a\n            // Refresh Boundary, letting us know we need to check for invalidation or\n            // enqueue an update.\n            if (prevExports !== null) {\n                // A boundary can become ineligible if its exports are incompatible\n                // with the previous exports.\n                //\n                // For example, if you add/remove/change exports, we'll want to\n                // re-execute the importing modules, and force those components to\n                // re-render. Similarly, if you convert a class component to a\n                // function, we want to invalidate the boundary.\n                if (self.$RefreshHelpers$.shouldInvalidateReactRefreshBoundary(prevExports, currentExports_1)) {\n                    module.hot.invalidate();\n                }\n                else {\n                    self.$RefreshHelpers$.scheduleUpdate();\n                }\n            }\n        }\n        else {\n            // Since we just executed the code for the module, it's possible that the\n            // new exports made it ineligible for being a boundary.\n            // We only care about the case when we were _previously_ a boundary,\n            // because we already accepted this update (accidental side effect).\n            var isNoLongerABoundary = prevExports !== null;\n            if (isNoLongerABoundary) {\n                module.hot.invalidate();\n            }\n        }\n    }\n\n/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../node_modules/webpack/buildin/harmony-module.js */ \"./node_modules/webpack/buildin/harmony-module.js\")(module)))//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9jb21wb25lbnRzL0VkaXRvci5qc3g/ZDdkNiJdLCJuYW1lcyI6WyJncWwiLCJ1cmwiLCJwYXJhbXMiLCJmZXRjaCIsIm1ldGhvZCIsImhlYWRlcnMiLCJBY2NlcHQiLCJib2R5IiwiSlNPTiIsInN0cmluZ2lmeSIsImNyZWF0ZVN0b3JhZ2UiLCJwcm9qZWN0IiwiZ2V0SXRlbSIsIm5hbWUiLCJ3aW5kb3ciLCJsb2NhbFN0b3JhZ2UiLCJzZXRJdGVtIiwidmFsdWUiLCJyZW1vdmVJdGVtIiwiY3JlYXRlRmV0Y2hlciIsInJlcyIsImpzb24iLCJzZXJ2ZXIiLCJ1c2VTdGF0ZSIsImxvYWRpbmciLCJzZXRMb2FkaW5nIiwicHJvamVjdHMiLCJzZXRQcm9qZWN0cyIsInNvdXJjZVF1ZXJ5Iiwic2V0UXVlcnkiLCJzb3VyY2VWYXJpYWJsZXMiLCJzZXRWYXJpYWJsZXMiLCJzZXRQcm9qZWN0IiwiZW5kc1dpdGgiLCJzdWJzdHIiLCJsZW5ndGgiLCJwcm9qZWN0VXJsIiwiZmV0Y2hQcm9qZWN0cyIsInF1ZXJ5IiwicmVzcG9uc2UiLCJkYXRhIiwidXNlRWZmZWN0IiwiY29uc29sZSIsImxvZyIsInRoZW4iLCJ2YXJpYWJsZXMiLCJtYXAiLCJwcm9qIiwiaWQiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7O0FBQUE7QUFDQTtBQUNBOztTQUVlQSxHOzs7OzswTEFBZixrQkFBbUJDLEdBQW5CLEVBQXdCQyxNQUF4QjtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQSxtQkFDZUMsS0FBSyxDQUFDRixHQUFELEVBQU07QUFDdEJHLG9CQUFNLEVBQUUsTUFEYztBQUV0QkMscUJBQU8sRUFBRTtBQUNQQyxzQkFBTSxFQUFFLGtCQUREO0FBRVAsZ0NBQWdCO0FBRlQsZUFGYTtBQU10QkMsa0JBQUksRUFBRUMsSUFBSSxDQUFDQyxTQUFMLENBQWVQLE1BQWY7QUFOZ0IsYUFBTixDQURwQjs7QUFBQTtBQUFBOztBQUFBO0FBQUE7QUFBQTtB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QURGLENBREYsQ0FmRixDQURGO0FBQUE7QUFBQTtBQUFBLHlzTUFERjtBQW1ERCIsImZpbGUiOiIuL2NvbXBvbmVudHMvRWRpdG9yLmpzeC5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCB7IHVzZVN0YXRlLCB1c2VFZmZlY3QgfSBmcm9tIFwicmVhY3RcIjtcbmltcG9ydCB7IHBhcnNlLCBwcmludCB9IGZyb20gXCJncmFwaHFsXCI7XG5pbXBvcnQgR3JhcGhpUUwgZnJvbSBcImdyYXBoaXFsXCI7XG5cbmFzeW5jIGZ1bmN0aW9uIGdxbCh1cmwsIHBhcmFtcykge1xuICByZXR1cm4gYXdhaXQgZmV0Y2godXJsLCB7XG4gICAgbWV0aG9kOiBcInBvc3RcIixcbiAgICBoZWFkZXJzOiB7XG4gICAgICBBY2NlcHQ6IFwiYXBwbGljYXRpb24vanNvblwiLFxuICAgICAgXCJDb250ZW50LVR5cGVcIjogXCJhcHBsaWNhdGlvbi9qc29uXCIsXG4gICAgfSxcbiAgICBib2R5OiBKU09OLnN0cmluZ2lmeShwYXJhbXMpLFxuICB9KTtcbn1cblxuZnVuY3Rpb24gY3JlYXRlU3RvcmFnZSh7IHByb2plY3QgfSkge1xuICByZXR1cm4ge1xuICAgIGdldEl0ZW0obmFtZSkge1xuICAgICAgcmV0dXJuIHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbShgZGlyZWN0dXM6JHtwcm9qZWN0fToke25hbWV9YCk7XG4gICAgfSxcbiAgICBzZXRJdGVtKG5hbWUsIHZhbHVlKSB7XG4gICAgICByZXR1cm4gd2luZG93LmxvY2FsU3RvcmFnZS5zZXRJdGVtKGBkaXJlY3R1czoke3Byb2plY3R9OiR7bmFtZX1gLCB2YWx1ZSk7XG4gICAgfSxcbiAgICByZW1vdmVJdGVtKG5hbWUpIHtcbiAgICAgIHJldHVybiB3aW5kb3cubG9jYWxTdG9yYWdlLnJlbW92ZUl0ZW0oYGRpcmVjdHVzOiR7cHJvamVjdH06JHtuYW1lfWApO1xuICAgIH0sXG4gIH07XG59XG5cbmZ1bmN0aW9uIGNyZWF0ZUZldGNoZXIoeyB1cmwgfSkge1xuICByZXR1cm4gYXN5bmMgKHBhcmFtcykgPT4ge1xuICAgIGNvbnN0IHJlcyA9IGF3YWl0IGdxbChgJHt1cmx9L2dyYXBocWxgLCBwYXJhbXMpO1xuICAgIHJldHVybiBhd2FpdCByZXMuanNvbigpO1xuICB9O1xufVxuXG5leHBvcnQgZGVmYXVsdCBmdW5jdGlvbiAoeyBzZXJ2ZXIgfSkge1xuICBjb25zdCBbbG9hZGluZywgc2V0TG9hZGluZ10gPSB1c2VTdGF0ZSh0cnVlKTtcbiAgY29uc3QgW3Byb2plY3RzLCBzZXRQcm9qZWN0c10gPSB1c2VTdGF0ZShbXSk7XG5cbiAgY29uc3QgW3NvdXJjZVF1ZXJ5LCBzZXRRdWVyeV0gPSB1c2VTdGF0ZShcIlwiKTtcbiAgY29uc3QgW3NvdXJjZVZhcmlhYmxlcywgc2V0VmFyaWFibGVzXSA9IHVzZVN0YXRlKFwiXCIpO1xuXG4gIGNvbnN0IFtwcm9qZWN0LCBzZXRQcm9qZWN0XSA9IHVzZVN0YXRlKFxuICAgIHdpbmRvdy5sb2NhbFN0b3JhZ2UuZ2V0SXRlbShcImRpcmVjdHVzOnByb2plY3RcIikgfHwgbnVsbFxuICApO1xuXG4gIHNlcnZlciA9IHNlcnZlciB8fCBcIlwiO1xuICBpZiAoc2VydmVyLmVuZHNXaXRoKFwiL1wiKSkge1xuICAgIHNlcnZlciA9IHNlcnZlci5zdWJzdHIoMCwgc2VydmVyLmxlbmd0aCAtIDEpO1xuICB9XG4gIHNlcnZlciA9IGAke3NlcnZlcn1gO1xuXG4gIGxldCBwcm9qZWN0VXJsID0gbnVsbDtcbiAgaWYgKHByb2plY3QgIT09IG51bGwpIHtcbiAgICBwcm9qZWN0VXJsID0gYCR7c2VydmVyfS8ke3Byb2plY3R9YDtcbiAgfVxuXG4gIGNvbnN0IGZldGNoUHJvamVjdHMgPSBhc3luYyAoKSA9PiB7XG4gICAgY29uc3QgcmVzcG9uc2UgPSBhd2FpdCBncWwoYCR7c2VydmVyfS9ncmFwaHFsYCwge1xuICAgICAgcXVlcnk6IGBcbiAgICAgICAgcXVlcnkge1xuICAgICAgICAgIHByb2plY3RzIHtcbiAgICAgICAgICAgIGlkXG4gICAgICAgICAgICBuYW1lXG4gICAgICAgICAgfVxuICAgICAgICB9XG4gICAgICBgLFxuICAgIH0pO1xuICAgIGNvbnN0IHsgZGF0YSB9ID0gYXdhaXQgcmVzcG9uc2UuanNvbigpO1xuICAgIHJldHVybiBkYXRhLnByb2plY3RzO1xuICB9O1xuXG4gIHVzZUVmZmVjdCgoKSA9PiB7XG4gICAgY29uc29sZS5sb2coXCJmZXRjaGluZyBwcm9qZWN0c1wiKTtcbiAgICBmZXRjaFByb2plY3RzKCkudGhlbigocHJvamVjdHMpID0+IHtcbiAgICAgIHNldFByb2plY3RzKHByb2plY3RzKTtcbiAgICAgIHNldExvYWRpbmcoZmFsc2UpO1xuICAgIH0pO1xuICB9LCBbXSk7XG5cbiAgaWYgKGxvYWRpbmcpIHtcbiAgICByZXR1cm4gKFxuICAgICAgPGRpdiBjbGFzc05hbWU9XCJsb2FkaW5nXCI+XG4gICAgICAgIDxzcGFuPkZldGNoaW5nIHByb2plY3RzPC9zcGFuPlxuICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImxvYWRlclwiPjwvZGl2PlxuICAgICAgPC9kaXY+XG4gICAgKTtcbiAgfVxuXG4gIHJldHVybiAoXG4gICAgPD5cbiAgICAgIDxHcmFwaGlRTFxuICAgICAgICBlZGl0b3JUaGVtZT1cImRpcmVjdHVzXCJcbiAgICAgICAgZmV0Y2hlcj17Y3JlYXRlRmV0Y2hlcih7IHVybDogcHJvamVjdFVybCB8fCBzZXJ2ZXIgfSl9XG4gICAgICAgIHN0b3JhZ2U9e2NyZWF0ZVN0b3JhZ2UoeyBwcm9qZWN0IH0pfVxuICAgICAgICBxdWVyeT17c291cmNlUXVlcnl9XG4gICAgICAgIHZhcmlhYmxlcz17c291cmNlVmFyaWFibGVzfVxuICAgICAgICBvbkVkaXRRdWVyeT17KHF1ZXJ5KSA9PiBzZXRRdWVyeShxdWVyeSl9XG4gICAgICAgIG9uRWRpdFZhcmlhYmxlcz17KHZhcmlhYmxlcykgPT4gc2V0VmFyaWFibGVzKHZhcmlhYmxlcyl9XG4gICAgICA+XG4gICAgICAgIDxHcmFwaGlRTC5Mb2dvPlxuICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwibG9nb1wiPlxuICAgICAgICAgICAgPGltZyBzcmM9XCJpbWFnZXMvbG9nby5zdmdcIiAvPlxuICAgICAgICAgICAgPHNwYW4+RGlyZWN0dXM8L3NwYW4+XG4gICAgICAgICAgPC9kaXY+XG4gICAgICAgIDwvR3JhcGhpUUwuTG9nbz5cbiAgICAgICAgPEdyYXBoaVFMLlRvb2xiYXI+XG4gICAgICAgICAgPEdyYXBoaVFMLkdyb3VwPlxuICAgICAgICAgICAgPEdyYXBoaVFMLlNlbGVjdCBvblNlbGVjdD17KHByb2plY3QpID0+IHNldFByb2plY3QocHJvamVjdCl9PlxuICAgICAgICAgICAgICA8R3JhcGhpUUwuU2VsZWN0T3B0aW9uIGNsYXNzTmFtZT1cImN1XCIgbGFiZWw9XCJTZXJ2ZXJcIiBzZWxlY3RlZD17IXByb2plY3R9IHZhbHVlPXtudWxsfSAvPlxuICAgICAgICAgICAgICB7cHJvamVjdHMubWFwKChwcm9qKSA9PiA8R3JhcGhpUUwuU2VsZWN0T3B0aW9uIGtleT17cHJvai5pZH0gbGFiZWw9e2Ake3Byb2oubmFtZX0gKCR7cHJvai5pZH0pYH0gc2VsZWN0ZWQ9e3Byb2plY3Q9PT1wcm9qLmlkfSB2YWx1ZT17cHJvai5pZH0gLz4pfVxuICAgICAgICAgICAgPC9HcmFwaGlRTC5TZWxlY3Q+XG4gICAgICAgICAgPC9HcmFwaGlRTC5Hcm91cD5cbiAgICAgICAgPC9HcmFwaGlRTC5Ub29sYmFyPlxuICAgICAgPC9HcmFwaGlRTD5cbiAgICAgIDxzdHlsZSBqc3g+e2BcbiAgICAgICAgLmxvZ28ge1xuICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XG4gICAgICAgICAgZmxleC1kaXJlY3Rpb246IHJvdztcbiAgICAgICAgICBmbGV4LXdyYXA6IG5vd3JhcDtcbiAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xuICAgICAgICAgIGFsaWduLWNvbnRlbnQ6IHN0cmV0Y2g7XG4gICAgICAgIH1cbiAgICAgICAgLmxvZ28gc3BhbiB7XG4gICAgICAgICAgbWFyZ2luLWxlZnQ6IDEycHg7XG4gICAgICAgICAgZm9udC1mYW1pbHk6IFJvYm90bztcbiAgICAgICAgfVxuICAgICAgICAubG9nbyBpbWcge1xuICAgICAgICAgIGhlaWdodDogMjRweDtcbiAgICAgICAgfVxuICAgICAgICBsaVtkYXRhLXNlbGVjdG9yXSB7XG4gICAgICAgICAgaGVpZ2h0OiAxcHg7XG4gICAgICAgICAgYmFja2dyb3VuZDogIzg4ODtcbiAgICAgICAgICBwYWRkaW5nOiAwO1xuICAgICAgICAgIG1hcmdpbjogMDtcbiAgICAgICAgfVxuICAgICAgYH08L3N0eWxlPlxuICAgIDwvPlxuICApO1xufVxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./components/Editor.jsx\n");

/***/ })

})