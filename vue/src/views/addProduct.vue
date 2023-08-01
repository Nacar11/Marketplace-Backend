<script setup>
import {reactive, ref} from '@vue/reactivity'
// import { useRouter } from 'vue-router'
// import { useAuthenticateStore } from '../../store/authenticate'
// import { storeToRefs } from 'pinia'
import { onBeforeMount } from '@vue/runtime-core'
import store from '../store'

const product_types = ref({})
onBeforeMount(async () => {
	store.dispatch('getProductTypes').then((data) => {
		console.log(data)
	product_types.value = data
  console.log(product_types.value)
	})
})


const state = reactive({
  product_type: "",
  product_price: "",
  product_quantity: "",
  product_image: {},


})

const filterQuantityInput = () => {
  // Filter out non-numeric characters
  state.product_quantity = state.product_quantity.replace(/\D/g, "");
  state.product_price = state.product_price.replace(/\D/g, "");
};
</script>



<template>
<div>
  <div class="flex flex-col items-center mt-4 px-4 sm:px-0">
    <h3 class="text-base font-semibold leading-7 text-gray-900">List a Product</h3>
    <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Product Details and Information.</p>
  </div>
  <div class="border-t border-gray-100">
    <dl class="divide-y divide-gray-100">
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">Product Type</dt>
        <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2">
          <select v-model="state.product_type" class="mr-10 block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            <option v-for="productType in product_types" :key="productType.id" :value="productType.name">{{ productType.name }}</option>
          </select>
        </dd>
      </div>

      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">Price</dt>
        <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 flex items-center">
          <span class="pr-6 text-gray-500">Php</span>
          <input v-model="state.product_price" @input="filterQuantityInput" class="w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" type="text" />
        </dd>
      </div>

      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">Quantity in Stock</dt>
        <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 flex items-center">
          <input v-model="state.product_quantity" @input="filterQuantityInput" class="w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" type="text" />
        </dd>
      </div>

      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">Product Images</dt>
        <dd class="text-sm text-gray-900 sm:col-span-2 sm:mt-0">
          <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
            <!-- List of product images... -->
            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
              <label for="image-upload" class="cursor-pointer text-indigo-600 hover:text-indigo-500">
                Upload Image
              </label>
              <input id="image-upload" type="file" class="hidden" />
            </li>
          </ul>
        </dd>
      </div>
    </dl>
  </div>
</div>


</template>