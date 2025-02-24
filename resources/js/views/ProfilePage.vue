<template>
    <div class="profile-page">
        <main class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <ProfileHeader :user="user" />
                    <ProfileSettings :user="user" @update-user="updateUser" />
                </div>
                <div class="col-md-8">
                    <PostForm @add-post="addPost" />
                    <PostList :posts="posts" :likedPosts="user.likedPosts" @like-post="likePost"
                        @add-comment="addComment" />
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import ProfileHeader from '@/components/ProfileHeader.vue';
import ProfileSettings from '@/components/ProfileSettings.vue';
import PostForm from '@/components/PostForm.vue';
import PostList from '@/components/PostList.vue';
import axios from 'axios';

export default {
    name: 'ProfilePage',
    components: {
        ProfileHeader,
        ProfileSettings,
        PostForm,
        PostList
    },
    data() {
        return {
            user: {
                avatar: '',
                first_name: '',
                last_name: '',
                birthdate: '',
                phone: '',
                email: '',
                bio: '',
                likedPosts: []
            },
            posts: []
        };
    },
    async created() {
        await this.fetchUserData();
        await this.fetchPosts();
    },
    methods: {
        async fetchUserData() {
            try {
                const response = await axios.get('/api/me', {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`,
                        'Accept': 'application/json'
                    }
                });
                console.log('Данные пользователя:', response.data);
                this.user = {
                    ...this.user,
                    ...response.data
                };
            } catch (error) {
                console.error('Ошибка:', error.response);
            }
        },
        async fetchPosts() {
            try {
                const response = await axios.get('/api/posts', {
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
        async addPost(newPost) {
            try {
                const response = await axios.post('/api/posts', { text: newPost }, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    }
                });

                this.posts.unshift({
                    ...response.data,
                    comments: response.data.comments || [],
                    likes: response.data.likes || 0
                });

            } catch (error) {
                console.error('Ошибка при создании поста:', error);
                alert('Не удалось опубликовать пост');
            }
        },
        async likePost(postId) {
            try {
                const response = await axios.post(`/api/posts/${postId}/like`, {}, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    }
                });

                const postIndex = this.posts.findIndex(post => post.id === postId);
                if (postIndex !== -1) {
                    this.posts[postIndex].likes = response.data.likes;

                    if (this.user.likedPosts.includes(postId)) {
                        this.user.likedPosts = this.user.likedPosts.filter(id => id !== postId);
                    } else {
                        this.user.likedPosts = [...this.user.likedPosts, postId];
                    }
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
                    this.posts[postIndex].comments.push({
                        ...response.data,
                        user: this.user
                    });
                }
            } catch (error) {
                console.error('Ошибка при добавлении комментария:', error);
                alert('Не удалось добавить комментарий');
            }
        },
        async updateUser(updatedUser) {
            try {
                const response = await axios.put('/user', updatedUser, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    }
                });
                this.user = response.data;
                alert('Данные успешно обновлены!');
            } catch (error) {
                console.error('Ошибка при обновлении данных:', error);
                alert('Не удалось обновить данные');
            }
        }
    }
};
</script>

<style scoped>
.profile-page {
    background: linear-gradient(135deg, #1e1e2f, #2a2a40);
    min-height: 100vh;
    padding: 2rem 0;
    color: #ffffff;
}
</style>