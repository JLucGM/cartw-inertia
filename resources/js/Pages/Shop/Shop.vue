<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage()
const products = ref(page.props.products);
const slug = page.props.slug;

const onDeleteSuccess = (e) => {
    products.value = e.props.products;
}

const addProduct = (product) => {
    router.post(route('cart.add'), {
        product_id: product.id,
        name: product.name,
        quantity: 1,
        price: product.price,
        tax: 0 // Agregamos este parámetro con valor 0

    });
}


</script>

<template #header>
    <div class="flex justify-between">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Shop
        </h2>

        <Link :href="route('cart.index', { slug: slug })" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
  Ver carrito
</Link>

    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div className="relative overflow-x-auto">
                    <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead
                            className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" className="px-6 py-3">
                                    Nombre
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Precio
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Description
                                </th>

                                <th scope="col" className="px-6 py-3">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products"
                                className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ product.name }}
                                </th>
                                <td className="px-6 py-4">
                                    {{ product.price }}
                                </td>
                                <td className="px-6 py-4">
                                    {{ product.description }}
                                </td>

                                <td className="px-6 py-4">
            <div class="space-x-4">
                <form @submit.prevent="addProduct(product)">
                    <input type="hidden" name="product_id" :value="product.id">
                    <input type="hidden" name="name" :value="product.name">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="price" :value="product.price">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                        Agregar al carrito
                    </button>
                </form>
            </div>
        </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>
