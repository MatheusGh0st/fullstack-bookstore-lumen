import { createStore } from "vuex";
import axios from 'axios';

const store = createStore({
    state() {
        return {
            accessToken: null,
        }
    },
    mutations: {
        setAccessToken(state, accessToken) {
            state.accessToken = accessToken;
        },
        logout(state) {
            state.accessToken = null;
        },
    },
    actions: {
        async loginUser({ commit }, { email, password }) {
            try {
                const response = await axios.post('http://localhost:5000/login', {
                    email, password
                });
                const { access_token } = response.data.message;

                commit('setAccessToken', access_token);
            } catch (error) {
                console.error(error);
            }
        },
        logoutUser({ commit }) {
            commit('logout');
        },
    },
});

export default store;
