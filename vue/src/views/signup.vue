<script setup>
import {reactive} from '@vue/reactivity'
import { useRouter } from 'vue-router'
// import { useAuthenticateStore } from '../../store/authenticate'

// const { register } = useAuthenticateStore()
// const router = useRouter()


// const registerButton = async () => {
//   if (formData.password === formData.confirm_password) {
//     try {
//       const response = await register(formData);
//       console.log(response);
//       // Handle the successful registration here, if needed
//       router.push('/login'); // Redirect to login page after successful registration
//     } catch (error) {
//       console.log(error);
//       // Handle the error during registration here
//       if (error.response) {
//         console.log('Error during Registration:', error.response.data);
//         // You can show error messages to the user using this response data
//       }
//     }
//   } else {
//     console.log('Error: Passwords do not match');
//     // Handle the case where the passwords do not match
//   }
// };

const formData = reactive({
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
	<div class="flex min-h-full flex-1 flex-col justify-center px-12 py-16 lg:px-8 bg-white rounded-lg shadow-lg">
	  <img class="mx-auto h-12 w-auto rounded-full" src="https://via.placeholder.com/50" alt="Your Company" />
	  <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-black">Create your Account</h2>
  
	  <form class="space-y-6 mt-6">
		<div>
		  <label for="first_name" class="flex flex-col items-start block text-sm font-medium leading-6 text-black">First Name</label>
		  
		  <div class="mt-2">
			<input
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
			<input
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
			<input
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
			<input
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
          <select
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
          <input
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
          <input
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
			<input
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
			<input
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
		  <button
			type="submit"
			class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
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