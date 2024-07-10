<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
//import FileInput from '@/Components/FileInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';

const page = usePage();
const product = ref(page.props.product);
console.log(page.props.product)

const initialValues = {
    name: product.value.name,
    price: product.value.price,
    //avatar: null,
    description: product.value.description,
    status: product.value.status,

}
const form = useForm(initialValues)

const onSelectAvatar = (e) => {
    //console.log(e.target.files);
    const files = e.target.files;

    if (files.length) {
        form.avatar = files[0]
    }
    //console.log(form.avatar);

}

const submit = () => {
    form.post(route('product.update',product.value),{
        onSuccess: (e) => {
            product.value = e.props.product;
            console.log(e.props.product)
        }
    })
 
    console.log("actualizando")
}
</script>

<template>
    <AppLayout title="Update product">
        <template #header>
            <div class="flex justify-between">

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Update product
                </h2>
                <Link :href="route('product.index')">Ir atras</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <form action="" class="w-1/3 py-5 space-y-3" @submit.prevent="submit">
                        <div>
                            <InputLabel for="name" value="Nombre" />
                            <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" autofocus
                                autocomplete="name" placeholder="Nombre" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div>
                            <InputLabel for="price" value="price" />
                            <TextInput id="price" v-model="form.price" type="text" class="mt-1 block w-full"
                                placeholder="price" />
                            <InputError class="mt-2" :message="form.errors.price" />
                        </div>
                        <div>
                            <InputLabel for="description" value="description" />
                            <TextInput id="description" v-model="form.description" type="text" class="mt-1 block w-full"
                                placeholder="description" />
                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <div>
                            <InputLabel for="status" value="status" />
                            <TextInput id="status" v-model="form.status" type="text" class="mt-1 block w-full"
                                placeholder="status" />
                            <InputError class="mt-2" :message="form.errors.status" />
                        </div>

                        <!-- <img class="h-16" :src="`/storage/${product.avatar}`" >
                        <div>
                            <InputLabel for="avatar" value="Avatar" />
                            <FileInput name="avatar" @change="onSelectAvatar" />
                            <InputError class="mt-2" :message="form.errors.avatar" />
                        </div>
                        <div>
                            <InputLabel for="privacity" value="privacity" />
                            <select v-model="form.privacity" name="privacity" id="privacity"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                                <option value="public">public</option>
                                <option value="private">private</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.privacity" />
                        </div> -->
                        <div class="flex justify-center">
                            <PrimaryButton>Actualizar product</PrimaryButton>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </AppLayout>
</template>



