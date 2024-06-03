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
                carts.value = response.data.data;
            } catch (err) {
                console.error(err);
            }
        }

        return {
            carts,
            getUserCarts,
        }
    },
    mounted() {
        this.getUserCarts();
    }
}
</script>

<template>
    <li class="cart-box" v-for="cart in carts" :key="cart_id">
        <div class="cart-item-container">
            <div>Total Books: {{ cart.total_books }}</div>
            <div>Discount: {{ cart.discount }}</div>
        </div>
    </li>
</template>

<style scoped>
.cart-box {
    background-color: #242121;
}
</style>
