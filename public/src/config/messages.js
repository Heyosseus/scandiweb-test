import { configure } from 'vee-validate'

import { localize } from '@vee-validate/i18n'

configure({
  generateMessage: localize({
    en: {
      messages: {
        required: 'This field is required',
        max: 'This field must be less than 5 characters'
      }
    }
  })
})
