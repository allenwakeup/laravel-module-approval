import {USER_INFO, STORE_ADMIN, USER_PREFERENCE} from '@/plugins/constant'
import {moduleStorageHelpers} from '@/plugins/function'
import {MUT_SET_PREFERENCE} from '@/store/mutation-types'

const {readStorage} = moduleStorageHelpers(STORE_ADMIN)

// initial state
const state = {
    common: {},
    preferences: {}
}

// getters
const getters = {
    pref: state => {
        if(Object.keys(state.preferences).length){
            return state.preferences;
        } else {
            const user_info = readStorage(USER_INFO);
            if(user_info && user_info.id){
                const userModuleStorage = moduleStorageHelpers(STORE_ADMIN, user_info.id);
                const pref = userModuleStorage.readUserPrefStorage(USER_PREFERENCE);
                if(pref){
                    return pref;
                }
            }
        }
        return {};
    },

    getPref: (state, getters) => (key, callback) => {
        if(getters.pref && getters.pref[key] && typeof callback === 'function'){
            callback(getters.pref[key]);
        }
        return getters.pref[key];
    }
}

// actions
const actions = {
    setPref ({commit, getters}, data) {
        const new_pref = Object.assign({}, getters.pref, data)
        commit(MUT_SET_PREFERENCE, new_pref)
        const userModuleStore = moduleStorageHelpers(
            STORE_ADMIN,
            readStorage(USER_INFO).id
        );
        userModuleStore.writeUserPrefStorage(USER_PREFERENCE, new_pref);

    },
    selectMenu({dispatch, commit, getters}, data) {
        const menu = Object.assign({}, getters.pref.menu, {
            selected: data.selected,
            route: data.route
        })
        dispatch('setPref', {menu})
    }
}

// mutations
const mutations = {
    [MUT_SET_PREFERENCE](state, payload){
        state.preferences = payload;
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
