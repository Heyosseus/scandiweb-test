import axios from 'axios'

axios.defaults.withCredentials = false
const axiosInstance = axios.create({
  baseURL: import.meta.env.VITE_PUBLIC_API,
  headers: {
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS'
  }
})

export default axiosInstance
