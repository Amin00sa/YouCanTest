<template>
  <ol>
    <li v-for="category in categories.data" :key="category.id">
      <ul>
        <li>
          Id : {{ category.id }}
        </li>
        <li>
          Name {{ category.name }}
        </li>
        <li v-if="category.parent != null">
          Parent Name {{category.parent?.name}}
        </li>
      </ul>
    </li>
  </ol>
</template>

<script>
import CategoryService from '@/services/CategoryService.js';

export default {
  data() {
    return {
      categories: []
    };
  },
  created() {
    this.fetchCategories();
  },
  methods: {
    fetchCategories() {
      CategoryService.getCategories()
          .then(response => {
            this.categories = response.data;
          })
          .catch(error => {
            console.error('Error fetching categories:', error);
          });
    }
    // Add methods for sorting and filtering categories if needed
  }
};
</script>
