<template>
	
	<section class="shopcontent">
		  
		  <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
		      <button type="button" class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800">All categories</button>
		      <button type="button" class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800">Shoes</button>
		      <button type="button" class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800">Bags</button>
		      <button type="button" class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800">Electronics</button>
		      <button type="button" class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:text-white dark:focus:ring-gray-800">Gaming</button>
		  </div>
		  <div id="shopfeature1" class="grid grid-cols-2 md:grid-cols-3 gap-4">
		      <div class="products">
				  <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg" alt="">
		          <h6 class="image-description">Description 1</h6>
		          <h6 class="price">$20</h6>
		      </div>
		      <div class="products">
				  <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" alt="">
		          <h6 class="image-description">Description 1</h6>
		          <h6 class="price">$20</h6>
		      </div>
		      <div class="products">
				  <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt="">
		          <h6 class="image-description">Description 1</h6>
		          <h6 class="price">$20</h6>
		      </div>
		      <div class="products">
				  <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg" alt="">
		          <h6 class="image-description">Description 1</h6>
		          <h6 class="price">$20</h6>
		      </div>
		      <div class="products">
				  <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg" alt="">
		          <h6 class="image-description">Description 1</h6>
		          <h6 class="price">$20</h6>
		      </div>
		      <div class="products">
				  <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-5.jpg" alt="">
		          <h6 class="image-description">Description 1</h6>
		          <h6 class="price">$20</h6>
		      </div>
		      <div class="products">
				  <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-6.jpg" alt="">
		          <h6 class="image-description">Description 1</h6>
		          <h6 class="price">$20</h6>
		      </div>
		      <div class="products">
				  <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-7.jpg" alt="">
		          <h6 class="image-description">Description 1</h6>
		          <h6 class="price">$20</h6>
		      </div>
		      <div class="products">
				  <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-8.jpg" alt="">
		          <h6 class="image-description">Description 1</h6>
		          <h6 class="price">$20</h6>
		      </div>
		      <div class="products">
				  <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-9.jpg" alt="">
		          <h6 class="image-description">Description 1</h6>
		          <h6 class="price">$20</h6>
		      </div>
		      <div class="products">
				  <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-10.jpg" alt="">
		          <h6 class="image-description">Description 1</h6>
		          <h6 class="price">$20</h6>
		      </div>
		      <div class="products">
				  <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-11.jpg" alt="">
		          <h6 class="image-description">Description 1</h6>
		          <h6 class="price">$20</h6>
		      </div>
		  </div>

		 </section>
</template>


<style>
	.shopfeature1{
		background-image: url("../assets/b4.jpg");
		height: 40vh;
		width: 100%;
		background-size: cover;
		padding: 0 40px;
		display:flex;
		flex-direction: column;
		align-items: flex-start;
		justify-content: center;
		background-position: top 25% right 60%;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
	}
	
	#btn{
		color: #088178;
		border: 0;
		font-weight: 700;
	}
	
	#shopfeature1{
		margin: 20px;
	}
	.products{
		padding: 10px 10px 25px 10px;
		border: 1px solid #d1cde7;
		border-radius: 10px;
	}
	.shop-img-desc{
		padding-top:10px;
	}
	
	@media (max-width: 538px) {
		/* iphonex series */
		.shopfeature1{
			background-position: top 25% right 65%;
			height: 35vh;
			padding: 0 25px;
		}
		@media (max-height: 736px) {
			/* iphone 6/7/8 */
			.shopfeature1{
				height: 35vh;
				background-position: top 25% right 70%;
			}
		}
	}
	
	@media (max-width: 320px) {
		/* iphone 4 */
		.shopfeature1{
			padding: 0 20px;
		}
	}
	
	.shopcontent{
		margin-top: 35px;
		
	}
	</style>