<script setup>
import {Head, useForm} from '@inertiajs/vue3'
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
    <div class="p-4">
        <h1 class="text-2xl font-semibold mb-4">New Product</h1>

        <div v-if="$page.props.flash.success" class="text-gray-600 bg-green-400 w-full border-gray-200 px-2">
            {{$page.props.flash.success}}
        </div>
        <div class="text-red-500 mt-2 rounded-2xl w-full border-gray-200">
            {{form.errors.error}}
        </div>
    </div>
    <form @submit.prevent="create">
        <label for="name">Product Name:</label>
        <input id="name" v-model="form.name" />
        <div v-if="form.errors.name" class="text-red-500">
            {{form.errors.name}}
        </div>

        <label for="opening_stock">Opening Stock:</label>
        <input id="opening_stock" v-model="form.opening_stock" />
        <div v-if="form.errors.opening_stock" class="text-red-500">
            {{form.errors.opening_stock}}
        </div>

        <button type="submit">Submit</button>
    </form>
</template>
