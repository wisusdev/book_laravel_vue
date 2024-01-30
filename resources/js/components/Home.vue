<script>
import Card from "./cart/Card.vue";
import Product from "./cart/Product.vue";

export default {
	components: {Card, Product},
	data() {
		return {
			cart: []
		}
	},
	methods: {
		updateCart(product){
			this.cart.push(product)
		},
		updateProduct(product){
			this.cart = this.cart.filter(item => item.id !== product.id)
		}
	}
}
</script>

<template>
	<div class="container">
		<div class="row">
			<Product @added-to-cart="updateCart" @removed-from-cart="updateProduct" />
			<Card :cart="cart" @added-to-cart="updateCart" @removed-from-cart="updateProduct" />
		</div>
	</div>
</template>