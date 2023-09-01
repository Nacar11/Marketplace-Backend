import { createApp } from 'vue'
import store from './store'
import App from './App.vue'
import router from './router'
import './index.css'
import vue3GoogleLogin from 'vue3-google-login'


createApp(App).use(store).use(router).use(vue3GoogleLogin, {
    clientId: "419658648075-eki2jnr9vnde92nmnc7pau0p5umscs7f.apps.googleusercontent.com",
  }).mount('#app')
