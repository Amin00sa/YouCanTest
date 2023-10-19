<template>
  <div>
    <ul>
      <li v-for="product in products.data" :key="product.id">
        <ul>
          <li>
            Id : {{ product.id }}
          </li>
          <li>
            Name : {{ product.name }}
          </li>
          <li>
            Description : {{ product.description }}
          </li>
          <li>
            Image : <img :src="product.image" style="width: 100px; height: 50px">
          </li>
          <li v-if="product.category != null">
            Parent Name : {{product.category?.name}}
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<script>
import ProductService from '../../../services/ProductService.js';

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
