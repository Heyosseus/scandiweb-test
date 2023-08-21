<template>
  <div class="flex flex-col md:flex-row justify-between items-center">
    <h1 class="text-4xl text-green-400">Product Add</h1>
    <div class="flex space-x-8 mt-6 lg:mt-0">
      <button
        class="uppercase py-2 px-4 border border-white rounded-md hover:bg-blue-600 hover:border-0"
        type="submit"
        id="save-product-btn"
      >
        {{ props.save }}
      </button>
      <router-link
        :to="{ name: 'home' }"
        class="uppercase py-2 px-4 border border-white rounded-md hover:bg-gray-600 hover:border-0"
        id="cancel-product-btn"
        >{{ props.cancel }}</router-link
      >
    </div>
  </div>
</template>
<script setup>
const props = defineProps({
  save: String,
  cancel: String,
  addProduct: Function
})
</script>
