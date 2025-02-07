<template>
    <div class="post-form mb-4">
        <textarea class="form-control mb-3" v-model="postText" placeholder="Что у вас нового?" rows="3"></textarea>
        <button @click="handleSubmit" class="btn btn-primary w-100">Опубликовать</button>
    </div>
</template>

<script>
export default {
    name: 'PostForm',
    data() {
        return {
            postText: ''
        };
    },
    methods: {
        handleSubmit() {
            if (this.postText.trim()) {
                this.$emit('add-post', this.postText);
                this.postText = '';
            }
        }
    }
};
</script>

<style scoped>
.post-form textarea {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #ffffff;
}

.post-form textarea:focus {
    background-color: rgba(255, 255, 255, 0.2);
    border-color: #ff6b35;
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
}
</style>