<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
const showingNavigationDropdown = ref(false);

// State to manage sidebar visibility
const isSidebarOpen = ref(false)

// Function to toggle sidebar visibility
const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <!--Navbar -->
            <nav
                class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800"
            >
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">

                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo/>
                                </Link>
                            </div>

                            <!-- Navigation Links (dashboard,new product,new client)-->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                            </div>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                        >
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="space-y-1 pb-3 pt-2">


                        <ResponsiveNavLink
                            :href="route('products.create')"
                            :active="route().current('products.create')"
                        >
                            New Product
                        </ResponsiveNavLink>

                    </div>

                    <!-- Responsive Settings Options -->
                    <div
                        class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600"
                    >
                        <div class="px-4">
                            <div
                                class="text-base font-medium text-gray-800 dark:text-gray-200"
                            >
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="flex h-screen overflow-hidden">
                <!--Sidebar-->
                <nav
                    class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 md:relative absolute transform -translate-x-full md:translate-x-0 transition-transform duration-200 h-screen z-40"
                    :class="{ '-translate-x-full': !isSidebarOpen, 'translate-x-0': isSidebarOpen  }"
                >
                    <div>
                        <ul class="space-y-4">
                            <li>
                                <Link
                                    :href="route('products.index')"
                                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700"
                                >
                                    All Products
                                </Link>
                            </li>

                            <li>
                                <Link
                                    :href="route('products.create')"
                                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700"
                                >
                                    New Product
                                </Link>
                            </li>


                            <li>

                                <Link
                                    :href="route('transactions.create')"
                                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:bg-contain"
                                >Restock/Package
                                </Link>
                            </li>

                            <li>

                                <Link
                                    :href="route('transactions.index')"
                                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:bg-contain"
                                >Product History
                                </Link>
                            </li>

                        </ul>
                    </div>
                </nav>

                <div class="flex-1 flex flex-col overflow-auto">
                    <header class="bg-gray-100 px-6 py-4 flex justify-between items-center">
                        <button
                            class="md:hidden text-gray-700 focus:outline-none top-4 left-4 z-50"
                            @click="toggleSidebar"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                        <h1 class="text-lg font-semibold text-gray-800">Dashboard</h1>

                    </header>

                    <!-- Page Content -->
                    <main class="p-6 flex-grow dark:text-white">
                        <slot />
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>
