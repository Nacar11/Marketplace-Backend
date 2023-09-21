<script setup>
import {reactive, ref, computed} from '@vue/reactivity'
import { useRouter } from 'vue-router'
import { useStore } from 'vuex';
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'

const store = useStore();
const userState = computed(() => store.state.user.data);
import agreement from '../components/modal/agreement.vue'
const router = useRouter();

const agreed = ref(false)
const isTermsAccepted = ref(false);

const registerButton = async (ev) => {
  ev.preventDefault()
  const formData = new FormData();
  formData.append('username', state.username);
  formData.append('first_name', state.first_name);
  formData.append('last_name', state.last_name);
  formData.append('email', state.email);
  formData.append('contact_number', state.contact_number);
  formData.append('password', state.password);
  formData.append('confirm_password', state.confirm_password);
  formData.append('gender', state.gender);
  formData.append('date_of_birth', state.date_of_birth);
  formData.append('google_id', state.google_id);
  formData.append('is_subscribe_to_promotions', state.is_subscribe_to_promotions);
  formData.append('is_subscribe_to_newsletters', state.is_subscribe_to_newsletters);

  store.dispatch('register', formData).then((data) => {
	console.log(data)
	if(data.message === 'Success'){
		router.push({
		name: 'home'
	}) 
	}
  })
};
const show = ref(false);

const showModal = () => {
  show.value = !show.value;
};

const state = reactive({
  username: '',
  first_name: ref(userState.value.userFirstName),
  last_name: ref(userState.value.userLastName),
  email: ref(userState.value.userEmail),
  contact_number: '',
  password: '',
  confirm_password: '',
  gender: '',
  date_of_birth: '',
  google_id: ref(userState.value.googleID),
  is_subscribe_to_newsletters: false,
  is_subscribe_to_promotions: false,

});
</script>

<template>
	<agreement
    :show="show"
	:showModal = "showModal"
  />
  <section class="bg-white min-h-screen flex items-center justify-center">
		<div class="bg-gray-50 flex rounded-2xl shadow-lg max-w-4xl p-8 items-center">
		<div class="w-full px-8 md:px-16">

		<h2 class="font-bold text-2xl text-[#002D74]">Hi, {{ userState.userFirstName }}! We'll help you setup your Account, this will only take a minute.</h2>
  
	  	<div class="flex flex-col gap-4">
			<input v-model="state.first_name"
			  id="first_name"
			  name="first_name"
			  type="text"
			  required=""
			  class="p-2 mt-8 rounded-xl border"
			  placeholder="First Name"
			/>
		  
			<input v-model="state.last_name"
			  id="last_name"
			  name="last_name"
			  type="text"
			  required=""
			  class="p-2 mt-8 rounded-xl border"	
			  placeholder="Last Name"
		/>
		  
			<input v-model="state.username"
			  id="username"
			  name="username"
			  type="text"
			  required=""
			  class="p-2 mt-8 rounded-xl border"	
			  placeholder="Username"
		/>
		  
			<input v-model="state.email"
			  id="email"
			  name="email"
			  type="email"
			  autocomplete="email"
			  required=""
			  class="p-2 mt-8 rounded-xl border"
			  placeholder="Email"

			/>
          <select v-model="state.gender"
            id="gender"
            name="gender"
            required=""
			class="p-2 mt-8 rounded-xl border"	
          >
            <option value="" disabled selected>Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        <label for="date_of_birth" class="flex flex-col items-start block text-sm font-medium leading-6 text-black">Date of Birth</label>
          <input v-model="state.date_of_birth"
            id="date_of_birth"
            name="date_of_birth"
            type="date"
            required=""
			class="p-2 rounded-xl border"	
			placeholder="Date of Birth"

          />
        <label for="country_code" class="block text-sm font-medium leading-6 text-black">Phone Number</label>
        <div class="mt-2 flex">
          <span class="rounded-l-xl bg-gray-200 px-3 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-600">+63</span>
          <input v-model="state.contact_number"
            id="country_code"
            name="country_code"
            type="tel" 
            pattern="[0-9]*"
            required=""
            class="flex-1 rounded-r-xl border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-800 sm:text-sm sm:leading-6"
          />
      </div>
			<input v-model="state.password"
			  id="password"
			  name="password"
			  type="password"
			  autocomplete="current-password"
			  required=""
			  class="p-2 mt-8 rounded-xl border"
			  placeholder="Password"
	
			/>
			<input v-model="state.confirm_password"
			  id="confirm_password"
			  name="confirm_password"
			  type="password"
			  autocomplete="current-password"
			  required=""
			  class="p-2 mt-8 rounded-xl border"
			  placeholder="Confirm Password"			
			  />



		<div clas="">
			<SwitchGroup as="div" class="flex my-6 gap-x-4">
          <div class="flex h-6 items-center">
            <Switch v-model="state.is_subscribe_to_newsletters" :class="[state.is_subscribe_to_newsletters ? 'bg-indigo-600' : 'bg-gray-200', 'flex w-8 flex-none cursor-pointer rounded-full p-px ring-1 ring-inset ring-gray-900/5 transition-colors duration-200 ease-in-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600']">
              <span class="sr-only">Agree to policies</span>
              <span aria-hidden="true" :class="[state.is_subscribe_to_newsletters ? 'translate-x-3.5' : 'translate-x-0', 'h-4 w-4 transform rounded-full bg-white shadow-sm ring-1 ring-gray-900/5 transition duration-200 ease-in-out']" />
            </Switch>
          </div>
          <SwitchLabel class="text-lg leading-6 text-black md:text-xl">
           Subscribe to MarketPlace Newsletters
          </SwitchLabel>
        </SwitchGroup>
		<SwitchGroup as="div" class="flex my-6 gap-x-4">
          <div class="flex h-6 items-center">
            <Switch v-model="state.is_subscribe_to_promotions" :class="[state.is_subscribe_to_promotions ? 'bg-indigo-600' : 'bg-gray-200', 'flex w-8 flex-none cursor-pointer rounded-full p-px ring-1 ring-inset ring-gray-900/5 transition-colors duration-200 ease-in-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600']">
              <span class="sr-only">Agree to policies</span>
              <span aria-hidden="true" :class="[state.is_subscribe_to_promotions ? 'translate-x-3.5' : 'translate-x-0', 'h-4 w-4 transform rounded-full bg-white shadow-sm ring-1 ring-gray-900/5 transition duration-200 ease-in-out']" />
            </Switch>
          </div>
          <SwitchLabel class="text-lg leading-6 text-black md:text-xl">
           Subscribe to MarketPlace Promotions
          </SwitchLabel>
        </SwitchGroup>
		<SwitchGroup as="div" class="flex my-6 gap-x-4">
          <div class="flex h-6 items-center">
            <Switch v-model="isTermsAccepted" :class="[isTermsAccepted ? 'bg-indigo-600' : 'bg-gray-200', 'flex w-8 flex-none cursor-pointer rounded-full p-px ring-1 ring-inset ring-gray-900/5 transition-colors duration-200 ease-in-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600']">
              <span class="sr-only"></span>
              <span aria-hidden="true" :class="[isTermsAccepted ? 'translate-x-3.5' : 'translate-x-0', 'h-4 w-4 transform rounded-full bg-white shadow-sm ring-1 ring-gray-900/5 transition duration-200 ease-in-out']" />
            </Switch>
          </div>
          <SwitchLabel class="text-lg leading-6 text-black md:text-xl">
			<span>I accept the <a class="text-[#5b6af2] font-semibold">Terms of Use</a> &  <a @click="showModal" class="text-[#5b6af2] font-semibold">Privacy Policy</a> 
					</span>
          </SwitchLabel>
        </SwitchGroup>
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
	</div>
  
	  <p class="mt-10 text-center text-sm text-gray-500">
		Already have an Account?
		{{ ' ' }}
		<router-link :to="{ name: 'login' }" class=" cursor-pointer font-semibold leading-6 text-black hover:text-gray-600">Login Here</router-link>
	  </p>
	</div>
	</div>
	</section>
  </template>

<style>

</style>