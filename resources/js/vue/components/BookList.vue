<script>
import BookListItem from "./BookListItem.vue";

export default {
    name: "Book",
    components: {BookListItem},
    data() {
        return {
            currentPage: this.$route.name,
            parameters: this.$route.params.genre,
        }
    }
}
</script>

<template>
    <div class="book-container">
        <BookListItem :page="currentPage" :paramsPage="parameters"></BookListItem>
    </div>
</template>

<style scoped>
.book-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(5, 1fr);
    grid-column-gap: 5px;
    grid-row-gap: 100px;
    place-items: center;
    background-color: #242121;
    padding-top: 80px;
}
</style>
