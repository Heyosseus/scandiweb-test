<template>
  <div class="py-10 px-16">
    <div class="flex justify-between items-center px-4">
      <h1 class="text-4xl text-green-400">Product Add</h1>
      <div class="flex space-x-8">
        <button
          class="uppercase py-2 px-4 border border-white rounded-md hover:bg-blue-600 hover:border-0"
          @click="addProduct"
        >
          save
        </button>
        <router-link
          :to="{ name: 'home' }"
          class="uppercase py-2 px-4 border border-white rounded-md hover:bg-gray-600 hover:border-0"
          >cancel</router-link
        >
      </div>
    </div>
    <div class="w-full h-[1px] bg-gray-400 mt-4"></div>
    <div class="flex justify-between" @submit.prevent>
      <Form class="w-inputs space-y-10 mt-12">
        <div class="flex">
          <label for="sku">SKU</label>
          <div class="flex flex-col ml-auto">
            <Field
              name="sku"
              type="text"
              id="sku"
              placeholder="sku"
              class="p-2 rounded-lg border-none outline-none text-black ml-auto w-input"
              rules="required"
              v-model="sku"
            />
            <ErrorMessage name="sku" class="text-sm text-red-600 mt-2" />
          </div>
        </div>

        <div class="flex">
          <label for="">Name</label>
          <div class="flex flex-col ml-auto">
            <Field
              name="name"
              type="text"
              id="name"
              placeholder="name"
              class="p-2 rounded-lg border-none outline-none text-black w-input"
              rules="required"
              v-model="name"
            />
            <ErrorMessage name="name" class="text-sm text-red-600 mt-2" />
          </div>
        </div>

        <div class="flex">
          <label for="">Price ($)</label>
          <div class="flex flex-col ml-auto">
            <Field
              name="price"
              type="number"
              id="price"
              placeholder="price"
              class="p-2 rounded-lg border-none outline-none text-black ml-auto w-input"
              rules="required|number"
              v-model="price"
            />
            <ErrorMessage name="price" class="text-sm text-red-600 mt-2" />
          </div>
        </div>
        <div>
          <label for="">Type switcher:</label>
          <select
            name=""
            id="productType"
            class="ml-10 p-2 bg-transparent"
            v-model="selectedProductType"
          >
            <option value="" disabled class="bg-primary text-white">Select product type</option>
            <option value="DVD" class="bg-primary text-white">DVD</option>
            <option value="Book" class="bg-primary text-white">Book</option>
            <option value="Furniture" class="bg-primary text-white">Furniture</option>
          </select>
        </div>
      </Form>
      <div>
        <div class="w-content bg-gray-950 h-contentH mt-12 rounded-lg drop-shadow-lg">
          <div class="p-10">
            <div v-if="selectedProductType === 'DVD'" class="">
              <label for="size">Size (mb)</label>
              <Field
                name="size"
                type="text"
                id="size"
                placeholder="size"
                class="p-2 rounded-lg border-none outline-none text-black ml-10 w-input"
                rules="required|number"
              />
              <ErrorMessage name="size" class="text-sm text-red-600 mt-2" />

              <p class="text-sm mt-4 text-gray-300">*Please, provide disc space in MB</p>
            </div>
            <div v-else-if="selectedProductType === 'Book'">
              <label for="length">Weight (kg)</label>
              <Field
                name="weight"
                type="text"
                id="weight"
                placeholder="weight"
                class="p-2 rounded-lg border-none outline-none text-black ml-10 w-input"
                rules="number"
              />
              <p class="text-sm mt-4 text-gray-300">*Please, provide weight in KG</p>
            </div>
            <div
              v-else-if="selectedProductType === 'Furniture'"
              class="flex flex-col space-y-8 w-content"
            >
              <div>
                <label for="height">Height (cm)</label>
                <Field
                  name="height"
                  type="text"
                  id="height"
                  placeholder="height"
                  class="p-2 rounded-lg border-none outline-none text-black ml-9 w-input"
                  rules="number"
                />
              </div>
              <div>
                <label for="width">Width (cm)</label>
                <Field
                  name="width"
                  type="text"
                  id="width"
                  placeholder="width"
                  class="p-2 rounded-lg border-none outline-none text-black ml-10 w-input"
                  rules="number"
                />
              </div>
              <div>
                <label for="length">Length (cm)</label>
                <Field
                  name="length"
                  type="text"
                  id="length"
                  placeholder="length"
                  class="p-2 rounded-lg border-none outline-none text-black ml-8 w-input"
                  rules="number"
                />
                <p class="text-sm mt-6 text-gray-300">*Please, provide dimensions in CM</p>
              </div>
            </div>

            <p v-else class="text-center text-lg">No selected type yet</p>
          </div>
        </div>
      </div>
    </div>

    <footer class="fixed w-full bottom-12">
      <div class="w-[94%] h-[1px] bg-gray-400 mt-4"></div>
      <p class="flex justify-center items-center text-lg mt-2">Scandiweb Test Assignment</p>
    </footer>
  </div>
</template>
<script setup>
import { Form, Field, ErrorMessage } from 'vee-validate'
import { ref } from 'vue'
import axios from 'axios'

const sku = ref('')
const name = ref('')
const price = ref('')

const selectedProductType = ref('')

const addProduct = () => {
  axios
    .post('http://localhost:3000/api/api.php', {
      action: 'addProducts',
      sku: sku.value,
      name: name.value,
      price: price.value
    })
    .then((response) => {
      console.log(response.data)
    })
    .catch((error) => {
      console.error(error.response.data)
    })
}
</script>
