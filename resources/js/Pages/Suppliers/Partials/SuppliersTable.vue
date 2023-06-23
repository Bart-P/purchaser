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

            <BaseButton data-modal-hide="deleteSupplierModal" color="back">
                Abbrechen
            </BaseButton>
        </template>
    </DeleteConfirmationModal>

    <table class="table">
        <thead class="table-head">
            <tr>
                <th scope="col" class="p-4">
                    <div class="flex items-center">
                        <input id="checkbox-all-search" type="checkbox"
                            class="w-4 h-4 text-purchaser-primary bg-gray-100 border-gray-300 rounded focus:ring-purchaser-primary focus:ring-2">
                        <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    </div>
                </th>
                <th @click="sort('id')" scope="col" class="whitespace-nowrap px-6 py-3 max-w-[30px] cursor-pointer">
                    ID <i class="fa-solid" :class="getSortDirectionClass('id')"></i>
                </th>
                <th @click="sort('name')" scope="col" class="px-6 py-3 cursor-pointer">
                    Firma

                    <i class="fa-solid" :class="getSortDirectionClass('name')"></i>
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="supplier in suppliers.data" class="table-row">
                <td class="w-4 p-4">
                    <div class="flex items-center">
                        <input id="checkbox-table-search-1" type="checkbox"
                            class="w-4 h-4 text-purchaser-primary bg-gray-100 border-gray-300 rounded focus:ring-purchaser-primary focus:ring-2">
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                </td>
                <td class="table-data max-w-[30px]">
                    {{ supplier.id }}
                </td>
                <td class="table-data font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ supplier.name }}
                </td>
                <td class="table-data">
                    {{ supplier.email }}
                </td>
                <td class="table-data flex justify-end gap-4">
                    <IconButton color='blue' :href="route('suppliers.edit', supplier.id)">
                        <i class="fa-solid fa-pen"></i>
                    </IconButton>

                    <IconButton color="red" @click="setSupplierToDelete(supplier.id, supplier.name)"
                        data-modal-target="deleteSupplierModal" data-modal-toggle="deleteSupplierModal">
                        <i class="fa-solid fa-trash"></i>
                    </IconButton>
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
import IconButton from '@/Components/IconButton.vue';
import DeleteConfirmationModal from '@/Components/DeleteConfirmationModal.vue';
import Pagination from '@/Components/Pagination.vue';
import { router } from '@inertiajs/vue3';
import { initModals } from 'flowbite';
import { onMounted, reactive, watch } from 'vue';

onMounted(() => {
    initModals()
})

const props = defineProps(
    {
        suppliers: Object,
        sortColumn: {
            default: null,
            type: String
        },
        sort: {
            default: {
                direction: '',
                column: ''
            },
            type: Object
        }
    },
)

const sortBy = reactive(props.sort)

if (props.sortColumn) {
    sortBy.column = props.sortColumn
}

watch(
    () => props.sort,
    () => {
        sortBy.direction = props.sort.direction
    }
)

const emits = defineEmits(['sortBy']);

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
    router.delete(route('suppliers.destroy', supplierToDelete.id))
}

function sort(column) {
    sortBy.column = column
    this.emits('sortBy', column)
}

function getSortDirectionClass(column) {

    const sortIndicator = {
        asc: 'fa-sort-up text-purchaser-secondary',
        desc: 'fa-sort-down text-purchaser-secondary',
        '': 'fa-sort text-gray-300',
    }

    if (sortBy.column === column) {
        return sortIndicator[sortBy.direction]
    }

    return sortIndicator['']
}
</script>