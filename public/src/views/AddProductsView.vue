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
                v-model="size"
              />
              <ErrorMessage name="size" class="text-sm block text-red-600 mt-4" />

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
                rules="required|number"
                v-model="weight"
              />
              <ErrorMessage name="weight" class="text-sm block text-red-600 mt-4" />

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
                  rules="required|number"
                  v-model="height"
                />
                <ErrorMessage name="height" class="text-sm block text-red-600 mt-4" />
              </div>
              <div>
                <label for="width">Width (cm)</label>
                <Field
                  name="width"
                  type="text"
                  id="width"
                  placeholder="width"
                  class="p-2 rounded-lg border-none outline-none text-black ml-10 w-input"
                  rules="required|number"
                  v-model="width"
                />
                <ErrorMessage name="width" class="text-sm block text-red-600 mt-4" />
              </div>
              <div>
                <label for="length">Length (cm)</label>
                <Field
                  name="length"
                  type="text"
                  id="length"
                  placeholder="length"
                  class="p-2 rounded-lg border-none outline-none text-black ml-8 w-input"
                  rules="required|number"
                  v-model="length"
                />
                <ErrorMessage name="length" class="text-sm block text-red-600 mt-4" />

                <p class="text-sm mt-6 text-gray-300">*Please, provide dimensions in CM</p>
              </div>
            </div>

            <p v-else class="text-center text-lg">Product type is not selected yet</p>
          </div>
        </div>
      </div>
    </div>

    <footer class="fixed w-full bottom-12">
      <div class="w-[94%] h-[1px] bg-gray-400 mt-4"></div>
      <p class="flex justify-center items-center text-lg mt-2">Scandiweb Test Assignment</p>
    </footer>
  </Form>
</template>
<script setup>
import { Form, Field, ErrorMessage } from 'vee-validate'
import BaseHeader from '@/components/layout/BaseHeader.vue'
import InputData from '@/components/InputData.vue'
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
      router.push({ name: 'home' })
    })
    .catch((error) => {
      console.error(error.response)
    })
}
</script>
