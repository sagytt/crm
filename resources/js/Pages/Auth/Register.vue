<template>
    <section class="bg-gray-50 dark:bg-gray-900">
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
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="create">
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
                                for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Password</label
                            >
                            <input
                                type="password"
                                name="password"
                                id="password"
                                v-model="form.password"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required=""
                            />
                            <div v-if="form.errors.password">
                                <p class="text-sm text-red-500">{{ form.errors.password }}</p>
                            </div>
                        </div>
                      
                        <button
                            type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        >
                            Sign up
                        </button>
                        <p
                            class="text-sm font-light text-gray-500 dark:text-gray-400"
                        >
                            Already Have Account?
                            <Link
                                :href="`/`"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                                >Sign in</Link
                            >
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: null,
    email: null,
    password: null
});

const create = () => form.post(route('storeuser'));
</script>
