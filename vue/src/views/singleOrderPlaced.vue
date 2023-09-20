<script setup>
import { onBeforeMount, onMounted } from '@vue/runtime-core'
import {ref, computed} from '@vue/reactivity'
import store from '../store'
import { useRouter } from 'vue-router'

const router = useRouter();

onMounted(async () => {
    await getOrdersPlaced();
})

const getOrdersPlaced = async () => {
    await store.dispatch('getSingleOrderline',props.id).then((data) => {
    single_order.value = data
    console.log(single_order.value)

    })
  .catch(err => {
	console.log(err)
    })
}
const single_order = ref([])
const props = defineProps({
  id: Number, 
});

</script>


<template>
{{ props.id }}
{{ single_order }}

</template>



<style>
	
	</style>