import { defineStore } from 'pinia'

export const useProductStore = defineStore('products', {
  state: () => ({
    items: []
  }),
  actions: {
    deleteItems(itemId) {
      const index = this.items.findIndex((item) => item.id === itemId)
      if (index !== -1) {
        this.items.splice(index, 1)
      }
    },
    deleteSelectedProducts(selectedProductIds) {
      for (const id of selectedProductIds) {
        this.deleteItems(id)
      }
    }
  }
})
