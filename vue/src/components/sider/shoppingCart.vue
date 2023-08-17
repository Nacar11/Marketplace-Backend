<script setup>
import { ref, computed } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { onMounted, onUpdated } from '@vue/runtime-core'
import store from '../../store'

const props = defineProps({
  visible: Boolean,
  showShoppingCartSider: Function,
  productItem: Object,
})

const shopping_cart = ref([]);
const userID = computed(() => {
  return sessionStorage.getItem('userID')
})
onMounted(async () => {
	store.dispatch('getShoppingCartByUser',userID.value).then((data) => {
    shopping_cart.value = data
    console.log(shopping_cart.value)
  })
  .catch(err => {
	console.log(err)
  })

})

const removeItem = () => {
  console.log("asd")
}

const onClick = () => {
  props.showShoppingCartSider()
}

const open = ref(true)
</script>


<template>
    <TransitionRoot as="template" :show="open">
      <Dialog as="div" class="relative z-10" @close="open = false">
        <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>
  
        <div class="fixed inset-0 overflow-hidden">
          <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
              <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
                <DialogPanel class="pointer-events-auto w-screen max-w-md">
                  <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                    <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                      <div class="flex items-start justify-between">
                        <DialogTitle class="text-lg font-medium text-gray-900">Shopping cart</DialogTitle>
                        <div class="ml-3 flex h-7 items-center">
                          <button @click="onClick" type="button" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500" >
                            <span class="absolute -inset-0.5" />
                            <span class="sr-only">Close panel</span>
                            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                          </button>
                        </div>
                      </div>
  
                      <div class="mt-8">
                        <div class="flow-root">
                          <ul role="list" class="-my-6 divide-y divide-gray-200">
                            <li v-for="item in shopping_cart.items" :key="shopping_cart.id" class="flex py-6">
                              <div class="carousel flex-shrink-0">
                              <div v-for="image in item.product_item.product_images" :key="image.id" class="carousel-item h-24 w-24 overflow-hidden rounded-md border border-gray-200">
                                <img :src="image.product_image" :alt="image.imageAlt" class="h-full w-full object-cover object-center" />
                                    </div>
                                      </div>
  
                              <div class="ml-4 flex flex-1 flex-col">
                                <div>
                                  <div class="flex justify-between text-base font-medium text-gray-900">
                                    <h3>
                                      <a>{{ item.product_item.product.name }}</a>
                                    </h3>
                                    <p class="ml-4">{{ item.product_item.price }}</p>
                                  </div>
                                  <!-- <p class="mt-1 text-sm text-gray-500">{{ item.color }}</p> -->
                                </div>
                                <div class="flex flex-1 items-end justify-between text-sm">
                                  <p class="text-gray-500">Qty {{ item.qty }}</p>
  
                                  <div class="flex">
                                    <button @click="removeItem" type="button" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                                  </div>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
  
                    <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                      <div class="flex justify-between text-base font-medium text-gray-900">
                        <p>Subtotal</p>
                        <p>$262.00</p>
                      </div>
                      <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                      <div class="mt-6">
                        <a href="#" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
                      </div>
                      <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                        <p>
                          or
                          <button @click="onClick" type="button" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Continue Shopping
                            <span aria-hidden="true"> &rarr;</span>
                          </button>
                        </p>
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
  <style scoped>
  .carousel-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1rem;
  }
  
  .carousel {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch; /* For smoother scrolling on iOS */
  }
  
  .carousel-item {
    flex: 0 0 auto;
    width: 100%;
    scroll-snap-align: start;
    padding-right: 1rem;
  }
  
  /* Optional: Add navigation buttons or indicators */
  </style>