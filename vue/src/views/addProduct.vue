<script setup>
import {reactive, ref} from '@vue/reactivity'
// import { useRouter } from 'vue-router'
// import { useAuthenticateStore } from '../../store/authenticate'
// import { storeToRefs } from 'pinia'
import { onBeforeMount } from '@vue/runtime-core'
import store from '../store'

const product_types = ref({})
const product_categories = ref({})
const variation_options_by_variations = ref({})
onBeforeMount(async () => {
	store.dispatch('getProductTypes').then((data) => {
	product_types.value = data
	})
})

const variants_of_product_type = ref({})
const state = reactive({
  product_type: "",
  product_price: "",
  product_quantity: "",
  product_image: {},

})
const variationOptionByVariation = (id) => {
  
};
const showProductDetails = ref(true);
const showProductAttributes = ref(false);

const filterQuantityInput = () => {
  // Filter out non-numeric characters
  state.product_quantity = state.product_quantity.replace(/\D/g, "");
  state.product_price = state.product_price.replace(/\D/g, "");
};

const selectedProductTypeID = ref(null);
const onProductTypeSelected = () => {
  const selectedProductType = product_types.value.find(productType => productType.name === selectedProductTypeID.value);
  if (selectedProductType) {
  console.log('Selected Product Type ID:', selectedProductType.id);
  store.dispatch('getVariantsByProductTypes', selectedProductType.id).then((data) => {
    variants_of_product_type.value = data;
    const idsArray = data.map((variant) => variant.id);

    const requests = idsArray.map((id) => store.dispatch('getVariationOptionbyVariant', id));

    Promise.all(requests)
      .then((responses) => {
        console.log(responses);
        variation_options_by_variations.value = responses
        console.log(variation_options_by_variations.value)
      })
      .catch((error) => {
        console.error('Error fetching variation options:', error);
      });
  });
}






	

};
</script>



<template>
  <div class="grid grid-cols-2 divide-x divide-gray-900/5 bg-gray-50">
        <a href="#" @click="showProductDetails = true; showProductAttributes = false" class="flex items-center justify-center gap-x-2.5 p-3 font-semibold text-gray-900 hover:bg-gray-100">
          Product Details
        </a>
        <a href="#" @click="showProductDetails = false; showProductAttributes = true" class="flex items-center justify-center gap-x-2.5 p-3 font-semibold text-gray-900 hover:bg-gray-100">
          Product Attributes
        </a>
      </div>
<div v-show="showProductDetails">
  <div class="flex flex-col items-center mt-4 px-4 sm:px-0">
    <h3 class="text-base font-semibold leading-7 text-gray-900">List a Product</h3>
    <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Product Details and Information.</p>
  </div>
  <div class="border-t border-gray-100">
    <dl class="divide-y divide-gray-100"> 
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">Product Type</dt>
        <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2">
          <select @change="onProductTypeSelected" v-model="selectedProductTypeID" class="mr-10 block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
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
<div v-show="showProductAttributes">
  <div class="flex flex-col items-center mt-4 px-4 sm:px-0">
    <h3 class="text-base font-semibold leading-7 text-gray-900">List a Product</h3>
    <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Product Attributes and Variants.</p>
  </div>

  <div class="border-t border-gray-100">
    <dl class="divide-y divide-gray-100">
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0" v-for="productType in variants_of_product_type" :key="productType.id">
        <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">{{ productType.name }}</dt>
        <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2">
          <label v-for="variant_options in variation_options_by_variations" :key="variation_options_by_variations.id" class="inline-flex items-center">
            <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600 rounded focus:ring-indigo-500 border-gray-300">
              <span class="ml-2 text-gray-700">{{variant_options}}</span>
          </label>
        </dd>
      </div>
    </dl>
  </div>
</div>


</template>