<script setup>
import { useForm } from '@inertiajs/vue3'
const form = useForm({
    name:null,
    opening_stock:0,
    current_stock:0,
    closing_stock:0,
    packaged_products:0,
})
function create(){
    form.post(route('products.store'))
}
</script>

<template>
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
