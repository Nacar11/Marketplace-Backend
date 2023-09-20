<script setup>
import { ref, computed } from 'vue'
import { onMounted } from '@vue/runtime-core'
import { useRouter, onBeforeRouteUpdate } from 'vue-router'

import store from '../store'
import deleteModal from '../components/modal/delete.vue'


const router = useRouter();



const userID = computed(() => {
  return sessionStorage.getItem('userID')
})
const totalValue = ref(0)
const shopping_cart = ref([]);
const show = ref(false);
const itemID = ref(0)
const showModal = () => {
    console.log(show.value)
    show.value = !show.value;
}
const removeItem = (item_id) => {
    show.value = true;
    itemID.value = item_id
}

const fetchShoppingCartData = async () => {
await store.dispatch('getShoppingCartByUser',userID.value).then((data) => {
    shopping_cart.value = data
    console.log(shopping_cart.value)
    console.log(store.getters.shoppingCart)
    let total = 0
    for (const item of data.items) {
    total += parseFloat(item.product_item.price);
    
  }
  console.log(total)
  totalValue.value = total.toFixed(2)
  })
  .catch(err => {
	console.log(err)
  })
}

onMounted(async () => {
    await fetchShoppingCartData();

})


</script>

<template>
    <deleteModal
    :itemID="itemID"
    :show="show"
    :showDeleteModal="showModal"
    />
<div class="flex-1 overflow-y-auto px-4 py-6">
<div class="flex items-start justify-between">
    <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Your Shopping cart</h2>
    <div class="ml-3 flex h-7 items-center">
     </div>
</div>

<div class="mt-8">
<div class="flow-root">
    <ul role="list" class="-my-6 divide-y divide-gray-200">
    <li v-for="item in shopping_cart.items" :key="item.id" class="flex py-6">
      <div class="carousel flex-shrink-0">
        <div class="carousel-item h-24 w-24 overflow-hidden rounded-md border border-gray-200">
          <img
            :src="item.product_item.product_images[0].product_image"
            :alt="item.product_item.product_images[0].imageAlt"
            class="h-full w-full object-cover object-center"
          />
        </div>
      </div>
  
    <div class="ml-4 flex flex-1 flex-col">
    <div>
        <div class="flex justify-between text-base font-medium text-gray-900">
        <h3>
            <a>{{ item.product_item.product.name }}</a>
            </h3>
            <p class="ml-4">{{ item.product_item.price }}</p>
            </div>
            <!-- <p class="mt-1 text-sm text-gray-500">{{ item.color }}</p> -->
        </div>
        <div class="flex flex-1 items-end justify-between text-sm">
            <div class="flex">
            <button @click="removeItem(item.id)" type="button" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
            </div>
        </div>
        </div>
    </li>
    </ul>
</div>
</div>

</div>

<div class="border-t border-gray-200 px-4 py-6 sm:px-6">
<div class="flex justify-between text-base font-medium text-gray-900">
    <p>Subtotal</p>
    <p>{{ totalValue }}</p>
</div>
<p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
<div class="mt-6">
  <router-link :to="{ name: 'checkout' }" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</router-link>
</div>
<div class="mt-6 flex justify-center text-center text-sm text-gray-500">
    <p>
        or
    <router-link :to="{ name: 'home' }" class="font-medium text-indigo-600 hover:text-indigo-500 cursor-pointer">
        Continue Shopping
        <span aria-hidden="true"> &rarr;</span>
    </router-link>
     </p>
</div>
</div>  


	
</template>


<style>
	
	</style>