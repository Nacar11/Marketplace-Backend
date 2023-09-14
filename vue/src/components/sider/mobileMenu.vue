<template>
    <TransitionRoot as="template" 
        :show="props.visibility">
      <Dialog as="div" class="relative z-10" @close="toggleSider">
        <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>
  
        <div class="fixed inset-0 overflow-hidden">
          <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 left-0 flex max-w-full pr-10">
              <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="-translate-x-full">
                <DialogPanel class="pointer-events-auto w-screen max-w-md">
                  <div class="flex h-full flex-col bg-white shadow-xl">
                    <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                      <div class="flex items-start justify-between">
                        <!-- <DialogTitle class="text-lg font-medium text-gray-900">Login</DialogTitle> -->
                        <div class="ml-3 flex flex-row">
                            <div class="icon facebook mr-6">
                                <span class="flex items-center justify-center cursor-pointer block h-14 w-14 bg-white rounded-full relative z-20 shadow-md transition-transform transform hover:scale-110"><i class="fab fa-facebook-f fa-2x"></i></span>
                            </div>
                            <div class="icon google mr-6">
                                <span class="flex items-center justify-center cursor-pointer block h-14 w-14 bg-white rounded-full relative z-20 shadow-md transition-transform transform hover:scale-110">
                                    <i class="fab fa-google fa-2x"></i>
                                </span>
                            </div>
                        </div>
                        <div class="ml-3 flex h-7 items-center">
                          <button type="button" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500" @click="toggleSider">
                            <span class="absolute -inset-0.5"/>
                            <XMarkIcon class="h-6 w-6" aria-hidden="true"/>
                          </button>
                        </div>
                      </div>
  
<div>
    <div class="mt-8 flow-root">
    <div class="border-t border-b border-gray-200" 
    v-for="parentCategory in organizedCategories" :key="parentCategory.id">
        <ul role="list" class=" divide-y divide-gray-200">
        <li @click="toggleSubMenu(parentCategory)" class="cursor-pointer justify-between flex w-full items-center py-2">
        <span>{{ parentCategory.category_name }}</span>
        <span class="text-sm" :class="{ 'rotate-180': parentCategory.showSubMenu }">
        <i class="fa fa-chevron-down text-gray-400"></i>
        </span>
        </li>     
        </ul>
    <div class="text-left text-sm font-thin mt-2 w-4/5">
        <ul v-show="parentCategory.showSubMenu" class="submenu">
        <li @click="filterByCategory(subCategory.id)" class='hover:bg-gray-100 hover:border rounded-lg py-2 pl-2 cursor-pointer' v-for="subCategory in parentCategory.children" :key="subCategory.id">
        {{ subCategory.category_name }}
        </li>
        </ul>
    </div>
    </div>
    </div>
    </div>
    </div>  
</div>
    </DialogPanel>
    </TransitionChild>
    </div>
    </div>
    </div>
    </Dialog>
    </TransitionRoot>

    
  </template>
  
  <script setup>
  import { ref} from '@vue/reactivity'
  import store from '../../store'
  import { useRouter } from 'vue-router'
  import { onBeforeMount } from '@vue/runtime-core'
  import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
  import { XMarkIcon } from '@heroicons/vue/24/outline'
  
  const router = useRouter();
  const props = defineProps({
  visibility: Boolean,
  openSider: Function,

})
const toggleSider = () => {
  props.openSider()
};

const toggleSubMenu = (parentCategory) => {
  parentCategory.showSubMenu = !parentCategory.showSubMenu;
};

const organizedCategories = ref([])

onBeforeMount(async () => {
await store.dispatch('getProductCategories').then(() => {
  organizedCategories.value = store.getters.organizedCategories
  console.log(organizedCategories.value)
  })
console.log(organizedCategories.value)
})

const filterByCategory = async(id) =>{
await store.dispatch('getProductItemsByCategory', id).then((data) => {
  console.log(store.getters.filteredProductItems)
  if(data.status === 'Success'){
    toggleSider()
    router.push({
		name: 'shop',
	    }) 	
    }
  })
}
  
  const open = ref(true)
  </script>