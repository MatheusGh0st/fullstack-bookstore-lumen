<script>
import axios from "axios";
import { ref } from "vue";
import { useStore } from "vuex";

export default {
    data() {
        return {
            imageUrl: 'https://www.boldstrokesbooks.com/assets/bsb/images/book-default-cover.jpg',
            imgCartUrl: '/images/cart-default.jpeg',
            currentPage: this.$route.name,
            parameters: this.$route.params.id,
        }
    },

    setup() {
        const store = useStore();
        const book = ref({});
        const author = ref({});

        const getBookById = async (id) => {
            try {
                const response = await axios.get(`http://localhost:5000/book/${id}`, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken,
                    }
                });
                book.value = response.data.data;
            } catch (error) {
                console.error(error);
            }
        }

        const getAuthorById = async (id) => {
            try {
                const response = await axios.get(`http://localhost:5000/author/${id}`, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken,
                    }
                });
                author.value = response.data.data;
            } catch (error) {
                console.error(error);
            }
        }


        return {
            book,
            author,
            getBookById,
            getAuthorById,
        }
    },

    mounted() {
        this.getBookById(this.parameters);
    }
}
</script>

<template>
    <div class="book-details-container">
        <div class="book-image">
            <img class="img-book" :src=imageUrl width="300" height="405" />
        </div>
        <div class="text-information" ref="book.value">
            <div class="information-up">
                <div class="book-title">Title: {{ book.title }}</div>
                <div class="book-date">Publication Date: {{ book.publication_date }}</div>
            </div>
            <hr>
            <div class="information-down">
                <div class="book-genre">Genre: {{ book.genre }}</div>
                <div class="book-edition">Edition: {{ book.edition }}</div>
            </div>
        </div>
        <div class="purchase-last-step">
            <div class="book-status">Status: {{ book.status }}</div>
            <div class="book-stock">In stock: {{ book.stock }}</div>
            <div class="book-price">Price: {{ book.price }}</div>
            <div class="book-cart"><router-link to="/cart">Add to Cart</router-link></div>
        </div>
    </div>
</template>

<style scoped>
hr {
    width: 400px;
}

.img-book {
    border-radius: 5%;
}

.book-details-container {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-around;
    align-items: center;
    align-content: center;
    color: #F38851;
    height: 100vh;
    background-color: #242121;
}

.book-image {
    border: 1px solid black;
}

.book-price {
    background-color: #f5d5d5;
    border-radius: 5%;
    padding: 5px 10px;
    color: black;
}

.text-information {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: space-around;
    align-items: flex-start;
    align-content: flex-start;
    height: 415px;
    width: 600px;
}

.purchase-last-step {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: space-around;
    align-items: center;
    align-content: center;
    height: 415px;
    width: 300px;
    border-radius: 5%;
    border: 1px solid black;
}

.book-cart > a {
    color: #F38851;
    text-decoration: none;
}

.book-cart {
    padding: 5px 10px;
    background-color: #ac0c0c;
    border: 1px solid black;
}

.book-cart:hover {
    background-color: #ec513a;
    cursor: pointer;
}
</style>