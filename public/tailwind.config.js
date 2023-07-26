/** @type {import('tailwindcss').Config} */
export const content = ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}']
export const theme = {
  extend: {
    colors: {
      primary: '#181624'
    },
    width: {
      inputs: '500px',
      input: '400px',
      content: '780px'
    },
    height: {
      contentH: '600px'
    }
  }
}
