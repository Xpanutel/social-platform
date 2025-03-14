<template>
    <div class="initiatives-page">
        <main class="container mt-5">
            <h1 class="display-4 fw-bold mb-4">Инициативы</h1>
            <!-- Кнопка создания инициативы -->
            <router-link to="/initiatives/create" class="btn btn-outline-primary btn-lg mb-4">
                Создать инициативу
            </router-link>
            <div class="row">
                <div class="col-md-4 mb-4" v-for="(initiative, index) in initiatives" :key="index">
                    <div class="card h-100 shadow" @click="goToInitiative(initiative.id)">
                        <div class="card-body">
                            <h5 class="card-title">{{ initiative.title }}</h5>
                            <!-- Обрезанное описание -->
                            <p class="card-text">{{ truncateDescription(initiative.description, 150) }}</p>
                            <small class="text-muted">Дата релиза: {{ initiative.release_date }}</small>
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
import axios from 'axios';

export default {
    name: 'InitiativesPage',
    data() {
        return {
            initiatives: []
        };
    },
    async created() {
        await this.fetchInitiatives();
    },
    methods: {
        async fetchInitiatives() {
            try {
                const response = await axios.get('/api/initiatives', {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    }
                });
                this.initiatives = response.data;
            } catch (error) {
                console.error('Ошибка при загрузке инициатив:', error);
                alert('Не удалось загрузить инициативы');
            }
        },
        goToInitiative(id) {
            this.$router.push({ name: 'InitiativeDetail', params: { id } });
        },
        async supportInitiative(id) {
            try {
                const response = await axios.post(`/api/initiatives/${id}/support`, {}, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    }
                });
                const initiativeIndex = this.initiatives.findIndex(initiative => initiative.id === id);
                if (initiativeIndex !== -1) {
                    this.initiatives[initiativeIndex].supporters = response.data.supporters;
                }
            } catch (error) {
                console.error('Ошибка при поддержке инициативы:', error);
                alert('Не удалось поддержать инициативу');
            }
        },
        truncateDescription(text, maxLength) {
            if (text.length > maxLength) {
                return text.substring(0, maxLength) + '...';
            }
            return text;
        }
    }
};
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