<template>
  <div class="bg-light p-4">
    <form @submit.prevent="createProduct" class="form">
      <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <base-input v-model="formData.name" id="name" class="form-control" />
      </div>
      <div class="mb-3">
        <select v-model="formData.category_id" class="form-control">
          <option value="" disabled>Select a category</option>
          <option v-for="category in categories.data" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <base-input v-model="formData.description" id="description" class="form-control" />
      </div>
      <div class="mb-3">
        <label for="price" class="form-label">Price:</label>
        <base-input v-model="formData.price" id="price" type="number" class="form-control" />
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Image:</label>
        <input
            type="file"
            id="image"
            @change="handleImageUpload"
            accept="image/*"
            class="form-control"
        />
        <img
            v-if="formData.image"
            :src="formData.image"
            alt="Product Image"
            class="img-fluid mt-3"
        />
      </div>
      <div class="text-center mt-4">
        <base-button type="submit" class="btn btn-primary">Create Product</base-button>
      </div>
    </form>
  </div>
</template>

<script>
import BaseButton from '@/components/common/BaseButton.vue'
import BaseInput from '@/components/common/BaseInput.vue'
import ProductService from '@/services/ProductService.js'
import CategoryService from "@/services/CategoryService";

export default {
  components: {
    BaseButton,
    BaseInput
  },
  created() {
    this.fetchCategories();
  },
  data() {
    return {
      formData: {
        name: '',
        description: '',
        price: '',
        category_id: '',
        image: null // Store the image file here
      },
      categories: []
    }
  },
  // Rest of your component code...
  methods: {
    createProduct() {
      // Create a FormData object and append the form data to it
      const formData = new FormData();
      formData.append('name', this.formData.name);
      formData.append('description', this.formData.description);
      formData.append('price', this.formData.price);
      formData.append('category_id', this.formData.category_id);
      formData.append('image', this.formData.image); // Append the image file to the FormData

      ProductService.createProduct(formData)
          .then((response) => {
            // Product created successfully, handle the response
            console.log('Product created:', response.data)
          })
          .catch((error) => {
            // Handle API error
            console.error('Error creating product:', error)
          })
    },
    handleImageUpload(event) {
      // Get the selected file from the input
      const file = event.target.files[0];
      console.log(file);
      // Update the formData.image property with the selected file
      this.formData.image = file;
    },
    fetchCategories() {
      CategoryService.getCategories()
          .then(response => {
            this.categories = response.data;
          })
          .catch(error => {
            console.error('Error fetching categories:', error);
          });
    },
  }
}
</script>