<template>
    <div class="profile-page">
        <main class="container mt-5">
            <div class="row">
                <!-- Левая колонка: Профиль и настройки -->
                <div class="col-md-4">
                    <ProfileHeader :user="user" />
                    <ProfileSettings :user="user" @update-user="updateUser" />
                </div>

                <!-- Правая колонка: Стена с постами -->
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
                avatar: 'https://via.placeholder.com/150', // Ссылка на аватарку
                firstName: 'Иван',
                lastName: 'Иванов',
                birthdate: '1990-01-01',
                phone: '+7 (999) 123-45-67',
                email: 'ivan@example.com',
                password: '********',
                likedPosts: [] // Список лайкнутых постов
            },
            posts: [
                {
                    id: 1,
                    text: 'Привет, это мой первый пост!',
                    likes: 10,
                    comments: [
                        { id: 1, text: 'Круто!', author: 'Петр' },
                        { id: 2, text: 'Привет!', author: 'Анна' }
                    ]
                },
                {
                    id: 2,
                    text: 'Сегодня отличный день!',
                    likes: 5,
                    comments: []
                }
            ]
        };
    },
    methods: {
        updateUser(updatedUser) {
            this.user = { ...this.user, ...updatedUser };
            alert('Данные успешно обновлены!');
        },
        addPost(newPost) {
            this.posts.unshift({
                id: Date.now(),
                text: newPost,
                likes: 0,
                comments: []
            });
        },
        likePost(postId) {
            if (this.user.likedPosts.includes(postId)) {
                alert('Вы уже лайкнули этот пост!');
                return;
            }

            const post = this.posts.find(p => p.id === postId);
            if (post) {
                post.likes += 1;
                this.user.likedPosts.push(postId); // Добавляем пост в список лайкнутых
            }
        },
        addComment({ postId, comment }) {
            const post = this.posts.find(p => p.id === postId);
            if (post) {
                post.comments.push({
                    id: Date.now(),
                    text: comment,
                    author: this.user.firstName
                });
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