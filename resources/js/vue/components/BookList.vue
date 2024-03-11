<script>
import BookListItem from "./BookListItem.vue";

export default {
    name: "Book",
    components: {BookListItem}
}
</script>

<template>
    <div class="book-container">
        <BookListItem></BookListItem>
    </div>
</template>

<style scoped>
 .book-container {
     display: grid;
     grid-template-columns: repeat(3, 1fr);
     grid-template-rows: repeat(3, 1fr);
     grid-column-gap: 5px;
     grid-row-gap: 5px;
     padding: 10px 10px;
     align-items: center;
     justify-content: center;
     align-content: center;
     justify-items: center;
 }
</style>
