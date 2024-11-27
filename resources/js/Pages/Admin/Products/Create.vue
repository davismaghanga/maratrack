<script setup>
import {Head, useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
const form = useForm({
    name:null,
    opening_stock:0,
})
function create(){
    form.post(route('products.store'))
}
</script>

<template>
    <Head title="New Product" />
    <AuthenticatedLayout>
        <div>
            <div class="p-4">
                <h1 class="text-2xl font-semibold mb-4">New Product</h1>

                <div v-if="$page.props.flash.success" class="text-gray-600 bg-green-400 w-full border-gray-200 px-2">
                    {{$page.props.flash.success}}
                </div>
                <div class="text-red-500 mt-2 rounded-2xl w-full border-gray-200">
                    {{form.errors.error}}
                </div>
            </div>
            <form @submit.prevent="create" class="space-y-6">
                <label for="name" class="block font-medium">Product Name:</label>
                <input id="name" v-model="form.name" class="w-1/2 p-2 border rounded"/>
                <div v-if="form.errors.name" class="text-red-500">
                    {{form.errors.name}}
                </div>

                <label for="opening_stock" class="block font-medium">Opening Stock:</label>
                <input id="opening_stock" v-model="form.opening_stock" class="w-1/2 p-2 border rounded" />
                <div v-if="form.errors.opening_stock" class="text-red-500">
                    {{form.errors.opening_stock}}
                </div>

                <button type="submit" class="block px-4 py-2 bg-indigo-600 text-white rounded">Submit</button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
