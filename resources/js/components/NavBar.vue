<template>
    <header class="shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-dark container">
            <router-link to="/" class="navbar-brand">SocialPlatform</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">Главная</router-link>
                    </li>
                    <li v-if="isAuthenticated" class="nav-item">
                        <router-link to="/profile" class="nav-link">Профиль</router-link>
                    </li>
                    <li class="nav-item" v-if="!isAuthenticated">
                        <router-link to="/auth" class="nav-link btn btn-gradient ms-3">Войти</router-link>
                    </li>
                    <li class="nav-item" v-if="isAuthenticated">
                        <button @click="logout" class="nav-link btn btn-gradient ms-3 btn-logout">Выйти</button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'NavBar',
    data() {
        return {
            isAuthenticated: false 
        }
    },
    mounted() {
        this.checkAuthStatus(); 
        window.addEventListener('storage', this.checkAuthStatus); // Следим за изменениями в localStorage
        this.$root.$on('update-auth-status', this.checkAuthStatus); // Слушаем глобальное событие
    },
    beforeUnmount() {
        window.removeEventListener('storage', this.checkAuthStatus); // Убираем слушатель при уничтожении компонента
        this.$root.$off('update-auth-status', this.checkAuthStatus); // Убираем слушатель глобального события
    },
    methods: {
        checkAuthStatus() {
            this.isAuthenticated = localStorage.getItem('access_token') !== null;
        },
        logout() {
            localStorage.removeItem('access_token');
            this.isAuthenticated = false; // Вручную обновляем состояние
            this.$router.push('/auth');
            this.$root.$emit('update-auth-status'); // Уведомляем другие компоненты
        }
    }
}
</script>

<style scoped>
header {
    background: linear-gradient(135deg, #1e1e2f, #2a2a40);
    border-bottom: 1px solid rgba(255, 107, 53, 0.2);
    padding: 1rem 0;
}

.navbar-brand {
    font-size: 1.5rem;
    font-weight: bold;
    color: #ff6b35 !important;
    transition: all 0.3s ease;
}

.navbar-brand:hover {
    color: #ff9f1c !important;
}

.nav-link {
    color: rgba(255, 255, 255, 0.8) !important;
    transition: all 0.3s ease;
}

.nav-link:hover {
    color: #ff6b35 !important;
    transform: translateY(-2px);
}

.btn-gradient {
    background: linear-gradient(135deg, #ff6b35, #ff9f1c);
    border: none;
    color: white;
    padding: 0.5rem 2rem;
    border-radius: 10px;
    transition: all 0.3s ease;
    display: inline-block;
    min-width: 100px;
    text-align: center;
    cursor: pointer; 
}

.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.btn-logout {
    background: linear-gradient(135deg, #dc3545, #c82333); 
}

.btn-logout:hover {
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3); 
}

.navbar-toggler {
    border-color: rgba(255, 107, 53, 0.5);
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 107, 53, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3Csvg%3E");
}
</style>