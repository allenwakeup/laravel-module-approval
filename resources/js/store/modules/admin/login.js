import {STORE_ADMIN, TOKEN, IS_LOGIN, USER_INFO} from '@/plugins/constant'
import {MUT_LOGIN, MUT_LOGOUT} from '@/store/mutation-types'
import {moduleStorageHelpers} from '@/plugins/function'

const {writeStorage, readStorage, removeStorage} = moduleStorageHelpers(STORE_ADMIN)

// initial state
const state = {
    isLogin: false,
    userInfo: {}
}

// getters
const getters = {
    userInfo: state => Object.keys(state.userInfo).length > 0 ? state.userInfo : (readStorage (USER_INFO) || {}),
    isLogin: state => state.isLogin || readStorage (IS_LOGIN)
}

// actions
const actions = {
    login({dispatch, commit}, e){
        if(e.code === 200){
            const data = Object.assign({}, e.data, { is_login: (e.data.hasOwnProperty('token')
                    && typeof e.data.token === 'string'
                    && e.data.token.length > 0) });
            writeStorage(TOKEN, data.token)
            commit(MUT_LOGIN, data);
            dispatch('remember', data).then(() => {

            })
        }
    },
    logout({commit}){
        commit(MUT_LOGOUT);
        removeStorage(TOKEN)
        removeStorage(USER_INFO)
        removeStorage(IS_LOGIN)
    },
    remember({dispatch}, data){
        writeStorage(IS_LOGIN, data.is_login)
        dispatch('update', data).then(() => {

        })
    },
    update({state}, data){
        writeStorage(USER_INFO, data.user_info)
    }
}

// mutations
const mutations = {
    [MUT_LOGIN](state, payload){
        state.isLogin = payload.is_login;
        state.userInfo = payload.user_info;
    },
    [MUT_LOGOUT](state){
        state.isLogin = false;
        state.userInfo = {};
        removeStorage(TOKEN)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
