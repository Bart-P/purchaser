<template>
    <DeleteConfirmationModal id="deleteSupplierModal">
        <template #text>
            Der Lieferant
            <span class="font-bold">{{ supplierToDelete.name }} (ID: {{ supplierToDelete.id }})</span>
            sowie die dazugehörigen Adressen und Personen werden unwiederruflich gelöscht!
        </template>
        <template #buttons>
            <BaseButton data-modal-hide="deleteSupplierModal" @click="deleteSupplier()" color="danger">
                Löschen
            </BaseButton>

            <BaseButton data-modal-hide="deleteSupplierModal" color="light">
                Abbrechen
            </BaseButton>
        </template>
    </DeleteConfirmationModal>

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3  max-w-[30px]">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Firma
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="supplier in suppliers.data"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-1" type="checkbox"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="px-6 py-4 max-w-[30px]">
                    {{ supplier.id }}
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ supplier.name }}
                </td>
                <td class="px-6 py-4">
                    {{ supplier.email }}
                </td>
                <td class="px-6 py-4 flex justify-end gap-4">
                    <Link :href="route('suppliers.edit', supplier.id)"
                        class="text-blue-600 dark:text-blue-500 hover:underline">
                    <i class="fa-solid fa-pen"></i>
                    </Link>

                    <button @click="setSupplierToDelete(supplier.id, supplier.name)" data-modal-target="deleteSupplierModal"
                        data-modal-toggle="deleteSupplierModal" class="text-red-600 dark:text-red-500 hover:underline">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
            <tr v-if="suppliers.data.length < 5" class="h-32">
            </tr>
        </tbody>
    </table>
    <Pagination :data="suppliers" />
</template>

<script setup>

import BaseButton from '@/Components/BaseButton.vue';
import DeleteConfirmationModal from '@/Components/DeleteConfirmationModal.vue';
import Pagination from '@/Components/Pagination.vue';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import { initModals } from 'flowbite';
import { onMounted, reactive } from 'vue';

onMounted(() => {
    initModals()
})

const props = defineProps(
    {
        suppliers: Object,
    },
)

const supplierToDelete = reactive(
    {
        id: 0,
        name: '',
    })

function setSupplierToDelete(id, name) {
    supplierToDelete.id = id
    supplierToDelete.name = name
}

function deleteSupplier() {
    Inertia.delete(route('suppliers.destroy', supplierToDelete.id))
}

</script>
