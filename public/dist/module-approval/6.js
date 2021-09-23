(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[6],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Admin/templates/index.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Admin/templates/index.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_join_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.join.js */ "./node_modules/core-js/modules/es.array.join.js");
/* harmony import */ var core_js_modules_es_array_join_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_join_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_object_assign_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.object.assign.js */ "./node_modules/core-js/modules/es.object.assign.js");
/* harmony import */ var core_js_modules_es_object_assign_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_assign_js__WEBPACK_IMPORTED_MODULE_1__);


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
  components: {},
  props: {},
  data: function data() {
    return {
      params: {
        page: 1,
        per_page: 30
      },
      total: 0,
      //总页数
      selectedRowKeys: [],
      // 被选择的行
      columns: [{
        title: '#',
        dataIndex: 'id',
        fixed: 'left',
        width: 80
      }, {
        title: '上级',
        scopedSlots: {
          customRender: 'pid'
        },
        width: 120
      }, {
        title: '分类',
        scopedSlots: {
          customRender: 'category'
        },
        width: 220
      }, {
        title: '编码',
        dataIndex: 'code',
        width: 120
      }, {
        title: '名称',
        dataIndex: 'name',
        width: 120
      }, {
        title: '分组',
        scopedSlots: {
          customRender: 'group'
        },
        width: 120
      }, {
        title: '类型',
        scopedSlots: {
          customRender: 'type'
        },
        width: 120
      }, {
        title: '排序',
        dataIndex: 'order',
        width: 90
      }, {
        title: '状态',
        scopedSlots: {
          customRender: 'status'
        },
        width: 120
      }, {
        title: '创建时间',
        dataIndex: 'created_at',
        width: 120
      }, {
        title: '更新时间',
        dataIndex: 'updated_at',
        width: 120
      }, {
        title: '操作',
        fixed: 'right',
        scopedSlots: {
          customRender: 'action'
        }
      }],
      list: [],
      dictionary: {
        status: {
          enabled: '启用',
          disabled: '禁用'
        },
        gender: ['默认', '男', '女', '其他']
      },
      loading_status: {}
    };
  },
  watch: {},
  computed: {},
  methods: {
    // 选择框被点击
    onSelectChange: function onSelectChange(selectedRowKeys) {
      this.selectedRowKeys = selectedRowKeys;
    },
    // 选择分页
    onChange: function onChange(e) {
      this.params.page = e;
    },
    // 删除
    del: function del() {
      var _this = this;

      if (this.selectedRowKeys.length === 0) {
        return this.$message.error('未选择数据.');
      }

      this.$confirm({
        title: '你确定要删除选择的数据？',
        content: '确定删除后无法恢复.',
        okText: '是',
        okType: 'danger',
        cancelText: '取消',
        onOk: function onOk() {
          var ids = _this.selectedRowKeys.join(',');

          _this.$delete(_this.$api.moduleApprovalTemplates + '/' + ids).then(function (res) {
            if (res.code === 200) {
              _this.onload();

              _this.$message.success('删除成功');
            } else {
              _this.$message.error(res.msg);
            }
          });
        }
      });
    },
    onStatusChange: function onStatusChange(record) {
      var _this2 = this;

      var reverse_status = [1, 0][record.status];
      this.loading_status['_' + record.id] = true;
      this.$put(this.$api.moduleApprovalTemplates + '/' + record.id, Object.assign({}, record, {
        status: reverse_status
      })).then(function (res) {
        _this2.loading_status['_' + record.id] = false;

        if (res.code === 200) {
          record.status = reverse_status;

          _this2.$message.success(res.msg);
        } else {
          return _this2.$message.error(res.msg);
        }
      }).catch(function () {
        return _this2.loading_status['_' + record.id] = false;
      });
    },
    onload: function onload() {
      var _this3 = this;

      this.$get(this.$api.moduleApprovalTemplates, this.params).then(function (res) {
        _this3.total = res.data.total;
        _this3.list = res.data.data;
      });
    }
  },
  created: function created() {
    this.onload();
  },
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Admin/templates/index.vue?vue&type=template&id=5083fa2d&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Admin/templates/index.vue?vue&type=template&id=5083fa2d&scoped=true& ***!
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
  return _c("div", [
    _c("div", { staticClass: "admin_table_page_title" }, [_vm._v("模版列表")]),
    _vm._v(" "),
    _c("div", { staticClass: "unline underm" }),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "admin_table_handle_btn" },
      [
        _c(
          "a-button",
          {
            attrs: { type: "primary", icon: "plus" },
            on: {
              click: function($event) {
                return _vm.$router.push(
                  "/Admin/goodcatch/m/approval/templates/form"
                )
              }
            }
          },
          [_vm._v("添加")]
        ),
        _vm._v(" "),
        _c(
          "a-button",
          {
            staticClass: "admin_delete_btn",
            attrs: { type: "danger", icon: "delete" },
            on: { click: _vm.del }
          },
          [_vm._v("批量删除")]
        )
      ],
      1
    ),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "admin_table_list" },
      [
        _c("a-table", {
          attrs: {
            columns: _vm.columns,
            "data-source": _vm.list,
            pagination: false,
            scroll: { x: 2048 },
            "row-selection": {
              selectedRowKeys: _vm.selectedRowKeys,
              onChange: _vm.onSelectChange
            },
            "row-key": "id"
          },
          scopedSlots: _vm._u([
            {
              key: "pid",
              fn: function(record) {
                return _c("span", {}, [
                  _vm._v(
                    "\n                " +
                      _vm._s(record.parent ? record.parent.name : "--") +
                      "\n            "
                  )
                ])
              }
            },
            {
              key: "type",
              fn: function(record) {
                return _c("span", {}, [
                  _vm._v(
                    "\n                " +
                      _vm._s(record.type === 0 ? "默认" : "其他") +
                      "\n            "
                  )
                ])
              }
            },
            {
              key: "category",
              fn: function(record) {
                return _c("span", {}, [
                  _vm._v(
                    "\n                " +
                      _vm._s(
                        record.category &&
                          _vm.recored.category.path_text.length > 0
                          ? record.path_text.join(" / ")
                          : "--"
                      ) +
                      "\n            "
                  )
                ])
              }
            },
            {
              key: "status",
              fn: function(record) {
                return _c("a-switch", {
                  attrs: {
                    loading: _vm.loading_status["_" + record.id],
                    "checked-children": _vm.dictionary.status.enabled,
                    "un-checked-children": _vm.dictionary.status.disabled,
                    "default-checked": record.status === 1
                  },
                  on: {
                    change: function($event) {
                      return _vm.onStatusChange(record)
                    }
                  }
                })
              }
            },
            {
              key: "action",
              fn: function(rows) {
                return _c(
                  "span",
                  {},
                  [
                    _c(
                      "a-button",
                      {
                        attrs: { icon: "edit" },
                        on: {
                          click: function($event) {
                            return _vm.$router.push(
                              "/Admin/goodcatch/m/approval/templates/form/" +
                                rows.id
                            )
                          }
                        }
                      },
                      [_vm._v("编辑")]
                    )
                  ],
                  1
                )
              }
            }
          ])
        }),
        _vm._v(" "),
        _vm.total > 0
          ? _c(
              "div",
              { staticClass: "admin_pagination" },
              [
                _c("a-pagination", {
                  attrs: {
                    "page-size": _vm.params.per_page,
                    total: _vm.total,
                    "show-less-items": ""
                  },
                  on: {
                    "update:pageSize": function($event) {
                      return _vm.$set(_vm.params, "per_page", $event)
                    },
                    "update:page-size": function($event) {
                      return _vm.$set(_vm.params, "per_page", $event)
                    },
                    change: _vm.onChange
                  },
                  model: {
                    value: _vm.params.page,
                    callback: function($$v) {
                      _vm.$set(_vm.params, "page", $$v)
                    },
                    expression: "params.page"
                  }
                })
              ],
              1
            )
          : _vm._e()
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/Admin/templates/index.vue":
/*!******************************************************!*\
  !*** ./resources/js/views/Admin/templates/index.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _index_vue_vue_type_template_id_5083fa2d_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./index.vue?vue&type=template&id=5083fa2d&scoped=true& */ "./resources/js/views/Admin/templates/index.vue?vue&type=template&id=5083fa2d&scoped=true&");
/* harmony import */ var _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./index.vue?vue&type=script&lang=js& */ "./resources/js/views/Admin/templates/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _index_vue_vue_type_template_id_5083fa2d_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _index_vue_vue_type_template_id_5083fa2d_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "5083fa2d",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/Admin/templates/index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/Admin/templates/index.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/views/Admin/templates/index.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Admin/templates/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/Admin/templates/index.vue?vue&type=template&id=5083fa2d&scoped=true&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/views/Admin/templates/index.vue?vue&type=template&id=5083fa2d&scoped=true& ***!
  \*************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_5083fa2d_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=template&id=5083fa2d&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Admin/templates/index.vue?vue&type=template&id=5083fa2d&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_5083fa2d_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_5083fa2d_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);