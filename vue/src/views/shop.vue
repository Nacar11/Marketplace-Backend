<script setup>
import { ref, computed} from '@vue/reactivity'
import store from '../store'
// import { useRouter } from 'vue-router'
import { onBeforeMount } from '@vue/runtime-core'
import productItemModal from '../components/modal/productItem.vue'


const computedProductItems = computed(() => store.getters.filteredProductItems);
const openMenus = ref([])
const organizedCategories = ref([]);
onBeforeMount(async () => {

  loadPrices()
  
  await store.dispatch('getProductCategories').then(() => {
  organizedCategories.value = store.getters.organizedCategories
  console.log(organizedCategories.value)
  })
  .catch(err => {
	console.log(err.response.data.message)
  })

  .catch(err => {
	console.log(err)
  })
  console.log(computedProductItems.value)
})

const openMenu = (categoryId) => {
  if (!openMenus.value.includes(categoryId)) {
    openMenus.value.push(categoryId);
  }
};

const closeMenu = (categoryId) => {
  const index = openMenus.value.indexOf(categoryId);
  if (index !== -1) {
    openMenus.value.splice(index, 1);
  }
};

const isActiveSubCategory = (subCategoryId) => {
  return openMenus.value.includes(subCategoryId);
};

const showModal = ref(false);
const productItem = ref(null);
const showProductItem = () => {
  showModal.value = !showModal.value;
}

const openProductModal = (product) => {
  productItem.value = product;
  showModal.value = true;
  console.log(productItem.value)
};


const handleSubCategoryClick = (id) => {
  store.dispatch('getProductItemByCategory',id).then((data) => {
  product_items.value = data
  })
  .catch(err => {
	console.log(err.response.data.message)
  })  
};

const prices = ref([]);
// const categories = ref([]);
// const manufacturers = ref([]);
const loading = ref(true);
const selected = ref({
  prices: [],
  categories: [],
  manufacturers: [],
});
const loadPrices = async () => {
  loading.value = true; 
  try {
    const response = await axios.get('/api/prices', {
      params: _.omit(selected.value, 'prices'),
    });
    prices.value = response.data;
  } catch (error) {
    console.error(error);
  } finally {
    loading.value = false; 
  }
};
</script>


<template>
  <div class="p-5 flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
    <div class="hidden md:block">
      <div class="flex space-x-4">
        <template v-for="category in organizedCategories" :key="category.id">
          <div
            class="text-black hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium cursor-pointer relative inline-block"
            @mouseenter="openMenu(category.id)"
            @mouseleave="closeMenu(category.id)"
          >
            {{ category.category_name }}
            <div
              v-if="openMenus.includes(category.id)"
              class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            >
              <a
                v-for="subCategory in category.children"
                :key="subCategory.id"
                class="hover:text-black hover:text-lg block px-4 py-2 text-sm text-gray-700"
                :class="{ 'bg-gray-100': isActiveSubCategory(subCategory.id) }"
                @click="handleSubCategoryClick(subCategory.id)"
                >
                {{ subCategory.category_name }}
              </a>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>
  <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <h1 class="mt-4">Filters</h1>

                <h3 class="mt-2">Price</h3>
                <div class="form-check" v-for="(price, index) in prices">
                    <input class="form-check-input" type="checkbox" :value="index" :id="'price'+index" v-model="selected.prices">
                    <label class="form-check-label" :for="'price' + index">
                        {{ price.name }} ({{ price.products_count }})
                    </label>
                </div>

               
            </div>
			</div>
  <div class="p-5 bg-white">
    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
      <div v-if="Object.keys(computedProductItems).length === 0" class="px-4 py-6 text-sm text-gray-700">
        <h3 class="text-base font-semibold text-gray-900">No Product Listing yet</h3>
      </div>
      <div v-for="product in computedProductItems" :key="product.id" class="group relative">
        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-48">  
          <div class="h-full w-full flex items-center justify-center">
            <img
              @click="openProductModal(product)"
              v-if="product.product_images && product.product_images.length > 0"
              :src="product.product_images[0].product_image"
              :alt="product.product_images[0].product_image"
              class="max-h-full max-w-full object-cover object-center"
            />
            <img
              v-else
              src="https://via.placeholder.com/300x200"
              alt="Default Image"
              class="h-full w-full object-cover object-center"
            />
          </div>
        </div>
        <div class="mt-4 flex justify-between">
          <div>
            <h3 class="text-sm text-gray-700">{{ product.product.name }}</h3>
          </div>
          <p class="text-sm font-medium text-gray-900">{{ product.price }}</p>
        </div>
      </div>
    </div>
  </div>
  <productItemModal
    :show="showModal"
	  :showProductItem = "showProductItem"
    :productItem = "productItem"
    />






</template>

<style>
	
	
	</style>


