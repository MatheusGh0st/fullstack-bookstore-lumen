<script>
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        async loginUser() {
            try {
                await this.$store.dispatch('loginUser', { email: this.email, password: this.password });

                this.$router.push('/Home');
            } catch (err)
            {
                console.error(err);
            }
        }
    }
}
</script>

<template>
    <section>
        <div class="login-container">
            <span class="span-sign">Sign In.</span>
            <form class="form-container" @submit.prevent="loginUser">
                <div class="label-container">
                    <input class="input-label" v-model="email" name="email" placeholder="E-mail" type="text"/>
                </div>
                <div class="label-container">
                    <input class="input-label" v-model="password" name= "password" placeholder= "Password" type="password"/>
                </div>
                <button type="submit">Sign In.</button>
                <span class="span-account">doest have an account? <router-link to="/register">Create a account</router-link></span>
            </form>
        </div>
    </section>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');

* {
    font-family: 'Poppins', sans-serif;
    background-color: #373737;
    color: #FFFFFF;
}

.login-container {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: space-evenly;
    align-items: center;
    align-content: center;
    height: 90vh;
}

.form-container {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    align-content: center;
}


.label-container {
    padding: 5px 0px 20px 0px;
}

.input-label {
    width: 295px;
    height: 40px;
    border-radius: 5px;
}

button {
    width: 300px;
    height: 40px;
    border-radius: 5px;
}
</style>
