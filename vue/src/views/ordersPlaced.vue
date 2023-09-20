<script setup>

import {ref} from '@vue/reactivity'
import { onMounted } from '@vue/runtime-core'
import { useRouter } from 'vue-router'
import store from '../store'

const orders_placed = ref([])
const orders_received = ref([])

onMounted(async () => {
    await getOrdersPlaced();
})

const getOrdersPlaced = async () => {
    await store.dispatch('getOrderLinesByID').then((data) => {
    orders_placed.value = data
    console.log(orders_placed.value)

    })
  .catch(err => {
	console.log(err)
    })
}

</script>

<template>
    <div class="mt-6 mb-6 justify-center items-center bg-white p-4 flex"> 
        <div class="flex flex-col">
          <p class="font-semibold leading-6 m-1 text-black">Orders Placed</p>
          <div>
            <ul>
            <li v-for="shop_order in orders_placed" :key="shop_order.id" class="mt-5 flex justify-between py-5 border-b border-gray-200">
              <div class="carousel-item h-15 w-20 overflow-hidden rounded-md border border-gray-200">
                <router-link :to="{ name: 'singleOrderPlaced', params: { id: shop_order.id } }">
                <img
                @click=""
                :src="shop_order.product_item.product_images[0].product_image"
                class="h-full w-full object-cover object-center"
                />
                </router-link>
                </div>
            <div class="flex flex-col px-2">
            <p class="md:text-base text-xs text-black">{{shop_order.product_item.product.name }}</p>
            <p class="md:text-base text-xs text-black">Php {{shop_order.product_item.price }}</p>
            <p class="md:text-base mt-3 text-xs text-black">Order Date:</p>
            <p class="md:text-base text-xs text-black">{{shop_order.order_date }}</p>
          </div>
          <div class="flex flex-col px-2">
            <h2 class="md:text-base text-xs font-semibold">Delivery Address:</h2>
            <h2 class="md:text-base mt-1 text-xs font-semibold">{{shop_order.shipping_address.address_line_1 }}</h2>
            <h2 class="md:text-base text-xs font-semibold">{{shop_order.shipping_address.city }}, {{shop_order.shipping_address.postal_code }}</h2>
            <div class="md:text-base mt-3 flex items-center justify-center">
            <h2 class="md:text-base text-xs font-semibold py-1 px-4 rounded-full bg-blue-500 text-white hover:bg-blue-600">
            {{ shop_order.order_status.status }}
            </h2>
          </div>

          </div>
            </li>
          </ul>
        </div>
        </div>
      </div>
  
      <!-- Second Column -->
      
  </template>
  