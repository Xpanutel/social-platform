<template>
    <div class="initiative-detail">
        <main class="container mt-5">
            <h1 class="display-4 fw-bold mb-4">{{ initiative.title }}</h1>
            <p class="lead mb-4">{{ initiative.description }}</p>
            <div class="mb-4">
                <small class="text-muted">Дата релиза: {{ initiative.releaseDate }}</small>
                <div class="mt-2">
                    <span class="badge bg-primary">{{ initiative.supporters }} поддерживают</span>
                </div>
                <button class="btn btn-sm btn-outline-primary mt-2" @click="supportInitiative(initiative.id)">
                    Поддержать
                </button>
                <small class="d-block mt-2">Автор: {{ initiative.author }}</small>
            </div>
            <router-link to="/initiatives" class="btn btn-secondary">Назад к инициативам</router-link>
        </main>
    </div>
</template>

<script>
export default {
    name: 'InitiativeDetail',
    data() {
        return {
            initiative: {
                id: this.$route.params.id,
                title: 'Инициатива 1',
                description: 'Описание первой инициативы.',
                releaseDate: '2023-10-01',
                supporters: 120,
                author: 'Иван Иванов'
            }
        };
    },
    methods: {
        supportInitiative(id) {
            // Логика для поддержки инициативы
            console.log(`Поддержана инициатива с ID: ${id}`);
        }
    }
}
</script>

<style scoped>
.initiative-detail {
    background: linear-gradient(135deg, #1e1e2f, #2a2a40);
    min-height: 100vh;
    padding: 2rem 0;
    color: #ffffff;
}

.lead {
    color: #a8a8c0;
}

.badge {
    background: linear-gradient(135deg, #ff6b35, #ff9f1c);
}

.btn-outline-primary {
    color: #ff6b35;
    border-color: #ff6b35;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: linear-gradient(135deg, #ff6b35, #ff9f1c);
    color: white;
    transform: translateY(-2px);
}
</style>