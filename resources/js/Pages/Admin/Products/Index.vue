<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import ReportModal from "@/Components/ReportModal.vue";
import { ref } from "vue";
import { Head } from '@inertiajs/vue3';
import { router } from "@inertiajs/vue3";
import Swal from "sweetalert2";

defineProps(['products'])

const showReportModal = ref(false);
const selectedProductId = ref(null);
const openReportModal = (productId) => {
    selectedProductId.value = productId;
    showReportModal.value = true;
};
const columns = ref([
    { title: "ID", data: "id" },
    { title: "Name", data: "name" },
    { title: "Opening Stock", data: "opening_stock" },
    { title: "Current Stock", data: "current_stock" },
    { title: "Cumulative Packaged Qty", data: "packaged_qty" },
    { title: "Cumulative Restocked Qty", data: "restocked_qty" },
    { title: "Cumulative Tanzania Bulk Qty", data: "tanzania_bulk" },
    {
        title: "Actions",
        render: (data, type, row)=>{
            return `
             <i class="fa fa-edit edit-btn font-awesome" title="Edit" data-id="${row.id}"></i>
             <i class="fa fa-eye view-btn font-awesome" title="History" data-id="${row.id}"></i>
             <i class="fa fa-trash delete-btn font-awesome" title="Delete" data-id="${row.id}"></i>
             <i class="fa fa-clipboard report-btn font-awesome" title="Report" data-id="${row.id}"></i>
            `;
        }
    }
]);
// Event handling for actions (Edit/Delete)
document.addEventListener("click", (event) => {
    if (event.target.matches(".edit-btn")) {
        const id = event.target.getAttribute("data-id");
        // Handle the edit action, e.g., navigate to an edit page or open a modal
        router.get(`/products/${id}/edit`);

    }

    if (event.target.matches(".view-btn")) {
        const id = event.target.getAttribute("data-id");
        //view product
        router.get(`/products/${id}`);

    }

    if (event.target.matches(".report-btn")){
        const id = event.target.getAttribute("data-id");
        // Handle the edit action, e.g., navigate to an edit page or open a modal
        //console.log(id)
        openReportModal(id)
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
                router.delete(`/products/${id}`,{
                    onSuccess: () => {
                        Swal.fire("Deleted!", "The product has been deleted.", "success");
                    },
                    onError: () => {
                        Swal.fire("Error!", "There was an error deleting the product.", "error");
                    },
                })
            }
        })
    }

    if(event.target.matches(".close-period-btn")){
        // Show SweetAlert2 confirmation dialog
        Swal.fire({
            title: "Are you sure?",
            text: "This action will reset the opening stock of each product to be that of closing stock!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, close stock!",
        }).then((result)=>{
            if(result.isConfirmed){
                router.get(`closeStock`,{
                    onSuccess: () => {
                        Swal.fire("Success!", "New Stock Period initialized!.", "success");
                    },
                    onError: () => {
                        Swal.fire("Error!", "There was an error initializing stock.", "error");
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
    <Head title="Products" />

    <AuthenticatedLayout>
        <button class="btn btn-main px-2 close-period-btn">Close Stock Period</button>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <DataTable
                            :data="products"
                            :columns="columns"
                            class="display"
                        >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Opening Stock</th>
                                <th>Current Stock</th>
                                <th>Packaged Qty</th>
                                <th>Restocked Qty</th>
                                <th>Tanzania Bulk Qty</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                        </DataTable>
                    </div>
                </div>

            </div>
            <!-- Product Modal -->
            <ReportModal
                v-if="showReportModal"
                :product-id="Number(selectedProductId)"
                @close="showReportModal = false"
            />
        </div>
    </AuthenticatedLayout>
</template>
