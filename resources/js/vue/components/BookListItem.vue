<script>
    import axios from 'axios';
    import { ref, watch, reactive, inject, provide } from 'vue';
    import { useStore } from 'vuex';

    export default {
        name: "BookListItem",
        props: {
            page: { type: String, required: false },
            paramsPage: { type: String, required: false },
        },
        data() {
            return {
                imageUrl: 'https://www.boldstrokesbooks.com/assets/bsb/images/book-default-cover.jpg',
                imgCartUrl: '/images/cart-default.jpeg',
            };
        },
        setup() {
            const store = useStore();
            const books = ref([]);
            const paginationLinks = inject('paginationLinks');
            const setPaginationLinks = inject('setPaginationLinks');
            const APP_HOST = process.env.APP_HOST;

            const getBooks = async (page = 1) => {
                try {
                    const response = await axios.get(`${APP_HOST}/books?page=${page}`, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken,
                        }
                    });
                    books.value = response.data.data;
                    setPaginationLinks(response.data.links);
                } catch (err) {
                    console.error(err);
                }
            };

            const getBooksByGenre = async (genre) => {
                try {
                    const response = await axios.get(`${APP_HOST}/books/${genre}`, {
                        headers: {
                            'Authorization': 'Bearer ' + store.state.accessToken,
                        }
                    });
                    books.value = response.data.data;
                } catch (err) {
                    console.error(err);
                }
            };

            const postBookToCart = async (bookId) => {
                try {
                    const response = await axios.post(`${APP_HOST}/cart`,
                        {
                            user_id: store.state.userId,
                            book_id: bookId,
                            discount: 0.0,
                            total_books: 1,
                            total_price: 544,
                        }, {
                            headers: {
                                'Authorization': 'Bearer ' + store.state.accessToken,
                            },
                        });
                } catch (error) {
                    console.error('Error adding book to cart:', error);
                    throw error;
                }
            };

            const getBooksByQuery = async (query) => {
                if (query.length == 0) {
                    getBooks();
                    return;
                }

                try {
                    const response = await axios.get(`${APP_HOST}/books/query/${query}`, {
                        headers: {
                            'Authorization': 'Bearer ' + store.state.accessToken,
                        }
                    });
                    books.value = response.data.data;
                } catch (err) {
                    console.error(err);
                }
            };

            watch(
                () => store.state.searchQuery,
                (val, oldVal) => {
                    books.value = [];
                    getBooksByQuery(val);
                }
            );

            watch(
                () => store.state.linkPage,
                (val, oldVal) => {
                    books.value = [];
                    getBooks(val);
                }
            )

            return {
                books,
                getBooks,
                getBooksByGenre,
                postBookToCart,
            };
        },
        mounted() {
            this.books.value = [];
            if (this.page === 'Books' && this.paramsPage) {
                this.getBooksByGenre(this.paramsPage);
            } else {
                this.getBooks();
            }
        }
    };
</script>

<template>
    <li class="book-box" v-for="book in books" :key="book.id">
        <div class="book-item-container">
            <div class="book-image">
                <img class="img-book" :src=imageUrl width="160" height="255" />
            </div>
            <div class="text-information">
                <div class="book-title"><router-link :to="`/book/${book.book_id}`">{{ book.title }}</router-link></div>
                <div class="price-cart-container">
                    <div class="book-price">${{ book.price }}</div>
                    <div class="book-cart">
                        <li><router-link to="/cart" @click=postBookToCart(book.book_id)><img class="img-cart" :src=imgCartUrl width="32" height="32" /></router-link></li>
                    </div>
                </div>
            </div>
            <button class="button-read-now">Read Now</button>
        </div>
    </li>
</template>

<style scoped>
.img-book {
    border-radius: 5%;
}

.book-title > a {
    text-decoration: none;
    color: #F38851
}

.book-title > a:hover {
    cursor: pointer;
    color: #F39971;
}

.book-item-container {
    display: flex;
    flex-direction: column;
    width: 160px;
    justify-content: space-between;
}

.book-item-container:nth-child(2) {
    display: block;
    flex-grow: 1;
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
    max-height: 3.6em;
    font-size: 18px;
    font-weight: 500;
    line-height: 1.2;
    letter-spacing: .1.5rem;
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

.book-cart:hover {
    cursor: pointer;
    background-color: #ec513a;
}

.img-cart {
    margin-right: 2px;
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
    height: 120px;
}

li {
    list-style-type: none;
}
</style>
