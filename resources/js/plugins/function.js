import Vue from 'vue'
import {message} from 'ant-design-vue';
export function formatDate (date, fmt) {
    if (/(y+)/.test(fmt)) {
        fmt = fmt.replace(RegExp.$1, (date.getFullYear() + '').substr(4 - RegExp.$1.length));
    }
    let o = {
        'M+': date.getMonth() + 1,
        'd+': date.getDate(),
        'h+': date.getHours(),
        'm+': date.getMinutes(),
        's+': date.getSeconds()
    };
    for (let k in o) {
        if (new RegExp(`(${k})`).test(fmt)) {
            let str = o[k] + '';
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length === 1) ? str : padLeftZero(str));
        }
    }
    return fmt;
}

export function getSession(name){
    let token_type = sessionStorage.getItem(name);
    return localStorage.getItem(token_type);
}

export function isArray(obj) {
    return Object.prototype.toString.call(obj).slice(8, -1) === 'Array';
}

export function returnInfo(res){
    if(res.code === 200){
        return message.success(res.msg);
    }else{
        return message.error(res.msg)
    }
}

export function returnError(res){
    if(res.code !== 200 && res.message){
        if(typeof res.errors === 'object'){
            const errors = [];
            Object.keys(res.errors).forEach(k => {
                if(res.errors.hasOwnProperty(k)){
                    if(isArray(res.errors[k])){
                        errors.push(res.errors[k].join(','));
                    } else {
                        errors.push(res.errors[k]);
                    }

                }
            });
            return errors.join(',')
        } else {
            return res.message;
        }

    }
    return
}

export function formatFloat(value,length=2){
    let tempNum = 0;
    let s,temp;
    let s1 = value + "";
    let start = s1.indexOf(".");
    if(s1.substr(start+length+1,1)>=5){
        tempNum=1;
    }
    temp = Math.pow(10,length);
    s = Math.floor(value * temp) + tempNum;
    return s/temp;
}

export function writeStorage(key, value){
    if(typeof key === 'string'){
        const value_type = typeof value;
        switch(value_type){
            case 'string':
                return localStorage.setItem (key, value);
            case 'boolean':
            case 'object':
                try{
                    return localStorage.setItem(key, JSON.stringify(value));
                }catch(err){
                    console.log(err);
                    return err;
                }
            default:
                break;
        }
    }
}

export function readStorage(key){
    const value = localStorage.getItem(key);
    try{
        return JSON.parse(value);
    }catch(err){
        console.log(err);
        return value;
    }
}
export function readStorageStr(key){
    return localStorage.getItem(key);
}

export function removeStorage(key){
    return localStorage.removeItem(key);
}

export function clearStorage(){
    return localStorage.clear();
}

export function moduleStorageHelpers(module, user_id = '') {
    const join = '_';
    const module_key = module + join;
    const user_key = module + join + user_id + join;
    return {
        writeStorage: (key, value) => writeStorage(module_key + key, value),
        readStorage: (key) => readStorage(module_key + key),
        readStorageStr: (key) => readStorageStr(module_key + key),
        removeStorage: (key) => removeStorage(module_key + key),
        key: (key) => module_key + key,
        clearStorage: () => {
            for(let i = 0, len = localStorage.length; i < len; i++){
                const key = localStorage.key(i);
                if(key.startsWith(module_key)){
                    removeStorage(key);
                }
            }
        },
        writeUserPrefStorage: (key, value) => user_id === '' ? false : writeStorage(user_key + key, value),
        readUserPrefStorage: (key) => user_id === '' ? false : readStorage(user_key + key),
        readUserPrefStorageStr: (key) => user_id === '' ? false : readStorageStr(user_key + key),
        removeUserPrefStorage: (key) => user_id === '' ? false : removeStorage(user_key + key),
    }
}

export function writeSession(key, value){
    if(typeof key === 'string'){
        const value_type = typeof value;
        switch(value_type){
            case 'string':
                return sessionStorage.setItem (key, value);
            case 'object':
                try{
                    return sessionStorage.setItem(key, JSON.stringify(value));
                }catch(err){
                    console.log(err);
                    return err;
                }
            default:
                break;
        }
    }
}

export function readSession(key){
    const value = sessionStorage.getItem(key);
    try{
        return JSON.parse(value);
    }catch(err){
        console.log(err);
        return value;
    }
}
export function removeSession(key){
    return sessionStorage.removeItem(key);
}

export function clearSession(){
    return sessionStorage.clear();
}

export function moduleSessionHelpers(module) {
    const join = '_';
    const module_key = module + join;
    return {
        writeSession: (key, value) => writeSession(module_key + key, value),
        readSession: (key) => readSession(module_key + key),
        removeSession: (key) => removeSession(module_key + key),
        clearSession: () => {
            for(let i = 0, len = sessionStorage.length; i < len; i++){
                const key = sessionStorage.key(i);
                if(key.startsWith(module_key)){
                    removeSession(key);
                }
            }
        }
    }
}

export function firstUpperCase(str){
    return str.replace(/\b(\w)(\w*)/g, function($0, $1, $2) {
        return $1.toUpperCase() + $2.toLowerCase();
    });
}

export function getMenuPathById($menu, id){
    let res = [];
    if($menu && $menu.length > 0 && id > 0){
        const find = $menu.filter(item => item.id === id);
        if(find.length > 0){
            res.push(find[0].id + '')
            return res;
        } else {
            for(let i = 0; i < $menu.length; i ++){
                const _res = getMenuPathById($menu[i].children, id);
                if(_res && _res.length > 0){
                    res.push($menu[i].id + '')
                    res = res.concat(_res);
                    return res;
                }
            }
            return false;
        }
    }
    return res;
}

export function hasRoute(vueRouter, route_resolve){
    return new Promise((resolve, reject) =>{
        try {
            const resolved_routes = vueRouter.resolve(route_resolve).resolved;
            if (resolved_routes.matched.length > 0) {
                resolve(resolved_routes.matched);
            }else{
                reject('route not found')
            }
        }catch (err) {
            reject(err)
        }
    });
}

function padLeftZero (str) {
    return ('00' + str).substr(str.length);
}

// 时间格式化
Vue.filter('formatDate', function (time) {
    var date = new Date(time*1000);
    return formatDate(date, 'yyyy-MM-dd hh:mm');
});

Vue.filter('formatDateAuto', function (time,str) {
    var date = new Date(time*1000);
    return formatDate(date, str);
});
