<script setup>

import authenticationHeader from '/src/components/layout/authenticationHeader.vue';
import appFooter from '/src/components/layout/appFooter.vue';

</script>

<template>
  <div>
    <authenticationHeader/>
        <router-view />
		</div>
	  <div class='foot1'>
		  <!-- <appFooter/> -->
	  </div>
</template>




<style>
</style>