<template>
  <div class="bg-light p-4">
    <h2 class="mb-4">Create Category</h2>
    <form @submit.prevent="createCategory" class="form">
      <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <base-input v-model="formData.name" id="name" class="form-control" />
      </div>
      <div class="mb-3">
        <label for="parent_id" class="form-label">Parent:</label>
        <select v-model="formData.parent_id" class="form-control">
          <option value="" disabled>Select a category</option>
          <option v-for="category in categories.data" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
      </div>
      <div class="text-center mt-4">
        <base-button type="submit" class="btn btn-primary">Create Category</base-button>
      </div>
    </form>
  </div>
</template>

<script>
import BaseButton from '@/components/common/BaseButton.vue'
import BaseInput from '@/components/common/BaseInput.vue'
import CategoryService from '@/services/CategoryService.js'

export default {
  components: {
    BaseButton,
    BaseInput
  },
  data() {
    return {
      formData: {
        name: '',
        parent_id : ''
      },
        categories: []
    }
  },
created() {
  this.fetchCategories();
},
  methods: {
    createCategory() {
      CategoryService.createCategory(this.formData)
          .then((response) => {
            // Category created successfully, handle the response
            console.log('Category created:', response.data)
            this.$router.push('/categories');
          })
          .catch((error) => {
            // Handle API error
            console.error('Error creating category:', error)
          })
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
  }
}
</script>
