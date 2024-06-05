<script>
import axios from "axios";
import { ref } from "vue";
import { useStore } from "vuex";

export default {
    name: "Cart",
    data() {
        return {
            imageUrl: 'https://www.boldstrokesbooks.com/assets/bsb/images/book-default-cover.jpg',
        }
    },
    setup() {
        const store = useStore();
        const carts = ref([]);
        const books = ref({});
        const total_price = ref(0.0);

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

        const getBookById = async (id) => {
            try {
                const response = await axios.get(`http://localhost:5000/book/${id}`, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken
                    }
                });
                return response.data.data;
            } catch (err) {
                console.error(err);
            }
        }

        return {
            carts,
            books,
            total_price,
            getBookById,
            getUserCarts,
        }
    },
    computed: {
        async fetchedCarts() {
            await this.getUserCarts();
            return this.carts;
        }
    },

    async mounted() {
        const cartsDetails = await this.fetchedCarts;
        this.books = await Promise.all(cartsDetails.map(cartDetail => this.getBookById(cartDetail.book_id)));
        this.calculateTotal();
    },
    methods: {
        calculateTotal() {
            this.total_price = 0;
            this.books.forEach(book => {
                this.total_price += book.price;
            });
        }
    }
}
</script>

<template>
    <div class="cart-item-container">
        <div class="cart-container">
            <li class="book-product-container" v-for="book in books">
                <!--
                <div class=book-img> <img :src=imageUrl width=60 height=80 /> </div>
                -->

                <div> {{ book.title }} </div>
                <div> {{ book.stock }} </div>
                <div> {{ book.status }} </div>
                <div> {{ book.genre }} </div>
                <div> {{ book.edition }} </div>
                <div> {{ book.price }} </div>
            </li>
            <hr>
            <div>Total: {{ total_price.toFixed(2) }}</div>
        </div>
    </div>
</template>

<style scoped>
.cart-item-container {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    align-content: center;
    height: 300vh;
    background-color: #242121;
}

.cart-container {
    border: 1px solid black;
}

.book-product-container {

    border: 1px solid black;
}

li {
    list-style: none;
}
</style>
