<template>
    <div class="isolate bg-white px-6 py-10 sm:py-32 lg:px-8">
      <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
        <!-- <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" /> -->
      </div>
      <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Contact sales</h2>
        <p class="mt-2 text-lg leading-8 text-gray-600">Aute magna irure deserunt veniam aliqua magna enim voluptate.</p>
      </div>
      <div class="mx-auto mt-16 max-w-xl sm:mt-20">
        <div class="grid grid-cols-3 gap-x-8 gap-y-6 sm:grid-cols-2">
          <div>
            <label for="unit_number" class="block text-sm font-semibold leading-6 text-gray-900">Unit Number</label>
            <div class="mt-2.5">
              <input type="text" name="unit_number" id="unit_number" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
          </div>
          <div>
            <label for="street_number" class="block text-sm font-semibold leading-6 text-gray-900">Street Number</label>
            <div class="mt-2.5">
              <input type="text" name="street_number" id="street_number" autocomplete="family-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
          </div>
          <div class="sm:col-span-2">
            <label for="address_line1" class="block text-sm font-semibold leading-6 text-gray-900">Address Line 1</label>
            <div class="mt-2.5">
              <input type="text" name="address_line1" id="address_line1" autocomplete="organization" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
          </div>
          <div class="sm:col-span-2">
            <label for="address_line2" class="block text-sm font-semibold leading-6 text-gray-900">Address Line 2</label>
            <div class="mt-2.5">
              <input type="text" name="address_line2" id="address_line2" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
          </div>
          <div>
    <label for="region" class="block text-sm font-semibold leading-6 text-gray-900">Region</label>
    <div class="mt-2.5">
      <input type="text" name="region" id="region" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
    </div>
  </div>
  <div>
    <label for="city" class="block text-sm font-semibold leading-6 text-gray-900">City</label>
    <div class="mt-2.5">
      <input type="text" name="city" id="city" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
    </div>
  </div>
  <div>
    <label for="postal_code" class="block text-sm font-semibold leading-6 text-gray-900">Postal Code</label>
    <div class="mt-2.5">
      <input type="text" name="postal_code" id="postal_code" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
    </div>
  </div>
  <div>
    <label for="country" class="block text-sm font-semibold leading-6 text-gray-900">Postal Code</label>
    <div class="mt-2.5">
      <input type="text" name="country" id="country" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
    </div>
  </div>
  
          <!-- <div class="sm:col-span-2">
            <label for="phone-number" class="block text-sm font-semibold leading-6 text-gray-900">Phone number</label>
            <div class="relative mt-2.5">
              <div class="absolute inset-y-0 left-0 flex items-center">
                <label for="country" class="sr-only">Country</label>
                <select id="country" name="country" class="h-full rounded-md border-0 bg-transparent bg-none py-0 pl-4 pr-9 text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                  <option>US</option>
                  <option>CA</option>
                  <option>EU</option>
                </select>
                <ChevronDownIcon class="pointer-events-none absolute right-3 top-0 h-full w-5 text-gray-400" aria-hidden="true" />
              </div>
              <input type="tel" name="phone-number" id="phone-number" autocomplete="tel" class="block w-full rounded-md border-0 px-3.5 py-2 pl-20 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
          </div> -->
          
          <!-- <SwitchGroup as="div" class="flex gap-x-4 sm:col-span-2">
            <div class="flex h-6 items-center">
              <Switch v-model="agreed" :class="[agreed ? 'bg-indigo-600' : 'bg-gray-200', 'flex w-8 flex-none cursor-pointer rounded-full p-px ring-1 ring-inset ring-gray-900/5 transition-colors duration-200 ease-in-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600']">
                <span class="sr-only">Agree to policies</span>
                <span aria-hidden="true" :class="[agreed ? 'translate-x-3.5' : 'translate-x-0', 'h-4 w-4 transform rounded-full bg-white shadow-sm ring-1 ring-gray-900/5 transition duration-200 ease-in-out']" />
              </Switch>
            </div>
            <SwitchLabel class="text-sm leading-6 text-gray-600">
              By selecting this, you agree to our
              {{ ' ' }}
              <a href="#" class="font-semibold text-indigo-600">privacy&nbsp;policy</a>.
            </SwitchLabel>
          </SwitchGroup> -->
        </div>
        <div class="mt-10">
          <button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Let's talk</button>
        </div>
    </div>
    </div>
  </template>
  
  <script setup>
  import {reactive, ref} from '@vue/reactivity'
  import { ChevronDownIcon } from '@heroicons/vue/20/solid'
  import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'
  

  const state = reactive({
  unit_number: '',
  stree_number: '',
  address_line1: '',
  address_line2: '',
  city: '',
  region: '',
  postal_code: '',
  country: '',
});
  const agreed = ref(false)
  </script>
