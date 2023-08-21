<template>
  <div>
    <Form @submit="addProduct" class="py-10 px-6 lg:px-16" id="product_form">
      <div
        v-if="alreadyExist"
        class="px-5 py-3 bg-red-500 text-center absolute bottom-24 left-20 rounded-lg cursor-pointer text-lg"
        @click="alreadyExist = false"
      >
        SKU name is already exists
      </div>
      <base-header save="Save" cancel="Cancel" :addProduct="addProduct"></base-header>
      <div class="w-full h-[1px] bg-gray-400 mt-4"></div>

      <div class="flex flex-col w-inputs justify-between space-y-4 mt-10">
        <div class="w-full justify-between flex items-center">
          <label for="sku">SKU</label>
          <Field
            name="sku"
            type="text"
            id="sku"
            v-model="sku"
            class="p-2 rounded-lg border-none outline-none text-black ml-auto w-fit lg:w-input uppercase placeholder:lowercase"
            placeholder="sku"
            rules="required"
          />
        </div>
        <ErrorMessage name="sku" class="text-sm text-red-600 ml-24" />

        <div class="w-full justify-between flex items-center">
          <label for="name">Name</label>
          <Field
            name="name"
            type="text"
            id="name"
            v-model="name"
            class="p-2 rounded-lg border-none outline-none text-black ml-auto w-fit lg:w-input placeholder:lowercase"
            placeholder="name"
            rules="required"
          />
        </div>
        <ErrorMessage name="name" class="text-sm text-red-600 ml-24 mt-2" />

        <div class="w-full justify-between flex items-center">
          <label for="price">Price ($)</label>
          <Field
            name="price"
            type="number"
            id="price"
            v-model="price"
            class="p-2 rounded-lg border-none outline-none text-black ml-auto w-fit lg:w-input uppercase placeholder:lowercase"
            placeholder="price"
            rules="required"
          />
        </div>
        <ErrorMessage name="price" class="text-sm text-red-600 ml-24 mt-2" />
      </div>

      <label for="productType">Type switcher:</label>
      <select
        name="selector"
        id="productType"
        v-model="productType"
        class="ml-10 p-2 bg-transparent outline-0 w-[352px] mt-6"
      >
        <option value="DVD" id="DVD" class="bg-primary text-white">DVD</option>
        <option value="Book" id="Book" class="bg-primary text-white">Book</option>
        <option value="Furniture" id="Furnitue" class="bg-primary text-white">Furniture</option>
      </select>
      <div v-if="productType === 'DVD'" class="mt-6">
        <label for="size">Size</label>
        <Field
          name="size"
          type="text"
          id="size"
          v-model="size"
          class="p-2 rounded-lg border-none outline-none text-black ml-16 w-fit lg:w-input uppercase placeholder:lowercase"
          placeholder="size"
          rules="required|number"
        />
      </div>
      <ErrorMessage name="size" class="text-sm text-red-600 ml-24" />

      <div v-if="productType === 'Book'" class="mt-6">
        <label for="weight">Weight</label>
        <Field
          name="weight"
          type="text"
          id="weight"
          v-model="weight"
          class="p-2 rounded-lg border-none outline-none text-black ml-11 w-fit lg:w-input uppercase placeholder:lowercase"
          placeholder="weight"
          rules="required|number"
        />
      </div>
      <ErrorMessage name="weight" class="text-sm text-red-600 ml-24" />

      <div v-if="productType === 'Furniture'" class="flex flex-col space-y-1 mt-6">
        <label for="height">Height</label>
        <Field
          name="height"
          type="text"
          id="height"
          v-model="height"
          class="p-2 rounded-lg border-none outline-none text-black w-fit lg:w-inputs uppercase placeholder:lowercase"
          placeholder="height"
          rules="required|number"
        />
        <ErrorMessage name="height" class="text-sm text-red-600" />
        <label for="width">Width</label>
        <Field
          name="width"
          type="text"
          id="width"
          v-model="width"
          class="p-2 rounded-lg border-none outline-none text-black w-fit lg:w-inputs uppercase placeholder:lowercase"
          placeholder="width"
          rules="required|number"
        />
        <ErrorMessage name="width" class="text-sm text-red-600" />
        <label for="length">Length</label>
        <Field
          name="length"
          type="text"
          id="length"
          v-model="length"
          class="p-2 rounded-lg border-none outline-none text-black w-fit lg:w-inputs uppercase placeholder:lowercase"
          placeholder="length"
          rules="required|number"
        />
        <ErrorMessage name="length" class="text-sm text-red-600" />
      </div>
    </Form>
    <BaseFooterVue />
  </div>
</template>

<script setup>
import { Form, Field, ErrorMessage } from 'vee-validate'
import { ref } from 'vue'
import BaseHeader from '../components/layout/BaseHeader.vue'
import BaseFooterVue from '../components/layout/BaseFooter.vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()
const sku = ref('')
const name = ref('')
const price = ref('')
const size = ref('')
const weight = ref('')
const height = ref('')
const width = ref('')
const length = ref('')
const productType = ref('')

const backendURL = import.meta.env.VITE_PUBLIC_API

const addProduct = () => {
  const formData = {
    action: 'addProducts',
    sku: sku.value,
    name: name.value,
    price: parseFloat(price.value),
    type: productType.value
  }
  if (productType.value === 'DVD') {
    formData.size = parseFloat(size.value)
  } else if (productType.value === 'Book') {
    formData.weight = parseFloat(weight.value)
  } else if (productType.value === 'Furniture') {
    formData.height = parseFloat(height.value)
    formData.width = parseFloat(width.value)
    formData.length = parseFloat(length.value)
  }

  axios
    .post(`${backendURL}/requests/action.php`, formData, {
      withCredentials: false
    })
    .then(() => {
      router.push({ name: 'home' })
    })
    .catch((error) => {
      console.error(error)
    })
}
</script>

<style></style>
