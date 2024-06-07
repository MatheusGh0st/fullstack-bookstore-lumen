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

        const calculateTotal = () => {
            total_price.value = 0;
            books.value.map(book => {
                total_price.value += book.price;
            });
        };

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

        const removeBookFromCartById = async (id) => {
            try {
                const response = await axios.delete(`http://localhost:5000/cart/${id}`, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken
                    }
                });
                const cardId = carts.value.filter(cart => cart.cart_id === id);
                const bookCartId = cardId[0].book_id;
                books.value = books.value.filter(book => book.book_id !== bookCartId);
                carts.value = carts.value.filter(cart => cart.cart_id !== id);
                calculateTotal();
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
            removeBookFromCartById,
            calculateTotal
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
    }
}
</script>

<template>
    <div class="cart-item-container">
        <div class="cart-container">
            <li class="book-product-container" v-for="(book, i) in books">
                <div class=book-img> <img :src=imageUrl width=60 height=80 /> </div>

                <div class="information-up">
                    <div> {{ book.title }} </div>
                    <div>Genre: {{ book.genre }} </div>
                    <div>Status: {{ book.status }} </div>
                </div>

                <div class="information-down">
                    <div>In Stock: {{ book.stock }} </div>
                    <div>Edition: {{ book.edition }} </div>
                    <div>$ {{ book.price }} </div>
                </div>

                <div class="remove-cart">
                    <div @click="removeBookFromCartById(carts[i].cart_id)" :key="carts[i].cart_id">Remove {{ carts[i].cart_id }}</div>
                </div>
            </li>
            <div class="cart-price">Total: {{ total_price.toFixed(2) }}</div>
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
    height: 100vh;
    background-color: #242121;
}

.remove-cart:hover {
    cursor: pointer;
}

.cart-price {
    display: flex;
    flex-direction: row;
    justify-content: center;
}

.information-up {
    padding: 5px 10px;
    width: 350px;
}

.information-down {
    padding: 5px 10px;
    width: 120px;
}

.cart-container {
    width: 700px;
    border: 1px solid black;
}

.book-product-container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    align-content: center;
    border: 1px solid black;
}

li {
    list-style: none;
}
</style>
