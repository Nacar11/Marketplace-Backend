import axios from 'axios'
import store from '../store'

const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
 
})

api.interceptors.request.use(config => {
  config.headers.Authorization = `Bearer ${store.state.user.token}`
  return config
})
export default api