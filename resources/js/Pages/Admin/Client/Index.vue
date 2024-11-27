<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref } from "vue";

import { Head } from '@inertiajs/vue3';
import { router } from "@inertiajs/vue3";
import Swal from "sweetalert2";



defineProps(['clients'])
const columns = ref([
    { title: "ID", data: "id" },
    { title: "Name", data: "name" },
    { title: "Country", data: "country" },
    {
        title: "Actions",
        render: (data, type, row)=>{
            return `
            <button class="btn btn-sm btn-primary edit-btn" data-id="${row.id}">Edit</button>
            <button class="btn btn-sm btn-primary view-btn" data-id="${row.id}">View</button>
            <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
            `;
        }
    }
]);
// Event handling for actions (Edit/Delete)
document.addEventListener("click", (event) => {
    if (event.target.matches(".edit-btn")) {
        const id = event.target.getAttribute("data-id");
        console.log(`Edit item with ID: ${id}`);
        router.get(`/clients/${id}/edit`);


        // Handle the edit action, e.g., navigate to an edit page or open a modal
    }

    if (event.target.matches(".view-btn")) {
        const id = event.target.getAttribute("data-id");
        console.log(`View item with ID: ${id}`);
        router.get(`/clients/${id}`);

    }

    if (event.target.matches(".delete-btn")) {
        const id = event.target.getAttribute("data-id");
        // Show SweetAlert2 confirmation dialog
        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
        }).then((result)=>{
            if(result.isConfirmed){
                router.delete(`/clients/${id}`,{
                    onSuccess: () => {
                        Swal.fire("Deleted!", "The client record has been deleted.", "success");
                    },
                    onError: () => {
                        Swal.fire("Error!", "There was an error deleting the client record.", "error");
                    },
                })
            }
        })

    }
});

</script>
<style scoped>
.btn {
    margin-right: 5px;
    cursor: pointer;
}
</style>
<template>
    <Head title="Clients" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <DataTable
                            :data="clients"
                            :columns="columns"
                            class="display"
                        >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
