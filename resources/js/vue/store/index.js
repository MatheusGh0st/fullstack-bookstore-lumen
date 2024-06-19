import { createStore } from "vuex";
import axios from 'axios';

const defaultState = {
    accessToken: null,
    isLogged: null,
    userId: null,
    searchQuery: null,
    email: null,
    linkPage: null,
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
        },
        setUserId(state, userId) {
            state.userId = userId;
        },
        setSearchQuery(state, query) {
            state.searchQuery = query;
        },
        setEmail(state, email) {
            state.email = email;
        },
        setLinkPage(state, page) {
            state.linkPage = page;
        }
    },
    actions: {
        async loginUser({ commit }, { email, password }) {
            try {
                const response = await axios.post('http://localhost:5000/login', {
                    email, password
                });
                const { access_token } = response.data.message;
                const { user_id } = response.data.message;

                commit('setAccessToken', access_token);
                commit('setUserId', user_id);
                commit('setEmail', email);
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
        },
        setQuery({ commit }, { query }) {
            commit('setSearchQuery', query);
        },
        setLink({ commit }, { page }) {
            commit('setLinkPage', page);
        }
    },
});

export default store;
