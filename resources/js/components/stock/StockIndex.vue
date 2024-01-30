<script>
    export default {
        data() {
            return {
                stocks: []
            }
        },
        created() {
            this.getStocks();
        },
        methods: {
            getStocks() {
                axios.get('api/stocks')
                    .then(response => {
                        this.stocks = response.data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            deleteStock(id) {
                axios.delete(`api/stock/${id}`)
                    .then(response => {
                        this.getStocks();
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
        <div class="col-md-12 mb-2">
            <router-link to="/stock/create" class="btn btn-primary">Add Stock</router-link>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="stock in stocks" :key="stock.id">
                        <td>{{ stock.id }}</td>
                        <td>{{ stock.product_name }}</td>
                        <td>{{ stock.quantity }}</td>
                        <td>
                            <router-link :to="{name: 'stock.edit', params: {id: stock.id}}" class="btn btn-primary me-3 btn-sm">Edit</router-link>
                            <button @click="deleteStock(stock.id)" class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>