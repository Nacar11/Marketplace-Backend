<template>
	<section class="salefeature1">
			<h4>Save up to 70%</h4>
			<h4>Off!</h4>
			<h4>With Coupons!</h4>
			<h4>#Elevate</h4>
	</section>
	
	<section class="salecontent">
		  <h1>Newest Arrivals</h1>
		  <h4 class="tracking-widest text-gray-500 md:text-lg dark:text-gray-400">Modern Apparel Collection </h4>
	
	
	<div id="gallery" class="relative w-full" data-carousel="slide">
	    <!-- Carousel wrapper -->
	    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
	         <!-- Item 1 -->
	        <div class="hidden duration-700 ease-in-out" data-carousel-item>
	            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
	        </div>
	        <!-- Item 2 -->
	        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
	            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
	        </div>
	        <!-- Item 3 -->
	        <div class="hidden duration-700 ease-in-out" data-carousel-item>
	            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg" class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
	        </div>
	        <!-- Item 4 -->
	        <div class="hidden duration-700 ease-in-out" data-carousel-item>
	            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg" class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
	        </div>
	        <!-- Item 5 -->
	        <div class="hidden duration-700 ease-in-out" data-carousel-item>
	            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-5.jpg" class="absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
	        </div>
	    </div>
	    <!-- Slider controls -->
	    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
	        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
	            <svg aria-hidden="true" class="w-6 h-6 text-white dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
	            <span class="sr-only">Previous</span>
	        </span>
	    </button>
	    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
	        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
	            <svg aria-hidden="true" class="w-6 h-6 text-white dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
	            <span class="sr-only">Next</span>
	        </span>
	    </button>
	</div>




	</section>
</template>



<style>
	.salefeature1{
		background-image: url("../assets/b4.jpg");
		height: 70vh;
		width: 100%;
		background-size: cover;
		display:flex;
		flex-direction: column;
		align-items: flex-start;
		justify-content: center;
		background-position: top 25% right 60%;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
	}
	
	#gallery{
		margin: 10px;
	}


	
	@media (max-width: 768px){
		/* small pc to ipad  */
		.salefeature1{
		background-position: top 25% right 60%;
		height: 40vh;
		padding: 0 40px;
		}
	}
	@media (max-width: 538px) {
		/* iphonex series */
		.salefeature1{
			background-position: top 25% right 65%;
			height: 35vh;
			padding: 0 25px;
		}
		@media (max-height: 736px) {
			/* iphone 6/7/8 */
			.salefeature1{
				height: 35vh;
				background-position: top 25% right 70%;
			}
		}
	}
	
	@media (max-width: 320px) {
		/* iphone 4 */
		.salefeature1{
			padding: 0 20px;
		}
	}
	
	.salecontent{
		margin-top: 35px;
		
	}
	</style>