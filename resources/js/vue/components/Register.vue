<template>
    <section>
        <div class="register-container">
            <span class="span-up">Sign Up.</span>
            <form class="form-container" @submit.prevent="storeRegister">
                <div class="label-container">
                    <input class="input-label" v-model="firstName" name="firstName" placeholder="Steph" type="text"/>
                </div>
                <div class="label-container">
                    <input class="input-label" v-model="lastName" name="lastName" placeholder="Smith" type="text"/>
                </div>
                <div class="label-container">
                    <input class="input-label" v-model="user_address" name="user_address" placeholder="Street 123" type="text"/>
                </div>
                <div class="label-container">
                    <input class="input-label" v-model="phone_number" name="phone_number" placeholder="19 999999" type="number"/>
                </div>
                <div class="label-container">
                    <label class="label-form">Role</label>
                    <select v-model="role" name="role">
                        <option v-for="(role, index) in roles" :key="index" :value="role">{{ role }}</option>
                    </select>
                </div>
                <div class="label-container">
                    <label class="label-form">City ID</label>
                </div>
                <div class="label-container">
                    <input class="input-label" v-model="email" name="email" placeholder="E-mail" type="text"/>
                </div>
                <div class="label-container">
                    <input class="input-label" v-model="password" name= "password" placeholder= "Password"type= "password"/>
                </div>
                <button type= "submit">Sign Up.</button>
            </form>
        </div>
    </section>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            firstName: "",
            lastName: "",
            user_address: "",
            phone_number: "",
            city_id: 1,
            role: "",
            email: "",
            password: "",
            roles: ["Author", "Editor", "Publisher", "Illustrator", "Translator"],
        };
    },
    methods: {
        async storeRegister() {
            try {
                const APP_HOST = process.env.APP_HOST;
                const response = await axios.post(`${APP_HOST}/register`, {
                    firstName: this.firstName,
                    lastName: this.lastName,
                    user_address: this.user_address,
                    phone_number: this.phone_number,
                    city_id: this.city_id,
                    role: this.role,
                    email: this.email,
                    password: this.password,
                });

                this.$router.push('/login');
            } catch (err) {
                console.error(err);
            }
        },
    },
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');

* {
    font-family: 'Poppins', sans-serif;
    background-color: #373737;
    color: #FFFFFF;
}

.span-up {
    display: flex;
    font-weight: bold;
    font-size: 35px;
}

.register-container {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: space-evenly;
    align-items: center;
    align-content: center;
    height: 90vh;
    padding-bottom: 10px;
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
    padding: 5px 0px 10px 0px;
}

.label-container > label {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.input-label {
    width: 295px;
    height: 40px;
    background-color: #4b4b4b;
    border-radius: 5px;
    padding-left: 10px;
}

button {
    font-weight: bold;
    font-size: 16px;
    background-color: #B6B6B6;
    color: #EAEAEA;
    width: 300px;
    height: 35px;
    border-radius: 10px;
    border: 1px solid #C4D1EB;
    box-shadow: -1px 3px 2px 0px #E2E2E2;
}

button:hover{
    cursor: pointer;
    background-color: #d3cdcd;
}
</style>
