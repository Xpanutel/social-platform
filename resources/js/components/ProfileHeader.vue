<template>
    <div class="profile-header text-center mb-4">
        <img :src="user.avatar" alt="Аватарка" class="avatar rounded-circle mb-3" />
        <h2>{{ user.first_name }} {{ user.last_name }}</h2>
        <p class="text-muted">Дата рождения: {{ user.birthdate }}</p>
    </div>
</template>

<script>
export default {
    name: 'ProfileHeader',
    props: {
        user: {
            type: Object,
            required: true
        }
    }
};
</script>

<style scoped>
.avatar {
    width: 150px;
    height: 150px;
    object-fit: cover;
}

h2 {
    color: #ff6b35;
}

.text-muted {
    color: #a8a8c0 !important;
}
</style>