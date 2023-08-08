<template>
  <div>
    <div class="py-10 px-4 md:px-20">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <h1 class="text-4xl text-green-400 mb-4 md:mb-0">Product List</h1>

        <div class="flex md:flex-row md:flex space-y-4 md:space-y-0 space-x-8">
          <router-link
            :to="{ name: 'add-products' }"
            class="uppercase py-2 px-4 border mt-4 md:mt-0 border-white text-center rounded-md hover:bg-gray-600 hover:border-0 shadow-lg shadow-black"
            id="ADD"
            >ADD</router-link
          >
          <button
            class="uppercase py-2 px-4 border border-white rounded-md hover:bg-red-700 hover:border-0 shadow-lg shadow-black"
            @click="deleteSelectedProducts"
            id="MASS_DELETE"
          >
            MASS DELETE
          </button>
        </div>
      </div>
      <div class="w-full h-[1px] bg-gray-400 mt-4"></div>
      <main class="flex flex-wrap justify-start w-full lg:w-screen max-h-[70vh] overflow-y-scroll">
        <div
          v-for="product in productStore.items"
          :key="product.id"
          class="w-full md:w-1/5 ml-2 md:ml-6 pb-12 pt-8 bg-gray-600 mt-4 md:mt-10 rounded-lg text-xl text-center flex justify-center items-center relative shadow-lg shadow-gray-950"
        >
          <input
            type="checkbox"
            class="absolute top-4 left-4 w-5 h-5 cursor-pointer delete-checkbox"
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
    </div>
    <BaseFooter />
  </div>
</template>
<script setup>
import BaseFooter from '@/components/layout/BaseFooter.vue'
import { ref, onMounted } from 'vue'
import { useProductStore } from '@/stores/products'
import { getFormattedDimensions } from '@/utils/helper.js'
import axios from 'axios'
// import AxiosInstace from '@/config/index.js'
const products = ref([])
const selectedProducts = ref([])
const productStore = useProductStore()
const backendURL = import.meta.env.VITE_PUBLIC_API

onMounted(async () => {
  try {
    const response = await axios.get(`${backendURL}/requests/all.php?action=getProducts`, {
      withCredentials: false
    })
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
    productIds: selectedProductIds,
    _method: 'DELETE'
  }

  try {
    const response = await axios.post(`${backendURL}/requests/action.php`, {
      data: formData,
      withCredentials: false
    })
    console.log(response)
    productStore.deleteSelectedProducts(selectedProductIds)
  } catch (error) {
    console.error(error)
  }
}
</script>
