<script>
import BookList from "./BookList.vue";

export default {
    name: "Home",
    components: { BookList },
    data() {
        return {
            genres: ['Action', 'Adventure', 'Classics', 'Comic Book', 'Graphic Novel',
                'Detective', 'Mystery', 'Fantasy', 'Historical Fiction', 'Horror', 'Literary Fiction',
                'Romance', 'Science Fiction', 'Suspense', 'Thrillers', 'Fiction'],
            imgBooks: '/images/books-slider.svg',
        };
    }
}
</script>

<template>
    <div class="home-container">
        <div class="genres-container">
            <ul class="list-genres" v-for="genre in genres">
                <li>{{ genre }}</li>
            </ul>
        </div>
        <div class="content-container">
            <img class="book-slider" :src=imgBooks width="1250" />
            <BookList></BookList>
        </div>
    </div>
</template>

<style scoped>
* {
    color: #FFFFFF;
    font-family: 'Ubuntu';
}

.home-container {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: stretch;
    align-content: center;
    background-color: #242121;
}

.book-slider {
    padding: 20px 0px 50px 100px;
}

.genres-container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    align-items: stretch;
    align-content: stretch;
}

.list-genres {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: flex-start;
    align-content: center;
    list-style-type: none;
}

.content-container {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: center;
    align-items: stretch;
    align-content: stretch;
}
</style>
