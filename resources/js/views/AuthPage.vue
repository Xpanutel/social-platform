<template>
    <div class="auth-page">
        <main class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="auth-container p-4 rounded shadow">
                        <!-- Переключатель между регистрацией и авторизацией -->
                        <div class="text-center mb-4">
                            <button @click="toggleForm('login')"
                                :class="['btn', 'btn-switch', { 'btn-active': isLoginForm }]">
                                Войти
                            </button>
                            <button @click="toggleForm('register')"
                                :class="['btn', 'btn-switch', { 'btn-active': !isLoginForm }]">
                                Зарегистрироваться
                            </button>
                        </div>

                        <!-- Описание для форм -->
                        <div class="text-center mb-4">
                            <p v-if="isLoginForm" class="form-description">
                                Войдите, чтобы общаться с друзьями, делиться идеями и находить новых единомышленников.
                            </p>
                            <p v-else class="form-description">
                                Зарегистрируйтесь, чтобы присоединиться к нашему сообществу. Общайтесь, учитесь и
                                находите новых друзей!
                            </p>
                        </div>

                        <!-- Ошибки -->
                        <div v-if="errorMessage" class="alert alert-danger">
                            {{ errorMessage }}
                        </div>

                        <!-- Форма авторизации -->
                        <transition name="fade" mode="out-in">
                            <form v-if="isLoginForm" @submit.prevent="handleLogin" class="auth-form">
                                <h2 class="text-center mb-4">Вход в систему</h2>
                                <div class="mb-3">
                                    <label for="login-identifier" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="login-identifier"
                                        v-model="loginData.identifier" placeholder="Введите email" required />
                                </div>
                                <div class="mb-3">
                                    <label for="login-password" class="form-label">Пароль</label>
                                    <input type="password" class="form-control" id="login-password"
                                        v-model="loginData.password" placeholder="Введите пароль" required />
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Войти</button>
                                <p class="text-center mt-3">
                                    <router-link to="/forgot-password" class="text-muted">Забыли пароль?</router-link>
                                </p>
                            </form>

                            <!-- Форма регистрации -->
                            <form v-else @submit.prevent="handleRegister" class="auth-form">
                                <h2 class="text-center mb-4">Регистрация</h2>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="register-first-name" class="form-label">Имя</label>
                                        <input type="text" class="form-control" id="register-first-name"
                                            v-model="registerData.first_name" placeholder="Введите имя" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="register-last-name" class="form-label">Фамилия</label>
                                        <input type="text" class="form-control" id="register-last-name"
                                            v-model="registerData.last_name" placeholder="Введите фамилию" required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="register-birthdate" class="form-label">Дата рождения</label>
                                    <input type="date" class="form-control" id="register-birthdate"
                                        v-model="registerData.birthdate" required />
                                </div>
                                <div class="mb-3">
                                    <label for="register-phone" class="form-label">Номер телефона</label>
                                    <input type="tel" class="form-control" id="register-phone"
                                        v-model="registerData.phone" placeholder="Введите номер телефона" required />
                                </div>
                                <div class="mb-3">
                                    <label for="register-email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="register-email"
                                        v-model="registerData.email" placeholder="Введите email" required />
                                </div>
                                <div class="mb-3">
                                    <label for="register-password" class="form-label">Пароль</label>
                                    <input type="password" class="form-control" id="register-password"
                                        v-model="registerData.password" placeholder="Введите пароль" required />
                                </div>
                                <div class="mb-3">
                                    <label for="register-bio" class="form-label">О себе</label>
                                    <textarea class="form-control" id="register-bio" v-model="registerData.bio"
                                        placeholder="Расскажите о себе" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
                            </form>
                        </transition>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'AuthPage',
    data() {
        return {
            isLoginForm: true,
            loginData: {
                identifier: '', // email
                password: ''
            },
            registerData: {
                first_name: '',
                last_name: '',
                birthdate: '',
                phone: '',
                email: '',
                password: '',
                bio: ''
            },
            errorMessage: '' // Для отображения ошибок
        };
    },
    methods: {
        toggleForm(formType) {
            this.isLoginForm = formType === 'login';
            this.errorMessage = ''; // Очистка ошибок при переключении форм
        },

        // Метод для авторизации
        async handleLogin() {
            try {
                const response = await axios.post('/login', {
                    email: this.loginData.identifier,
                    password: this.loginData.password
                });

                // Сохраняем токен в localStorage
                localStorage.setItem('access_token', response.data.access_token);

                // Перенаправляем пользователя на защищенную страницу
                this.$router.push('/profile'); // Замените на ваш маршрут
            } catch (error) {
                if (error.response) {
                    this.errorMessage = error.response.data.message || 'Ошибка при входе';
                } else {
                    this.errorMessage = 'Ошибка сети';
                }
            }
        },

        // Метод для регистрации
        async handleRegister() {
            try {
                const response = await axios.post('/register', this.registerData);

                // Сохраняем токен в localStorage
                localStorage.setItem('access_token', response.data.access_token);

                // Перенаправляем пользователя на защищенную страницу
                this.$router.push('/profile'); // Замените на ваш маршрут
            } catch (error) {
                if (error.response) {
                    // Логируем ошибку
                    console.error('Ошибка при регистрации:', error.response.data);

                    // Отображаем сообщение об ошибке
                    if (error.response.data.errors) {
                        // Если есть ошибки валидации
                        this.errorMessage = Object.values(error.response.data.errors).join(', ');
                    } else {
                        this.errorMessage = error.response.data.message || 'Ошибка при регистрации';
                    }
                } else {
                    this.errorMessage = 'Ошибка сети';
                }
            }
        }
    }
};
</script>

<style scoped>
.auth-page {
    background: linear-gradient(135deg, #1e1e2f, #2a2a40);
    min-height: 100vh;
    padding: 2rem 0;
    color: #ffffff;
}

.auth-container {
    background: linear-gradient(135deg, #2a2a40, #1e1e2f);
    border: 1px solid rgba(255, 107, 53, 0.2);
    animation: fadeIn 0.5s ease-in-out;
}

.auth-form {
    animation: fadeIn 0.5s ease-in-out;
}

.btn-switch {
    background: none;
    border: none;
    color: #a8a8c0;
    font-size: 1.1rem;
    margin: 0 1rem;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
}

.btn-switch.btn-active {
    color: #ff6b35;
    border-bottom: 2px solid #ff6b35;
}

.btn-switch:hover {
    color: #ff6b35;
}

.btn-primary {
    background: linear-gradient(135deg, #ff6b35, #ff9f1c);
    border: none;
    transition: all 0.3s ease;
    color: #ffffff;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.form-control {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #ffffff;
    transition: all 0.3s ease;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.form-control:focus {
    background-color: rgba(255, 255, 255, 0.2);
    border-color: #ff6b35;
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
}

.form-label {
    color: #a8a8c0;
}

.text-muted {
    color: #a8a8c0 !important;
}

.text-muted:hover {
    color: #ff6b35 !important;
}

.form-description {
    color: #a8a8c0;
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Анимация для форм */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>