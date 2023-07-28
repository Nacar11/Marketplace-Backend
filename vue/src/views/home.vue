<script setup>
	</script>


<template>
	<section class="feature1">
		<h6>Trade-in-offer</h6>
		<h4>Elevate Your Wardrobe</h4>
		<h2>Value Deals</h2>
		<button id="btn" type="button" class="text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Shop Now</button>
  </section>
  
  <section class="content m-4">
	  <h1>Featured Designs</h1>
	  <h4 class="tracking-widest text-gray-500 md:text-lg dark:text-gray-400">Summer Sale Collection </h4>
	  
	  <div class="grid grid-cols-2 md:grid-cols-3 gap-4 m-4">
	      <div class="product">
	          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg" alt="">
			  <h6 class="image-description">Description 1</h6>
			  <h6 class="price">$20</h6>
		  </div>
	      <div class="product">
	          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" alt="">
	          <h6 class="image-description">Description 1</h6>
	          <h6 class="price">$20</h6>
		  </div>
	      <div class="product">
	          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt="">
			  <h6 class="image-description">Description 1</h6>
			  <h6 class="price">$20</h6>
		  </div>
	      <div class="product">
	          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg" alt="">
			  <h6 class="image-description">Description 1</h6>
			  <h6 class="price">$20</h6>
		  </div>
	      <div class="product">
	          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg" alt="">
			  <h6 class="image-description">Description 1</h6>
			  <h6 class="price">$20</h6>
		  </div>
	      <div class="product">
	          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-5.jpg" alt="">
			  <h6 class="image-description">Description 1</h6>
			  <h6 class="price">$20</h6>
		  </div>
	      <div class="product">
	          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-6.jpg" alt="">
			  <h6 class="image-description">Description 1</h6>
			  <h6 class="price">$20</h6>
		  </div>
	      <div class="product">
	          <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-7.jpg" alt="">
			  <h6 class="image-description">Description 1</h6>
			  <h6 class="price">$20</h6>
		  </div>
	      
	          
	  </div>

  </section>
    
  
</template>


<style>
	.feature1{
		background-image: url("../assets/final.png");
		height: 70vh;
		width: 100%;
		background-size: cover;
		display:flex;
		flex-direction: column;
		align-items: flex-start;
		justify-content: center;
		background-position: top 25% right 60%;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.12);
	}
	
	.product{
		
		padding: 10px 10px 25px 10px;
		border: 1px solid #d1cde7;
		border-radius: 10px;
	}
	.image-description{
		padding-top:10px;
	}
	
	
	
	@media (max-width: 768px){
		/* small pc to ipad  */
		.feature1{
		background-position: top 25% right 60%;
		height: 40vh;
		padding: 0 40px;
		}
	}
	@media (max-width: 538px) {
		/* iphonex series */
		.feature1{
			background-position: top 25% right 42%;
			height: 35vh;
		}
		@media (max-height: 667px) {
			/* iphone 6/7/8 */
			.feature1{
				height: 35vh;
				background-position: top 25% right 70%;
			}
		}
	}
	
	@media (max-width: 320px) {
		/* iphone 4 */
	  #btn {
	   margin-top:10px;
       font-size: 8px;
	   width: 105px; 
	   height: 40px;
	   font-weight: 550;  	
	   }
	    
	}
	
	</style>


