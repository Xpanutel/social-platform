<template>
    <div class="post-list">
        <div v-for="post in posts" :key="post.id" class="post mb-4 p-4 rounded shadow">
            <p>{{ post.text }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <button @click="handleLike(post.id)"
                    :class="['btn', 'btn-sm', likedPosts.includes(post.id) ? 'btn-primary' : 'btn-outline-primary']"
                    :disabled="likedPosts.includes(post.id)">
                    ❤️ {{ post.likes }}
                </button>
                <small class="text-muted">{{ post.comments.length }} комментариев</small>
            </div>
            <div class="comments mt-3">
                <div v-for="comment in post.comments" :key="comment.id" class="comment mb-2">
                    <strong>{{ comment.user.name }}:</strong> {{ comment.text }}
                </div>
                <input type="text" class="form-control mt-2" v-model="newComments[post.id]"
                    @keyup.enter="handleComment(post.id)" placeholder="Добавить комментарий" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostList',
    props: {
        posts: {
            type: Array,
            required: true
        },
        likedPosts: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            newComments: {}
        };
    },
    methods: {
        handleLike(postId) {
            this.$emit('like-post', postId);
        },
        handleComment(postId) {
            if (this.newComments[postId]?.trim()) {
                this.$emit('add-comment', { postId, comment: this.newComments[postId] });
                this.newComments[postId] = '';
            }
        }
    }
};
</script>

<style scoped>
.post {
    background: linear-gradient(135deg, #2a2a40, #1e1e2f);
    border: 1px solid rgba(255, 107, 53, 0.2);
}

.comment {
    background: rgba(255, 255, 255, 0.05);
    padding: 0.5rem;
    border-radius: 5px;
}

.form-control {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #ffffff;
}

.form-control:focus {
    background-color: rgba(255, 255, 255, 0.2);
    border-color: #ff6b35;
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
}
</style>