<template>
    <div class="user-profile">
        <main class="container mt-5">
            <div class="row">
                <!-- Информация о пользователе (левая колонка) -->
                <div class="col-md-4">
                    <div class="text-center mb-4">
                        <img src="../components/avatar.jpg" alt="Аватар" class="avatar rounded-circle mb-3">
                        <h2>{{ user.first_name }} {{ user.last_name }}</h2>
                        <p>{{ user.bio }}</p>
                    </div>
                </div>

                <!-- Посты пользователя (правая колонка) -->
                <div class="col-md-8">
                    <PostList :posts="posts" :likedPosts="[]" @like-post="likePost" @add-comment="addComment" />
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import PostList from '@/components/PostList.vue';
import axios from 'axios';
import defaultAvatar from '@/components/avatar.jpg';

export default {
    name: 'UserProfile',
    components: {
        PostList
    },
    data() {
        return {
            user: {
                avatar: '',
                first_name: '',
                last_name: '',
                bio: ''
            },
            posts: []
        };
    },
    computed: {
        userAvatar() {
            return this.user.avatar || this.defaultAvatar;
        }
    },
    async created() {
        await this.fetchUserData();
        await this.fetchPosts();
    },
    methods: {
        async fetchUserData() {
            try {
                const userId = this.$route.params.id;
                const response = await axios.get(`/api/user/${userId}`, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    }
                });
                this.user = response.data;
            } catch (error) {
                console.error('Ошибка при загрузке данных пользователя:', error);
                alert('Не удалось загрузить данные пользователя');
            }
        },
        async fetchPosts() {
            try {
                const userId = this.$route.params.id;
                const response = await axios.get(`/api/user/${userId}/posts`, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    }
                });
                this.posts = response.data;
            } catch (error) {
                console.error('Ошибка при загрузке постов:', error);
                alert('Не удалось загрузить посты');
            }
        },
        async likePost(postId) {
            try {
                await axios.post(`/api/posts/${postId}/like`, {}, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    }
                });
                const postIndex = this.posts.findIndex(post => post.id === postId);
                if (postIndex !== -1) {
                    this.posts[postIndex].likes += 1;
                }
            } catch (error) {
                console.error('Ошибка при лайке поста:', error);
                alert('Не удалось поставить лайк');
            }
        },
        async addComment({ postId, comment }) {
            try {
                const response = await axios.post(`/api/posts/${postId}/comment`, { text: comment }, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    }
                });
                const postIndex = this.posts.findIndex(post => post.id === postId);
                if (postIndex !== -1) {
                    this.posts[postIndex].comments.push(response.data);
                }
            } catch (error) {
                console.error('Ошибка при добавлении комментария:', error);
                alert('Не удалось добавить комментарий');
            }
        }
    }
};
</script>

<style scoped>
.user-profile {
    background: linear-gradient(135deg, #1e1e2f, #2a2a40);
    min-height: 100vh;
    padding: 2rem 0;
    color: #ffffff;
}

.avatar {
    width: 150px;
    height: 150px;
    object-fit: cover;
}

h2 {
    color: #ff6b35;
}
</style>