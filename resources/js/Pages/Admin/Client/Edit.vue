<script setup>
import {Head, useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
const props = defineProps({
    client:Object
})
const form = useForm({
    name:props.client.name,
    country:props.client.country,
})
function update(){
    form.put(route('clients.update',{client:props.client.id}))
}


</script>


<template>
    <AuthenticatedLayout>
        <Head title="Edit Client"/>

        <div class="p-4">
            <h1 class="text-2xl font-semibold mb-4">New Product</h1>

            <div v-if="$page.props.flash.success" class="text-gray-600 bg-green-400 w-full border-gray-200 px-2">
                {{$page.props.flash.success}}
            </div>
            <div class="text-red-500 mt-2 rounded-2xl w-full border-gray-200">
                {{form.errors.error}}
            </div>
        </div>
        <form @submit.prevent="update" class="space-y-6">
            <label for="name">Client Name:</label>
            <input id="name" v-model="form.name" />
            <div v-if="form.errors.name" class="text-red-500">
                {{form.errors.name}}
            </div>

            <label for="country">Country:</label>
            <input id="country" v-model="form.country"/>
            <div v-if="form.errors.country" class="text-red-500">
                {{form.errors.country}}
            </div>


            <button type="submit" class="btn-main">Submit</button>
        </form>
    </AuthenticatedLayout>

</template>
