<script setup>
import {Head, useForm} from '@inertiajs/vue3'
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
    <Head title="Edit Client"/>
    <form @submit.prevent="update">
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


        <button type="submit">Submit</button>
    </form>

</template>
