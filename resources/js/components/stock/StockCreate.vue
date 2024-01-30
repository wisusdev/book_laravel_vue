<script>
export default {
    data() {
        return {
            stock: {
                product_id: '',
                quantity: ''
            },
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
                })
                .catch(error => {
                    console.log(error);
                })
        },
        createStock() {
            axios.post('/api/stocks', this.stock)
                .then(response => {
                    this.$router.push({ name: 'stock.index' });
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>

<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <router-link to="/stock" class="btn btn-primary">Back</router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="createStock">
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="text" class="form-control" id="quantity" v-model="stock.quantity">
                        </div>
                        <div class="mb-3">
                            <select v-model="stock.product_id" class="form-select mb-3">
                                <option value="">Select a product</option>
                                <option v-for="product in products" :key="product.id" :value="product.id">{{ product.name }}
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>