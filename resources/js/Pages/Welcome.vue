<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>
<style scoped>
body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
}

.container {
    max-width: 100%;
}
@media (max-width: 640px) {
    header h1 {
        font-size: 1.25rem; /* Adjust title size for smaller screens */
    }

    footer p {
        font-size: 0.875rem; /* Adjust footer text for smaller screens */
    }
}
</style>
<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black dark:bg-gray-900 dark:text-white h-full">
        <header>
            <div class="container mx-auto px-4 py-6 md:flex justify-between items-center">
                <div class="flex items-center ">
                    <ApplicationLogo/>
                    <div class="text-xl font-bold text-white/50 px-2">Stock Keeping System</div>
                </div>

                <div>
                    <nav v-if="canLogin" class="flex space-x-4">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>
                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-grow container mx-auto px-4 md:py-8 mt-1 md:mt-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-8">
                <!-- Inventory Overview -->
                <div class="bg-gray-200 rounded shadow-2xl p-2 md:p-6">
                    <h2 class="text-lg font-semibold mb-4 text-black">Inventory Overview</h2>
                    <p class="text-gray-600">
                        View a snapshot of available stock, low stock alerts, and recent additions to the inventory.
                    </p>
                </div>

                <!-- Stock Management -->
                <div class="bg-gray-200 rounded shadow-2xl p-2 md:p-6">
                    <h2 class="text-lg font-semibold mb-4 text-black">Stock Management</h2>
                    <p class="text-gray-600">
                        Add, edit, and track products in your inventory. Easily update stock quantities and monitor stock levels.
                    </p>
                </div>

                <!-- Order Management -->
                <div class="bg-gray-200 rounded shadow-2xl p-2 md:p-6">
                    <h2 class="text-lg font-semibold mb-4 text-black">Order Management</h2>
                    <p class="text-gray-600">
                        Manage incoming and outgoing orders. Keep track of order statuses and ensure timely deliveries.
                    </p>
                </div>

                <!-- Reports and Insights -->
                <div class="bg-gray-200 rounded shadow-2xl p-2 md:p-6">
                    <h2 class="text-lg font-semibold mb-4 text-black">Reports and Insights</h2>
                    <p class="text-gray-600">
                        Generate reports on inventory performance, sales, and stock trends to make informed decisions.
                    </p>
                </div>
            </div>
        </main>

        <footer
            class="py-16 text-center text-sm text-black dark:text-white/70"
        >
            Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </footer>
    </div>
</template>
