<script>
import BookList from "./BookList.vue";
import { ref, provide, inject } from "vue";
import { useStore } from "vuex";

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
    },
    setup() {
        const store = useStore();
        const paginationLinks = ref({});
        const setPaginationLinks = (links) => {
            paginationLinks.value = links;
        };

        provide('paginationLinks', paginationLinks);
        provide('setPaginationLinks', setPaginationLinks);

        const setLinkPage = async (page) => {
            await store.dispatch('setLink', { page: page });
        };

        const regex = /\?page=(\d+)/;

        return {
            paginationLinks,
            setLinkPage,
            regex
        };
    }
}
</script>

<template>
    <div class="home-container">
        <div class="genres-container">
            <ul class="list-genres" v-for="genre in genres">
                <li><router-link :to="`/books/${genre.toLowerCase()}`">{{ genre }}</router-link></li>
            </ul>
        </div>
        <div class="content-container">
            <img class="book-slider" :src=imgBooks width="1250" />
            <BookList></BookList>
            <div class="paginate-container">
                <ul class="paginate-list" v-for="paginationLink in paginationLinks">
                    <li @click=setLinkPage(paginationLink.url?.match(regex)[1]) v-if=parseInt(paginationLink.url?.match(regex)[1])>{{ paginationLink.url?.match(regex)[1] }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>
* {
    color: #FFFFFF;
    font-family: 'Ubuntu';
}

li {
    list-style-type: none;
}

li:hover {
    cursor: pointer;
}

li > a {
   text-decoration: none;
}

.home-container {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: stretch;
    align-content: center;
    background-color: #242121;
    min-height: 100vh;
}

.paginate-container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    align-content: center;
}

.book-slider {
    padding: 20px 0px 60px 0px;
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
    min-height: 100vh;
    align-content: center;
}
</style>
