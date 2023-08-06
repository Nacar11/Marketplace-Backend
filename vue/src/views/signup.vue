<script setup>
import {reactive, ref} from '@vue/reactivity'
import { useRouter } from 'vue-router'
import store from '../store'
import agreement from '../components/modal/agreement.vue'
const router = useRouter();


const isTermsAccepted = ref(false);

const registerButton = async (ev) => {
  ev.preventDefault()
  store.dispatch('register', state).then((data) => {
	console.log(data)
	router.push({
		name: 'login'
	}) 
  })
};

const show = ref(false);

const showModal = () => {
  show.value = !show.value;
};

const state = reactive({
  username: '',
  first_name: '',
  last_name: '',
  email: '',
  contact_number: '',
  password: '',
  confirm_password: '',
  gender: '',
  date_of_birth: '',
});
</script>

<template>
	<agreement
    :show="show"
	:showModal = "showModal"
  />
	<div class="flex min-h-full flex-1 flex-col justify-center px-12 py-16 lg:px-8 bg-white rounded-lg shadow-lg">
	  <img class="mx-auto h-12 w-auto rounded-full" src="https://via.placeholder.com/50" alt="Your Company" />
	  <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-black">Create your Account</h2>
  
	  <form class="space-y-6 mt-6">
		<div>
		  <label for="first_name" class="flex flex-col items-start block text-sm font-medium leading-6 text-black">First Name</label>
		  
		  <div class="mt-2">
			<input v-model="state.first_name"
			  id="first_name"
			  name="first_name"
			  type="text"
			  required=""
			  class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-800 sm:text-sm sm:leading-6"
			/>
		  </div>
		</div>
		<div>
		  <label for="last_name" class="flex flex-col items-start block text-sm font-medium leading-6 text-black">Last Name</label>
		  
		  <div class="mt-2">
			<input v-model="state.last_name"
			  id="last_name"
			  name="last_name"
			  type="text"
			  required=""
			  class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-800 sm:text-sm sm:leading-6"
			/>
		  </div>
		</div>
		<div>
		  <label for="username" class="flex flex-col items-start block text-sm font-medium leading-6 text-black">Username</label>
		  
		  <div class="mt-2">
			<input v-model="state.username"
			  id="username"
			  name="username"
			  type="text"
			  required=""
			  class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-800 sm:text-sm sm:leading-6"
			/>
		  </div>
		</div>
		<div>
		  <label for="email" class="flex flex-col items-start block text-sm font-medium leading-6 text-black">Email address</label>
		  
		  <div class="mt-2">
			<input v-model="state.email"
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
        <label for="gender" class="flex flex-col items-start block text-sm font-medium leading-6 text-black">Gender</label>
        <div class="mt-2">
          <select v-model="state.gender"
            id="gender"
            name="gender"
            required=""
            class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-800 sm:text-sm sm:leading-6"
          >
            <option value="" disabled selected>Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>
      </div>
		<div>
        <label for="date_of_birth" class="flex flex-col items-start block text-sm font-medium leading-6 text-black">Date of Birth</label>
        <div class="mt-2">
          <input v-model="state.date_of_birth"
            id="date_of_birth"
            name="date_of_birth"
            type="date"
            required=""
            class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-800 sm:text-sm sm:leading-6"
          />
        </div>
      </div>
	  <div class="flex flex-col items-start">
        <label for="country_code" class="block text-sm font-medium leading-6 text-black">Country Code</label>
        <div class="mt-2 flex">
          <span class="rounded-l-md bg-gray-200 px-3 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-600">+63</span>
          <input v-model="state.contact_number"
            id="country_code"
            name="country_code"
            type="tel" 
            pattern="[0-9]*"
            required=""
            class="flex-1 rounded-r-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-800 sm:text-sm sm:leading-6"
          />
        </div>
      </div>
		<div>
		  <div class="flex items-center justify-between">
			<label for="password" class="block text-sm font-medium leading-6 text-black">Password</label>
		  </div>
		  <div class="mt-2">
			<input v-model="state.password"
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
		  <div class="flex items-center justify-between">
			<label for="confirm_password" class="block text-sm font-medium leading-6 text-black">Confirm Password</label>
		  </div>
		  <div class="mt-2">
			<input v-model="state.confirm_password"
			  id="confirm_password"
			  name="confirm_password"
			  type="password"
			  autocomplete="current-password"
			  required=""
			  class="block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-800 sm:text-sm sm:leading-6"
			/>
		  </div>
		</div>
		<div>
			
		  <div class="m-2">
		  <input type="checkbox" v-model="isTermsAccepted" class="mx-2 border border-gray-400">
				<span>I accept the <a class="text-[#5b6af2] font-semibold">Terms of Use</a> &  <a @click="showModal" class="text-[#5b6af2] font-semibold">Privacy Policy</a> 
					</span>
				</div>
		  <button
		 	:disabled="!isTermsAccepted"
			@click="registerButton"
			:class="{
        'flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600': isTermsAccepted,
        'flex w-full justify-center rounded-md bg-gray-300 px-3 py-1.5 text-sm font-semibold leading-6 text-gray-600 cursor-not-allowed': !isTermsAccepted
      }"
		  >
			Sign Up
		  </button>
		</div>
	  </form>
  
	  <p class="mt-10 text-center text-sm text-gray-500">
		Already have an Account?
		{{ ' ' }}
		<router-link :to="{ name: 'login' }" class=" cursor-pointer font-semibold leading-6 text-black hover:text-gray-600">Login Here</router-link>
	  </p>
	</div>
  </template>

<style>

</style>