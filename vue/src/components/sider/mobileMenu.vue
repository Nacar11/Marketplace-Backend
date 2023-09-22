<template>
    <TransitionRoot as="template" 
        :show="props.visibility">
      <Dialog as="div" class="relative z-10" @close="toggleSider">
        <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>
  
        <div class="fixed inset-0 overflow-hidden">
          <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 left-0 flex max-w-xs md:max-w-md"  >
              <TransitionChild as="template" enter="transform transition ease-in-out duration-500" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500" leave-from="translate-x-0" leave-to="-translate-x-full">
                <DialogPanel class="pointer-events-auto w-screen max-w-sm">
                  <div class="flex h-full flex-col bg-white shadow-xl">
                    <div class="flex-1 overflow-y-auto px-4 py-6">
                      <div class="flex items-start justify-between">
                        <!-- <DialogTitle class="text-lg font-medium text-gray-900">Login</DialogTitle> -->
                        <div v-if="!store.state.user.token" class="ml-3 flex flex-row">
                            <div class="icon facebook mr-6">
                                <span class="flex items-center justify-center cursor-pointer block h-14 w-14 bg-white rounded-full relative z-20 shadow-md transition-transform transform hover:scale-110"><i class="fab fa-facebook-f fa-2x"></i></span>
                            </div>
                            <div class="icon google mr-6">
                                <span class="flex items-center justify-center cursor-pointer block h-14 w-14 bg-white rounded-full relative z-20 shadow-md transition-transform transform hover:scale-110">
                                    <i class="fab fa-google fa-2x"></i>
                                </span>
                            </div>
                        </div>
                        <div v-else>
                            <div class="flex items-center mb-4">
                            <div class="w-14 h-14 rounded-full bg-gray-300 mr-4"></div> <!-- Placeholder profile picture -->
                            <div class="flex items-start flex-col">
                                <h2 class="text-lg font-semibold">{{ capitalize(userProfile.username) }}</h2> <!-- Name -->
                                <p class="text-sm text-gray-600">{{ capitalize(userProfile.first_name) }} {{ capitalize(userProfile.last_name) }}</p>
                                <p class="text-sm text-gray-600">{{ userProfile.email }}</p> <!-- Email -->
             
                            </div>
                            </div>
                <ul>
                <li class="hover:bg-gray-100 hover:border rounded-lg  md:py-2 md:pl-2 cursor-pointer justify-between flex w-full items-center py-3">
                  <a href="/" @click="toggleSider" class="px-2 text-sm md:text-base">Home</a>
                </li>
                <li  class="hover:bg-gray-100 hover:border rounded-lg md:py-2 md:pl-2 cursor-pointer justify-between flex w-full items-center py-3">
                  <router-link :to="{ name: 'account' }" @click="toggleSider" class="px-2 text-sm md:text-base">View Profile</router-link>
                </li>
                <li  class="hover:bg-gray-100 hover:border rounded-lg md:py-2 md:pl-2 cursor-pointer justify-between flex w-full items-center py-3">
                  <router-link :to="{ name: 'addProduct' }" @click="toggleSider" class="px-2 text-sm md:text-base">List a Product</router-link>
                </li>
                <li class="hover:bg-gray-100 hover:border rounded-lg md:py-2 md:pl-2 cursor-pointer justify-between flex w-full items-center py-3">
                  <router-link :to="{ name: 'shoppingCart' }" @click="toggleSider" class="px-2 text-sm md:text-base">Your Shopping Cart</router-link>
                </li>
                <li @click="toggleOrderSubMenu()" class="hover:bg-gray-100 pr-5 hover:border rounded-lg  md:py-2 md:pl-2 cursor-pointer justify-between flex w-full items-center py-3">
                  <p class="px-2 text-sm md:text-base">Order</p>
                  <span class="text-sm" :class="{'rotate-180': orderSideMenu }">
                  <i class="fa fa-chevron-down text-gray-400"></i>
                  </span>
                </li>
                <div class="text-left text-sm">
                  <ul v-show="orderSideMenu" class="submenu">
                  <li class='hover:bg-gray-100 hover:border rounded-lg py-3 pl-2 cursor-pointer'>
                  <router-link :to="{ name: 'ordersPlaced' }" @click="toggleSider" class="px-2 text-sm md:text-base">Orders Placed</router-link>
                  </li>
                  <li class='hover:bg-gray-100 hover:border rounded-lg py-3 pl-2 cursor-pointer'>
                    <router-link :to="{ name: 'ordersReceived' }" @click="toggleSider" class="px-2 text-sm md:text-base">Orders from Product Listings</router-link>
                  </li>
                  </ul>
                </div>
                <li class="hover:bg-gray-100 hover:border rounded-lg  md:py-2 md:pl-2 cursor-pointer justify-between flex w-full items-center py-3">
                  <a @click="toggleSider" class="px-2 text-sm md:text-base">Settings</a>
                </li>
                <li  class="hover:bg-gray-100 hover:border rounded-lg md:py-2 md:pl-2 cursor-pointer justify-between flex w-full items-center py-3">
                  <a @click="() => { toggleSider(); logoutButton(); }" class="px-2 text-sm md:text-base">Sign out</a>
                </li>
                 </ul>
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
    <div class="mr-4 mb-5">
    <h2 class="text-xl font-semibold">Browse MarketPlace</h2> <!-- Name -->
    </div>
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

const orderSideMenu = ref(false)

const logoutButton = async () => {
  store.dispatch('logout').then((data) => {
	console.log(data)
	router.push({
		name: 'login', 
	}) 	
  })
  .catch(err => {
	console.log(err)
  })
};

const capitalize = (str) => {
  return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
};

const toggleSider = () => {
  props.openSider()
};

const toggleSubMenu = (parentCategory) => {
  parentCategory.showSubMenu = !parentCategory.showSubMenu;
};

const toggleOrderSubMenu = () => {
  orderSideMenu.value = !orderSideMenu.value;
};
const organizedCategories = ref([])
const userProfile = ref([])

onBeforeMount(async () => {
await store.dispatch('getUser').then((data) => {
userProfile.value = data
})
.catch(err => {
console.log(err.response.data.message)
})
await store.dispatch('getProductCategories').then(() => {
organizedCategories.value = store.getters.organizedCategories
})
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
  </script>