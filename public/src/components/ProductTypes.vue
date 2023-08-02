<template>
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
            :value="props.size"
            @input="$emit('update:size', $event.target.value)"
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
            :value="props.weight"
            @input="$emit('update:weight', $event.target.value)"
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
              :value="props.height"
              @input="$emit('update:height', $event.target.value)"
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
              :value="props.width"
              @input="$emit('update:width', $event.target.value)"
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
              :value="props.length"
              @input="$emit('update:length', $event.target.value)"
            />
            <ErrorMessage name="length" class="text-sm block text-red-600 mt-4" />

            <p class="text-sm mt-6 text-gray-300">*Please, provide dimensions in CM</p>
          </div>
        </div>

        <p v-else class="text-center text-lg">Product type is not selected yet</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Field, ErrorMessage } from 'vee-validate'

const props = defineProps({
  selectedProductType: {
    required: true
  },
  size: {
    required: false
  },
  weight: {
    required: false
  },
  height: {
    required: false
  },
  width: {
    required: false
  },
  length: {
    required: false
  }
})
</script>
