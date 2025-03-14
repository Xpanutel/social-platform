<template>
    <div class="create-initiative">
        <main class="container mt-5">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-primary text-white">
                    <h1 class="h4 mb-0">Создать новую инициативу</h1>
                </div>
                <div class="card-body">
                    <!-- Сообщение об ошибке -->
                    <div v-if="error" class="alert alert-danger">
                        {{ error }}
                    </div>

                    <form @submit.prevent="createInitiative">
                        <!-- Название -->
                        <div class="mb-4">
                            <label for="title" class="form-label">Название инициативы</label>
                            <input
                                type="text"
                                class="form-control"
                                id="title"
                                v-model="form.title"
                                placeholder="Введите название"
                                required
                            />
                            <small class="form-text text-muted">Краткое и понятное название.</small>
                        </div>

                        <!-- Описание -->
                        <div class="mb-4">
                            <label for="description" class="form-label">Описание</label>
                            <textarea
                                class="form-control"
                                id="description"
                                v-model="form.description"
                                rows="5"
                                placeholder="Опишите вашу инициативу"
                                required
                            ></textarea>
                            <small class="form-text text-muted">Подробно расскажите о вашей идее.</small>
                        </div>

                        <!-- Дата релиза -->
                        <div class="mb-4">
                            <label for="release_date" class="form-label">Дата реализации</label>
                            <input
                                type="date"
                                class="form-control"
                                id="release_date"
                                v-model="form.release_date"
                                required
                            />
                            <small class="form-text text-muted">Когда планируется реализация?</small>
                        </div>

                        <!-- Автор -->
                        <div class="mb-4">
                            <label for="author" class="form-label">Автор</label>
                            <input
                                type="text"
                                class="form-control"
                                id="author"
                                v-model="form.author"
                                placeholder="Ваше имя"
                                required
                            />
                            <small class="form-text text-muted">Кто вы?</small>
                        </div>

                        <!-- Кнопка отправки -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-gradient-primary btn-lg">
                                Создать инициативу
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'CreateInitiative',
    data() {
        return {
            form: {
                title: '',
                description: '',
                release_date: '',
                author: ''
            },
            error: ''
        };
    },
    methods: {
        async createInitiative() {
            // Сброс ошибки
            this.error = '';

            // Валидация
            if (!this.form.title || !this.form.description || !this.form.release_date || !this.form.author) {
                this.error = 'Все поля обязательны для заполнения.';
                return;
            }

            try {
                const response = await axios.post('/api/initiatives', this.form, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    }
                });

                this.$router.push({ name: 'Initiatives' });
            } catch (error) {
                console.error('Ошибка при создании инициативы:', error);
                this.error = 'Не удалось создать инициативу. Пожалуйста, попробуйте снова.';
            }
        }
    }
};
</script>

<style scoped>
.create-initiative {
    background: linear-gradient(135deg, #1e1e2f, #2a2a40);
    min-height: 100vh;
    padding: 2rem 0;
    color: #ffffff;
}

.card {
    background: #2a2a40;
    border: 1px solid rgba(255, 107, 53, 0.2);
    border-radius: 10px;
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #ff6b35, #ff9f1c);
    padding: 1.5rem;
    border-bottom: none;
}

.card-body {
    padding: 2rem;
}

.form-control {
    background-color: #1e1e2f;
    border: 1px solid rgba(255, 107, 53, 0.2);
    color: #ffffff;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    background-color: #1e1e2f;
    border-color: #ff6b35;
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
    color: #ffffff;
}

.form-label {
    font-weight: 500;
    color: rgba(255, 255, 255, 0.9);
}

.form-text {
    color: rgba(255, 255, 255, 0.6);
}

.btn-gradient-primary {
    background: linear-gradient(135deg, #ff6b35, #ff9f1c);
    border: none;
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-gradient-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.alert-danger {
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    margin-bottom: 1.5rem;
}
</style>