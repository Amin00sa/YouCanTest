import { createRouter, createWebHistory } from 'vue-router'
import ProductCreate from '../views/Products/ProductCreate.vue';
import CategoryCreate from '../views/Categories/CategoryCreate.vue';
import ProductListPage from '../views/Products/ProductListPage.vue';
import CategoryListPage from '../views/Categories/CategoryListPage.vue';
import NotFoundComponent from '../components/common/NotFoundComponent.vue';
import App from '../App.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/products/create', component: ProductCreate },
    { path: '/', component: App },
    { path: '/categories/create', component: CategoryCreate },
    { path: '/products', component: ProductListPage },
    { path: '/categories', component: CategoryListPage },
    {
      path: '/:pathMatch(.*)*', // Define a catch-all route with a param and a custom regex
      component: NotFoundComponent
    }
  ]
})

export default router
