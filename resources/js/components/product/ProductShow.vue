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
        mounted() {
            this.getProduct();
        },
        methods: {
            getProduct() {
                axios.get(`/api/products/${this.$route.params.id}`)
                    .then(response => {
                        this.product = response.data.data;
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
                    <router-link to="/product" class="btn btn-primary">Back</router-link>
                </div>
                <div class="card-body">
                    <h3>{{ product.name }}</h3>
                    <p>{{ product.price }}</p>
                    <p>{{ product.description }}</p>
                    <img :src="`/storage/${product.image}`" alt="" style="width: 100px; height: 100px;">
                </div>
            </div>
        </div>
    </div>
</template>