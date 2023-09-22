<script setup>
import { onBeforeMount } from '@vue/runtime-core'
import {ref, computed} from '@vue/reactivity'
import store from '../store'
import { useRouter } from 'vue-router'

const router = useRouter();

const productItem = ref([])
const hasMatchingId = ref(false);
const fetchShoppingCartData = async () => {
  await store.dispatch('getShoppingCartByUser',userID.value).then((data) => {
    console.log(store.getters.shoppingCart)
    for(const item of store.getters.shoppingCart.items){
      if (item.product_item_id === props.id) {
          hasMatchingId.value = true;
          break; 
        }
    }
  })
  .catch(err => {
	console.log(err)
  })
}
onBeforeMount(async () => {
  getProductItemFullDetails()
  fetchShoppingCartData()
  getAllOrderLines()
})
const productOrdered = ref(false);

const getAllOrderLines = async () => {
  await store.dispatch('getAllOrderLines').then((data) => {
    console.log(store.getters.orderLines)
    for(const item of store.getters.orderLines){
      if (item.product_item.id === props.id) {
          productOrdered.value = true;
          break; 
        }
    }
  
  })
  .catch(err => {
  })
}

const getProductItemFullDetails = async () => {
  await store.dispatch('getProductItemFullDetails', props.id ).then((data) => {
  productItem.value = data
  console.log(productItem.value)

  })
  
  .catch(err => {
	console.log(err.response.data.message)
	productItem.value = err.response.data.message
  })
}
const props = defineProps({
  id: Number, 
});



const addToCart = async() => {
  const formData = new FormData();
  formData.append('product_item_id', props.id);
  console.log(formData.value)
  store.dispatch('addToCart',formData).then((data) => {
    console.log(data)
    if(data.message === 'success'){
      router.push({
		  name: 'home',
	    }) 	
    }

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
      <p v-for="variationOptions in productItem.data.variation_options">
        {{ variationOptions.variation.name }}: {{ variationOptions.value}}
      </p>
      
      
      <div class="py-8" v-if="userID !== productItem.data.user_id">
          <div v-if="productOrdered">
            <button
              :disabled=true
              type="button"
              class="inline-flex mt-4 items-center justify-center rounded-md bg-green-500 pl-4 pr-4 py-2 text-sm font-semibold text-white cursor-not-allowed opacity-50"
                >
              Unavailable
            </button>
          </div>
            <div v-else-if="hasMatchingId">
              <button
              :disabled=true
              type="button"
              class="inline-flex mt-4 items-center justify-center rounded-md bg-green-500 pl-4 pr-4 py-2 text-sm font-semibold text-white cursor-not-allowed opacity-50"
                >
              Added to Cart
            </button>
            </div>
            <div v-else>
              <button
              @click="addToCart"
              type="button"
              class="inline-flex mt-4 items-center justify-center rounded-md bg-green-500 pl-4 pr-4 py-2 text-sm font-semibold text-white  hover:bg-green-600"
              >Add To Cart
              </button>
          </div>
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