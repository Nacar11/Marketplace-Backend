<script setup>
import {ref} from '@vue/reactivity'
import { onMounted } from '@vue/runtime-core'
import { useRouter } from 'vue-router'
import store from '../store'
import { GoogleLogin } from 'vue3-google-login'



const router = useRouter();
const error= ref('')
const userData= ref([])

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
// const facebookLogin = async (ev) => {
//   ev.preventDefault()
//   store.dispatch('facebookLogin').then((data) => {
// 	console.log(data)
// 	const redirectUrl = data.redirect_url;
// 	window.location.href = redirectUrl;
	
//   })
//   .catch(err => {
// 	console.log(err.response.data.message)
// 	error.value = err.response.data.message
//   })
// }
const googleCallback = async (user) => {
  
  console.log(user);
  const response = await fetch('https://www.googleapis.com/oauth2/v3/userinfo', {
    headers: {
      Authorization: `Bearer ${user.access_token}`,
    },
  });

  if (response.ok) {
    userData.value = await response.json();
    console.log('User Data:', userData.value.email);
  	} 
  else {
    console.error('Failed to fetch user data:', response.status, response.statusText);
  }

  store.dispatch('googleLogin',userData.value).then((data) => {
	console.log(data)
	if(data.message === 'registerFirst'){
		store.commit('setUserToRegister', userData.value);
		router.push({
		name: 'signup',
	}) 	
	}
	else if(data.message === 'Success'){
		router.push({
		name: 'home',
	}) 	
	}
  })
};
const user = {
email:'',
password :''
}

</script>


<template>
	<section class="bg-white min-h-screen flex items-center justify-center">
		<div class="bg-gray-50 flex rounded-2xl shadow-lg max-w-4xl p-8 items-center">
		<div class="w-full px-8 md:px-16">
      <h2 class="font-bold text-2xl text-[#002D74]">Login</h2>
	  <div class="flex flex-col gap-4">
			<input
			  class="p-2 mt-8 rounded-xl border"
			  v-model="user.email"
			  id="email"
			  name="email"
			  type="email"
			  autocomplete="email"
			  required=""
			  placeholder="Email"
			/>
  
			<div class="relative">
			<input
			  class="p-2 rounded-xl border w-full"
			  v-model="user.password"
			  id="password"
			  name="password"
			  type="password"
			  autocomplete="current-password"
			  required=""
			  placeholder="Password"
			/>
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-eye absolute top-1/2 right-3 -translate-y-1/2" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
          </svg>
		</div>
		<button class="bg-[#002D74] mt-2 rounded-xl text-white py-2"
			@click="loginButton">
			Login
		  </button>
  
		  <div class="mt-6 grid grid-cols-3 items-center text-gray-400">
        <hr class="border-gray-400">
        <p class="text-center text-sm">OR</p>
        <hr class="border-gray-400">
      </div>
	  <button @click="facebookLogin" class="bg-white border py-2 w-full rounded-xl mt-5 flex justify-center items-center text-sm text-[#002D74]">
		<i class="fab fa-facebook mr-3"></i> 
        Login with Facebook
      </button>
	  <GoogleLogin
            :callback="googleCallback"
            class="google-btn"
            popup-type="TOKEN"
          >
            <button
              class="login-google bg-white border py-2 w-full rounded-xl mt-5 flex justify-center items-center text-sm text-[#002D74]"
            
              size="large"
              type="primary"
            >
			<i class="fab fa-google mr-3"></i> 
			Login With Google
              <!-- {{ loading ? 'Logging In' : ' Login With Google ' }} -->
            </button>
          </GoogleLogin>
	  <div class="mt-5 text-xs py-4 text-[#002D74]">
        <a href="#">Forgot your password?</a>
      </div>

      
	  </div>
	</div>
	</div>
	</section>
  </template>
  
  

<style>
</style>