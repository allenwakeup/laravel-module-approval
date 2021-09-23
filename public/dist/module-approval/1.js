(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/bpmn/designer.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/bpmn/designer.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_array_find_index_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.array.find-index.js */ "./node_modules/core-js/modules/es.array.find-index.js");
/* harmony import */ var core_js_modules_es_array_find_index_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_find_index_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_array_splice_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.array.splice.js */ "./node_modules/core-js/modules/es.array.splice.js");
/* harmony import */ var core_js_modules_es_array_splice_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_splice_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_web_url_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/web.url.js */ "./node_modules/core-js/modules/web.url.js");
/* harmony import */ var core_js_modules_web_url_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_url_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_object_keys_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.object.keys.js */ "./node_modules/core-js/modules/es.object.keys.js");
/* harmony import */ var core_js_modules_es_object_keys_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_keys_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.promise.js */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var bpmn_js_lib_Modeler__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! bpmn-js/lib/Modeler */ "./node_modules/bpmn-js/lib/Modeler.js");
/* harmony import */ var _customBpmn_palette__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./customBpmn/palette */ "./resources/js/components/admin/bpmn/customBpmn/palette/index.js");
/* harmony import */ var _customBpmn_renderer__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./customBpmn/renderer */ "./resources/js/components/admin/bpmn/customBpmn/renderer/index.js");
/* harmony import */ var _customBpmn_context_pad__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./customBpmn/context-pad */ "./resources/js/components/admin/bpmn/customBpmn/context-pad/index.js");
/* harmony import */ var _config_paletteEntries__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./config/paletteEntries */ "./resources/js/components/admin/bpmn/config/paletteEntries.js");
/* harmony import */ var _config_etl_json__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ./config/etl.json */ "./resources/js/components/admin/bpmn/config/etl.json");
var _config_etl_json__WEBPACK_IMPORTED_MODULE_15___namespace = /*#__PURE__*/__webpack_require__.t(/*! ./config/etl.json */ "./resources/js/components/admin/bpmn/config/etl.json", 1);
/* harmony import */ var diagram_js_minimap__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! diagram-js-minimap */ "./node_modules/diagram-js-minimap/dist/index.esm.js");
/* harmony import */ var _example_bpmn__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ./example.bpmn */ "./resources/js/components/admin/bpmn/example.bpmn");
/* harmony import */ var tiny_svg__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! tiny-svg */ "./node_modules/tiny-svg/dist/index.esm.js");
/* harmony import */ var min_dom__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! min-dom */ "./node_modules/min-dom/dist/index.esm.js");
/* harmony import */ var _components_admin_bpmn_customBpmn_utils_index_js__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! @/components/admin/bpmn/customBpmn/utils/index.js */ "./resources/js/components/admin/bpmn/customBpmn/utils/index.js");











function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
// 引入相关的依赖







 // 这里是直接引用了xml字符串


 // import { addResizeListener, removeResizeListener } from 'element-ui/src/utils/resize-event'


/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'Bpmn',
  components: {},
  props: {
    height: {
      type: String,
      default: '500px'
    },
    actions: {
      required: true,
      type: Object,
      default: function _default() {
        return {
          upload: '',
          import: ''
        };
      }
    }
  },
  data: function data() {
    return {
      bpmnModeler: null,
      container: null,
      canvas: null,
      scale: 1,
      xml: ''
    };
  },
  mounted: function mounted() {
    var _this = this;

    // addResizeListener(this.$refs.canvas, this.resizeListener)
    this.$nextTick(function () {
      _this.init();
    });
  },
  beforeDestroy: function beforeDestroy() {// removeResizeListener(this.$refs.canvas, this.resizeListener)
  },
  methods: {
    init: function init() {
      var _this2 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var modules, index, canvas, palette;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                // 去除默认工具栏
                modules = bpmn_js_lib_Modeler__WEBPACK_IMPORTED_MODULE_10__["default"].prototype._modules;
                index = modules.findIndex(function (it) {
                  return it.paletteProvider;
                });
                modules.splice(index, 1);
                canvas = _this2.$refs.canvas;
                palette = _this2.$refs.palette; // 建模

                _this2.bpmnModeler = new bpmn_js_lib_Modeler__WEBPACK_IMPORTED_MODULE_10__["default"]({
                  // 主要容器
                  container: canvas,
                  // 工具栏容器
                  paletteContainer: palette,
                  // 工具栏配置及实现自定义渲染方法
                  paletteEntries: _config_paletteEntries__WEBPACK_IMPORTED_MODULE_14__["default"],
                  // 开启键盘快捷
                  keyboard: {
                    bindTo: document
                  },
                  // 添加自定义元模型
                  moddleExtensions: {
                    etl: _config_etl_json__WEBPACK_IMPORTED_MODULE_15__
                  },
                  // 扩展
                  additionalModules: [// 小地图
                  diagram_js_minimap__WEBPACK_IMPORTED_MODULE_16__["default"], // 自定义工具栏
                  _customBpmn_palette__WEBPACK_IMPORTED_MODULE_11__["default"], // 自定义渲染
                  _customBpmn_renderer__WEBPACK_IMPORTED_MODULE_12__["default"], // 自定义内容面板
                  _customBpmn_context_pad__WEBPACK_IMPORTED_MODULE_13__["default"], {// 禁用左侧默认工具栏
                    // paletteProvider: ['value', '']// 去不干净，还是默认生成
                    // // 禁用滚轮滚动
                    // zoomScroll: ['value', ''],
                    // // 禁止拖动线
                    // bendpoints: ['value', ''],
                    // // 禁止点击节点出现contextPad
                    // contextPadProvider: ['value', ''],
                    // // 禁止双击节点出现label编辑框
                    // labelEditingProvider: ['value', '']
                  }]
                }); // 绑定事件

                _this2.initEvent(); // 初始化 流程图


                _context.next = 9;
                return _this2.createNewDiagram();

              case 9:
                // 调整与正中间
                _this2.bpmnModeler.get('canvas').zoom('fit-viewport', 'auto'); // 初始化箭头


                _this2.initArrow('sequenceflow-arrow-normal');

                _this2.initArrow('sequenceflow-arrow-active'); // 默认打开 minimap


                _this2.bpmnModeler.get('minimap').open();

              case 13:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    createNewDiagram: function createNewDiagram() {
      // 将字符串转换成图显示出来
      this.xml = _example_bpmn__WEBPACK_IMPORTED_MODULE_17__["xmlStr"];
      return this.bpmnModeler.importXML(this.xml);
    },
    // 绑定事件
    initEvent: function initEvent() {
      // this.getEventBusAll() 查看所有可用事件
      var eventBus = this.bpmnModeler.get('eventBus');
      eventBus.on('element.click', function (e) {
        console.log('点击了元素', e);
      });
    },
    // 初始化自定义箭头
    initArrow: function initArrow(id) {
      var marker = Object(tiny_svg__WEBPACK_IMPORTED_MODULE_18__["create"])('marker');
      Object(tiny_svg__WEBPACK_IMPORTED_MODULE_18__["attr"])(marker, {
        id: id,
        viewBox: '0 0 20 20',
        refX: '11',
        refY: '10',
        markerWidth: '10',
        markerHeight: '10',
        orient: 'auto'
      });
      var path = Object(tiny_svg__WEBPACK_IMPORTED_MODULE_18__["create"])('path');
      Object(tiny_svg__WEBPACK_IMPORTED_MODULE_18__["attr"])(path, {
        d: 'M 1 5 L 11 10 L 1 15 Z',
        style: ' stroke-width: 1px; stroke-linecap: round; stroke-dasharray: 10000, 1; '
      });
      var defs = Object(min_dom__WEBPACK_IMPORTED_MODULE_19__["query"])('defs');
      Object(tiny_svg__WEBPACK_IMPORTED_MODULE_18__["append"])(marker, path);
      Object(tiny_svg__WEBPACK_IMPORTED_MODULE_18__["append"])(defs, marker);
    },
    saveXML: function saveXML() {
      var _this3 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
        var result, xml, xmlBlob, downloadLink;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.prev = 0;
                _context2.next = 3;
                return _this3.bpmnModeler.saveXML({
                  format: true
                });

              case 3:
                result = _context2.sent;
                xml = result.xml;
                xmlBlob = new Blob([xml], {
                  type: 'application/bpmn20-xml;charset=UTF-8,'
                });
                downloadLink = document.createElement('a');
                downloadLink.download = "bpmn-".concat(+new Date(), ".bpmn");
                downloadLink.innerHTML = 'Get BPMN SVG';
                downloadLink.href = window.URL.createObjectURL(xmlBlob);

                downloadLink.onclick = function (event) {
                  document.body.removeChild(event.target);
                };

                downloadLink.style.visibility = 'hidden';
                document.body.appendChild(downloadLink);
                downloadLink.click();
                _context2.next = 19;
                break;

              case 16:
                _context2.prev = 16;
                _context2.t0 = _context2["catch"](0);
                console.log(_context2.t0);

              case 19:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, null, [[0, 16]]);
      }))();
    },
    saveSVG: function saveSVG() {
      var _this4 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3() {
        var result, svg, svgBlob, downloadLink;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
          while (1) {
            switch (_context3.prev = _context3.next) {
              case 0:
                _context3.prev = 0;
                _context3.next = 3;
                return _this4.bpmnModeler.saveSVG();

              case 3:
                result = _context3.sent;
                svg = result.svg;
                svgBlob = new Blob([svg], {
                  type: 'image/svg+xml'
                });
                downloadLink = document.createElement('a');
                downloadLink.download = "bpmn-".concat(+new Date(), ".SVG");
                downloadLink.innerHTML = 'Get BPMN SVG';
                downloadLink.href = window.URL.createObjectURL(svgBlob);

                downloadLink.onclick = function (event) {
                  document.body.removeChild(event.target);
                };

                downloadLink.style.visibility = 'hidden';
                document.body.appendChild(downloadLink);
                downloadLink.click();
                _context3.next = 19;
                break;

              case 16:
                _context3.prev = 16;
                _context3.t0 = _context3["catch"](0);
                console.log(_context3.t0);

              case 19:
              case "end":
                return _context3.stop();
            }
          }
        }, _callee3, null, [[0, 16]]);
      }))();
    },
    uploadXML: function uploadXML() {
      var _this5 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4() {
        var result, xml, xmlBlob, form;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
          while (1) {
            switch (_context4.prev = _context4.next) {
              case 0:
                _context4.prev = 0;
                _context4.next = 3;
                return _this5.bpmnModeler.saveXML({
                  format: true
                });

              case 3:
                result = _context4.sent;
                xml = result.xml;
                xmlBlob = new Blob([xml], {
                  type: 'application/bpmn20-xml;charset=UTF-8,'
                });
                form = new FormData();
                form.append('file', xmlBlob);

                _this5.$postfile(_this5.actions.upload, form).then(function (res) {
                  console.log(res);
                });

                _context4.next = 13;
                break;

              case 11:
                _context4.prev = 11;
                _context4.t0 = _context4["catch"](0);

              case 13:
              case "end":
                return _context4.stop();
            }
          }
        }, _callee4, null, [[0, 11]]);
      }))();
    },
    loadXML: function loadXML() {
      var _this6 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee5() {
        var that, file, reader;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee5$(_context5) {
          while (1) {
            switch (_context5.prev = _context5.next) {
              case 0:
                that = _this6;
                file = _this6.$refs.refFile.files[0];
                reader = new FileReader();
                reader.readAsText(file);

                reader.onload = function () {
                  console.log('this', this);
                  that.xmlStr = this.result;
                  that.createNewDiagram();
                };

              case 5:
              case "end":
                return _context5.stop();
            }
          }
        }, _callee5);
      }))();
    },
    handlerRedo: function handlerRedo() {
      this.bpmnModeler.get('commandStack').redo();
    },
    handlerUndo: function handlerUndo() {
      this.bpmnModeler.get('commandStack').undo();
    },
    handlerZoom: function handlerZoom(radio) {
      var newScale = !radio ? 1.0 : this.scale + radio;
      this.bpmnModeler.get('canvas').zoom(newScale);
      this.scale = newScale;
    },
    // 获取所有元素
    getElementAll: function getElementAll() {
      var all = this.bpmnModeler.get('elementRegistry').getAll();
      console.log('all', all);
      return all;
    },
    // 根据 id 获取元素
    getElementById: function getElementById(id) {
      return this.bpmnModeler.get('elementRegistry').get(id);
    },
    // 创建 业务对象 business objects
    createBusinessElement: function createBusinessElement() {
      var bpmnFactory = this.bpmnModeler.get('bpmnFactory');
      var taskBusinessObject = bpmnFactory.create('bpmn:Task', {
        id: 'Task_1',
        name: 'Task'
      }); // 使用刚创建的业务对象创建新的图表形状

      var task = this.createElement({
        type: 'bpmn:Task',
        businessObject: taskBusinessObject
      });
      return task;
    },
    // 新增元素
    createElement: function createElement() {
      var elementConfig = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {
        type: 'bpmn:Task'
      };
      var elementFactory = this.bpmnModeler.get('elementFactory');
      var task = elementFactory.createShape(elementConfig);
      return task;
    },
    // 添加元素
    appendElement: function appendElement(parentsElement, newElement) {
      var location = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {
        x: 400,
        y: 100
      };
      var modeling = this.bpmnModeler.get('modeling');
      modeling.createShape(newElement, location, parentsElement); // modeling.createShape(newElement, location, parentsElement, { attach: true })
    },
    // 连线
    connectElement: function connectElement(sourceElement, targetElement) {
      var modeling = this.bpmnModeler.get('modeling');
      modeling.connect(sourceElement, targetElement);
    },
    // 添加元素并连线
    appendConnect: function appendConnect(sourceElement, targetElement) {
      var location = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {
        x: 400,
        y: 100
      };
      var parentsElement = arguments.length > 3 ? arguments[3] : undefined;
      var modeling = this.bpmnModeler.get('modeling');
      modeling.appendShape(sourceElement, targetElement, location, parentsElement);
    },
    // 查看所有可用事件
    getEventBusAll: function getEventBusAll() {
      var eventBus = this.bpmnModeler.get('eventBus');
      var eventTypes = Object.keys(eventBus._listeners);
      console.log(eventTypes); // 打印出来有242种事件

      return eventTypes;
    },
    // 更新属性
    updateAttr: function updateAttr(id) {
      var AttrObj = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      var element = this.getElementById(id);
      var modeling = this.bpmnModeler.get('modeling');
      modeling.updateProperties(element, AttrObj);
    },
    resizeListener: function resizeListener() {
      var canvas = this.bpmnModeler.get('canvas');

      _components_admin_bpmn_customBpmn_utils_index_js__WEBPACK_IMPORTED_MODULE_20__["_fitViewport"].call(canvas, true);
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/bpmn/input.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/bpmn/input.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _designer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./designer */ "./resources/js/components/admin/bpmn/designer.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "ABpmnInput",
  components: {
    ABpmnDesigner: _designer__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  props: {
    file: {
      required: true,
      type: String,
      default: ""
    },
    actions: {
      required: true,
      type: Object,
      default: function _default() {
        return {
          upload: '',
          import: ''
        };
      }
    },
    title: {
      type: String,
      default: "设计器"
    }
  },
  computed: {},
  data: function data() {
    return {
      show: false
    };
  },
  methods: {
    toggle: function toggle() {
      this.show = !this.show;
    },
    onChangeFilePath: function onChangeFilePath(result) {
      this.$emit("change", result);
    },
    close: function close() {
      this.show = false;
    }
  },
  created: function created() {},
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Admin/templates/form.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Admin/templates/form.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");
/* harmony import */ var core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.array.slice.js */ "./node_modules/core-js/modules/es.array.slice.js");
/* harmony import */ var core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var _components_admin_bpmn__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @/components/admin/bpmn */ "./resources/js/components/admin/bpmn/index.js");
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }











//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    ABpmnInput: _components_admin_bpmn__WEBPACK_IMPORTED_MODULE_10__["ABpmnInput"]
  },
  props: {},
  data: function data() {
    return {
      form: {
        department_id: 0,
        pid: 0,
        code: '',
        name: '',
        alias: '',
        type: '',
        category_id: 0,
        group: '',
        path: '',
        order: 1,
        status: 1
      },
      rules: {
        code: [{
          min: 1,
          max: 20,
          message: '1到20个字符',
          trigger: 'blur'
        }],
        name: [{
          required: true,
          message: '请输入名称',
          trigger: 'blur'
        }, {
          min: 2,
          max: 10,
          message: '至少两个字',
          trigger: 'blur'
        }]
      },
      categories: [],
      id: 0
    };
  },
  watch: {},
  computed: {},
  methods: {
    handleSubmit: function handleSubmit() {
      var _this = this;

      // 验证代码处
      if (this.$isEmpty(this.form.code)) {
        return this.$message.error('编码不能为空');
      }

      if (this.$isEmpty(this.form.name)) {
        return this.$message.error('名称不能为空');
      }

      var api = this.$apiHandle(this.$api.moduleApprovalTemplates, this.id);

      if (api.status) {
        this.$put(api.url, this.form).then(function (res) {
          if (res.code === 200) {
            _this.$message.success(res.msg);

            return _this.$router.back();
          } else {
            return _this.$message.error(res.msg);
          }
        });
      } else {
        this.$post(api.url, this.form).then(function (res) {
          if (res.code === 200 || res.code === 201) {
            _this.$message.success(res.msg);

            return _this.$router.back();
          } else {
            return _this.$message.error(res.msg);
          }
        });
      }
    },
    get_form: function get_form() {
      var _this2 = this;

      this.$get(this.$api.moduleApprovalTemplates + '/' + this.id).then(function (res) {
        _this2.form = res.data;
      });
    },
    onChangeOrder: function onChangeOrder(value) {
      this.form.order = value;
    },
    onChangeStatus: function onChangeStatus(checked) {
      this.form.status = checked ? 1 : 0;
    },
    onChangeBpmnPath: function onChangeBpmnPath(path) {
      this.form.path = path;
    },
    categorie_change: function categorie_change(row, form) {
      this.form.category_id = row[row.length - 1];

      if (row.length === 0) {
        this.form.category_id = 0;
      }
    },
    load_categories: function load_categories(selectedOptions) {
      var _this3 = this;

      var targetOption = selectedOptions[selectedOptions.length - 1];
      targetOption.loading = true;
      var params = {
        pid: targetOption.id,
        data_type: 'select'
      };
      this.$get(this.$api.moduleApprovalCategories, params).then(function (res) {
        targetOption.loading = false;
        targetOption.children = res.data;
        _this3.categories = _toConsumableArray(_this3.categories);
      });
    },
    // 获取列表
    onload: function onload() {
      var _this4 = this;

      // 判断你是否是编辑
      if (!this.$isEmpty(this.$route.params.id)) {
        this.id = this.$route.params.id;
        this.get_form();
      }

      this.$get(this.$api.moduleApprovalCategories, {
        data_type: 'select'
      }).then(function (res) {
        if (res.code === 200) {
          _this4.categories = res.data;
        }
      });
    }
  },
  created: function created() {
    this.onload();
  },
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/less-loader/dist/cjs.js!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/bpmn/designer.vue?vue&type=style&index=0&id=4abf8050&lang=less&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--9-2!./node_modules/less-loader/dist/cjs.js!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/bpmn/designer.vue?vue&type=style&index=0&id=4abf8050&lang=less&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".bpmn[data-v-4abf8050] {\n  width: 100%;\n  position: relative;\n}\n.bpmn .canvas[data-v-4abf8050] {\n  width: 100%;\n  height: 100%;\n}\n.bpmn .panel[data-v-4abf8050] {\n  position: absolute;\n  right: 0;\n  top: 0;\n  width: 300px;\n}\n.bpmn .tool[data-v-4abf8050] {\n  position: absolute;\n  z-index: 1;\n  left: 50%;\n  bottom: 20px;\n  transform: translateX(-50%);\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/less-loader/dist/cjs.js!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/bpmn/designer.vue?vue&type=style&index=0&id=4abf8050&lang=less&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--9-2!./node_modules/less-loader/dist/cjs.js!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/bpmn/designer.vue?vue&type=style&index=0&id=4abf8050&lang=less&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--9-2!../../../../../node_modules/less-loader/dist/cjs.js!../../../../../node_modules/vue-loader/lib??vue-loader-options!./designer.vue?vue&type=style&index=0&id=4abf8050&lang=less&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/less-loader/dist/cjs.js!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/bpmn/designer.vue?vue&type=style&index=0&id=4abf8050&lang=less&scoped=true&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/bpmn/designer.vue?vue&type=template&id=4abf8050&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/bpmn/designer.vue?vue&type=template&id=4abf8050&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "bpmn", style: { height: _vm.height } }, [
    _c(
      "div",
      { staticClass: "tool" },
      [
        _c("a-button", { on: { click: _vm.saveXML } }, [_vm._v("保存 XML")]),
        _vm._v(" "),
        _c("a-button", { on: { click: _vm.uploadXML } }, [_vm._v("上传 XML")]),
        _vm._v(" "),
        _c(
          "a-button",
          {
            on: {
              click: function($event) {
                return _vm.$refs.refFile.click()
              }
            }
          },
          [_vm._v("导入 XML")]
        ),
        _vm._v(" "),
        _c("a-button", { on: { click: _vm.saveSVG } }, [_vm._v("保存为 SVG")]),
        _vm._v(" "),
        _c("a-button", { on: { click: _vm.handlerUndo } }, [_vm._v("撤销")]),
        _vm._v(" "),
        _c("a-button", { on: { click: _vm.handlerRedo } }, [_vm._v("恢复")]),
        _vm._v(" "),
        _c(
          "a-button",
          {
            on: {
              click: function($event) {
                return _vm.handlerZoom(0.1)
              }
            }
          },
          [_vm._v("放大")]
        ),
        _vm._v(" "),
        _c(
          "a-button",
          {
            on: {
              click: function($event) {
                return _vm.handlerZoom(-0.1)
              }
            }
          },
          [_vm._v("缩小")]
        ),
        _vm._v(" "),
        _c(
          "a-button",
          {
            on: {
              click: function($event) {
                return _vm.handlerZoom(0)
              }
            }
          },
          [_vm._v("还原")]
        ),
        _vm._v(" "),
        _c("a-button", { on: { click: _vm.getElementAll } }, [
          _vm._v("获取所有元素")
        ]),
        _vm._v(" "),
        _c("a-input", {
          ref: "refFile",
          staticStyle: { display: "none" },
          attrs: { type: "file", id: "files" },
          on: { change: _vm.loadXML }
        })
      ],
      1
    ),
    _vm._v(" "),
    _c("div", { ref: "palette" }),
    _vm._v(" "),
    _c("div", { ref: "canvas", staticClass: "canvas" })
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/bpmn/input.vue?vue&type=template&id=57694796&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/admin/bpmn/input.vue?vue&type=template&id=57694796&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "a-input",
        {
          attrs: { disabled: "" },
          model: {
            value: _vm.file,
            callback: function($$v) {
              _vm.file = $$v
            },
            expression: "file"
          }
        },
        [
          _c("a-icon", {
            attrs: { slot: "addonAfter", type: "edit" },
            on: { click: _vm.toggle },
            slot: "addonAfter"
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "a-modal",
        {
          attrs: {
            title: _vm.title,
            "body-style": { padding: 0, height: "800px" },
            "dialog-style": { top: 0, left: 0 },
            visible: _vm.show,
            cancelText: "关闭",
            width: "80%",
            footer: null,
            height: "800px"
          },
          on: { cancel: _vm.close }
        },
        [
          _c(
            "a-layout-content",
            [
              _c("a-bpmn-designer", {
                attrs: { height: "800px", actions: _vm.actions },
                on: { change: _vm.onChangeFilePath }
              })
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Admin/templates/form.vue?vue&type=template&id=7b286139&scoped=true&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Admin/templates/form.vue?vue&type=template&id=7b286139&scoped=true& ***!
  \******************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      { staticClass: "admin_table_page_title" },
      [
        _c(
          "a-button",
          {
            staticClass: "float_right",
            attrs: { icon: "arrow-left" },
            on: {
              click: function($event) {
                return _vm.$router.back()
              }
            }
          },
          [_vm._v("返回")]
        ),
        _vm._v("\n        模版编辑\n    ")
      ],
      1
    ),
    _vm._v(" "),
    _c("div", { staticClass: "unline underm" }),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "admin_form" },
      [
        _c(
          "a-form-model",
          {
            attrs: {
              model: _vm.form,
              rules: _vm.rules,
              "label-col": { span: 6 },
              "wrapper-col": { span: 16 }
            }
          },
          [
            _c(
              "a-row",
              { attrs: { gutter: 1 } },
              [
                _c(
                  "a-col",
                  { attrs: { span: 12 } },
                  [
                    _c(
                      "a-form-model-item",
                      { attrs: { label: "模版分类" } },
                      [
                        _c("a-cascader", {
                          attrs: {
                            "load-data": _vm.load_categories,
                            options: _vm.categories,
                            fieldNames: {
                              label: "name",
                              value: "id",
                              children: "children"
                            },
                            placeholder:
                              _vm.form.category_id > 0 && _vm.form.categories
                                ? _vm.form.categories
                                : "请选择上级分类",
                            "change-on-select": ""
                          },
                          on: { change: _vm.categorie_change }
                        })
                      ],
                      1
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "a-col",
                  { attrs: { span: 12 } },
                  [
                    _c(
                      "a-form-model-item",
                      { attrs: { label: "状态" } },
                      [
                        _c("a-switch", {
                          attrs: {
                            "checked-children": "启用",
                            "un-checked-children": "禁用",
                            checked: _vm.form.status === 1
                          },
                          on: { change: _vm.onChangeStatus }
                        })
                      ],
                      1
                    )
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "a-row",
              { attrs: { gutter: 1 } },
              [
                _c(
                  "a-col",
                  { attrs: { span: 12 } },
                  [
                    _c(
                      "a-form-model-item",
                      { attrs: { label: "编码", prop: "code" } },
                      [
                        _c("a-input", {
                          model: {
                            value: _vm.form.code,
                            callback: function($$v) {
                              _vm.$set(_vm.form, "code", $$v)
                            },
                            expression: "form.code"
                          }
                        })
                      ],
                      1
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "a-col",
                  { attrs: { span: 12 } },
                  [
                    _c(
                      "a-form-model-item",
                      { attrs: { label: "名称", prop: "name" } },
                      [
                        _c("a-input", {
                          model: {
                            value: _vm.form.name,
                            callback: function($$v) {
                              _vm.$set(_vm.form, "name", $$v)
                            },
                            expression: "form.name"
                          }
                        })
                      ],
                      1
                    )
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "a-row",
              { attrs: { gutter: 1 } },
              [
                _c(
                  "a-col",
                  { attrs: { span: 12 } },
                  [
                    _c(
                      "a-form-model-item",
                      { attrs: { label: "别名", prop: "alias" } },
                      [
                        _c("a-input", {
                          model: {
                            value: _vm.form.alias,
                            callback: function($$v) {
                              _vm.$set(_vm.form, "alias", $$v)
                            },
                            expression: "form.alias"
                          }
                        })
                      ],
                      1
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "a-col",
                  { attrs: { span: 12 } },
                  [
                    _c(
                      "a-form-model-item",
                      { attrs: { label: "BPMN", prop: "bpmn" } },
                      [
                        _c("a-bpmn-input", {
                          attrs: {
                            file: _vm.form.path,
                            actions: {
                              upload:
                                _vm.$api.moduleApprovalTemplates +
                                "/upload/" +
                                _vm.id,
                              import:
                                _vm.$api.moduleApprovalTemplates +
                                "/download/" +
                                _vm.id
                            },
                            title: "流程设计器"
                          },
                          on: { change: _vm.onChangeBpmnPath }
                        })
                      ],
                      1
                    )
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "a-row",
              { attrs: { gutter: 1 } },
              [
                _c(
                  "a-col",
                  { attrs: { span: 12 } },
                  [
                    _c(
                      "a-form-model-item",
                      { attrs: { label: "类型", prop: "type" } },
                      [
                        _c("a-input", {
                          model: {
                            value: _vm.form.type,
                            callback: function($$v) {
                              _vm.$set(_vm.form, "type", $$v)
                            },
                            expression: "form.type"
                          }
                        })
                      ],
                      1
                    )
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "a-col",
                  { attrs: { span: 12 } },
                  [
                    _c(
                      "a-form-model-item",
                      { attrs: { label: "分组", prop: "group" } },
                      [
                        _c("a-input", {
                          model: {
                            value: _vm.form.group,
                            callback: function($$v) {
                              _vm.$set(_vm.form, "group", $$v)
                            },
                            expression: "form.group"
                          }
                        })
                      ],
                      1
                    )
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "a-row",
              { attrs: { gutter: 1 } },
              [
                _c(
                  "a-col",
                  { attrs: { span: 12 } },
                  [
                    _c(
                      "a-form-model-item",
                      { attrs: { label: "描述", prop: "description" } },
                      [
                        _c("a-textarea", {
                          attrs: { "auto-size": { minRows: 3, maxRows: 5 } },
                          model: {
                            value: _vm.form.description,
                            callback: function($$v) {
                              _vm.$set(_vm.form, "description", $$v)
                            },
                            expression: "form.description"
                          }
                        })
                      ],
                      1
                    )
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "a-row",
              { attrs: { gutter: 1 } },
              [
                _c(
                  "a-col",
                  { attrs: { span: 12 } },
                  [
                    _c(
                      "a-form-model-item",
                      { attrs: { label: "排序", prop: "order" } },
                      [
                        _c("a-input-number", {
                          attrs: { min: 0 },
                          on: { change: _vm.onChangeOrder },
                          model: {
                            value: _vm.form.order,
                            callback: function($$v) {
                              _vm.$set(_vm.form, "order", $$v)
                            },
                            expression: "form.order"
                          }
                        })
                      ],
                      1
                    )
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "a-form-model-item",
              { attrs: { "wrapper-col": { span: 12, offset: 5 } } },
              [
                _c(
                  "a-button",
                  {
                    attrs: { type: "primary" },
                    on: { click: _vm.handleSubmit }
                  },
                  [_vm._v("提交")]
                )
              ],
              1
            )
          ],
          1
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/admin/bpmn/config/etl.json":
/*!************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/config/etl.json ***!
  \************************************************************/
/*! exports provided: name, uri, prefix, xml, associations, types, emumerations, default */
/***/ (function(module) {

module.exports = JSON.parse("{\"name\":\"etl\",\"uri\":\"http://etl.org/bpmn\",\"prefix\":\"etl\",\"xml\":{\"tagAlias\":\"lowerCase\"},\"associations\":[],\"types\":[{\"name\":\"Task\",\"superClass\":[\"bpmn:UserTask\"],\"properties\":[]}],\"emumerations\":[]}");

/***/ }),

/***/ "./resources/js/components/admin/bpmn/config/paletteEntries.js":
/*!*********************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/config/paletteEntries.js ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
/* harmony import */ var core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
/* harmony import */ var core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var min_dash__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! min-dash */ "./node_modules/min-dash/dist/index.esm.js");
/* harmony import */ var tiny_svg__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! tiny-svg */ "./node_modules/tiny-svg/dist/index.esm.js");





/* harmony default export */ __webpack_exports__["default"] = ({
  'create.customtask': createAction('etl:Task', // etl.json 定义
  '自定义', 'customShape customtask', 'Create custom Task', drawCustomTask),
  'create.start-StartEvent': createAction('bpmn:StartEvent', 'event', 'custom-icon-start-event-none', 'Create StartEvent'),
  'create.end-event': createAction('bpmn:EndEvent', 'event', 'custom-icon-end-event-none', 'Create EndEvent'),
  'create.task': createAction('bpmn:Task', 'activity', 'inShape custom-icon-task', 'Create Task', drawTask),
  'create.exclusive-gateway': createAction('bpmn:ExclusiveGateway', 'gateway', 'inShape custom-icon-gateway-none', 'Create Gateway'),
  'create.data-object': createAction('bpmn:DataObjectReference', 'data-object', 'inShape custom-icon-data-object', 'Create DataObjectReference')
});

function createAction(type, group, className, title, drawShape, translate, options) {
  var shortType = type.replace(/^bpmn:/, '');

  function createListener(event, autoActivate, elementFactory, bpmnFactory, model, create) {
    var prefix = type + +new Date() + '_';
    var id = model.ids.nextPrefixed(prefix, {
      type: type
    });
    var taskBusinessObject = bpmnFactory.create(type, {
      id: id,
      name: id
    });
    var shape = elementFactory.createShape(Object(min_dash__WEBPACK_IMPORTED_MODULE_3__["assign"])({
      type: type
    }, options, {
      businessObject: taskBusinessObject
    }));

    if (options) {
      shape.businessObject.di.isExpanded = options.isExpanded;
    }

    create.start(event, shape);
  }

  return {
    type: type,
    group: group,
    className: className,
    title: title || translate('Create {type}', {
      type: shortType
    }),
    drawShape: drawShape,
    action: {
      dragstart: createListener,
      click: createListener
    }
  };
}

function drawCustomTask(parentNode, element, textRenderer, entries) {
  var width = 130;
  var height = 60;
  var borderRadius = 20;
  var strokeColor = '#4483ec';
  var fillColor = !element.businessObject.suitable && '#a2c5fd';
  element.width = width;
  element.height = height;
  var rect = drawRect(parentNode, width, height, borderRadius, strokeColor, fillColor);
  var text = textRenderer.createText(element.businessObject.name || '', {
    box: element,
    align: 'center-middle',
    padding: 5,
    size: {
      width: 100
    }
  });
  Object(tiny_svg__WEBPACK_IMPORTED_MODULE_4__["append"])(parentNode, text);
  return rect;
}

function drawTask(parentNode, element, textRenderer, entries) {
  var width = 100;
  var height = 80;
  var borderRadius = 20;
  var strokeColor = element.businessObject.suitable;
  var fillColor = '#fff';
  element.width = width;
  element.height = height;
  var rect = drawRect(parentNode, width, height, borderRadius, strokeColor, fillColor);
  var text = textRenderer.createText(element.businessObject.name || '', {
    box: element,
    align: 'center-middle',
    padding: 5,
    size: {
      width: 100
    }
  });
  Object(tiny_svg__WEBPACK_IMPORTED_MODULE_4__["append"])(parentNode, text);
  return rect;
} // helpers //////////
// copied from https://github.com/bpmn-io/bpmn-js/blob/master/lib/draw/BpmnRenderer.js


function drawRect(parentNode, width, height, borderRadius, strokeColor, fillColor) {
  var rect = Object(tiny_svg__WEBPACK_IMPORTED_MODULE_4__["create"])('rect');
  Object(tiny_svg__WEBPACK_IMPORTED_MODULE_4__["attr"])(rect, {
    width: width,
    height: height,
    rx: borderRadius,
    ry: borderRadius,
    stroke: strokeColor || '#000',
    strokeWidth: 2,
    fill: fillColor
  });
  Object(tiny_svg__WEBPACK_IMPORTED_MODULE_4__["append"])(parentNode, rect);
  return rect;
} // copied from https://github.com/bpmn-io/diagram-js/blob/master/lib/core/GraphicsFactory.js
// function prependTo (newNode, parentNode, siblingNode) {
//   parentNode.insertBefore(newNode, siblingNode || parentNode.firstChild)
// }

/***/ }),

/***/ "./resources/js/components/admin/bpmn/customBpmn/context-pad/CustomContextPad.js":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/customBpmn/context-pad/CustomContextPad.js ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return CustomContextPad; });
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var min_dash__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! min-dash */ "./node_modules/min-dash/dist/index.esm.js");


function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }


var COLOR_RED = '#cc0000 ';
var COLOR_YELLOW = 'ffc800';
var COLOR_GREEN = '#52b415';

var CustomContextPad = /*#__PURE__*/function () {
  function CustomContextPad(bpmnFactory, config, contextPad, create, elementFactory, injector, translate) {
    _classCallCheck(this, CustomContextPad);

    this.bpmnFactory = bpmnFactory;
    this.create = create;
    this.elementFactory = elementFactory;
    this.translate = translate;

    if (config.autoPlace !== false) {
      this.autoPlace = injector.get('autoPlace', false);
    }

    contextPad.registerProvider(this);
  }

  _createClass(CustomContextPad, [{
    key: "getContextPadEntries",
    value: function getContextPadEntries(element) {
      var autoPlace = this.autoPlace,
          bpmnFactory = this.bpmnFactory,
          create = this.create,
          elementFactory = this.elementFactory,
          translate = this.translate;
      var actions = {};

      if (element.type === 'label') {
        return actions;
      }

      function appendServiceTask(suitabilityScore) {
        return function (event, element) {
          console.log('autoPlace', autoPlace);

          if (autoPlace) {
            var businessObject = bpmnFactory.create('bpmn:Task');
            businessObject.suitable = suitabilityScore;
            businessObject.name = element.type;
            var shape = elementFactory.createShape({
              type: 'bpmn:Task',
              businessObject: businessObject
            });
            autoPlace.append(element, shape);
          } else {
            appendServiceTaskStart(event, element);
          }
        };
      }

      function appendServiceTaskStart(suitabilityScore) {
        return function (event) {
          var businessObject = bpmnFactory.create('bpmn:Task');
          businessObject.suitable = suitabilityScore;
          businessObject.name = element.type;
          var shape = elementFactory.createShape({
            type: 'bpmn:Task',
            businessObject: businessObject
          });
          create.start(event, shape, element);
        };
      }

      if (element.type === 'bpmn:Task') {
        Object(min_dash__WEBPACK_IMPORTED_MODULE_1__["assign"])(actions, {
          'append.low-task': {
            group: 'model',
            className: 'bpmn-icon-task red',
            title: translate('Append Task with low suitability score'),
            action: {
              click: appendServiceTask(COLOR_RED),
              dragstart: appendServiceTaskStart(COLOR_RED)
            }
          },
          'append.average-task': {
            group: 'model',
            className: 'bpmn-icon-task yellow',
            title: translate('Append Task with average suitability score'),
            action: {
              click: appendServiceTask(COLOR_YELLOW),
              dragstart: appendServiceTaskStart(COLOR_YELLOW)
            }
          },
          'append.high-task': {
            group: 'model',
            className: 'bpmn-icon-task green',
            title: translate('Append Task with high suitability score'),
            action: {
              click: appendServiceTask(COLOR_GREEN),
              dragstart: appendServiceTaskStart(COLOR_GREEN)
            }
          }
        });
      }

      console.log('actions', actions);
      return actions;
    }
  }]);

  return CustomContextPad;
}();


CustomContextPad.$inject = ['bpmnFactory', 'config', 'contextPad', 'create', 'elementFactory', 'injector', 'translate'];

/***/ }),

/***/ "./resources/js/components/admin/bpmn/customBpmn/context-pad/index.js":
/*!****************************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/customBpmn/context-pad/index.js ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CustomContextPad__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CustomContextPad */ "./resources/js/components/admin/bpmn/customBpmn/context-pad/CustomContextPad.js");

/* harmony default export */ __webpack_exports__["default"] = ({
  __init__: ['customContextPad'],
  customContextPad: ['type', _CustomContextPad__WEBPACK_IMPORTED_MODULE_0__["default"]]
});

/***/ }),

/***/ "./resources/js/components/admin/bpmn/customBpmn/palette/CustomPalette.js":
/*!********************************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/customBpmn/palette/CustomPalette.js ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.concat.js */ "./node_modules/core-js/modules/es.array.concat.js");
/* harmony import */ var core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_keys_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.keys.js */ "./node_modules/core-js/modules/es.object.keys.js");
/* harmony import */ var core_js_modules_es_object_keys_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_keys_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
/* harmony import */ var core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
/* harmony import */ var core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_string_split_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.string.split.js */ "./node_modules/core-js/modules/es.string.split.js");
/* harmony import */ var core_js_modules_es_string_split_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_split_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var min_dash__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! min-dash */ "./node_modules/min-dash/dist/index.esm.js");
/* harmony import */ var min_dom__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! min-dom */ "./node_modules/min-dom/dist/index.esm.js");








var TOGGLE_SELECTOR = '.custom-palette-toggle';
var ENTRY_SELECTOR = '.entry';
var ELEMENT_SELECTOR = TOGGLE_SELECTOR + ', ' + ENTRY_SELECTOR;
var PALETTE_OPEN_CLS = 'open';
var PALETTE_TWO_COLUMN_CLS = 'two-column';
var DEFAULT_PRIORITY = 1000;
/**
 * A palette containing modeling elements.
 */

function Palette(eventBus, canvas, elementFactory, bpmnFactory, moddle, create, paletteContainer, paletteEntries) {
  this._eventBus = eventBus;
  this._canvas = canvas;
  this._entries = paletteEntries;
  this._paletteContainer = paletteContainer;
  this._elementFactory = elementFactory;
  this._model = moddle;
  this._bpmnFactory = bpmnFactory;
  this._create = create;
  var self = this;
  eventBus.on('tool-manager.update', function (event) {
    var tool = event.tool;
    self.updateToolHighlight(tool);
  });
  eventBus.on('i18n.changed', function () {
    self._update();
  });
  eventBus.on('diagram.init', function () {
    self._diagramInitialized = true;

    self._rebuild();
  });
}

Palette.$inject = ['eventBus', 'canvas', 'elementFactory', 'bpmnFactory', 'moddle', 'create', 'config.paletteContainer', 'config.paletteEntries'];
/**
 * Register a provider with the palette
 *
 * @param  {number} [priority=1000]
 * @param  {PaletteProvider} provider
 *
 * @example
 * const paletteProvider = {
 *   getPaletteEntries: function() {
 *     return function(entries) {
 *       return {
 *         ...entries,
 *         'entry-1': {
 *           label: 'My Entry',
 *           action: function() { alert("I have been clicked!"); }
 *         }
 *       };
 *     }
 *   }
 * };
 *
 * palette.registerProvider(800, paletteProvider);
 */

Palette.prototype.registerProvider = function (priority, provider) {
  if (!provider) {
    provider = priority;
    priority = DEFAULT_PRIORITY;
  }

  this._eventBus.on('palette.getProviders', priority, function (event) {
    event.providers.push(provider);
  });

  this._rebuild();
};
/**
 * Returns the palette entries
 *
 * @return {Object<string, PaletteEntryDescriptor>} map of entries
 */


Palette.prototype.getEntries = function () {
  var providers = this._getProviders();

  return providers.reduce(addPaletteEntries, {});
};

Palette.prototype._rebuild = function () {
  if (!this._diagramInitialized) {
    return;
  }

  var providers = this._getProviders();

  if (!providers.length) {
    return;
  }

  if (!this._container) {
    this._init();
  }

  this._update();
};
/**
 * Initialize
 */


Palette.prototype._init = function () {
  var self = this;
  var eventBus = this._eventBus; // var parentContainer = this._getParentContainer()
  // 获取传入的工具栏容器

  var container = this._container = this._paletteContainer; // 未找到 使用默认

  if (!container) {
    container = this._container = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["domify"])(Palette.HTML_MARKUP);
  } else {
    // 为 传入的工具栏容器 创建子元素
    addClasses(container, 'custom-palette');
    var entries = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["query"])('.custom-palette-entries', container);
    var toggle = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["query"])('.custom-palette-toggle', container);

    if (!entries) {
      container.appendChild(Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["domify"])('<div class="custom-palette-entries"></div>'));
    }

    if (!toggle) {
      container.appendChild(Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["domify"])('<div class="custom-palette-toggle"></div>'));
    }
  } // parentContainer.appendChild(container)
  // 下面是绑定 click 、 dragstart


  min_dom__WEBPACK_IMPORTED_MODULE_7__["delegate"].bind(container, ELEMENT_SELECTOR, 'click', function (event) {
    var target = event.delegateTarget;

    if (Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["matches"])(target, TOGGLE_SELECTOR)) {
      return self.toggle();
    }

    self.trigger('click', event);
  }); // prevent drag propagation

  min_dom__WEBPACK_IMPORTED_MODULE_7__["event"].bind(container, 'mousedown', function (event) {
    event.stopPropagation();
  }); // prevent drag propagation

  min_dom__WEBPACK_IMPORTED_MODULE_7__["delegate"].bind(container, ENTRY_SELECTOR, 'dragstart', function (event) {
    self.trigger('dragstart', event);
  });
  eventBus.on('canvas.resized', this._layoutChanged, this);
  eventBus.fire('palette.create', {
    container: container
  });
};

Palette.prototype._getProviders = function (id) {
  var event = this._eventBus.createEvent({
    type: 'palette.getProviders',
    providers: []
  });

  this._eventBus.fire(event);

  return event.providers;
};
/**
 * Update palette state.
 *
 * @param  {Object} [state] { open, twoColumn }
 */


Palette.prototype._toggleState = function (state) {
  state = state || {};

  var parent = this._getParentContainer();

  var container = this._container;
  var eventBus = this._eventBus;
  var twoColumn;
  var cls = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["classes"])(container);

  if ('twoColumn' in state) {
    twoColumn = state.twoColumn;
  } else {
    twoColumn = this._needsCollapse(parent.clientHeight, this._entries || {});
  } // always update two column


  cls.toggle(PALETTE_TWO_COLUMN_CLS, twoColumn);

  if ('open' in state) {
    cls.toggle(PALETTE_OPEN_CLS, state.open);
  }

  eventBus.fire('palette.changed', {
    twoColumn: twoColumn,
    open: this.isOpen()
  });
};

Palette.prototype._update = function () {
  var entriesContainer = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["query"])('.custom-palette-entries', this._container);
  var entries = this._entries = this.getEntries();
  Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["clear"])(entriesContainer); // 遍历工具栏元素

  Object(min_dash__WEBPACK_IMPORTED_MODULE_6__["forEach"])(entries, function (entry, id) {
    var grouping = entry.group || 'default'; // 设置分组

    var container = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["query"])('[data-group=' + grouping + ']', entriesContainer);

    if (!container) {
      container = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["domify"])('<div class="group" data-group="' + grouping + '"></div>');
      var arrowDown = 'el-icon-arrow-down';
      var groupLabel = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["domify"])("<div class=\"groupLabel\"><span title=\"".concat(grouping, "\">").concat(grouping, "</span></i></i><i id=\"custom-palette-group-arrow\" class=\"").concat(arrowDown, "\"></i></div></div>"));
      groupLabel.addEventListener('click', function () {
        var iconArrowDown = this.querySelector('.el-icon-arrow-down');
        var iconArrowLeft = this.querySelector('.el-icon-arrow-left');

        if (iconArrowDown) {
          // const isArrowDown = Array.from(iconArrowDown).includes('el-icon-arrow-down')
          iconArrowDown.classList = ['el-icon-arrow-left'];

          var _entry = this.parentNode.querySelectorAll('.entry');

          Object(min_dash__WEBPACK_IMPORTED_MODULE_6__["forEach"])(_entry, function (it) {
            it.style.display = 'none';
          });
        }

        if (iconArrowLeft) {
          iconArrowLeft.classList = ['el-icon-arrow-down'];

          var _entry2 = this.parentNode.querySelectorAll('.entry');

          Object(min_dash__WEBPACK_IMPORTED_MODULE_6__["forEach"])(_entry2, function (it) {
            it.style.display = 'block';
          });
        }
      });
      container.appendChild(groupLabel);
      entriesContainer.appendChild(container);
    }

    var html = entry.html || (entry.separator ? '<hr class="separator" />' : '<div class="entry" draggable="true"></div>');
    var control = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["domify"])(html);
    container.appendChild(control);

    if (!entry.separator) {
      Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["attr"])(control, 'data-action', id);

      if (entry.title) {
        Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["attr"])(control, 'title', entry.title);
      }

      if (entry.className) {
        addClasses(control, entry.className);
      }

      if (entry.imageUrl) {
        control.appendChild(Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["domify"])('<img src="' + entry.imageUrl + '">'));
      }
    }
  }); // open after update

  this.open();
};
/**
 * Trigger an action available on the palette
 *
 * @param  {string} action
 * @param  {Event} event
 */


Palette.prototype.trigger = function (action, event, autoActivate) {
  var entries = this._entries;
  var elementFactory = this._elementFactory;
  var bpmnFactory = this._bpmnFactory;
  var model = this._model;
  var create = this._create;
  var entry;
  var handler;
  var originalEvent;
  var button = event.delegateTarget || event.target;

  if (!button) {
    return event.preventDefault();
  }

  entry = entries[Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["attr"])(button, 'data-action')]; // when user clicks on the palette and not on an action

  if (!entry) {
    return;
  }

  handler = entry.action;
  originalEvent = event.originalEvent || event; // simple action (via callback function)
  //  传入 action 的 dragstart方法 click 方法

  if (Object(min_dash__WEBPACK_IMPORTED_MODULE_6__["isFunction"])(handler)) {
    if (action === 'click') {
      handler(originalEvent, autoActivate, elementFactory, bpmnFactory, model, create);
    }
  } else {
    if (handler[action]) {
      handler[action](originalEvent, autoActivate, elementFactory, bpmnFactory, model, create);
    }
  } // silence other actions


  event.preventDefault();
};

Palette.prototype._layoutChanged = function () {
  this._toggleState({});
};
/**
   * Do we need to collapse to two columns?
   *
   * @param {number} availableHeight
   * @param {Object} entries
   *
   * @return {boolean}
   */


Palette.prototype._needsCollapse = function (availableHeight, entries) {
  // top margin + bottom toggle + bottom margin
  // implementors must override this method if they
  // change the palette styles
  var margin = 20 + 10 + 20;
  var entriesHeight = Object.keys(entries).length * 46;
  return availableHeight < entriesHeight + margin;
};
/**
   * Close the palette
   */


Palette.prototype.close = function () {
  this._toggleState({
    open: false,
    twoColumn: false
  });
};
/**
   * Open the palette
   */


Palette.prototype.open = function () {
  this._toggleState({
    open: true
  });
};

Palette.prototype.toggle = function (open) {
  if (this.isOpen()) {
    this.close();
  } else {
    this.open();
  }
};

Palette.prototype.isActiveTool = function (tool) {
  return tool && this._activeTool === tool;
};

Palette.prototype.updateToolHighlight = function (name) {
  var entriesContainer, toolsContainer;

  if (!this._toolsContainer) {
    entriesContainer = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["query"])('.custom-palette-entries', this._container);
    this._toolsContainer = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["query"])('[data-group=tools]', entriesContainer);
  }

  toolsContainer = this._toolsContainer;
  Object(min_dash__WEBPACK_IMPORTED_MODULE_6__["forEach"])(toolsContainer.children, function (tool) {
    var actionName = tool.getAttribute('data-action');

    if (!actionName) {
      return;
    }

    var toolClasses = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["classes"])(tool);
    actionName = actionName.replace('-tool', '');

    if (toolClasses.contains('entry') && actionName === name) {
      toolClasses.add('highlighted-entry');
    } else {
      toolClasses.remove('highlighted-entry');
    }
  });
};
/**
   * Return true if the palette is opened.
   *
   * @example
   *
   * palette.open();
   *
   * if (palette.isOpen()) {
   *   // yes, we are open
   * }
   *
   * @return {boolean} true if palette is opened
   */


Palette.prototype.isOpen = function () {
  return Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["classes"])(this._container).has(PALETTE_OPEN_CLS);
};
/**
   * Get container the palette lives in.
   *
   * @return {Element}
   */


Palette.prototype._getParentContainer = function () {
  return this._canvas.getContainer();
};
/* markup definition */


Palette.HTML_MARKUP = '<div class="custom-palette">' + '<div class="custom-palette-entries"></div>' + '<div class="custom-palette-toggle"></div>' + '</div>'; // helpers //////////////////////

function addClasses(element, classNames) {
  var classes = Object(min_dom__WEBPACK_IMPORTED_MODULE_7__["classes"])(element);
  var actualClassNames = Object(min_dash__WEBPACK_IMPORTED_MODULE_6__["isArray"])(classNames) ? classNames : classNames.split(/\s+/g);
  actualClassNames.forEach(function (cls) {
    classes.add(cls);
  });
}

function addPaletteEntries(entries, provider) {
  var entriesOrUpdater = provider.getPaletteEntries();

  if (Object(min_dash__WEBPACK_IMPORTED_MODULE_6__["isFunction"])(entriesOrUpdater)) {
    return entriesOrUpdater(entries);
  }

  Object(min_dash__WEBPACK_IMPORTED_MODULE_6__["forEach"])(entriesOrUpdater, function (entry, id) {
    entries[id] = entry;
  });
  return entries;
}

/* harmony default export */ __webpack_exports__["default"] = ({
  __init__: ['customPalette'],
  customPalette: ['type', Palette]
});

/***/ }),

/***/ "./resources/js/components/admin/bpmn/customBpmn/palette/CustomPaletteProvider.js":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/customBpmn/palette/CustomPaletteProvider.js ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return PaletteProvider; });
/**
 * A palette provider for BPMN 2.0 elements.
 */
function PaletteProvider(paletteEntries, customPalette, spaceTool) {
  this._entries = paletteEntries;
  console.log('spaceTool', spaceTool);
  customPalette.registerProvider(this);
}
PaletteProvider.$inject = ['config.paletteEntries', 'customPalette', 'spaceTool'];

PaletteProvider.prototype.getPaletteEntries = function (element) {
  return this._entries;
};

/***/ }),

/***/ "./resources/js/components/admin/bpmn/customBpmn/palette/index.js":
/*!************************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/customBpmn/palette/index.js ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CustomPalette__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CustomPalette */ "./resources/js/components/admin/bpmn/customBpmn/palette/CustomPalette.js");
/* harmony import */ var _CustomPaletteProvider__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CustomPaletteProvider */ "./resources/js/components/admin/bpmn/customBpmn/palette/CustomPaletteProvider.js");

 // 该服务称为customPaletteProvider，它依赖于 customPalette，并且应在创建关系图时初始化该服务

/* harmony default export */ __webpack_exports__["default"] = ({
  __depends__: [_CustomPalette__WEBPACK_IMPORTED_MODULE_0__["default"]],
  __init__: ['customPaletteProvider'],
  customPaletteProvider: ['type', _CustomPaletteProvider__WEBPACK_IMPORTED_MODULE_1__["default"]]
});

/***/ }),

/***/ "./resources/js/components/admin/bpmn/customBpmn/renderer/CustomRenderer.js":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/customBpmn/renderer/CustomRenderer.js ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return CustomRenderer; });
/* harmony import */ var bpmn_js_lib_draw_BpmnRenderer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bpmn-js/lib/draw/BpmnRenderer */ "./node_modules/bpmn-js/lib/draw/BpmnRenderer.js");
/* harmony import */ var bpmn_js_lib_draw_BpmnRenderUtil__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! bpmn-js/lib/draw/BpmnRenderUtil */ "./node_modules/bpmn-js/lib/draw/BpmnRenderUtil.js");
/* harmony import */ var min_dash__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! min-dash */ "./node_modules/min-dash/dist/index.esm.js");
/* harmony import */ var bpmn_js_lib_util_ModelUtil__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! bpmn-js/lib/util/ModelUtil */ "./node_modules/bpmn-js/lib/util/ModelUtil.js");




var HIGH_PRIORITY = 1500;
var TASK_BORDER_RADIUS = 2;
function CustomRenderer(config, eventBus, styles, pathMap, canvas, textRenderer, paletteEntries) {
  bpmn_js_lib_draw_BpmnRenderer__WEBPACK_IMPORTED_MODULE_0__["default"].call(this, config, eventBus, styles, pathMap, canvas, textRenderer, HIGH_PRIORITY);
  this._paletteEntries = paletteEntries;
  this._textRenderer = textRenderer;
}

CustomRenderer.prototype.canRender = function (element) {
  // only render tasks and events (ignore labels)
  var paletteEntries = this._paletteEntries;
  return Object(min_dash__WEBPACK_IMPORTED_MODULE_2__["some"])(paletteEntries, function (entry) {
    return Object(bpmn_js_lib_util_ModelUtil__WEBPACK_IMPORTED_MODULE_3__["is"])(element, entry.type);
  }) && !element.labelTarget;
};

CustomRenderer.prototype.drawShape = function (parentNode, element) {
  var paletteEntries = this._paletteEntries;
  var textRenderer = this._textRenderer;
  var shape = Object(min_dash__WEBPACK_IMPORTED_MODULE_2__["find"])(paletteEntries, function (entry) {
    return Object(bpmn_js_lib_util_ModelUtil__WEBPACK_IMPORTED_MODULE_3__["is"])(element, entry.type);
  });

  if (shape && shape.drawShape instanceof Function) {
    return shape.drawShape(parentNode, element, textRenderer, paletteEntries);
  }

  return bpmn_js_lib_draw_BpmnRenderer__WEBPACK_IMPORTED_MODULE_0__["default"].prototype.drawShape.call(this, parentNode, element);
};

CustomRenderer.prototype.getShapePath = function (shape) {
  if (Object(bpmn_js_lib_util_ModelUtil__WEBPACK_IMPORTED_MODULE_3__["is"])(shape, 'bpmn:Task')) {
    return Object(bpmn_js_lib_draw_BpmnRenderUtil__WEBPACK_IMPORTED_MODULE_1__["getRoundRectPath"])(shape, TASK_BORDER_RADIUS);
  }

  return bpmn_js_lib_draw_BpmnRenderer__WEBPACK_IMPORTED_MODULE_0__["default"].prototype.getShapePath.call(this, shape);
};

CustomRenderer.$inject = ['config.bpmnRenderer', 'eventBus', 'styles', 'pathMap', 'canvas', 'textRenderer', 'config.paletteEntries'];

/***/ }),

/***/ "./resources/js/components/admin/bpmn/customBpmn/renderer/index.js":
/*!*************************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/customBpmn/renderer/index.js ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CustomRenderer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CustomRenderer */ "./resources/js/components/admin/bpmn/customBpmn/renderer/CustomRenderer.js");

/* harmony default export */ __webpack_exports__["default"] = ({
  __init__: ['customRenderer'],
  customRenderer: ['type', _CustomRenderer__WEBPACK_IMPORTED_MODULE_0__["default"]]
});

/***/ }),

/***/ "./resources/js/components/admin/bpmn/customBpmn/utils/index.js":
/*!**********************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/customBpmn/utils/index.js ***!
  \**********************************************************************/
/*! exports provided: _fitViewport */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "_fitViewport", function() { return _fitViewport; });
function _fitViewport(center) {
  var vbox = this.viewbox(false);
  var outer = vbox.outer;
  var inner = vbox.inner;
  var newScale;
  var newViewbox; // display the complete diagram without zooming in.
  // instead of relying on internal zoom, we perform a
  // hard reset on the canvas viewbox to realize this
  //
  // if diagram does not need to be zoomed in, we focus it around
  // the diagram origin instead

  if (inner.x >= 0 && inner.y >= 0 && inner.x + inner.width <= outer.width && inner.y + inner.height <= outer.height && !center) {
    newViewbox = {
      x: 0,
      y: 0,
      width: Math.max(inner.width + inner.x, outer.width),
      height: Math.max(inner.height + inner.y, outer.height)
    };
  } else {
    newScale = Math.min(1, outer.width / inner.width, outer.height / inner.height);
    newViewbox = {
      x: inner.x + (center ? inner.width / 2 - outer.width / newScale / 2 : 0),
      y: inner.y + (center ? inner.height / 2 - outer.height / newScale / 2 : 0),
      width: outer.width / newScale,
      height: outer.height / newScale
    };
  }

  this.viewbox(newViewbox);
  return this.viewbox(false).scale;
}
;

/***/ }),

/***/ "./resources/js/components/admin/bpmn/designer.vue":
/*!*********************************************************!*\
  !*** ./resources/js/components/admin/bpmn/designer.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _designer_vue_vue_type_template_id_4abf8050_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./designer.vue?vue&type=template&id=4abf8050&scoped=true& */ "./resources/js/components/admin/bpmn/designer.vue?vue&type=template&id=4abf8050&scoped=true&");
/* harmony import */ var _designer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./designer.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/bpmn/designer.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _designer_vue_vue_type_style_index_0_id_4abf8050_lang_less_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./designer.vue?vue&type=style&index=0&id=4abf8050&lang=less&scoped=true& */ "./resources/js/components/admin/bpmn/designer.vue?vue&type=style&index=0&id=4abf8050&lang=less&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _designer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _designer_vue_vue_type_template_id_4abf8050_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _designer_vue_vue_type_template_id_4abf8050_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "4abf8050",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/bpmn/designer.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/bpmn/designer.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/designer.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_designer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./designer.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/bpmn/designer.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_designer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/admin/bpmn/designer.vue?vue&type=style&index=0&id=4abf8050&lang=less&scoped=true&":
/*!*******************************************************************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/designer.vue?vue&type=style&index=0&id=4abf8050&lang=less&scoped=true& ***!
  \*******************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_9_2_node_modules_less_loader_dist_cjs_js_node_modules_vue_loader_lib_index_js_vue_loader_options_designer_vue_vue_type_style_index_0_id_4abf8050_lang_less_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--9-2!../../../../../node_modules/less-loader/dist/cjs.js!../../../../../node_modules/vue-loader/lib??vue-loader-options!./designer.vue?vue&type=style&index=0&id=4abf8050&lang=less&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/less-loader/dist/cjs.js!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/bpmn/designer.vue?vue&type=style&index=0&id=4abf8050&lang=less&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_9_2_node_modules_less_loader_dist_cjs_js_node_modules_vue_loader_lib_index_js_vue_loader_options_designer_vue_vue_type_style_index_0_id_4abf8050_lang_less_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_9_2_node_modules_less_loader_dist_cjs_js_node_modules_vue_loader_lib_index_js_vue_loader_options_designer_vue_vue_type_style_index_0_id_4abf8050_lang_less_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_9_2_node_modules_less_loader_dist_cjs_js_node_modules_vue_loader_lib_index_js_vue_loader_options_designer_vue_vue_type_style_index_0_id_4abf8050_lang_less_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_9_2_node_modules_less_loader_dist_cjs_js_node_modules_vue_loader_lib_index_js_vue_loader_options_designer_vue_vue_type_style_index_0_id_4abf8050_lang_less_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/admin/bpmn/designer.vue?vue&type=template&id=4abf8050&scoped=true&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/designer.vue?vue&type=template&id=4abf8050&scoped=true& ***!
  \****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_designer_vue_vue_type_template_id_4abf8050_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./designer.vue?vue&type=template&id=4abf8050&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/bpmn/designer.vue?vue&type=template&id=4abf8050&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_designer_vue_vue_type_template_id_4abf8050_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_designer_vue_vue_type_template_id_4abf8050_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/admin/bpmn/example.bpmn":
/*!*********************************************************!*\
  !*** ./resources/js/components/admin/bpmn/example.bpmn ***!
  \*********************************************************/
/*! exports provided: xmlStr */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "xmlStr", function() { return xmlStr; });
var xmlStr = `<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdi="http://www.omg.org/spec/DD/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" isExecutable="false">
    <startEvent id="StartEvent_1y45yut" name="开始">
    <outgoing>SequenceFlow_0h21x7r</outgoing>
    </startEvent>
    <task id="Task_1hcentk">
    <incoming>SequenceFlow_0h21x7r</incoming>
    </task>
    <sequenceFlow id="SequenceFlow_0h21x7r" sourceRef="StartEvent_1y45yut" targetRef="Task_1hcentk" />
</process>
<bpmndi:BPMNDiagram id="BpmnDiagram_1">
    <bpmndi:BPMNPlane id="BpmnPlane_1" bpmnElement="Process_1">
    <bpmndi:BPMNShape id="StartEvent_1y45yut_di" bpmnElement="StartEvent_1y45yut">
        <omgdc:Bounds x="152" y="102" width="36" height="36" />
        <bpmndi:BPMNLabel>
        <omgdc:Bounds x="160" y="145" width="22" height="14" />
        </bpmndi:BPMNLabel>
    </bpmndi:BPMNShape>
    <bpmndi:BPMNShape id="Task_1hcentk_di" bpmnElement="Task_1hcentk">
        <omgdc:Bounds x="240" y="80" width="100" height="80" />
    </bpmndi:BPMNShape>
    <bpmndi:BPMNEdge id="SequenceFlow_0h21x7r_di" bpmnElement="SequenceFlow_0h21x7r">
        <omgdi:waypoint x="188" y="120" />
        <omgdi:waypoint x="240" y="120" />
    </bpmndi:BPMNEdge>
    </bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>`

/***/ }),

/***/ "./resources/js/components/admin/bpmn/index.js":
/*!*****************************************************!*\
  !*** ./resources/js/components/admin/bpmn/index.js ***!
  \*****************************************************/
/*! exports provided: ABpmnDesigner, ABpmnInput */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _designer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./designer */ "./resources/js/components/admin/bpmn/designer.vue");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "ABpmnDesigner", function() { return _designer__WEBPACK_IMPORTED_MODULE_0__["default"]; });

/* harmony import */ var _input__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./input */ "./resources/js/components/admin/bpmn/input.vue");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "ABpmnInput", function() { return _input__WEBPACK_IMPORTED_MODULE_1__["default"]; });





/***/ }),

/***/ "./resources/js/components/admin/bpmn/input.vue":
/*!******************************************************!*\
  !*** ./resources/js/components/admin/bpmn/input.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _input_vue_vue_type_template_id_57694796_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./input.vue?vue&type=template&id=57694796&scoped=true& */ "./resources/js/components/admin/bpmn/input.vue?vue&type=template&id=57694796&scoped=true&");
/* harmony import */ var _input_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./input.vue?vue&type=script&lang=js& */ "./resources/js/components/admin/bpmn/input.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _input_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _input_vue_vue_type_template_id_57694796_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _input_vue_vue_type_template_id_57694796_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "57694796",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/admin/bpmn/input.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/admin/bpmn/input.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/input.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_input_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./input.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/bpmn/input.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_input_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/admin/bpmn/input.vue?vue&type=template&id=57694796&scoped=true&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/components/admin/bpmn/input.vue?vue&type=template&id=57694796&scoped=true& ***!
  \*************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_input_vue_vue_type_template_id_57694796_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./input.vue?vue&type=template&id=57694796&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/admin/bpmn/input.vue?vue&type=template&id=57694796&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_input_vue_vue_type_template_id_57694796_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_input_vue_vue_type_template_id_57694796_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/views/Admin/templates/form.vue":
/*!*****************************************************!*\
  !*** ./resources/js/views/Admin/templates/form.vue ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _form_vue_vue_type_template_id_7b286139_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./form.vue?vue&type=template&id=7b286139&scoped=true& */ "./resources/js/views/Admin/templates/form.vue?vue&type=template&id=7b286139&scoped=true&");
/* harmony import */ var _form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./form.vue?vue&type=script&lang=js& */ "./resources/js/views/Admin/templates/form.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _form_vue_vue_type_template_id_7b286139_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _form_vue_vue_type_template_id_7b286139_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "7b286139",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/Admin/templates/form.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/Admin/templates/form.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/js/views/Admin/templates/form.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./form.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Admin/templates/form.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/Admin/templates/form.vue?vue&type=template&id=7b286139&scoped=true&":
/*!************************************************************************************************!*\
  !*** ./resources/js/views/Admin/templates/form.vue?vue&type=template&id=7b286139&scoped=true& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_form_vue_vue_type_template_id_7b286139_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./form.vue?vue&type=template&id=7b286139&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Admin/templates/form.vue?vue&type=template&id=7b286139&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_form_vue_vue_type_template_id_7b286139_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_form_vue_vue_type_template_id_7b286139_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);