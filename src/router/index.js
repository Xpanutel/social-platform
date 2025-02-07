import { createRouter, createWebHistory } from 'vue-router';
import LandingPage from '@/views/LandingPage.vue';
import AuthPage from '@/views/AuthPage.vue';

const routes = [
  {
    path: '/',
    name: 'LandingPage',
    component: LandingPage
  },
  {
    path: '/auth',
    name: 'AuthPage',
    component: AuthPage
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;