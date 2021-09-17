import qs from 'qs';
import axios from 'axios'
import {message} from 'ant-design-vue';
import router from './router'
import {STORE_ADMIN, STORE_SELLER, STORE_HOME, TOKEN, TOKEN_TYPE} from '@/plugins/constant'
import {returnError, moduleStorageHelpers} from '@/plugins/function'

axios.defaults.timeout = 10 * 1000;  // 请求超时
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=UTF-8';
// axios.defaults.withCredentials = true; // 允许跨域携带cookie

const baseUrlRegExp = new RegExp(window.baseUrl.replace(/\/*$/i,'/'), 'ig');

function getSessType(url){
    url = url.replace(baseUrlRegExp, '')
    if(url.search(/^Admin\//i) === 0){
        return STORE_ADMIN
    }else if(url.search(/^Seller\//i) === 0){
        return STORE_SELLER
    }else{
        return STORE_HOME
    }
}

function getToken(url, store_name){
    if(isEmpty(store_name)){
        store_name = getSessType(url);
    }
    if(!isEmpty(store_name)){
        return moduleStorageHelpers(store_name).readStorageStr(TOKEN);
    }
    return '';
}

function setToken(url, token, store_name){
    if(isEmpty(store_name)){
        store_name = getSessType(url);
    }

    if(!isEmpty(store_name)){
        moduleStorageHelpers(store_name).writeStorage(TOKEN, token);
    }

}

function removeToken(url, store_name){
    if(isEmpty(store_name)){
        store_name = getSessType(url);
    }
    if(!isEmpty(store_name)){
        moduleStorageHelpers(store_name).removeStorage(TOKEN);
    }
}

// 添加请求拦截器
axios.interceptors.request.use(function (config) {
    // 在发送请求之前做些什么

    // 获取localStorage 内token
    let token = getToken(config.url);

    if(!isEmpty(token)){
		config.headers['Authorization'] = 'Bearer '+token; // 如果token 存在则携带token访问
    }

    return config;

    }, function (error) {
    // 对请求错误做些什么
    return Promise.reject(error);
});


// 添加响应拦截器
axios.interceptors.response.use(function (res) {
    // 对响应数据做点什么
    // eslint-disable-next-line no-console
    // console.log(res.data.code);

    if(res.status !== 200){
        return message.error(res.statusText);
	}

    const sess_type = getSessType(res.config.url);

	// 如果出现401 代表token 失效
	if(res.data.code === 401){
        message.error(res.data.msg);
        removeToken(res.config.url, sess_type);
        if(sess_type === STORE_ADMIN){
            router.push('/Admin/login');
        }else if(sess_type === STORE_SELLER){
            router.push('/Seller/login');
        }else{
            router.push('/user/login');
        }
    }

    // 如果出现402 代表接口无权限 失效
	if(res.data.code === 402){
        return message.error(res.data.msg);
    }

    // 429 代表请求太频繁
	if(res.data.code === 429){
        return message.error("您请求太频繁了，请休息一会");
	}

	// 刷新了token 则重新存放
	if(!isEmpty(res.headers.authorization)){
        const token = res.headers.authorization.split(" ")[1];
        setToken(res.config.url, token, sess_type)
	}

	// 防止多次出现
    message.destroy();

    return res;
  }, function (err) {
    // eslint-disable-next-line no-console
    // console.log(err);

    // 如果地址无法请求
    if(isEmpty(err.response)){
        console.log(err);
        message.error("网络异常，请检查！");
    }

    // 存在状态码
    if (err.response.status) {
        switch(err.response.status){
            case 404:
                message.error('error_code:404');
                break;
            case 500:
                message.error('error_code:500');
                break;
            // case 401:
            // // token 失效
            //     if(err.response.statusText == 'Unauthorized'){
            //         if(err.response.data.message == undefined){
            //         Message.error(err.response.data);
            //         }else{
            //         Message.error(err.response.data.message);
            //         window.location.href='/#/admin/login';
            //         }
            //     }else{
            //         Message.error(err.response.statusText+",Code："+err.response.status+"！");
            //     }
            //     break;

            case 422:
                message.error(returnError(err.response.data));
                break;
            default:
                message.error(err.response.statusText+",error_code："+err.response.status);
            break;
        }

    }else{
        message.error("未知错误,错误信息："+err.response.statusText+"！");
    }

    // 对响应错误做点什么
    return Promise.reject(err);
  });


/*对象转json*/
export function toJson(data){
  return qs.stringify(data);
}

/* apihandle */
export function apiHandle(url,id=0){
    let status = false;
    if(id>0){
        status = true;
        url += '/'+id
    }
    return {url:url,status:status}; // 编辑则为false
}

/*判断是否为空*/
export function isEmpty(str){
  if(str === '' || str === null || str === undefined){
    return true;
  }
  return false;
}


/**
 * get方法，对应get请求
 * @param {String} url [请求的url地址]
 * @param {Object} params [请求时携带的参数]
 */
export function get(url, params){
 return new Promise((resolve, reject) =>{
  axios.get(url, {
   params: params
  })
  .then(res => {
   resolve(res.data);
  })
  .catch(err => {
   reject(err.data)
  })
 });
}

export function put(url, params){
 return new Promise((resolve, reject) =>{
  axios.put(url, qs.stringify(params))
  .then(res => {
   resolve(res.data);
  }, function(){})
  .catch(err => {
   reject(err.data)
  })
 });
}

export function deletes(url, params){
 return new Promise((resolve, reject) =>{
  axios.delete(url, {
   params: params
  })
  .then(res => {
   resolve(res.data);
  })
  .catch(err => {
   reject(err.data)
  })
 });
}
/**
 * post方法，对应post请求
 * @param {String} url [请求的url地址]
 * @param {Object} params [请求时携带的参数]
 */
export function post(url, params) {
 return new Promise((resolve, reject) => {
  axios.post(url, qs.stringify(params))
  .then(res => {
   resolve(res.data);
  })
  .catch(err => {
   reject(err.data)
  })
 });
}

/**
 * post方法，对应post请求,file 文件上传
 * @param {String} url [请求的url地址]
 * @param {Object} params [请求时携带的参数]
 */
export function postfile(url, params) {
    return new Promise((resolve, reject) => {
     axios.post(url, params,{headers:{'Content-Type': 'multipart/form-data'}})
     .then(res => {
      resolve(res.data);
     })
     .catch(err => {
      reject(err.data)
     })
    });
   }
 //Vue.use(axios)
