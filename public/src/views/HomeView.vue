<template>
  <div class="py-10 px-20">
    <div class="flex justify-between items-center px-4">
      <h1 class="text-4xl text-green-400">Product List</h1>
      <div class="flex space-x-8">
        <router-link
          :to="{ name: 'add-products' }"
          class="uppercase py-2 px-4 border border-white rounded-md hover:bg-gray-600 hover:border-0 shadow-lg shadow-black"
          >add</router-link
        >
        <button
          class="uppercase py-2 px-4 border border-white rounded-md hover:bg-red-700 hover:border-0 shadow-lg shadow-black"
          @click="deleteSelectedProducts"
        >
          mass delete
        </button>
      </div>
    </div>
    <div class="w-full h-[1px] bg-gray-400 mt-4"></div>
    <main class="flex flex-wrap justify-start w-full">
      <div
        v-for="product in productStore.items"
        :key="product.id"
        class="w-1/5 ml-16 pb-12 pt-8 bg-gray-600 mt-10 rounded-lg text-xl text-center flex justify-center items-center relative shadow-lg shadow-gray-950"
      >
        <input
          type="checkbox"
          class="absolute top-4 left-4 w-5 h-5 cursor-pointer"
          v-model="selectedProducts"
          :value="product.id"
        />
        <div class="flex flex-col space-y-1">
          <p class="uppercase">{{ product.sku }}</p>
          <p>{{ product.name }}</p>
          <p>{{ product.price }}$</p>
          <span v-show="product.size" class="italic">Size: {{ product.size }}MB</span>
          <span v-show="product.weight" class="italic">Weight: {{ product.weight }}KG</span>
          <span v-show="product.dimensions" class="italic"
            >Dimensions: {{ getFormattedDimensions(product.dimensions) }}</span
          >
        </div>
      </div>
    </main>
    <footer class="fixed w-screen bottom-12">
      <div class="w-[94%] h-[1px] bg-gray-400 mt-4"></div>
      <p class="flex justify-center items-center text-lg mt-3 mr-28">Scandiweb Test Assignment</p>
    </footer>
  </div>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import { useProductStore } from '@/stores/products'
import { getFormattedDimensions } from '@/utils/helper.js'
import axios from 'axios'

const products = ref([])
const selectedProducts = ref([])
const productStore = useProductStore()

onMounted(async () => {
  try {
    const response = await axios.get(
      'http://localhost:3000/api/requests/all.php?action=getProducts'
    )
    products.value = response.data
    productStore.items = response.data
  } catch (error) {
    console.error(error)
  }
})
const deleteSelectedProducts = async () => {
  const selectedProductIds = selectedProducts.value

  if (selectedProductIds.length === 0) {
    return
  }

  const formData = {
    action: 'deleteProducts',
    productIds: selectedProductIds
  }

  try {
    await axios.delete('http://localhost:3000/api/requests/action.php', {
      data: formData,
      headers: {
        'Content-Type': 'application/json'
      }
    })
    productStore.deleteSelectedProducts(selectedProductIds)
  } catch (error) {
    console.error(error.response.data)
  }
}
</script>
