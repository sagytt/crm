<template>
    <div class="mx-auto mt-20">
        <div class="relative overflow-x-auto drop-shadow-md sm:rounded-lg">
            <div class="text-right mt-5">
                <Link
                    :href="route('createcustomer')"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                >
                    Add Customer
                </Link>
            </div>
            <div
                v-if="showFlash"
                class="mt-10 flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3"
                role="alert"
            >
                <svg
                    class="fill-current w-4 h-4 mr-2"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"
                    />
                </svg>
                <p>{{ flashSuccess }}</p>
            </div>

            <div class="p-4">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div
                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                    >
                        <svg
                            class="w-5 h-5 text-gray-500 dark:text-gray-400"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </div>
                    <input
                        type="text"
                        id="table-search"
                        v-model="searchTerm"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for items"
                    />
                </div>
            </div>
            <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Address</th>
                        <th scope="col" class="px-6 py-3">Phone No.</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="customer in filteredCustomers"
                        :key="customer.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                        >
                            {{ customer.name }}
                        </th>
                        <td class="px-6 py-4">{{ customer.email }}</td>
                        <td class="px-6 py-4">{{ customer.address }}</td>
                        <td class="px-6 py-4">{{ customer.phone_number }}</td>
                        <td class="px-6 py-4 text-right">
                            <Link
                                :href="route('editcustomer', customer.id)"
                                class="font-medium text-green-600 dark:text-green-500 hover:underline"
                                ><i class="fa-solid fa-pen-to-square"></i
                            ></Link>
                            <Link
                                :href="route('deletecustomer', customer.id)"
                                class="ml-2 font-medium text-red-600 dark:text-red-500 hover:underline"
                                ><i class="fa-solid fa-trash"></i
                            ></Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <nav class="mt-4 flex justify-between mb-10" aria-label="Table navigation">
            <ul class="inline-flex -space-x-px">
                <li v-for="link in paginationLinks" :key="link.label">
                    <Link
                        :href="link.url"
                        :class="[
                            'acion_class px-4 py-2 leading-tight border border-gray-300 rounded-md transition-colors duration-150 ease-in-out',
                            {
                                'bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-300':
                                    link.active,
                                'bg-white text-gray-500 hover:bg-gray-100 focus:ring-gray-300':
                                    !link.active && link.url,
                                'cursor-not-allowed': !link.url,
                            },
                        ]"
                    >
                        <span v-if="link.label.includes('Next')">
                            <span v-html="'Next &raquo;'"></span>
                        </span>
                        <span v-else-if="link.label.includes('Previous')">
                            <span v-html="'&laquo; Previous'"></span>
                        </span>
                        <span v-else>{{ link.label }}</span>
                    </Link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script setup>
import { computed, ref, watchEffect } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const props = defineProps({
    customers: {
        type: Array,
        required: true,
    },
});

// Reactive search term
const searchTerm = ref("");

/// Computed property to filter customers based on search term
const filteredCustomers = computed(() => {
    const customerData = props.customers.data; // Access the actual data array

    if (!searchTerm.value) {
        return customerData;
    }

    const lowerSearchTerm = searchTerm.value.toLowerCase();

    return customerData.filter(
        (customer) =>
            customer.name.toLowerCase().includes(lowerSearchTerm) ||
            customer.email.toLowerCase().includes(lowerSearchTerm) ||
            customer.address.toLowerCase().includes(lowerSearchTerm) ||
            customer.phone_number.toLowerCase().includes(lowerSearchTerm)
    );
});

// Pagination links
const paginationLinks = computed(() => props.customers.links);

//// this code is used to to show flash messages /////
const page = usePage();
const flashSuccess = computed(() => page.props.flash.success);
const showFlash = ref(false);

// Watch for changes in flashSuccess and manage the visibility of the flash message
watchEffect(() => {
    if (flashSuccess.value) {
        showFlash.value = true;
        setTimeout(() => {
            showFlash.value = false;
        }, 3000); // Hide after 3 seconds
    } else {
        showFlash.value = false;
    }
});
//// flash message code end here /////
</script>

<style scoped>
/* General styles for pagination links */
.acion_class {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    font-weight: 500;
    transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
}

/* Hover and focus effects */
.acion_class:hover {
    background-color: rgba(0, 0, 0, 0.1);
}

.acion_class:focus {
    outline: 2px solid transparent;
    outline-offset: 2px;
}

/* Disabled state */
.cursor-not-allowed {
    opacity: 0.5;
    pointer-events: none;
}

/* Rounded corners for active and previous/next buttons */
.rounded-md {
    border-radius: 0.375rem;
    margin-left: 10px;
}

/* Custom focus ring styles */
.focus:ring-blue-300 {
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
}

.focus:ring-gray-300 {
    box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.5);
}
</style>
