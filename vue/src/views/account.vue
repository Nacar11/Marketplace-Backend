
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
        <div v-if="0==0">
        <p class="mt-4 mb-4">
            You don't have default Address currently, set up your Address first.
        </p></div>
        <p class="flex items-start"><router-link :to="{ name: 'address' }" class="cursor-pointer font-semibold leading-6 m-2 text-indigo-600 hover:text-indigo-400">+Set Up Address</router-link></p>
      </div>
      </div>
    </div>
  </template>
  

<script setup>
import store from '../store'
import { ref, computed} from '@vue/reactivity'
import { onBeforeMount } from '@vue/runtime-core'
import { useRouter } from 'vue-router'

const router = useRouter();

const userProfile = ref([])

onBeforeMount(async () => {
	await store.dispatch('getUser').then((data) => {
    userProfile.value = data
    })
    .catch(err => {
	console.log(err.response.data.message)
    })
})

const capitalize = (str) => {
  return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
};


</script>