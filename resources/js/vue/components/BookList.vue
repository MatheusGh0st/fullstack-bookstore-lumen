<script>
    import BookListItem from "./BookListItem.vue";
    import { inject } from "vue";

    export default {
        name: "Book",
        components: {BookListItem},
        data() {
            return {
                currentPage: this.$route.name,
                parameters: this.$route.params.genre,
            }
        },
        setup() {
            const testFodase = inject('testFodase');
            console.log(testFodase);
        }
    }
</script>

<template>
    <div class="book-container">
        <BookListItem :method="parentMethod" :page="currentPage" :paramsPage="parameters"></BookListItem>
    </div>
</template>

<style scoped>
.book-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(auto-fill, 1fr);
    grid-column-gap: 5px;
    grid-row-gap: 100px;
    place-items: center;
    min-height: 100vh;
    background-color: #242121;
    padding-top: 80px;
    padding-bottom: 100px;
}
</style>
