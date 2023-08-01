import { defineRule } from 'vee-validate'
import { required, max } from '@vee-validate/rules'

defineRule('required', required)
defineRule('max', max)

defineRule('number', (value) => {
  if (!/^[0-9]+$/.test(value)) {
    return 'Please enter only numbers'
  }
  return true
})
