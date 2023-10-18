import { createRouter, createWebHistory } from 'vue-router'
// import ProductCreate from '@/views/Products/ProductCreate.vue';
import CategoryCreate from '@/views/Categories/CategoryCreate.vue';
// import ProductListPage from '@/views/Products/ProductListPage.vue';
import CategoryListPage from '@/views/Categories/CategoryListPage.vue';
import NotFoundComponent from '@/components/common/NotFoundComponent.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // { path: '/products/create', component: ProductCreate },
    { path: '/categories/create', component: CategoryCreate },
    // { path: '/products', component: ProductListPage },
    { path: '/categories', component: CategoryListPage },
    {
      path: '/:pathMatch(.*)*', // Define a catch-all route with a param and a custom regex
      component: NotFoundComponent
    }
  ]
})

export default router
