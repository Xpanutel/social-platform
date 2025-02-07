<template>
    <div class="landing-page">
        <NavBar />
        <main class="container mt-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold mb-4">Добро пожаловать на SocialPlatform!</h1>
                    <p class="lead mb-4">
                        Мы создали эту платформу для того, чтобы молодежь могла общаться, делиться идеями и находить
                        новых друзей. Присоединяйся к нам и начни свой путь в мире новых возможностей!
                    </p>
                    <div class="actions">
                        <router-link to="/register" class="btn btn-primary btn-lg me-3">Зарегистрироваться</router-link>
                        <router-link to="/login" class="btn btn-outline-primary btn-lg">Войти</router-link>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="logo-container p-4 rounded shadow">
                        <div class="logo-text">
                            <span class="logo-vue">Social</span>
                            <span class="logo-social">Platform</span>
                        </div>
                        <p class="logo-slogan mt-3">Общайся. Учись. Развлекайся.</p>
                    </div>
                </div>
            </div>

            <!-- Дополнительная информация -->
            <div class="row mt-5">
                <div class="col-md-4 mb-4" v-for="(card, index) in cards" :key="index">
                    <div class="card h-100 shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ card.title }}</h5>
                            <p class="card-text">{{ card.text }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Футер -->
        <footer class="text-center py-4 mt-5">
            <p class="mb-0">&copy; 2025 SocialPlatform. Все права защищены.</p>
        </footer>
    </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue';

export default {
    name: 'LandingPage',
    components: {
        NavBar
    },
    data() {
        return {
            cards: [
                {
                    title: 'Общение',
                    text: 'Общайся с друзьями, находи единомышленников и делитесь своими идеями.'
                },
                {
                    title: 'Обучение',
                    text: 'Участвуй в вебинарах, читай полезные статьи и развивай свои навыки.'
                },
                {
                    title: 'Развлечения',
                    text: 'Играй в игры, участвуй в конкурсах и получай призы.'
                }
            ]
        };
    }
}
</script>


<style scoped>
.logo-container {
    background: linear-gradient(135deg, #2a2a40, #1e1e2f);
    border: 1px solid rgba(255, 107, 53, 0.2);
    text-align: center;
    padding: 2rem;
}

.logo-text {
    font-size: 3rem;
    font-weight: bold;
    color: #ffffff;
}

.logo-vue {
    color: #42b983;
}

.logo-social {
    color: #ff6b35;
}

.logo-slogan {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.8);
    font-style: italic;
}

.landing-page {
    background: linear-gradient(135deg, #1e1e2f, #2a2a40);
    min-height: 100vh;
    padding: 2rem 0;
    color: #ffffff;
}

h1 {
    color: #ff6b35;
}

.lead {
    color: #a8a8c0;
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

.img-fluid {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-10px);
    }
}

.card {
    background: linear-gradient(135deg, #2a2a40, #1e1e2f);
    border: 1px solid rgba(255, 107, 53, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    color: #ffffff;
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

footer {
    background: linear-gradient(135deg, #1e1e2f, #2a2a40);
    color: #ffffff;
    padding: 1rem 0;
    border-top: 1px solid rgba(255, 107, 53, 0.2);
}

footer p {
    margin: 0;
    color: #a8a8c0;
}

/* Анимация для карточек */
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

.card {
    animation: fadeIn 0.5s ease-in-out;
}

/* Анимация для текста */
@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

h1,
.lead,
.actions {
    animation: slideInLeft 0.8s ease-in-out;
}

/* Анимация для изображения */
@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(20px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.img-fluid {
    animation: slideInRight 0.8s ease-in-out, float 3s ease-in-out infinite;
}
</style>