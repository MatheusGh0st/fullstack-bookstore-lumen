<script>
    import { ref } from "vue";
    import axios from "axios";
    import { useStore } from "vuex";

    export default {
        name: "Notification",
        setup() {
            const store = useStore();
            const notifications = ref([]);
            const APP_HOST = process.env.APP_HOST;

            const getUserNotifications = async () => {
                const userId = store.state.userId;
                try {
                    const response = await axios.get(`${APP_HOST}/notifications/${userId}`, {
                        headers: {
                            'Authorization': 'Bearer ' + store.state.accessToken,
                        }
                    });
                    notifications.value = response.data.data;
                } catch (err) {
                    console.error(err);
                }
            }

            const removeNotificationById = async (id) => {
                try {
                    const response = await axios.delete(`${APP_HOST}/notification/${id}`, {
                        headers: {
                            'Authorization': 'Bearer ' + store.state.accessToken
                        }
                    });
                    notifications.value = notifications.value.filter(notification => notification.notification_id !== id);
                } catch (err) {
                    console.error(err);
                }
            }

            getUserNotifications();

            return {
                getUserNotifications,
                removeNotificationById,
                notifications,
            }
        },
    }
</script>

<template>
    <div class="notification-container">
        <span class="span-notifications">Notifications</span>
        <div class="notification-item-container">
            <li class="notification-wrap" v-for="(notification, i) in notifications">
                <div>
                    <span>Message: {{ notification.message }}</span>
                </div>
                <div class="remove-notification">
                    <div @click="removeNotificationById(notification.notification_id)" :key="notification.notification_id">
                        Remove
                    </div>
                </div>
            </li>
        </div>
    </div>
</template>

<style scoped>
.notification-container {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    align-content: center;
    min-height: 100vh;
    background-color: #242121;
}

.notification-wrap {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    align-content: center;
    min-height: 50px;
    border: 1px solid black;
}

.span-notifications {
    font-weight: bold;
    font-size: 40px;
    padding-top: 60px;
    padding-bottom: 50px;
}

.remove-notification:hover {
    cursor: pointer;
}

.notification-item-container {
    width: 700px;
    border: 1px solid black;
}

li {
    list-style: none;
}
</style>
