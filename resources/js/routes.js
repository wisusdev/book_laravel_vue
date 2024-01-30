import Home from "./components/Home.vue";
import ProductIndex from "./components/product/ProductIndex.vue";
import ProductShow from "./components/product/ProductShow.vue";
import ProductCreate from "./components/product/ProductCreate.vue";
import ProductEdit from "./components/product/ProductEdit.vue";
import StockIndex from "./components/stock/StockIndex.vue";
import StockCreate from "./components/stock/StockCreate.vue";
import StockEdit from "./components/stock/StockEdit.vue";

export const routes = [
	{ path: '/', name: 'home', component: Home },
	{ path: '/product', name: 'product.index', component: ProductIndex },
	{ path: '/product/create', name: 'product.create', component: ProductCreate },
	{ path: '/product/:id/edit', name: 'product.edit', component: ProductEdit, props: true },
	{ path: '/product/:id', name: 'product.show', component: ProductShow, props: true },
	{ path: '/stock', name: 'stock.index', component: StockIndex },
	{ path: '/stock/create', name: 'stock.create', component: StockCreate },
	{ path: '/stock/:id/edit', name: 'stock.edit', component: StockEdit, props: true},
];