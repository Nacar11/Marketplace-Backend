<script setup>

import {ref} from '@vue/reactivity'
import { onMounted } from '@vue/runtime-core'
import { useRouter } from 'vue-router'
import store from '../store'

const orders_placed = ref([])
const orders_received = ref([])

onMounted(async () => {
    await getOrdersPlaced();
    await getOrdersReceived();
})

const getOrdersPlaced = async () => {
    await store.dispatch('getShopOrderByID').then((data) => {
    orders_placed.value = data
    console.log(orders_placed.value)

    })
  .catch(err => {
	console.log(err)
    })
}

const getOrdersReceived = async () => {
    await store.dispatch('getOrdersReceived').then((data) => {
    orders_received.value = data
    console.log(orders_received.value)

    })
  .catch(err => {
	console.log(err)
    })
}
</script>

<template>
    <div class="min-h-screen bg-gray-100 flex">
      <!-- First Column -->
      <div class="flex-1 bg-white p-6 rounded-lg shadow-md">
            <!-- Add content for the first column as needed -->
        <div class="flex flex-col">
          <p class="font-semibold leading-6 m-2 text-black">Orders Placed</p>
          <div>
            <ul>
                <li v-for="shop_order in orders_placed" :key="shop_order.id" class="flex justify-between gap-x-6 py-5">

            <h2 class="text-2xl font-semibold">{{shop_order.SKU }}</h2>
            <h2 class="text-2xl font-semibold">{{shop_order.order_date }}</h2> <!-- Name -->
            <p class="text-gray-600">{{ shop_order.order_total }}</p>
            </li>
          </ul>
        </div>
        </div>
      </div>
  
      <!-- Second Column -->
      <div class="flex-1 bg-white p-6 rounded-lg shadow-md">
        <!-- Add content for the second column as needed -->
        <div class="flex flex-col">
          <p class="font-semibold leading-6 m-2 text-black">Orders Received from your Product Listings</p>
          <div>
            <ul>
                <li v-for="shop_order in orders_received" :key="shop_order.id" class="flex justify-between gap-x-6 py-5">

            <h2 class="text-2xl font-semibold">{{shop_order.SKU }}</h2> <!-- Name -->
            <p class="text-gray-600">{{ shop_order.price }}</p>
            </li>
          </ul>
          </div>
        </div>
      </div>
    </div>
  </template>
  