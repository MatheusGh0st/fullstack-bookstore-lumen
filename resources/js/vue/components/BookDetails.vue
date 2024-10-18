<script>
import axios from "axios";
import { ref } from "vue";
import { useStore } from "vuex";

export default {
    data() {
        return {
            imageUrl: 'https://www.boldstrokesbooks.com/assets/bsb/images/book-default-cover.jpg',
            imgCartUrl: '/images/cart-default.jpeg',
            imgFavBookUrl: '/images/bx_bx-book-heart.svg',
            currentPage: this.$route.name,
            parameters: this.$route.params.id,
        }
    },

    setup() {
        const store = useStore();
        const book = ref({});
        const author = ref({});
        const reviews = ref([]);
        const reviewUser = ref('');
        const usersNamesReviews = ref({});
        const APP_HOST = process.env.APP_HOST;

        const getBookById = async (id) => {
            try {
                const response = await axios.get(`${APP_HOST}/book/${id}`, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken,
                    }
                });
                book.value = response.data.data;
            } catch (error) {
                console.error(error);
            }
        }

        const getAuthorById = async (id) => {
            try {
                const response = await axios.get(`${APP_HOST}/author/${id}`, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken,
                    }
                });
                author.value = response.data.data;
            } catch (error) {
                console.error(error);
            }
        }

        const getUserNameById = async (id) => {
            try {
                const response = await axios.get(`${APP_HOST}/user/${id}`, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken,
                    }
                });
                return response.data.data;
            } catch(error) {
                console.error(error);
            }
        }

        const postBookToCart = async () => {
            try {
                const response = await axios.post(`${APP_HOST}/cart`,
                    {
                        user_id: store.state.userId,
                            book_id: book.value.book_id,
                            discount: 0.0,
                            total_books: 1,
                            total_price: 1222,
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

        const postBookToFavorite = async () => {
            try {
                const response = await axios.post(`${APP_HOST}/favorites`,
                {
                    user_id: store.state.userId,
                    book_id: book.value.book_id,
                }, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken
                    },
                });
            } catch (error) {
                console.error(error);
            }
        }

        const getReviewsByBookId = async (bookId) => {
            try {
                const response = await axios.get(`${APP_HOST}/reviews/${bookId}`,
                    {
                        headers: {
                            'Authorization': 'Bearer ' + store.state.accessToken
                        },
                    });
                reviews.value = response.data.data;
            } catch (error) {
                console.error(error);
            }
        }

        const postReviewByBookId = async (bookId) => {
            try {
                const response = await axios.post(`${APP_HOST}/review`, {
                    customer_id: store.state.userId,
                    review_book_id: bookId,
                    review: reviewUser.value,
                }, {
                    headers: {
                        'Authorization': 'Bearer ' + store.state.accessToken
                    },
                });
                getReviewsByBookId(bookId);
            } catch (error) {
               console.error(error);
            }
        }

        return {
            book,
            author,
            reviews,
            reviewUser,
            usersNamesReviews,
            getBookById,
            getAuthorById,
            getUserNameById,
            postBookToCart,
            postBookToFavorite,
            getReviewsByBookId,
            postReviewByBookId,
        }
    },
    computed: {
        async fetchedBook() {
            await this.getBookById(this.parameters);
            return this.book;
        }
    },

    async mounted() {
        const bookDetails = await this.fetchedBook;
        await this.getAuthorById(bookDetails.author_id);
        await this.getReviewsByBookId(bookDetails.book_id);
        this.usersNamesReviews = await Promise.all(this.reviews.map(review => this.getUserNameById(review.customer_id)));
    }
}
</script>

<template>
    <div class="book-details-wrapper">
        <div class="book-details-container">
            <div class="book-image">
                <img class="img-book" :src=imageUrl width="300" height="405" />
            </div>
            <div class="text-information" ref="book.value">
                <div class="information-up">
                    <div class="book-title">Title: {{ book.title }}</div>
                    <div class="book-date">Publication Date: {{ book.publication_date }}</div>
                    <div class="book-author">
                        <span v-if="author && author.author_name">Author: {{ author.author_name }}</span>
                        <span v-else>Author: Unknown</span>
                    </div>
                </div>
                <hr>
                <div class="information-down">
                    <div class="author-description">
                        <span v-if="author && author.description">Description: {{ author.description }}</span>
                        <span v-else>Description: None</span>
                    </div>
                    <div class="book-genre">Genre: {{ book.genre }}</div>
                    <div class="book-edition">Edition: {{ book.edition }}</div>
                </div>
            </div>
            <div class="purchase-last-step">
                <div class="book-favorite" @click=postBookToFavorite>
                    <img class="img-fav" :src=imgFavBookUrl width=35 height=35 />
                    <span class="span-fav">Add to favorite</span>
                </div>
                <div class="book-status">Status: {{ book.status }}</div>
                <div class="book-stock">In stock: {{ book.stock }}</div>
                <div class="book-price">Price: {{ book.price }}</div>
                <div class="book-cart"><router-link to="/cart" @click=postBookToCart>Add to Cart</router-link></div>
            </div>
        </div>
        <div class="reviews-container">
            <span class="span-review">Reviews</span>
            <div class="review-item-container">
                <li class="review-container" v-for="(review, i) in reviews" :key="i">
                    <span class="review-by">Review By User&nbsp;</span>
                    <span class="user-name" v-if="usersNamesReviews[i] && usersNamesReviews[i][0]">
                         {{ usersNamesReviews[i][0] }}</span>
                    <span class="user-name" v-else>
                        Unknown
                    </span>
                    <span class="review-text">: {{ review.review }}</span>
                </li>
            </div>
            <div class="review-user">
                <form class="form-review-user" @submit.prevent="postReviewByBookId(book.book_id)">
                    <p><label class="label-review-user">Review of User</label></p>
                    <textarea v-model="reviewUser" class="textarea-review" rows="4" cols="50"></textarea>
                    <br>
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
hr {
    width: 600px;
}

input {
    padding: 5px 10px;
    background-color: #ac0c0c;
    border: 1px solid black;
}

input:hover {
    background-color: #ec513a;
    cursor: pointer;
}

.label-review-user {
    font-weight: bold;
    font-size: 35px;
    padding-top: 60px;
    padding-bottom: 30px;
}

.user-name {
    color: white;
}

.review-by {
    color: black;
}

.img-book {
    border-radius: 5%;
}

.span-review {
    font-weight: bold;
    font-size: 35px;
    padding-top: 60px;
    padding-bottom: 30px;
}

.book-details-wrapper {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    background-color: #242121;
}

.review-container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    border: 1px solid black;
    padding: 5px 15px;
    color: #F38851;
}

.reviews-container {
    padding: 0px 120px 0px 120px;
    background-color: #242121;
}

.book-details-container {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-around;
    align-items: center;
    align-content: center;
    color: #F38851;
    min-height: 100vh;
    background-color: #242121;
}

.book-favorite {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    align-content: center;
    gap: 10px;
}

.book-favorite:nth-child(2) {
  display: block;
  flex-grow: 1;
}

.book-favorite:hover {
    cursor: pointer;
}

.book-price {
    background-color: #f5d5d5;
    border-radius: 5%;
    padding: 5px 10px;
    color: black;
}

.text-information {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: space-around;
    align-items: flex-start;
    align-content: flex-start;
    margin: 10px 0px;
    height: 415px;
    width: 600px;
}

.information-up {
    gap: 10px;
}

.purchase-last-step {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: space-around;
    align-items: center;
    align-content: center;
    height: 415px;
    width: 300px;
    border-radius: 5%;
    border: 1px solid black;
}

.book-cart > a {
    color: #F38851;
    text-decoration: none;
}

.book-cart {
    padding: 5px 10px;
    background-color: #ac0c0c;
    border: 1px solid black;
}

.book-cart:hover {
    background-color: #ec513a;
    cursor: pointer;
}
</style>
