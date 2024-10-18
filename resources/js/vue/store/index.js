import { createStore } from "vuex";
import axios from 'axios';
import { useStorage } from "@vueuse/core";

const defaultState = {
    accessToken: null,
    isLogged: null,
    userId: null,
    searchQuery: null,
    email: null,
    linkPage: null,
}

const accessToken = useStorage('access-token', null);
const isLogged = useStorage('is-logged', null);
const userId = useStorage('user-id', null);
const searchQuery = useStorage('search-query', null);
const email = useStorage('email', null);
const linkPage = useStorage('link-page', null);

const store = createStore({
    state() {
        return {
            accessToken: accessToken.value,
            isLogged: !!isLogged.value,
            userId: JSON.parse(userId.value),
            searchQuery: JSON.parse(searchQuery.value),
            email: email.value,
            linkPage: JSON.parse(linkPage.value)
        };
    },
    mutations: {
        setAccessToken(state, token) {
            state.accessToken = token;
            accessToken.value = token;
        },
        setIsLogged(state, isUserLogged) {
            state.isLogged = isUserLogged;
            isLogged.value = isUserLogged
        },
        logout(state) {
            state.accessToken = null;
            state.isLogged = null;
            state.userId = null;
            state.searchQuery = null;
            state.email = null;
            state.linkPage = null;

            accessToken.value = null;
            isLogged.value = null;
            userId.value = null;
            searchQuery.value = null;
            email.value = null;
            linkPage.value = null;
        },
        resetState(state) {
            state.accessToken = null;
            state.isLogged = null;
            state.userId = null;
            state.searchQuery = null;
            state.email = null;
            state.linkPage = null;

            accessToken.value = null;
            isLogged.value = null;
            userId.value = null;
            searchQuery.value = null;
            email.value = null;
            linkPage.value = null;
        },
        setUserId(state, id) {
            state.userId = id;
            userId.value = id;
        },
        setSearchQuery(state, query) {
            state.searchQuery = query;
            searchQuery.value = query;
        },
        setEmail(state, emailUser) {
            state.email = emailUser;
            email.value = emailUser;
        },
        setLinkPage(state, page) {
            state.linkPage = page;
            linkPage.value = page;
        }
    },
    actions: {
        async loginUser({ commit }, { email, password }) {
            try {
                const APP_HOST = process.env.APP_HOST;
                const response = await axios.post(`${APP_HOST}/login`, {
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
