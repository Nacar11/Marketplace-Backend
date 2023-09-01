<template>
    <div class="isolate bg-white px-6 py-10 sm:py-32 lg:px-8">
      <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
      </div>
      <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Address Details</h2>
        <p class="mt-2 text-lg leading-8 text-gray-600">Set up your Billing Address </p>
      </div>
      <div class="mx-auto mt-16 max-w-xl sm:mt-20">
        <div class="grid grid-cols-3 gap-x-8 gap-y-6 sm:grid-cols-2">
          <div>
            <label class="block text-sm font-semibold leading-6 text-gray-900">Unit Number</label>
              <input v-model="state.unit_number" type="text" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
          <div>
            <label class="block text-sm font-semibold leading-6 text-gray-900">Street Number</label>
              <input v-model="state.street_number" type="text" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
          <div class="sm:col-span-2">
            <label class="block text-sm font-semibold leading-6 text-gray-900">Address Line 1</label>
              <input type="text" v-model="state.address_line_1" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
          <div class="sm:col-span-2">
            <label class="block text-sm font-semibold leading-6 text-gray-900">Address Line 2</label>
              <input type="text" v-model="state.address_line_2" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
          <div>
            <label for="region" class="block text-sm font-semibold leading-6 text-gray-900">Region</label>
              <input type="text" v-model="state.region" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
          <div>
            <label class="block text-sm font-semibold leading-6 text-gray-900">City</label>
              <input type="text" v-model="state.city" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
          <div>
            <label class="block text-sm font-semibold leading-6 text-gray-900">Postal Code</label>
              <input v-model="state.postal_code" type="text" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
          </div>
          <div>
          <label class="block text-sm font-semibold leading-6 text-gray-900">Country</label>
            <div class="flex items-center">

              <select v-model="state.country_id" class="w-full h-10 rounded-md border border-gray-300 bg-none py-0 pl-4 pr-9 text-gray-900 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
      <!-- <ChevronDownIcon class="absolute top-0 h-full w-5 text-gray-400" aria-hidden="true" /> -->

              <option value="" disabled selected>Select Your Country</option>
              <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
            </select>
            </div>
        </div>

          <!-- <SwitchGroup as="div" class="flex gap-x-4 sm:col-span-2">
            <div class="flex h-6 items-center">
              <Switch v-model="agreed" :class="[agreed ? 'bg-indigo-600' : 'bg-gray-200', 'flex w-8 flex-none cursor-pointer rounded-full p-px ring-1 ring-inset ring-gray-900/5 transition-colors duration-200 ease-in-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600']">
                <span class="sr-only">Agree to policies</span>
                <span aria-hidden="true" :class="[agreed ? 'translate-x-3.5' : 'translate-x-0', 'h-4 w-4 transform rounded-full bg-white shadow-sm ring-1 ring-gray-900/5 transition duration-200 ease-in-out']" />
              </Switch>
            </div>
            <SwitchLabel class="text-sm leading-6 text-gray-600">
              By selecting this, you agree to our
              {{ ' ' }}
              <a href="#" class="font-semibold text-indigo-600">privacy&nbsp;policy</a>.
            </SwitchLabel>
          </SwitchGroup> -->
        </div>
        <div class="mt-10">
          <button @click="addressButton" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Address</button>
        </div>
    </div>
    </div>
  </template>
  
  <script setup>
  import {reactive, ref} from '@vue/reactivity'
  import { useRouter } from 'vue-router'
  // import { ChevronDownIcon } from '@heroicons/vue/20/solid'
  // import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'
  import { onBeforeMount } from '@vue/runtime-core'
  import store from '../store'

  const router = useRouter();

  const countries = ref([])

  onBeforeMount(async () => {
	store.dispatch('getCountries').then((data) => {
	countries.value = data
	})
})
const addressButton = async (ev) => {
store.dispatch('addAddress', state).then((data) => {
	console.log(data)
  if(data.message === 'Success'){
		router.push({
		name: 'account'
	}) 
	}
  
  })
  
}



const state = reactive({
  unit_number: '',
  street_number: '',
  address_line_1: '',
  address_line_2: '',
  city: '',
  region: '',
  postal_code: '',
  country_id: '',
});

  </script>
