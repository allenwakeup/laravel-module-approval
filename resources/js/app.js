// require('./bootstrap');
// window.Vue = require('vue');
// window.VueRouter = require('vue-router');

import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '@/store/index'
import router from '@/plugins/router'
import Antd from 'ant-design-vue'
import {Icon} from 'ant-design-vue'
import App from '@/views/App'
import 'ant-design-vue/dist/antd.css';
import {post,get,put,deletes,postfile,toJson,isEmpty,apiHandle} from '@/plugins/http.js' // 请求方式中间件
import {api} from '@/plugins/api' // 后端API
import {returnInfo,formatFloat,hasRoute} from '@/plugins/function' // 辅助方法
import VueLazyload from 'vue-lazyload' // 懒加载图片
import 'babel-polyfill' // 兼容IE

// 以下为bpmn工作流绘图工具的样式
import 'bpmn-js/dist/assets/diagram-js.css' // 左边工具栏以及编辑节点的样式
import 'bpmn-js/dist/assets/bpmn-font/css/bpmn.css'
import 'bpmn-js/dist/assets/bpmn-font/css/bpmn-codes.css'
import 'bpmn-js/dist/assets/bpmn-font/css/bpmn-embedded.css'
import 'diagram-js-minimap/assets/diagram-js-minimap.css'

import '@/plugins/css/diagram-js.scss'
import '@/plugins/css/bpmn.scss'

Vue.prototype.$api=api;
Vue.prototype.$post=post;
Vue.prototype.$get=get;
Vue.prototype.$put=put;
Vue.prototype.$delete=deletes;
Vue.prototype.$postfile=postfile;
Vue.prototype.$toJson=toJson;
Vue.prototype.$isEmpty=isEmpty;
Vue.prototype.$apiHandle=apiHandle;
Vue.prototype.$returnInfo=returnInfo; // api返回信息做处理
Vue.prototype.$formatFloat=formatFloat; // 浮点型格式化
Vue.prototype.$hasRoute=hasRoute; // 是否存在路由

Vue.config.productionTip = false;

// 字体图标 iconFont
const AFont = Icon.createFromIconfontCN({
    scriptUrl: '/assets/fonts/iconfont.js',
});
Vue.use(Antd);
Vue.component('a-font', AFont);

Vue.use(VueLazyload); // 懒加载图片

// 跳转页面回到顶部
router.afterEach(() => {
    window.scrollTo(0,0);
});

// 重复路由报错
const _vue_router_push = VueRouter.prototype.push;
const { isNavigationFailure, NavigationFailureType } = VueRouter;
VueRouter.prototype.push = function push(location) {
    _vue_router_push
        .call(this, location)
        .catch(err => {
            if (isNavigationFailure(err, NavigationFailureType.redirected)) {
                // 是否发生重定向
            }

            if (isNavigationFailure(err, NavigationFailureType.duplicated)) {
                // 是否发生重复路由
                throw err;
            }
        })
}

Vue.use(VueRouter)

const app = new Vue({
    el: '#app',
    store,
    components: { App },
    router,
});
