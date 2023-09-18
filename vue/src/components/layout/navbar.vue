<script setup>	
import store from '../../store'
import { ref, computed} from '@vue/reactivity'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { useRouter } from 'vue-router'
import mobileMenu from '../sider/mobileMenu.vue'

const router = useRouter()
const showSider = ref(false);
const logoutButton = async (ev) => {
  ev.preventDefault()
  store.dispatch('logout').then((data) => {
	console.log(data)
	router.push({
		name: 'login', 
	}) 	
  })
  .catch(err => {
	console.log(err)
  })
};

const openSider = () => {
  showSider.value = !showSider.value;

};
</script>

<template>
  
  <mobileMenu
  :show="showSider"
  :openSider="openSider"
  >
</mobileMenu>
<div class="bg-gray-800">
  <div class="flex items-center justify-between mx-auto p-3">
    <div class="flex items-center">
    <!-- Leftmost button -->
    <button @click="openSider" class="text-blue-100 md:hidden">
      <i class="fa fa-list-ul fa-lg p-2"></i>
    </button>
    <a class="flex items-center" href="/">
      <img src="https://via.placeholder.com/50" alt="Placeholder Image" style="border-radius: 50%; border: 3px solid #ddd; margin-right: 10px;">
      <span id="title" class="self-center md:text-2xl text-l text-white font-semibold whitespace-nowrap text-primary">MarketPlace</span>
    </a>
    </div>
    <!-- Search Bar -->
    <div class="hidden md:flex items-center">

  <!-- Input -->
  <input type="text" class="w-96 h-10 font-medium focus:outline-none searchInput rounded-l-2xl" placeholder="Search Items">
  <!-- Search button -->
  <button class="w-14 h-10 bg-orange-600 flex justify-center items-center rounded-r-2xl text-white font-medium">
    <i class="fas fa-search text-white"></i>
  </button>
</div>
    <!-- Rightmost buttons -->
    <div class="flex items-center">
      <div v-if="store.state.user.token" class="absolute right-0 pr-2 hidden md:block">
        <!-- User Menu -->
        <Menu as="div" class="relative ml-3">
            <div>
              <MenuButton class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                <span class="absolute -inset-1.5" />
                <span class="sr-only">Open user menu</span>
                <img class="h-8 w-8 rounded-full" src="https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png" alt="" />
              </MenuButton>
            </div>
            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
              <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <MenuItem v-slot="{ active }">
                  <a @click="userProfile" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">View Profile</a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <a  @click="addProduct" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">List a Product</a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <a  @click="shopCart" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Your Shopping Cart</a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <a @click="orders" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Your Orders</a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <a :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Settings</a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <a  @click="logoutButton" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Sign out</a>
                </MenuItem>
                
              </MenuItems>
            </transition>
          </Menu>
      </div>
      <div v-else>
        <a class="btn md:text-base md:border-2 border-blue-400 text-blue-400 text-sm">
          <router-link :to="{ name: 'login' }">Login</router-link>
        </a>
      </div>
    </div>
  </div>
</div>

  
</template>

<style>
</style>