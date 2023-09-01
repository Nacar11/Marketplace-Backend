<script setup>	
import store from '../../store'
// import {ref} from '@vue/reactivity'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { useRouter } from 'vue-router'



const router = useRouter()
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

const addProduct = async (ev) => {
	router.push('/product');
};

const shopCart = async (ev) => {
	router.push('/cart');
};

const userProfile = async (ev) => {
	router.push('/account');
};


</script>


<template>
<section class="bg-gray-800" as="nav">
	  <div class="flex flex-wrap items-center justify-between mx-auto p-3">
	    <a class="flex items-center">
	        <img src="https://via.placeholder.com/50" alt="Placeholder Image" style="border-radius: 50%; border: 3px solid #ddd; margin-right: 10px;">
      <router-link to="/">
	        <span id="title" class="self-center text-2xl text-white font-semibold whitespace-nowrap ">MarketPlace</span>
        </router-link>
        </a>

          <div v-if="store.state.user.token" class="absolute right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

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
                  <a :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Your Orders</a>
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
          <button class="cta-btn group bg-blue-500 text-white">
          <router-link :to="{ name: 'login' }"><span class="relative group-hover:text-white">Login</span></router-link>
      
    </button>
        </div>
      </div>
      
	</section>
  <!-- <section>
    <Disclosure as="nav" class="bg-white" v-slot="{ open }">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          
          <DisclosureButton class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
            <span class="absolute -inset-0.5" />
            <span class="sr-only">Open main menu</span>
            <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
            <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
        </div>
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          
          <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-1">
              <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-900 text-black' : 'text-black hover:bg-gray-700 hover:text-white', 'rounded-md px-3 py-2 text-sm font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</a>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <DisclosurePanel class="sm:hidden">
      <div class="space-y-1 px-2 pb-3 pt-2">
        <DisclosureButton v-for="item in navigation" :key="item.name" as="a" :href="item.href" :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block rounded-md px-3 py-2 text-base font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</DisclosureButton>
      </div>
    </DisclosurePanel>
  </Disclosure>
  </section> -->
</template>

<style>
 .first_nav{
	padding:5px 5px;
	background: #E3E1F2;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}



/* .dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.dropdown-content a:hover {background-color: #ddd;}
.dropdown:hover .dropdown-content {display: block;}
.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style> */