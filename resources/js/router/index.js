import { createRouter, createWebHistory } from 'vue-router';
import LandingPage from '@/views/LandingPage.vue';
import AuthPage from '@/views/AuthPage.vue';
import ProfilePage from '@/views/ProfilePage.vue';
import InitiativesPage from '@/views/InitiativesPage.vue';
import InitiativeDetail from '@/views/InitiativeDetail.vue';

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
  },
  {
    path: '/initiatives',
    name: 'Initiatives',
    component: InitiativesPage
  },
  {
    path: '/initiatives/:id',
    name: 'InitiativeDetail',
    component: InitiativeDetail
  },
  {
    path: '/user/:id',
    name: 'UserProfile',
    component: () => import('@/views/UserProfile.vue'),
    meta: { requiresAuth: true }
}
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;