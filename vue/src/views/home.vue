<script setup>
import {computed, ref} from '@vue/reactivity'
import store from '../store'
import { useRouter } from 'vue-router'
import { onBeforeMount } from '@vue/runtime-core'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
const error= ref('')
const organizedCategories = ref([])
const product_items = ref([])
const openMenus = ref([]);
const organizeCategories = (data) => {
    const categoriesMap = new Map();
    const result = [];

    data.forEach((category) => {
    if (!category.category_id) {
      result.push(category);
    } else {
      const parentCategory = categoriesMap.get(category.category_id);
      if (!parentCategory.children) {
        parentCategory.children = [];
      }
      parentCategory.children.push(category);
    }

    categoriesMap.set(category.id, category);
  });

  return result;
};

onBeforeMount(async () => {
	store.dispatch('getProductCategories').then((data) => {
	console.log(data)
  organizedCategories.value = organizeCategories(data);
  console.log("organizedcategories")
	console.log(organizedCategories.value)
  })
  .catch(err => {
	console.log(err.response.data.message)
	error.value = err.response.data.message
  })

  store.dispatch('getProductItems').then((data) => {
		
		for (let i = 0; i < data.length; i++) {
		product_items.value.push(data[i]);
	}
  })
  
  


})

const openMenu = (categoryId) => {
  if (!openMenus.value.includes(categoryId)) {
    openMenus.value.push(categoryId);
  }
};

const closeMenu = (categoryId) => {
  const index = openMenus.value.indexOf(categoryId);
  if (index !== -1) {
    openMenus.value.splice(index, 1);
  }
};

const isActiveSubCategory = (subCategoryId) => {
  return openMenus.value.includes(subCategoryId);
};

</script>


<template>
  <div class="p-5 flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
    <div class="hidden sm:ml-6 sm:block">
      <div class="flex space-x-4">
        <template v-for="category in organizedCategories" :key="category.id">
          <div
            class="text-black hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium cursor-pointer relative inline-block"
            @mouseenter="openMenu(category.id)"
            @mouseleave="closeMenu(category.id)"
          >
            {{ category.category_name }}
            <div
              v-if="openMenus.includes(category.id)"
              class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            >
              <a
                v-for="subCategory in category.children"
                :key="subCategory.id"
                class="hover:text-black hover:text-lg block px-4 py-2 text-sm text-gray-700"
                :class="{ 'bg-gray-100': isActiveSubCategory(subCategory.id) }"
              >
                {{ subCategory.category_name }}
              </a>
            </div>
          </div>
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


