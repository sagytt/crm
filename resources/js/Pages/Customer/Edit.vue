<template>
    <section class="bg-gray-50 dark:bg-gray-900 mt-20">
        <div
            class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0"
        >
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
            >
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
                    >
                        Edit Customer
                    </h1>
                    <form
                        class="space-y-4 md:space-y-6"
                        @submit.prevent="update"
                    >
                    <div>
                            <label
                                for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Your Name</label
                            >
                            <input
                                type="text"
                                name="name"
                                id="name"
                                v-model="form.name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter Your Name"
                                required=""
                            />
                            <div v-if="form.errors.name">
                                <p class="text-sm text-red-500">{{ form.errors.name }}</p>
                            </div>
    
                        </div>
                        <div>
                            <label
                                for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Your email</label
                            >
                            <input
                                type="email"
                                name="email"
                                id="email"
                                v-model="form.email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com"
                                required=""
                            />
                            <div v-if="form.errors.email">
                                <p class="text-sm text-red-500">{{ form.errors.email }}</p>
                            </div>
                        </div>
                        <div>
                            <label
                                for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Your Address</label
                            >
                            <input
                                type="text"
                                name="address"
                                id="address"
                                v-model="form.address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter Your Address"
                                required=""
                            />
                            <div v-if="form.errors.address">
                                <p class="text-sm text-red-500">{{ form.errors.address }}</p>
                            </div>
                        </div>
                        <div>
                            <label
                                for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Your Phone No.</label
                            >
                            <input
                                type="text"
                                name="phone_number"
                                id="phone_number"
                                v-model="form.phone_number"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter Your Phone Number"
                                required=""
                            />
                            <div v-if="form.errors.phone_number">
                                <p class="text-sm text-red-500">{{ form.errors.phone_number }}</p>
                            </div>
                        </div>
                        <div class="flex">
                            <button
                                type="submit"
                                class="flex-auto mr-2 w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            >
                                Submit
                            </button>

                            <Link
                                :href="route('managecustomer')"
                                class="flex-auto w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                            >
                                Cancel
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link, useForm} from "@inertiajs/vue3";

// Define the props
const props = defineProps({
    customers: {
        type: Object,
        required: true
    }
});

console.log(props);


// Initialize the form with the customer's data
const form = useForm({
    name: props.customers.name || '',
    email: props.customers.email || '',
    phone_number: props.customers.phone_number || '',
    address: props.customers.address || ''
});
console.log(form.name);

const update = () => form.post(route('updatecustomer',props.customers.id));
</script>
