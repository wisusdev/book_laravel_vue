<script>
export default {
	data() {
		return {
			products: []
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
		deleteProduct(id) {
			axios.delete(`/api/products/${id}`)
				.then(response => {
					this.getProducts();
				});
		}
	}
}
</script>

<template>
	<div class="row">
		<div class="col-md-12 mb-2">
			<router-link to="/product/create" class="btn btn-primary">Add Product</router-link>
		</div>
		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Price</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="product in products" :key="product.id">
						<td>{{ product.id }}</td>
						<td>{{ product.name }}</td>
						<td>{{ product.price }}</td>
						<td>
							<router-link :to="{name: 'product.edit', params: {id: product.id}}" class="btn btn-primary me-3 btn-sm">Edit</router-link>
							<router-link :to="{name: 'product.show', params: {id: product.id}}" class="btn btn-success me-3 btn-sm">Show</router-link>
							<button class="btn btn-danger btn-sm" @click="deleteProduct(product.id)">Delete</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>