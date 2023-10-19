<template>
  <div class="d-xl-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
      <RouterLink to="/categories/create">Add new Category</RouterLink>
      <h1>Category List</h1>
      <CategoryList />
    </div>
  </div>
</template>

<script>
import CategoryList from '../../components/entities/categories/CategoryList.vue';

export default {
  components: {
    CategoryList
  }
};
</script>
