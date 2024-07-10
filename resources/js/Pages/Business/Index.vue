<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage()
const businesses = ref(page.props.businesses);

const onDeleteSuccess = (e) => {
businesses.value = e.props.businesses;
}

</script>

<template>
    <AppLayout title="business">
        <template #header>
            <div class="flex justify-between">

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    business
                </h2>
                <Link :href="route('business.create')">Crear business</Link>
            </div>
        </template>

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
                                        email
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Telefono
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        direction
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        rif
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="business in businesses"
                                    className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ business.name }}
                                    </th>
                                    <td className="px-6 py-4">
                                        {{ business.email }}
                                    </td>
                                    <td className="px-6 py-4">
                                        {{ business.phone }}
                                    </td>
                                    <td className="px-6 py-4">
                                        {{ business.direction }}
                                    </td>
                                    <td className="px-6 py-4">
                                        {{ business.rif }}
                                    </td>
                                    <!-- <td className="px-6 py-4">
                                        <img class="h-16" :src="business.avatar" >
                                    </td> -->
                                    <td className="px-6 py-4">
                                        <div class="space-x-4">

                                            <Link :href="route('business.edit',business)">Editar</Link>
                                            <Link @success="onDeleteSuccess" :href="route('business.destroy',business)" method="delete" as="button">Eliminar</Link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
