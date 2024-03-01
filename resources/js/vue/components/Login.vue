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
            <form @submit.prevent="loginUser">
                <div class="label-container">
                    <label class="label-form">Email Address</label>
                    <input class="input-label" v-model="email" name="email" placeholder="e.g. stephsmith@lorem.com" type="text"/>
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

<style scoped>

</style>
