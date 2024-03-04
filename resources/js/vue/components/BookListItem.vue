<script>
import axios from 'axios';
export default {
    name: "BookListItem",
    data() {
      return {
          imageUrl: 'https://www.boldstrokesbooks.com/assets/bsb/images/book-default-cover.jpg',
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
        <div class="book-image">
            <img :src=imageUrl width="160" height="280" />
        </div>
        <div class="book-title">{{ book.title }}</div>
        <div class="book-author">{{ book.author }}</div>
        <div class="book-genre">{{ book.genre }}</div>
        <div class="book-status">{{ book.status }}</div>
        <div class="book-stock">{{ book.stock }}</div>
        <div class="book-edition">{{ book.edition }}</div>
        <div class="book-date">{{ book.publication_date }}</div>
        <div class="book-price">{{ book.price }}</div>
        <button class="button add-to-cart" @click="">
            Add to Cart
        </button>
        <button class="button read-now">Read Now</button>
    </li>
</template>

<style scoped>
li {
    list-style-type: none;
}
</style>
