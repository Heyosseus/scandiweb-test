<template>
  <div class="w-full lg:w-inputs space-y-10 mt-12">
    <div class="flex" id="sku">
      <label for="sku">SKU</label>
      <div class="flex flex-col ml-auto">
        <Field
          name="sku"
          type="text"
          id="sku"
          placeholder="sku"
          class="p-2 rounded-lg border-none outline-none text-black ml-auto w-fit lg:w-input uppercase"
         
          :value="props.sku"
          @input="$emit('update:sku', $event.target.value)"
        />
        <ErrorMessage name="sku" class="text-sm text-red-600 mt-2" />
      </div>
    </div>

    <div class="flex" id="name">
      <label for="">Name</label>
      <div class="flex flex-col ml-auto">
        <Field
          name="name"
          type="text"
          id="name"
          placeholder="name"
          class="p-2 rounded-lg border-none outline-none text-black w-fit lg:w-input"
      
          :value="props.name"
          @input="$emit('update:name', $event.target.value)"
        />
        <ErrorMessage name="name" class="text-sm text-red-600 mt-2" />
      </div>
    </div>

    <div class="flex" id="price">
      <label for="">Price ($)</label>
      <div class="flex flex-col ml-auto">
        <Field
          name="price"
          type="number"
          id="price"
          placeholder="price"
          class="p-2 rounded-lg border-none outline-none text-black ml-auto w-fit lg:w-input"
       
          :value="props.price"
          @input="$emit('update:price', $event.target.value)"
        />
        <ErrorMessage name="price" class="text-sm text-red-600 mt-2" />
      </div>
    </div>
    <div>
      <label for="">Type switcher:</label>
      <Field
        name="selector"
        as="select"
        id="productType"
        class="ml-10 p-2 bg-transparent"
        :value="props.selectedProductType"
        @input="$emit('update:selectedProductType', $event.target.value)"
        
      >
        <option value="" disabled class="bg-primary text-white">Select product type</option>
        <option value="DVD" class="bg-primary text-white">DVD</option>
        <option value="Book" class="bg-primary text-white">Book</option>
        <option value="Furniture" class="bg-primary text-white">Furniture</option>
      </Field>
      <ErrorMessage name="selector" class="text-sm text-red-600 mt-2 lg:ml-6" />
    </div>
  </div>
</template>

<script setup>
import { Field, ErrorMessage } from 'vee-validate'

const props = defineProps({
  sku: {
    type: String,
    required: true
  },
  name: {
    type: String,
    required: true
  },
  price: {
    required: true
  },
  selectedProductType: {
    type: String,
    required: true
  }
})
</script>
