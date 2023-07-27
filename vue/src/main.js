import { createApp } from 'vue'
import './style.css'
import store from './store'
import App from './App.vue'
import router from './router'
import './index.css'

createApp(App).use(store).use(router).mount('#app')
