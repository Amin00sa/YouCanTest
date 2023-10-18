<template>
  <input class="base-input" v-model="inputValue" @input="handleInput">
</template>

<script>
export default {
  props: {
    value: String
  },
  data() {
    return {
      inputValue: this.value
    };
  },
  methods: {
    handleInput() {
      this.$emit('input', this.inputValue);
    }
  }
};
</script>

<style scoped>
/* Base input styles */
</style>
