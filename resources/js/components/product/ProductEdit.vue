<script>
    export default {
        data() {
            return {
                product: {
                    name: '',
                    price: '',
                    description: '',
                    image: null
                }
            }
        },
        created() {
            this.getProduct();
        },
        methods: {
            getProduct() {
                axios.get(`/api/products/${this.$route.params.id}`)
                    .then(response => {
                        this.product = response.data.data;
                    });
            },
            updateProduct() {
                let formData = new FormData();
                formData.append('name', this.product.name);
                formData.append('price', this.product.price);
                formData.append('description', this.product.description);
                formData.append('image', this.product.image);

                axios.post(`/api/products/${this.$route.params.id}?_method=PUT`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.$router.push({name: 'product.index'});
                });
            },
            onFileChange(e) {
                if (e.target.files.length > 0) {
                    this.product.image = e.target.files[0];
                }
            },
        }
    }
</script>

<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <router-link to="/product" class="btn btn-primary">Back</router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateProduct">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" v-model="product.name">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" v-model="product.price">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" v-model="product.description"></textarea>
                        </div>
                        <div class="mb-3">
                            <img :src="'/storage/' + product.image" class="img-fluid" v-if="product.image">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" @change="onFileChange">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>