<script setup>
// import {ref} from '@vue/reactivity'
// import { useRouter } from 'vue-router'
// import { useAuthenticateStore } from '../../store/authenticate'
// import { storeToRefs } from 'pinia'



</script>



<template>
<div class="bg-gray-100 flex shadow-lg max-w-3xl p-10 rounded-lg">
    <div class="px-1 md:px-16 ">
          <h3 class="font-bold text-[#5b6af2]">Login</h3>
          <p class="text-xs mt-4 text-[#5b6af2]">If you are already a member, easily log in</p>
   
            <input v-model="email" class="p-2 mt-8 rounded-xl border" type="email" name="email" placeholder="Email">
            <div class="relative">
              <input v-model="password" class="p-2 rounded-xl border w-full" type="password" name="password" placeholder="Password">
              <div class="mt-5 text-xs border-[#002D74] text-[#002D74]">
                <a href="#">Forgot your password?</a>
              </div>
            </div>
            </div>
            </div>

</template>