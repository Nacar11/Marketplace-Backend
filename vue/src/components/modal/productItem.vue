<script setup>
import { ref, computed } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
const props = defineProps({
  visible: Boolean,
  showProductItem: Function,
  productItem: Object,
})

const onClick = () => {
  props.showProductItem()
}

const checkedOptions = ref([]);
const toggleOption = (option) => {
  option.selected = !option.selected;
  updateSelectedValues();
};
const updateSelectedValues = () => {
  checkedOptions.value = [];
  for (const options of Object.values(groupedVariationOptions.value)) {
    for (const option of options) {
      if (option.selected) {
        checkedOptions.value.push(option.value);
      }
    }
  }
  console.log(checkedOptions.value)
};
const groupedVariationOptions = computed(() => {
  const groupedOptions = {};
  props.productItem.variation_options.forEach(variation_option => {
    const variationId = variation_option.variation_id;
    if (!groupedOptions[variationId]) {
      groupedOptions[variationId] = [];
    }
    groupedOptions[variationId].push(variation_option);
  });
  console.log(groupedOptions)
  return groupedOptions;
});

const hasSelectedOption = (groupedOptions, selectedOption) => {
  return groupedOptions.some(option => option.selected && option !== selectedOption);
};


</script>


<template>
    <TransitionRoot as="template">
      <Dialog as="div" class="relative z-10" @close="open = false">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>
        
        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
              <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 sm:p-6 sm:pb-4">
                  <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                      <DialogTitle as="h3" class=" mb-10 text-base font-semibold leading-6 text-gray-900">{{productItem.product.name}}</DialogTitle>
                      <div class="flex">
    <!-- Images Carousel -->
    <div class="w-1/2 pr-4">
      <div v-if="productItem.product_images.length > 1" class="carousel-container">
        <div class="carousel">
          <div v-for="(product_images, index) in productItem.product_images" :key="index" class="carousel-item">
            <img :src="product_images.product_image" alt="Carousel Slide" class="w-full h-auto rounded-lg">
          </div>
        </div>
      </div>
      <div v-else>
        <img
          v-if="productItem.product_images[0].product_image && productItem.product_images[0].product_image.length > 0"
          :src="productItem.product_images[0].product_image"
          :alt="productItem.product_images[0].product_image"
          class="h-full w-full object-cover object-center rounded-lg"
        />
      </div>
    </div>
    
    <!-- Product Details -->
    <div class="w-1/2">
      <p>Price:  {{ productItem.price }}</p>
      <p>Quantity in Stock: {{ productItem.qty_in_stock }}</p>
      <div v-for="(groupedOptions, variationId) in groupedVariationOptions" :key="variationId">
        <a v-for="variation_option in groupedOptions">
          <button
          @click="toggleOption(variation_option)"
          :class="{
            'bg-blue-500 text-white': variation_option.selected,
            'bg-gray-200 text-gray-700': !variation_option.selected,
          }"
          class="px-2 py-1 rounded mr-2 mb-2 transition-colors duration-150 ease-in-out"
          :disabled="hasSelectedOption(groupedOptions, variation_option)"
          >
          {{ variation_option.value }}
        </button>
        </a>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  <div class='flex justify-end'>
  <div class="pl-2 py-3 sm:flex sm:flex-row-reverse ">
    <button
        @click="addToCart"
        type="button"
        class="inline-flex items-center justify-center rounded-md bg-green-500 pl-2 pr-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-600 sm:w-auto"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 mr-2"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
          />
        </svg>
        Add To Cart
      </button>   </div>
    <div class="pr-4 py-3 sm:flex sm:flex-row-reverse ">
    <button @click="onClick" type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Close</button>       
    </div>
  </div>
              </DialogPanel>
            </TransitionChild>
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