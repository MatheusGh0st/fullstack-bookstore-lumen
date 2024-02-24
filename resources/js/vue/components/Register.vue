<template>
    <section>
        <div class="register-container">
            <form @submit.prevent="storeRegister">
                <div class="label-container">
                    <label class="label-form">First Name</label>
                    <input class="input-label" v-model="firstName" name="firstName" placeholder="Steph" type="text"/>
                </div>
                <div class="label-container">
                    <label class="label-form">Last Name</label>
                    <input class="input-label" v-model="lastName" name="lastName" placeholder="Smith" type="text"/>
                </div>
                <div class="label-container">
                    <label class="label-form">Address</label>
                    <input class="input-label" v-model="user_address" name="user_address" placeholder="Street 123" type="text"/>
                </div>
                <div class="label-container">
                    <label class="label-form">Phone</label>
                    <input class="input-label" v-model="phone_number" name="phone_number" placeholder="19 999999" type="number"/>
                </div>
                <div class="label-container">
                    <label class="label-form">Role</label>
                    <select v-model="role" name="role">
                        <option v-for="(role, index) in roles" :key="index" :value="role">{{ role }}</option>
                    </select>
                </div>
                <div class="label-container">
                    <label class="label-form">Email Address</label>
                    <input class="input-label" v-model="email" name="email" placeholder="e.g. stephsmith@lorem.com" type="text"/>
                </div>
                <div class="label-container">
                    <label class="label-form">City ID</label>
                </div>
                <div class="label-container">
                    <label class="label-form">Password</label>
                    <input class="input-label" v-model="password" name= "password" placeholder= "Password"type= "password"/>
                </div>
                <button type= "submit">Submit</button>
            </form>
        </div>
    </section>
</template>

<script>
import { ref } from "vue";
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
                const response = await axios.post("http://localhost:5000/register", {
                    firstName: this.firstName,
                    lastName: this.lastName,
                    user_address: this.user_address,
                    phone_number: this.phone_number,
                    city_id: this.city_id,
                    role: this.role,
                    email: this.email,
                    password: this.password,
                });

                console.log(response.data);
            } catch (err) {
                console.error(err);
            }
        },
    },
};
</script>

<style scoped>

</style>
