<script>
    import axios from "axios";
    import { useStore } from "vuex";
    import { useRouter } from 'vue-router';

export default {
    data() {
        return {
            email: this.$store.state.email,
        };
    },
    setup() {
        const store = useStore();
        const router = useRouter();

        const logout = async () => {
            try {
                const response = await axios.post(`http://localhost:5000/logout`, {}, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken,
                    }
                });

                await store.dispatch('logoutUser');

                router.push({ path: '/Login' });
            } catch (error) {
                console.error(error);
            }
        }

        return {
            logout,
        }
    }

}

</script>

<template>
    <section>
        <div class="me-container">
            <span class="span-me">Account</span>
            <form class="form-me-container" @submit.prevent="logout">
                <div class="label-container">
                    <input class="input-label" v-model="email" name="email" type="text" disabled />
                </div>
                <div class="label-container">
                    <input class="input-label" name="password" type="password" />
                </div>
                <div class="btn-container">
                    <button type="submit">Save changes</button>
                    <button type="submit">Logout</button>
                </div>
            </form>
        </div>
    </section>
</template>

<style scoped>
* {
    font-family: 'Poppins', sans-serif;
    background-color: #373737;
    color: #FFFFFF;
}

.span-me {
    font-weight: bold;
    font-size: 40px;
    padding-top: 60px;
}

.btn-container {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    gap: 20px;
}

button {
    font-weight: bold;
    font-size: 18px;
    background-color: #B6B6B6;
    color: #EAEAEA;
    width: 300px;
    height: 40px;
    border-radius: 10px;
    border: 1px solid #C4D1EB;
    box-shadow: -1px 3px 2px 0px #E2E2E2;
}

button:hover {
    cursor: pointer;
    background-color: #D3CDCD;
}

.me-container {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: space-evenly;
    align-items: center;
    align-content: center;
    height: 80vh;
}

.form-container {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    align-content: center;
    padding-bottom: 30px;
}

.label-container {
    padding: 5px 0px 20px 0px;
}

.input-label {
    width: 295px;
    height: 40px;
    background-color: #4b4b4b;
    border-radius: 5px;
    padding-left: 10px;
}
</style>
