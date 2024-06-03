<script>
import axios from "axios";
import { ref } from "vue";
import { useStore } from "vuex";

export default {
    name: "Cart",
    setup() {
        const store = useStore();
        const carts = ref([]);

        const getUserCarts = async () => {
            const userId = store.state.userId;
            try {
                const response = await axios.get(`http://localhost:5000/cart/${userId}`, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken,
                    }
                });
                carts.value = response.data?.data;
                console.log(response.data);
            } catch (err) {
                console.error(err);
            }
        }

        return {
            getUserCarts
        }
    },
    mounted() {
        this.getUserCarts();
    }
}
</script>

<template>
    <div class="cart-container">
        <li v-for="cart in carts" :key="cart.id">
            <div class="cart-item-container">
                <div>
                    {{ cart.total_books }}
                </div>
            </div>
        </li>
    </div>
</template>

<style scoped>

</style>
