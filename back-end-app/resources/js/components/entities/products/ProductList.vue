<template>
  <div>
      <div
          class="collapse navbar-collapse d-flex"
          id="navbarSupportedContent"
      >
          <form @submit.prevent="SearchProduct()" class="form-inline my-2 my-lg-0 d-flex">
              <div class="mb-3">
              <label for="price" class="col-form-label">Price Range</label>
                  <div class="row">
                      <base-input
                          v-model="minPrice"
                          class="col form-control mr-sm-2 mx-2"
                          type="number"
                          placeholder="Min Price"
                          id="minPrice"
                      />
                      <base-input
                          v-model="maxPrice"
                          class="col form-control mr-sm-2 mx-2"
                          type="number"
                          placeholder="Max Price"
                          id="maxPrice"
                      />
                  </div>
              </div>
              <div class="mb-2 mx-4">
                  <label for="category_id" class="form-label">Select Category:</label>
                  <select class="form-control">
                      <option value="" disabled>Select a category</option>
                      <option v-for="category in categories.data" :key="category.id" :value="category.id">
                          {{ category.name }}
                      </option>
                  </select>
              </div>
              <div class="mx-3 mt-5">
              <base-button class="btn btn-success" type="submit">
                  Search
              </base-button>
              </div>
          </form>
      </div>
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
import BaseInput from "../../common/BaseInput";
import BaseButton from "../../common/BaseButton";
import CategoryService from "../../../services/CategoryService";

export default {
    components: {BaseButton, BaseInput},
    data() {
    return {
      products: [], categories: []
    };
  },
  created() {
    this.fetchProducts();
    this.fetchCategories();
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
    },
      fetchCategories() {
          CategoryService.getCategories()
              .then(response => {
                  this.categories = response.data;
              })
              .catch(error => {
                  console.error('Error fetching categories:', error);
              });
      }
    // Add methods for sorting and filtering products if needed
  }
};
</script>
