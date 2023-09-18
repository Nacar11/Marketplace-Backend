<script setup>
import navbar from '/src/components/layout/navbar.vue';
import appFooter from '/src/components/layout/appFooter.vue';

</script>

<template>
  <div class>
    <navbar/>
        <router-view />
		</div>
	  <div class='foot1'>
		  <appFooter/>
	  </div>
</template>







