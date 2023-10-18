<template>
  <div class="d-xl-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
      <RouterLink to="/products/create">Add new Product</RouterLink>
      <h1>Product List</h1>
      <ProductList />
    </div>
  </div>
</template>

<script>
import ProductList from '@/components/entities/products/ProductList.vue';

export default {
  components: {
    ProductList
  }
};
</script>
