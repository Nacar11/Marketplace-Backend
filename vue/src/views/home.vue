<script setup>
import {computed, ref} from '@vue/reactivity'
import store from '../store'
import { useRouter } from 'vue-router'
import { onBeforeMount } from '@vue/runtime-core'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
const error= ref('')
const product_category= ref([])
const product_items = ref([])
onBeforeMount(async () => {
	store.dispatch('getProductCategories').then((data) => {
		console.log(data)
		for (let i = 0; i < data.length; i++) {
 		const name = data[i];
		product_category.value.push(name);
	}
	console.log(product_category.value)
	
  })
  .catch(err => {
	console.log(err.response.data.message)
	error.value = err.response.data.message
  })

  store.dispatch('getProductItems').then((data) => {
		console.log(data)
		for (let i = 0; i < data.length; i++) {
		product_items.value.push(data[i]);
	}
	console.log(product_items.value)
	
  })
  


})

const getSubcategories = (parentCategoryId => {
      // Filter and return the subcategories for the given parentCategoryId
      return product_category.value.filter(category => category.category_id === parentCategoryId);
    })
	</script>


<template>
	<div class=" p-5 flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
			<template v-for="category in product_category" :key="category.id">
			<Menu as="div" class="relative inline-block">
			<div>
            <MenuButton v-if="category.category_id == null"
              class="text-black hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
            >
              {{ category.category_name }}
            </MenuButton>
			</div>
			<transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
				<MenuItems class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
					<MenuItem v-for="subCategory in getSubcategories(category.id)" :key="subCategory.id" v-slot="{ active }">
						<a :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
                  {{ subCategory.category_name }}
                </a>
                </MenuItem>
              </MenuItems>

			</transition>
			<!-- <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
      <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Account settings</a>
          </MenuItem>
          <MenuItem v-slot="{ active }">
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Support</a>
          </MenuItem>
          <MenuItem v-slot="{ active }">
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">License</a>
          </MenuItem>
          <form method="POST" action="#">
            <MenuItem v-slot="{ active }">
              <button type="submit" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block w-full px-4 py-2 text-left text-sm']">Sign out</button>
            </MenuItem>
          </form>
        </div>
      </MenuItems>
      
    </transition> -->
    
			</Menu>
          </template>
          </div>
        </div>
      </div>
  <div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16">
      <!-- <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2> -->

      <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        <div v-for="product in product_items" :key="product.id" class="group relative">
          <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
            <img :src="product.product_image" :alt="product.product_image" class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
          </div>
          <div class="mt-4 flex justify-between">
            <div>
              <h3 class="text-sm text-gray-700">
                {{ product.product.name }}
              </h3>
                        </div>
            <p class="text-sm font-medium text-gray-900">{{ product.price }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

      









    
  
</template>


<style>
	
	
	</style>


