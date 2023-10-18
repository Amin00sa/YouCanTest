<template>
  <div>
    <ul>
      <li v-for="product in products.data" :key="product.id">
        {{ product.name }} - {{ product.price }}
      </li>
    </ul>
  </div>
</template>

<script>
import ProductService from '@/services/ProductService.js';

export default {
  data() {
    return {
      products: []
    };
  },
  created() {
    this.fetchProducts();
  },
  methods: {
    fetchProducts() {
      ProductService.getAllProducts()
          .then(response => {
            this.products = response.data;
            console.log(response);
          })
          .catch(error => {
            console.error('Error fetching products:', error);
          });
    }
    // Add methods for sorting and filtering products if needed
  }
};
</script>
