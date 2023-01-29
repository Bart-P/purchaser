<template>
    
    <FlashNotification />
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col"
                class="p-4">
                <div class="flex items-center">
                    <input id="checkbox-all-search"
                           type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-all-search"
                           class="sr-only">checkbox</label>
                </div>
            </th>
            <th scope="col"
                class="px-6 py-3">
                Firma
            </th>
            <th scope="col"
                class="px-6 py-3">
                Email
            </th>
            <th scope="col"
                class="px-6 py-3">
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="supplier in suppliers.data"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="w-4 p-4">
                <div class="flex items-center">
                    <input id="checkbox-table-search-1"
                           type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-table-search-1"
                           class="sr-only">checkbox</label>
                </div>
            </td>
            <th scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ supplier.name }}
            </th>
            <td class="px-6 py-4">
                {{ supplier.email }}
            </td>
            <td class="px-6 py-4 flex justify-end gap-4">
                <Link href="#"
                      class="text-green-600 dark:text-green-500 hover:underline">
                    <i class="fa-solid fa-eye"></i>
                </Link>
                <Link href="#"
                      class="text-blue-600 dark:text-blue-500 hover:underline">
                    <i class="fa-solid fa-pen"></i>
                </Link>
                <button class="text-red-600 dark:text-red-500 hover:underline">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
    <Pagination :data="suppliers" />

</template>

<script setup>

import Pagination from "@/Components/Pagination.vue";
import {Link, usePage} from "@inertiajs/inertia-vue3";
import FlashNotification from "@/Components/FlashNotification.vue";

const props = defineProps(
    {
        suppliers: Object,
    }
)

let message = usePage().props.value.notification?.message
let show = true

setTimeout(() => show = false, 5000)

</script>