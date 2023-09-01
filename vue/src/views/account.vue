<script setup>
import store from '../store'
import { ref, computed} from '@vue/reactivity'
import { onBeforeMount } from '@vue/runtime-core'
import { useRouter } from 'vue-router'

const router = useRouter();

const userProfile = ref([])
const addresses = ref([])

onBeforeMount(async () => {
	await store.dispatch('getUser').then((data) => {
    userProfile.value = data
    })
    .catch(err => {
	console.log(err.response.data.message)
    })

  await store.dispatch('getAddress').then((data) => {
  addresses.value = data
  })
  .catch(err => {
	console.log(err.response.data.message)
  })

  console.log(addresses.value.data)
})

const addressesData = computed(() => {
  const data = addresses.value.data;
  const isEmpty = !data || data.length === 0;
  return { data, isEmpty };
});
const capitalize = (str) => {
  return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
};

const removeAddress = async (id) => {
  await store.dispatch('deleteAddress',id).then((data) => {
    console.log(data)
  })
};



</script>
<template>
    <div class="min-h-screen bg-gray-100 flex">
      <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center mb-4">
          <div class="w-20 h-20 rounded-full bg-gray-300 mr-4"></div> <!-- Placeholder profile picture -->
          <div class="flex items-start flex-col">
            <h2 class="text-2xl font-semibold">{{ capitalize(userProfile.username) }}</h2> <!-- Name -->
            <p class="text-gray-600">{{ capitalize(userProfile.first_name) }} {{ capitalize(userProfile.last_name) }}</p>
            <p class="text-gray-600">{{ userProfile.email }}</p> <!-- Email -->
          </div>
        </div>
        <div class="flex flex-col">
        <p class="font-semibold leading-6 m-2 text-black">User Address</p>
        <div v-if="addressesData.isEmpty">
        <p class="mt-4 mb-4">
            You don't have default Address currently, set up your Address first.
        </p>
      </div>
      <div v-else>
        <ul role="list" class="divide-y divide-gray-100">
    <li v-for="data in addresses.data" :key="data.id" class="flex justify-between gap-x-6 py-5">
      <div class="flex min-w-0 gap-x-4">
        <div class="min-w-0 flex-auto">
          <p class="text-sm font-semibold leading-6 text-gray-900">{{ data.address.city }}</p>
          <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ data.address.address_line_1 }}</p>
        </div>
      </div>
      <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
        <p class="text-sm leading-6 text-gray-900">{{ data.address.region }}</p>
        <p class="mt-1 text-xs leading-5 text-gray-500">
        {{ data.address.postal_code }}
        </p>
        <div class="mt-1 flex items-center gap-x-1.5">
          <div class="flex-none rounded-full bg-emerald-500/20 p-1">
            <div class="h-1.5 w-1.5 rounded-full bg-emerald-500" />
          </div>
          <button @click="removeAddress(data.id)" class="text-xs leading-5 text-gray-500">Remove</button>
        </div>
      </div>
    </li>
  </ul>
      </div>
        <p class="flex items-start"><router-link :to="{ name: 'address' }" class="cursor-pointer font-semibold leading-6 m-2 text-indigo-600 hover:text-indigo-400">+Set Up Address</router-link></p>
      </div>
      </div>
    </div>
  </template>
  

