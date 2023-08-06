<script setup>
import {reactive, ref, computed} from '@vue/reactivity'
import { useRouter } from 'vue-router'
// import { useAuthenticateStore } from '../../store/authenticate'
// import { storeToRefs } from 'pinia'
import { onBeforeMount, onMounted } from '@vue/runtime-core'
import store from '../store'


const router = useRouter();
const product_types = ref({})
const currentIndex = ref(0);
const variation_options = ref([])
const checkedOptions = ref([]);


onBeforeMount(async () => {
	store.dispatch('getProductTypes').then((data) => {
	product_types.value = data
	})

  store.dispatch('getAllVariationOptions').then((data) => {
	variation_options.value = data
	})
})

const selectedOptionValues = computed(() => {
  return checkedOptions.value.map(optionValue => {
    return optionValue;
  });
});

const submitButton = async (ev) => {
  ev.preventDefault()
  console.log(selectedOptionValues.value)
  
  const formData = new FormData();
  formData.append('product_id', state.product_id);
  formData.append('price', parseFloat(state.price));
  formData.append('qty_in_stock', parseFloat(state.qty_in_stock));

  for (const file of state.product_images) {
    formData.append('product_images[]', file);
  }
 
  store.dispatch('addProductItem', formData).then((data) => {
	console.log(data)
  
  for (const option of selectedOptionValues.value){
    console.log(typeof option)
    const form = ({
      product_item_id: data.id,
      variation_option_id: option,
    });
  store.dispatch('addProductConfiguration',form).then((data2) => {
	console.log(data2)
  })
  }
  router.push({
		name: 'home',
	}) 	

  })
  .catch(err => {
	console.log(err)

  })



};
const variants_of_product_type = ref({})
const state = reactive({
  product_id: null,
  price: "",
  qty_in_stock: "",
  product_images: [], 

})
const showProductDetails = ref(true);
const showProductAttributes = ref(false);

const filterQuantityInput = () => {
  state.qty_in_stock = state.qty_in_stock.replace(/\D/g, "");
  state.price = state.price.replace(/\D/g, "");
};

const selectedProductTypeID = ref(null);
const onProductTypeSelected = () => {
  const selectedProductType = product_types.value.find(productType => productType.name === selectedProductTypeID.value);
  if (selectedProductType) {
      store.dispatch('getVariantsByProductTypes', selectedProductType.id).then((data) => {
      state.product_id = selectedProductType.id
      variants_of_product_type.value = data
  });
}
}

const onFilesSelected = (event) =>{
 console.log(event)
 state.product_images = event.target.files
 console.log(state.product_images)
}

const convertToMB = (size) => {
  return (size / (1024 * 1024)).toFixed(2) + ' MB';
};
const filteredOptions = (variantId) => {
  return variation_options.value.filter(option => option.variation_id === variantId);
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
    <div class="relative mt-2 rounded-md shadow-sm">
    <input v-model="state.price" @input="filterQuantityInput" class="w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" placeholder="0.00">
    <div class="absolute inset-y-0 right-0 flex items-center">
      <select id="currency" name="currency" class="h-full rounded-md border-0 bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
        <option>PHP</option>
      </select>
    </div>
  </div>
  </dd>
</div>

      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">Quantity in Stock</dt>
        <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 flex items-center">
          <input v-model="state.qty_in_stock" @input="filterQuantityInput" class="w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" type="text" />
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
              <input id="image-upload" @change="onFilesSelected" type="file" multiple class="hidden" />
            </li>
            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
              <div class="flex w-0 flex-1 items-center">
                
                <div v-for="image in state.product_images" :key="state.product_images.id" class="ml-4 flex min-w-0 flex-1 gap-2">
                  <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                </svg>
                  <span class="truncate font-medium">{{image.name}}</span>
                  <span class="flex-shrink-0 text-gray-400">{{ convertToMB(image.size )}} </span>
                </div>
              </div>
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
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0" v-for="variant in variants_of_product_type" :key="variant.id">
        <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">{{ variant.name }}</dt>
        <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2">
          <label v-for="option in filteredOptions(variant.id)" :key="option.variation_id" class="inline-flex items-center">
            <input v-model="checkedOptions" :value="option.id" type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600 rounded focus:ring-indigo-500 border-gray-300">
            <span class="ml-2 text-gray-700">{{ option.value }}</span>
          </label>
          
        </dd>
      </div>
    </dl>
  </div>
</div>
<div>
  <div class="m-4 flex flex-col items-center mt-4 px-4 sm:px-0">
    <button @click="submitButton" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 text-white rounded-md shadow-sm">
  Submit
</button>
  </div>

  
  
  
</div>



</template>