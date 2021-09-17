import Vue from 'vue'
import Vuex from 'vuex'
import {firstUpperCase} from '@/plugins/function'

Vue.use(Vuex)

// const debug = process.env.NODE_ENV !== 'production'

const stores = require.context('./modules', true, /\.js$/);
// 自动模块文件
const modules = stores.keys()
    .reduce(function (s, key) {
        const path = key.replace(/(.*\/)*([^.]+).*/ig,"$1");
        const store = key.replace(/(.*\/)*([^.]+).*/ig,"$2");
        const folder = path.replace(/(.*\/)*([^\/]+).*/ig,"$2");
        s[folder + firstUpperCase(store)] = stores(key).default;
        return s;
    }, {});

export default new Vuex.Store({
    modules,
    strict: false,
})
