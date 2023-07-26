<template>
  <div class="py-10 px-16">
    <div class="flex justify-between items-center px-4">
      <h1 class="text-4xl text-green-400">Product List</h1>
      <div class="flex space-x-8">
        <router-link
          :to="{ name: 'add-products' }"
          class="uppercase py-2 px-4 border border-white rounded-md hover:bg-gray-600 hover:border-0"
          >add</router-link
        >
        <button
          class="uppercase py-2 px-4 border border-white rounded-md hover:bg-red-700 hover:border-0"
        >
          mass delete
        </button>
      </div>
    </div>
    <div class="w-full h-[1px] bg-gray-400 mt-4"></div>
    <main class="flex flex-wrap justify-start space-x-16 w-full">
      <div
        v-for="product in products"
        :key="product.id"
        class="w-1/6 pb-12 pt-8 bg-gray-600 mt-10 rounded-lg text-xl text-center flex justify-center items-center relative"
      >
        <input type="checkbox" class="absolute top-4 left-4 w-5 h-5" />
        <div>
          <p>{{ product.sku }}</p>
          <p>{{ product.name }}</p>
          <p>{{ product.price }} $</p>
        </div>
      </div>
    </main>
    <footer class="fixed w-full bottom-12">
      <div class="w-[94%] h-[1px] bg-gray-400 mt-4"></div>
      <p class="flex justify-center items-center text-lg mt-2">Scandiweb Test Assignment</p>
    </footer>
  </div>
</template>
<script setup>
// import { Field, ErrorMessage } from 'vee-validate'
import { ref, onMounted } from 'vue'
import axios from 'axios'

const products = ref([])
const loading = ref(true)

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost:3000/api/all.php?action=fetchall')
    products.value = response.data
    console.log(response)

    loading.value = false
  } catch (error) {
    console.error(error)
    loading.value = false
  }
})
</script>
