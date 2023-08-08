<template>
  <Form @submit="addProduct" class="py-10 px-6   lg:px-16" id="product_form">
    <base-header save="Save" cancel="Cancel" :addProduct="addProduct"></base-header>
    <div
      v-if="alreadyExist"
      class="px-5 py-3 bg-red-500 text-center absolute bottom-24 left-20 rounded-lg cursor-pointer text-lg"
      @click="alreadyExist = false"
    >
      SKU name is already exists
    </div>
    <div class="w-full h-[1px] bg-gray-400 mt-4"></div>
    <div class="flex flex-col lg:items-start lg:p-5 lg:flex-row md:justify-between" @submit.prevent>
      <input-data
        :sku="sku"
        :name="name"
        :price="price"
        :selectedProductType="selectedProductType"
        @update:sku="sku = $event"
        @update:name="name = $event"
        @update:price="price = $event"
        @update:selectedProductType="selectedProductType = $event"
      ></input-data>
      <product-types
        :size="size"
        :weight="weight"
        :height="height"
        :width="width"
        :length="length"
        :selectedProductType="selectedProductType"
        @update:size="size = $event"
        @update:weight="weight = $event"
        @update:height="height = $event"
        @update:width="width = $event"
        @update:length="length = $event"
        @update:selectedProductType="selectedProductType = $event"
      ></product-types>
    </div>

    <BaseFooter />
  </Form>
</template>
<script setup>
import { Form } from 'vee-validate'
import BaseHeader from '@/components/layout/BaseHeader.vue'
import BaseFooter from '@/components/layout/BaseFooter.vue'
import InputData from '@/components/InputData.vue'
import ProductTypes from '@/components/ProductTypes.vue'
// import AxiosInstance from '@/config/index.js'
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
const backendURL = import.meta.env.VITE_PUBLIC_API
const router = useRouter()
const sku = ref('')
const name = ref('')
const price = ref('')
const size = ref('')
const weight = ref('')
const height = ref('')
const width = ref('')
const length = ref('')
const selectedProductType = ref('')
const alreadyExist = ref(false)

const addProduct = async () => {
  const formData = {
    action: 'addProducts',
    sku: sku.value,
    name: name.value,
    price: parseFloat(price.value),
    type: selectedProductType.value
  }
  if (selectedProductType.value === 'DVD') {
    formData.size = parseFloat(size.value)
  } else if (selectedProductType.value === 'Book') {
    formData.weight = parseFloat(weight.value)
  } else if (selectedProductType.value === 'Furniture') {
    formData.height = parseFloat(height.value)
    formData.width = parseFloat(width.value)
    formData.length = parseFloat(length.value)
  }

  await axios
    .post(`${backendURL}/requests/action.php`, formData, {
      withCredentials: false
    })
    .then(() => {
      console.log(formData)
      router.push({ name: 'home' })
    })
    .catch((error) => {
      if (error.response && error.response.status === 500) {
        alreadyExist.value = true
      }
    })
}
</script>
