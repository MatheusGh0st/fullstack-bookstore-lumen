<script>
    import { ref } from "vue";
    import axios from "axios";
    import { useStore } from "vuex";

    export default {
        name: "Favorite",
        data() {
            return {
                imageUrl: 'https://www.boldstrokesbooks.com/assets/bsb/images/book-default-cover.jpg',
            }
        },
        setup() {
            const store = useStore();
            const favorites = ref([]);
            const books = ref({});
            const APP_HOST = process.env.APP_HOST;

            const getUserFavorites = async () => {
                const userId = store.state.userId;
                try {
                    const response = await axios.get(`${APP_HOST}/favorites/${userId}`,
                        { headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken,
                    }
                        });
                    favorites.value = response.data.data;
                } catch (err) {
                    console.error(err);
                }
            }

            const getBookById = async (id) => {
                try {
                    const response = await axios.get(`${APP_HOST}/book/${id}`, {
                        headers: {
                            'Authorization': 'Bearer ' + store.state.accessToken
                        }
                    });
                    return response.data.data;
                } catch (err) {
                    console.error(err);
                }
            }

            const removeBookFromFavoriteById = async (id) => {
                try {
                    const response = await axios.delete(`${APP_HOST}/favorites/${id}`, {
                        headers: {
                            'Authorization': 'Bearer ' + store.state.accessToken
                        }
                    });
                    const favoriteId = favorites.value.filter(favorite => favorite.favorites_id === id);
                    const bookFavoriteId = favoriteId[0].book_id;
                    books.value = books.value.filter(book => book.book_id !== bookFavoriteId);
                    favorites.value = favorites.value.filter(favorite => favorite.favorites_id !== id);

                } catch (err) {
                    console.error(err);
                }


            }

            return {
                favorites,
                books,
                getBookById,
                getUserFavorites,
                removeBookFromFavoriteById
            }
        },
        computed: {
            async fetchedFavorites() {
                await this.getUserFavorites();
                return this.favorites;
            }
        },

        async mounted() {
            const favoritesDetails = await this.fetchedFavorites;
            this.books = await Promise.all(favoritesDetails.map(favoriteDetail => this.getBookById(favoriteDetail.book_id)));
        }
    }
</script>

<template>
    <div class="favorite-item-container">
        <span class="span-favorites">Favorites</span>
        <div class="favorite-container">
            <li class="book-container" v-for="(book, i) in books">
                <div class="book-img">
                    <img :src=imageUrl width=60 height=80 />
                </div>
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
                <div class="remove-favorite">
                    <div @click="removeBookFromFavoriteById(favorites[i].favorites_id)" :key="favorites[i].favorites_id">Remove</div>
                </div>
            </li>
        </div>
    </div>
</template>

<style scoped>
.favorite-item-container {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    align-content: center;
    min-height: 100vh;
    background-color: #242121;
}

.span-favorites {
    font-weight: bold;
    font-size: 40px;
    padding-top: 60px;
}

.remove-favorite:hover {
    cursor: pointer;
}

.information-up {
    padding: 5px 10px;
    width: 350px;
}

.information-down {
    padding: 5px 10px;
    width: 120px;
}

.favorite-container {
    width: 700px;
    border: 1px solid black;
}

.book-container {
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
