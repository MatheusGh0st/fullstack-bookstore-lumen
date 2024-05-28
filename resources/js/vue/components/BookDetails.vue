<script>
import axios from "axios";
import { ref } from "vue";
import { useStore } from "vuex";

export default {
    data() {
        return {
            imageUrl: 'https://www.boldstrokesbooks.com/assets/bsb/images/book-default-cover.jpg',
        }
    },

    setup() {
        const book = ref();

        const getBookById = async (id) => {
            try {
                const response = await axios.get(`http://localhost:5000/book/${id}`, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken,
                    }
                });
                book.value = response.data;
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>

<template>
    <div class="book-details-container">
        <div class="book-image">
            <img class="img-book" :src=imageUrl width="300" height="407" />
        </div>
        <div class="text-information">
            <div class="book-title">{{ book.title }}</div>
            <div class="book-genre">{{ book.genre }}</div>
            <div class="book-status">{{ book.status }}</div>
            <div class="book-stock">{{ book.stock }}</div>
            <div class="book-edition">{{ book.edition }}</div>
            <div class="book-date">{{ book.publication_date }}</div>
        </div>
    </div>
</template>

<style scoped>

</style>
