<script setup>
import {Head, useForm} from '@inertiajs/vue3'
const props = defineProps({
    product:Object
})
const form = useForm({
    name:props.product.name,
    opening_stock:props.product.opening_stock,
    current_stock:props.product.current_stock,
    closing_stock:props.product.closing_stock,
    packaged_products:props.product.packaged_products
})
function update(){
    form.put(route('products.update',{product:props.product.id}))
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

    <form @submit.prevent="update">
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

        <label for="current_stock">Current Stock:</label>
        <input id="current_stock" v-model="form.current_stock" />
        <div v-if="form.errors.current_stock" class="text-red-500">
            {{form.errors.current_stock}}
        </div>

        <label for="closing_stock">Closing Stock:</label>
        <input id="closing_stock" v-model="form.closing_stock" />
        <div v-if="form.errors.closing_stock" class="text-red-500">
            {{form.errors.closing_stock}}
        </div>

        <label for="packaged_products">Packaged Products:</label>
        <input id="packaged_products" v-model="form.packaged_products" />
        <div v-if="form.errors.packaged_products" class="text-red-500">
            {{form.errors.packaged_products}}
        </div>

        <button type="submit">Submit</button>
    </form>

</template>
