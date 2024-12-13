<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref } from "vue";

import { Head } from '@inertiajs/vue3';
import { router } from "@inertiajs/vue3";
import Swal from "sweetalert2";



defineProps(['transactions'])
const columns = ref([
    { title: "ID", data: "id" },
    { title: "Product Name",
        data: "product.name",
        defaultContent: "N/A", // Show "N/A" if the product is null

    },
    { title: "Transaction Type",
        data: "type",
        defaultContent: "N/A", // Show "N/A" if the product is null

    },

    { title: "Quantity (Kg/L)",
        data: "quantity",
        defaultContent: "N/A", // Show "N/A" if the product is null

    },

    { title: "Operator In-charge",
        data: "user.name",
        defaultContent: "N/A", // Show "N/A" if the user is null

    },


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
        router.get(`/transactions/${id}/edit`);


        // Handle the edit action, e.g., navigate to an edit page or open a modal
    }

    if (event.target.matches(".view-btn")) {
        const id = event.target.getAttribute("data-id");
        console.log(`View item with ID: ${id}`);
        router.get(`/transactions/${id}`);

    }

    if (event.target.matches(".delete-btn")) {
        const id = event.target.getAttribute("data-id");

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
                router.delete(`/transactions/${id}`,{
                    onSuccess: () => {
                        Swal.fire("Deleted!", "The transaction has been deleted.", "success");
                    },
                    onError: () => {
                        Swal.fire("Error!", "There was an error deleting the transaction.", "error");
                    },
                });

            }
        })
        // router.delete(`/transactions/${id}`);

        // Handle the delete action, e.g., confirm and send a delete request
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
    <Head title="Transaction History" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <DataTable
                            :data="transactions"
                            :columns="columns"
                            class="display"
                        >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Transaction Type</th>
                                <th>Qty (kg/l)</th>
                                <th>Operator</th>
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
