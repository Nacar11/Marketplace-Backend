<script setup>
import {ref} from '@vue/reactivity'
import { useRouter } from 'vue-router'
import store from '../store'
import agreement from '../components/modal/agreement.vue';


const router = useRouter();
const error= ref('')

const loginButton = async (ev) => {
  ev.preventDefault()
  store.dispatch('login', user).then((data) => {
	console.log(data)
	router.push({
		name: 'home',
	}) 	
  })
  .catch(err => {
	console.log(err.response.data.message)
	error.value = err.response.data.message
  })
};
const user = {
email:'',
password :''
}

</script>


<template>
	<!-- <agreement :show="state.show"></agreement> -->

	<div class="flex min-h-full flex-1 flex-col justify-center px-12 py-16 lg:px-8 bg-white rounded-lg shadow-lg">
	  <img class="mx-auto h-12 w-auto rounded-full" src="https://via.placeholder.com/50" alt="Your Company" />
	  <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-black">Log in to your account</h2>
  
	  <form class="space-y-6 mt-6">
		<div v-if="error" class="py-3 px-5 bg-red-500 text-white rounded">
			{{ error }}
		</div>
		<div>
		  <label for="email" class="flex flex-col items-start block text-sm font-medium leading-6 text-black">Email address</label>
		  
		  <div class="mt-2">
			<input
			  v-model="user.email"
			  id="email"
			  name="email"
			  type="email"
			  autocomplete="email"
			  required=""
			  class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-800 sm:text-sm sm:leading-6"
			/>
		  </div>
		</div>
  
		<div>
		  <div class="flex items-center justify-between">
			<label for="password" class="block text-sm font-medium leading-6 text-black">Password</label>
			<div class="text-sm">
			  <a href="#" class="font-semibold text-black hover:text-blue-800">Forgot password?</a>
			</div>
		  </div>
		  <div class="mt-2">
			<input
			  v-model="user.password"
			  id="password"
			  name="password"
			  type="password"
			  autocomplete="current-password"
			  required=""
			  class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-800 sm:text-sm sm:leading-6"
			/>
		  </div>
		</div>
  
		<div>
		  <button
			@click="loginButton"
			class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
		  >
			Sign in
		  </button>
		</div>
	  </form>
  
	  <p class="mt-10 text-center text-sm text-gray-500">
		No Account yet?
		{{ ' ' }}
		<router-link :to="{ name: 'signup' }" class=" cursor-pointer font-semibold leading-6 text-black hover:text-gray-600">Register Here</router-link>
	  </p>
	</div>
  </template>
  
  

<style>
</style>