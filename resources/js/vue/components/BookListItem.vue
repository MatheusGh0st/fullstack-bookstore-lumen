<script>
import axios from 'axios';
export default {
    name: "BookListItem",
    data() {
      return {
          imageUrl: 'https://www.boldstrokesbooks.com/assets/bsb/images/book-default-cover.jpg',
          imgCartUrl: '/images/cart-default.jpeg',
        books: [],
          authors: [],
      };
    },
    mounted() {
        this.getBooks();
        this.getAuthors();
    },
    methods: {
        async getBooks() {
            try {
                const response = await  axios.get('http://localhost:5000/books', { headers: {
                        'Authorization': 'Bearer ' + this.$store.state.accessToken
                    }});
                this.books = response.data;
            } catch (err)
            {
                console.error(err);
            }
        },

        async getAuthors() {
            try {
                const response = await axios.get('http://localhost:5000/authors', { headers: {
                    'Authorization': 'Bearer ' + this.$store.state.accessToken
                    }});
                this.authors = response.data;
            } catch (err) {
                console.error(err);
            }
        }
    }
}
</script>

<template>
    <li class="book-box" v-for="book in books" :key="book.id">
        <div class="book-item-container">
            <div class="book-image">
                <img :src=imageUrl width="160" height="255" />
            </div>
            <div class="text-information">
                <div class="book-title">{{ book.title }}</div>
                <!--            <div class="book-author">{{ book.author }}</div>-->
                <!--            <div class="book-genre">{{ book.genre }}</div>-->
                <!--            <div class="book-status">{{ book.status }}</div>-->
                <!--            <div class="book-stock">{{ book.stock }}</div>-->
                <!--            <div class="book-edition">{{ book.edition }}</div>-->
                <!--            <div class="book-date">{{ book.publication_date }}</div>-->
                <div class="price-cart-container">
                    <div class="book-price">${{ book.price }}</div>
                    <div class="book-cart">
                        <li><router-link to="/cart"><img :src=imgCartUrl width="32" height="32" /></router-link></li>
                    </div>
                </div>
            </div>
            <button class="button-read-now">Read Now</button>
        </div>
    </li>
</template>

<style scoped>
.book-item-container {
    display: flex;
    flex-direction: column;
    width: 160px;
    height: 530px;
}

.button-read-now {
    background-color: #B6B6B6;
    color: #000000;
    font-weight: bold;
    padding: 12px 20px;
    border-radius: 1px;
    border: 1px solid black;
}

.button-read-now:hover {
    cursor: pointer;
    background-color: #d3cdcd;
}

.book-title {
    text-overflow: ellipsis;
    overflow: hidden;
}

.book-price {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f5d5d5;
    width: 100px;
    height: 50px;
    border: 1px solid black;
    color: black;
}

.book-cart {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ac0c0c;
    width: 70px;
    height: 50px;
    border: 1px solid black;
}

.price-cart-container {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-between;
    align-items: center;
    align-content: center;
}

.text-information {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 160px;
    height: 150px;
}

li {
    list-style-type: none;
}
</style>
