import { createRouter, createWebHistory } from 'vue-router';
import LandingPage from '@/views/LandingPage.vue';
import AuthPage from '@/views/AuthPage.vue';
import ProfilePage from '@/views/ProfilePage.vue';

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
  },
  {
    path: '/profile',
    name: 'ProfilePage',
    component: ProfilePage
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;