<script setup>
import { onBeforeMount } from '@vue/runtime-core'
import {reactive, ref, computed} from '@vue/reactivity'
import store from '../store'


const productItem = ref([])
onBeforeMount(async () => {
  console.log(userID.value)
  await store.dispatch('getProductItemFullDetails', props.id ).then((data) => {
  productItem.value = data
  console.log(productItem.value)

  })
  
  .catch(err => {
	console.log(err.response.data.message)
	productItem.value = err.response.data.message
	console.log(productItem.value)
  })
})
const props = defineProps({
  id: Number, 
});



const addToCart = async() => {
  const formData = new FormData();
  formData.append('product_item_id', props.id);
  
  console.log(formData)
  store.dispatch('addToCart',props.id).then((data) => {
    console.log(data)

  })
  .catch(err => {
	console.log(err)
})
}
const userID = computed(() => {
  return parseInt(sessionStorage.getItem('userID'))
})


</script>


<template>
<div>
<div v-if="productItem.data">
  <div class="h-[80vh] container">
  <div class=" justify-center flex flex-row p-5">
    
      <div class="m-4">
      <template v-for="(productImage, index) in productItem.data.product_images" :key="index">
        <img :src="productImage.product_image" :alt="productItem.data.product.name"               
        class="max-h-full max-w-full object-cover object-center"
                />
      </template>
      </div>
    
    <div class="p-5">
      <h4 class="text-2xl">{{ productItem.data.product.name }}</h4>
      <h6 class="italic">{{ productItem.data.product.product_category.category_name}}</h6>
      <h6 class="font-semibold">$ {{ productItem.data.price }}</h6>
      <p>
        {{ productItem.data.description }}
      </p>
      <div class="py-8" v-if="userID !== productItem.data.user_id">
      <button
        @click="addToCart"
        type="button"
        class="inline-flex mt-4 items-center justify-center rounded-md bg-green-500 pl-2 pr-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-600 sm:w-auto"
      >Add To Cart
    </button>
    </div>
    
    <div class="mt-4" v-else>
      <i>You own this Item</i>
    </div>
    </div>
  </div>
</div>
</div>
    <div v-else-if="productItem === 'ProductItem not found'">
      Product Item not found
    </div>
    <div v-else class="h-[80vh] flex items-center justify-center">
  Loading...
</div>
  </div>
</template>



<style>
	
	</style>