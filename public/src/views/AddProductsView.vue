<template>
  <Form @submit="addProduct" class="py-10 px-16">
    <base-header save="save" cancel="cancel" :addProducty="addProduct"></base-header>
    <div class="w-full h-[1px] bg-gray-400 mt-4"></div>
    <div class="flex justify-between" @submit.prevent>
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

    <footer class="fixed w-full bottom-12">
      <div class="w-[94%] h-[1px] bg-gray-400 mt-4"></div>
      <p class="flex justify-center items-center text-lg mt-2">Scandiweb Test Assignment</p>
    </footer>
  </Form>
</template>
<script setup>
import { Form } from 'vee-validate'
import BaseHeader from '@/components/layout/BaseHeader.vue'
import InputData from '@/components/InputData.vue'
import ProductTypes from '@/components/ProductTypes.vue'

import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

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
    .post('http://localhost:3000/api/requests/action.php', formData, {
      headers: {
        'Content-Type': 'application/json'
      }
    })
    .then(() => {
      console.log(formData)
      router.push({ name: 'home' })
    })
    .catch((error) => {
      console.error(error.response)
    })
}
</script>
