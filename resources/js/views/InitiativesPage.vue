<template>
    <div class="initiatives-page">
        <main class="container mt-5">
            <h1 class="display-4 fw-bold mb-4">Инициативы</h1>
            <div class="row">
                <div class="col-md-4 mb-4" v-for="(initiative, index) in initiatives" :key="index">
                    <div class="card h-100 shadow" @click="goToInitiative(initiative.id)">
                        <div class="card-body">
                            <h5 class="card-title">{{ initiative.title }}</h5>
                            <p class="card-text">{{ initiative.description }}</p>
                            <small class="text-muted">Дата релиза: {{ initiative.releaseDate }}</small>
                            <div class="mt-2">
                                <span class="badge bg-primary">{{ initiative.supporters }} поддерживают</span>
                            </div>
                            <button class="btn btn-sm btn-outline-primary mt-2" @click.stop="supportInitiative(initiative.id)">
                                Поддержать
                            </button>
                            <small class="d-block mt-2">Автор: {{ initiative.author }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
export default {
    name: 'InitiativesPage',
    data() {
        return {
            initiatives: [
                {
                    id: 1,
                    title: 'Инициатива 1',
                    description: 'Описание первой инициативы.',
                    releaseDate: '2023-10-01',
                    supporters: 120,
                    author: 'Иван Иванов'
                },
                {
                    id: 2,
                    title: 'Инициатива 2',
                    description: 'Описание второй инициативы.',
                    releaseDate: '2023-10-15',
                    supporters: 85,
                    author: 'Петр Петров'
                },
                {
                    id: 3,
                    title: 'Инициатива 3',
                    description: 'Описание третьей инициативы.',
                    releaseDate: '2023-11-01',
                    supporters: 200,
                    author: 'Сидор Сидоров'
                }
            ]
        };
    },
    methods: {
        goToInitiative(id) {
            this.$router.push({ name: 'InitiativeDetail', params: { id } });
        },
        supportInitiative(id) {
            // Логика для поддержки инициативы
            console.log(`Поддержана инициатива с ID: ${id}`);
        }
    }
}
</script>

<style scoped>
.initiatives-page {
    background: linear-gradient(135deg, #1e1e2f, #2a2a40);
    min-height: 100vh;
    padding: 2rem 0;
    color: #ffffff;
}

.card {
    background: linear-gradient(135deg, #2a2a40, #1e1e2f);
    border: 1px solid rgba(255, 107, 53, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    color: #ffffff;
    cursor: pointer;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(255, 107, 53, 0.3);
}

.card-title {
    color: #ff6b35;
}

.card-text {
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

h1 {
    color: #ff6b35;
}
</style>