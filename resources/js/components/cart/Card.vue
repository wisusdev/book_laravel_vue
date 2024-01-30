<script>
    export default {
        name: 'Card',
		props: ['cart'],
        data() {
            return {
                cart: []
            }
        },
        created() {
            this.getCart();
        },
        methods: {
            getCart() {
                this.cart = JSON.parse(localStorage.getItem('cart')) || [];
            },
            removeFromCart(product) {
                let item = this.cart.find(item => item.product.id === product.id);
                if (item.quantity > 1) {
                    item.quantity--;
                } else {
                    this.cart = this.cart.filter(item => item.product.id !== product.id);
                }
                product.stock++;
                localStorage.setItem('cart', JSON.stringify(this.cart));
				this.$emit('removed-from-cart', product);
            }
        }
    }
</script>

<template>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Shopping Cart
            </div>
            <ul class="list-group list-group-flush">
                <li v-for="item in cart" :key="item.product.id" class="list-group-item">
                    {{ item.product.name }} - {{ item.quantity }} <button @click="removeFromCart(item.product)"
                        class="btn btn-danger btn-sm">Remove</button>
                </li>
            </ul>
        </div>
    </div>
</template>