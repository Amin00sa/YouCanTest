<template>
  <div class="d-xl-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
      <h1>Create Product</h1>
      <ProductForm />
    </div>
  </div>
</template>
<script>
import ProductForm from '@/components/entities/products/ProductForm.vue';

export default {
  components: {
    ProductForm
  }
};
</script>
