import { createStore } from "vuex";
import axios from 'axios';

const defaultState = {
    accessToken: null,
    isLogged: null,
}

const store = createStore({
    state() {
        return { ...defaultState };
    },
    mutations: {
        setAccessToken(state, accessToken) {
            state.accessToken = accessToken;
        },
        setIsLogged(state, isLogged) {
            state.isLogged = isLogged;
        },
        logout(state) {
            state.accessToken = null;
        },
        resetState(state) {
            Object.assign(state, defaultState);
        }
    },
    actions: {
        async loginUser({ commit }, { email, password }) {
            try {
                const response = await axios.post('http://localhost:5000/login', {
                    email, password
                });
                const { access_token } = response.data.message;

                commit('setAccessToken', access_token);
                const userIsLogged = (access_token !== null);
                commit('setIsLogged', userIsLogged);
            } catch (error) {
                console.error(error);
            }
        },
        logoutUser({ commit }) {
            commit('logout');
        },
        resetUserState({ commit }) {
            commit('resetState');
        }
    },
});

export default store;
