<script setup>
import {Head, useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
const props = defineProps({
    product:Object
})
const form = useForm({
    name:props.product.name,
    opening_stock:props.product.opening_stock,
    current_stock:props.product.current_stock,
    closing_stock:props.product.closing_stock,
    packaged_qty:props.product.packaged_qty,
    restocked_qty:props.product.restocked_qty

})
function update(){
    form.put(route('products.update',{product:props.product.id}))
}


</script>


<template>
    <Head title="New Product" />
    <AuthenticatedLayout>
        <div>
            <div class="p-4">
                <h1 class="text-2xl font-semibold mb-4">Update Product</h1>

                <div v-if="$page.props.flash.success" class="text-gray-600 bg-green-400 w-full border-gray-200 px-2">
                    {{$page.props.flash.success}}
                </div>
                <div class="text-red-500 mt-2 rounded-2xl w-full border-gray-200">
                    {{form.errors.error}}
                </div>
            </div>

            <form @submit.prevent="update" class="space-y-6">
                <label for="name" class="block font-medium">Product Name:</label>
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

                <label for="packaged_products">Packaged Quantity (Kg/L):</label>
                <input id="packaged_products" v-model="form.packaged_qty" />
                <div v-if="form.errors.packaged_qty" class="text-red-500">
                    {{form.errors.packaged_qty}}
                </div>

                <label for="restocked_qty">Restocked Quantity (Kg/L):</label>
                <input id="restocked_qty" v-model="form.restocked_qty" />
                <div v-if="form.errors.packaged_qty" class="text-red-500">
                    {{form.errors.restocked_qty}}
                </div>

                <button type="submit" class="block px-4 py-2 bg-indigo-600 text-white rounded">Submit</button>
            </form>
        </div>
    </AuthenticatedLayout>

</template>
