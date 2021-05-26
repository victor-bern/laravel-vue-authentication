import Vue from "vue";
import Vuex from "vuex";


Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        user_token: "",
        user: ""
    },
    actions: {
        setToken({commit}, {token, user}){
            commit('SET_TOKEN', {token, user});
        }
    },
    mutations: {
        SET_TOKEN(state, { token, user}){
            state.user_token = token;
            state.user = user;
        }
    },
    getters: {
        getToken: state => {
            return state.user_token;
        },
        getUser: state => state.user
    }
});

export default store;
