<script setup>
import { reactive, ref, computed } from 'vue'
import { onMounted, onBeforeMount } from '@vue/runtime-core'
import { useRouter } from 'vue-router'

import store from '../store'
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'

onBeforeMount(async () => {
    await fetchShoppingCartData();
    await getPaymentTypes();
    await getaddresses();
    await getUPMbyID();
    await getFirstShipping()

})

const router = useRouter();

const userID = computed(() => {
  return sessionStorage.getItem('userID')
})
const total_value = ref(0)
const shopping_cart = ref([]);
const payment_types = ref([]);
const addresses = ref([]);
const shipping_method = ref([]);
const agreed = ref(false)


const fetchShoppingCartData = async () => {
    await store.dispatch('getShoppingCartByUser',userID.value).then((data) => {
    shopping_cart.value = data  
    let total = 0
    console.log(shopping_cart.value)
    for (const item of data.items) {
    total += parseFloat(item.product_item.price);
    
  }
  total_value.value = total
  })
  .catch(err => {
	console.log(err)
  })
}

const getPaymentTypes = async () => {
    await store.dispatch('getPaymentTypes').then((data) => {
    payment_types.value = data  
    
    })
    .catch(err => {
	console.log(err)
    })
}
const getFirstShipping = async () => {
    await store.dispatch('getFirstShipping').then((data) => {
    shipping_method.value = data  
    
    })
    .catch(err => {
	  console.log(err)
    })
}

const getaddresses = async () => {
    await store.dispatch('getAddress').then((data) => {
    addresses.value = data.data
    })
    .catch(err => {
	  console.log(err.response.data.message)
    })
}

const getUPMbyID = async () => {
    await store.dispatch('getUPMbyID').then((data) => {
    UMPID.value = data[0].id
    selectedPaymentType.value = data[0].payment_type_id
    provider.value = data[0].provider
    account_number.value = data[0].account_number
    expiry_date.value = data[0].expiry_date    
    })
    .catch(err => {
	  console.log(err.response.data.message)
    })
}

  const UMPID = ref('');
  const provider = ref('');
  const account_number = ref('');
  const expiry_date = ref('');
  const is_default = ref(true);


  const orderButton = async () => {
  const form = {
    payment_type_id: selectedPaymentType.value,
    provider: provider.value,
    account_number: account_number.value,
    expiry_date: expiry_date.value,
    is_default: is_default.value,
  };

  // Initialize a counter for successful responses
  let successfulResponses = 0;

  await store.dispatch('updateUPM', form)
    .then((data) => {
      console.log(data);
    })
    .catch((err) => {
      console.log(err.response.data.message);
    });

  const form1 = {
    payment_method_id: UMPID.value,
    shipping_address_id: selectedAddress.value,
  };

  for (const item of shopping_cart.value.items) {
    console.log(item);
    console.log(item.product_item.price);
    const itemForm = {
      ...form1,
      product_item_id: item.product_item_id,
      price: item.product_item.price,
    };
    console.log(itemForm);

    await store.dispatch('addOrderLine', itemForm)
      .then((data) => {
        console.log(data);
        if (data.message === 'success') {
          successfulResponses++;
          console.log(successfulResponses)
          if (successfulResponses === shopping_cart.value.items.length) {
            router.push({ name: 'home' });
          }
        }
      })
      .catch((err) => {
        console.log(err.response.data.message);
      });
  }
};
    





const computedTotalValue = computed(() => {
  return total_value.value + shipping_method.value.price;
});

const selectedAddress = ref('')
const selectedPaymentType = ref('')
</script>



<template>
   <div class="grid grid-cols-2 gap-4 m-10">
    <section class="bg-white flex flex-col rounded-2xl shadow-lg max-w-4xl p-8 items-center">
        <!-- Content for the first section -->
       <a class="px-3 pb-3 font-semibold text-gray-900">Select Shipping Address</a>
       <select v-model="selectedAddress" class="block w-full text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
        <option v-for="address in addresses" :key="address.id" :value="address.id">{{ address.address.address_line_1  }}</option>

          </select>

    </section>

    <section class="bg-white flex rounded-2xl shadow-lg max-w-4xl p-8 items-center">
        <div class="mt-8">
<div class="flow-root">
    <ul role="list" class="-my-6 divide-y divide-gray-200">
    <li v-for="item in shopping_cart.items" :key="item.id" class="flex py-6">
      <div class="carousel flex-shrink-0">
        <div class="carousel-item h-24 w-24 overflow-hidden rounded-md border border-gray-200">
          <img
            :src="item.product_item.product_images[0].product_image"
            :alt="item.product_item.product_images[0].imageAlt"
            class="h-full w-full object-cover object-center"
          />
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
            <div class="flex">
            </div>
        </div>
        </div>
    </li>
    </ul>
</div>
</div>
    </section>

    <section class="bg-white flex rounded-2xl shadow-lg max-w-4xl p-8 items-center col-span-2">
        <!-- Content for the third section -->
        <div>
        <div class="flex flex-col items-center mt-4 px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">Payment </h3>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Payment Details and Information.</p>
            </div>
        <div class="border-t border-gray-100">
            <dl class="divide-y divide-gray-100"> 
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">Payment Type</dt>
                <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2">
                <select v-model="selectedPaymentType" class="mr-10 block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option v-for="payment in payment_types" :key="payment.id" :value="payment.id">{{ payment.value }}</option>

                </select>
                </dd>
            </div>

        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">Provider</dt>
            <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 flex items-center">
                <div class="relative mt-2 rounded-md shadow-sm">
                <input v-model="provider" class="w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            </div>
            </dd>
            </div>

      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">Account/Card Number</dt>
        <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 flex items-center">
          <input v-model="account_number" class="w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" type="text" />
        </dd>
      </div>

      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">Expiry Date</dt>
            <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 flex items-center">
                <div class="relative mt-2 rounded-md shadow-sm">
                <input
                    v-model="expiry_date"
                    type="date"
                    required=""
			        class="w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"	
			        placeholder="Date of Birth"
                />
            </div>
            </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">Shipping Fee</dt>
            <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 flex items-center">
                <div class="relative mt-2 rounded-md shadow-sm">
                <a
                    required=""
			              class="w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"	
			            >
                  {{ shipping_method.price }}
                  </a>
            </div>
            </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
            <dt class="ml-16 text-sm font-medium leading-6 text-gray-900 flex items-center">Total Cost</dt>
            <dd class="mr-10 mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 flex items-center">
                <div class="relative mt-2 rounded-md shadow-sm">
                <a
                    required=""
			              class="w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"	
			            >
                  {{computedTotalValue}}    
                </a>
            </div>
            </dd>
            </div>

            <div class="mt-6 items-center justify-center">
            <button @click="orderButton" class="w-full flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Order</button>
            </div>
            <div class="flex h-6 items-center">
              <a class="w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                 Payment Details are Saved for Next Time
                </a>
            </div>
    </dl>
    </div>
    </div>
    
</section>

</div>
</template>




