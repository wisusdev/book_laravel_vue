<script>
export default {
    name: 'Product',
    data() {
		return {
			products: [],
		}
	},
	created() {
		this.getProducts();
	},
	methods: {
		getProducts() {
			axios.get('/api/products')
				.then(response => {
					this.products = response.data.data;
				});
		},
		addToCart(product) {
			let item = this.cart.find(item => item.product.id === product.id);
			if (item) {
				item.quantity++;
			} else {
				this.cart.push({ product, quantity: 1 });
			}
			product.stock--;
			localStorage.setItem('cart', JSON.stringify(this.cart));
            
            this.$emit('added-to-cart', product);
		},
	},
    props: ['product'],
}
</script>
<template>
    <div class="col-md-8">
        <div class="row">
            <div v-for="product in products" :key="product.id" class="col-md-4">
                <div class="card mb-4">
                    <img :src="`/storage/${product.image}`" class="card-img-top" :alt="product.name">
                    <div class="card-body">
                        <h5 class="card-title">{{ product.name }}</h5>
                        <p class="card-text">{{ product.description }}</p>
                        <p class="card-text">Price: ${{ product.price }}</p>
                        <p class="card-text">Stock: {{ product.stock }}</p>
                        <router-link :to="{ name: 'product.show', params: { id: product.id } }" class="btn btn-primary">View
                            Product</router-link>
                        <button @click="addToCart(product)" class="btn btn-success">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>