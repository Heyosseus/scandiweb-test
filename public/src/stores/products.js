import { defineStore } from 'pinia'

export const useProductStore = defineStore('products', {
  state: () => ({
    items: []
  }),
  actions: {
    deleteSelectedProducts(selectedProductIds) {
      for (const id of selectedProductIds) {
        this.deleteItems(id)
      }
    }
  }
})
