<template>
    <Head title="Lieferanten" />
    <AuthenticatedLayout>
        <template #header>
            Alle Lieferanten
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg py-4">
                        <SuppliersTableNav @toggle-check-category="toggleCheckCategory" @toggle-check-tag="toggleCheckTag"
                            @search-for-term="updateSearchTerm" @reset-fields="resetFilterAndSearch"
                            :search-term="searchTerm" :suppliers="suppliers" :categories="categories"
                            :selected-category="filterByCategory" :tags="tags" :filter-by-tags="filterByTags" />

                        <SuppliersTable :suppliers="suppliers" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/inertia-vue3';
import SuppliersTable from '@/Pages/Suppliers/Partials/SuppliersTable.vue';
import SuppliersTableNav from '@/Pages/Suppliers/Partials/SuppliersTableNav.vue';
import SupplierSelectionStore from '@/Stores/SupplierSelectionStore'
import { Inertia } from '@inertiajs/inertia';
import { watch } from 'vue';

const props = defineProps(
    {
        suppliers: Object,
        categories: Object,
        tags: Object,
    }
)

const pageQuery = usePage().props.value.query
const searchTerm = SupplierSelectionStore.searchTerm
let filterByCategory = SupplierSelectionStore.categoryFilter
let filterByTags = SupplierSelectionStore.tagFilter

watch(
    () => SupplierSelectionStore.categoryFilter,
    () => filterByCategory = SupplierSelectionStore.categoryFilter
)

watch(
    () => SupplierSelectionStore.tagFilter,
    () => filterByTags = SupplierSelectionStore.tagFilter
)

if (!pageQuery.page && (searchTerm || filterByCategory || filterByTags)) {
    applySearchAndFilter()
}

function toggleCheckCategory(categoryId) {
    SupplierSelectionStore.toggleCategoryFilter(categoryId)
    applySearchAndFilter()
}

function toggleCheckTag(tagId) {
    SupplierSelectionStore.toggleTagFilter(tagId)
    applySearchAndFilter()
}

function updateSearchTerm(searchTerm) {
    SupplierSelectionStore.addSearchTerm(searchTerm)
    applySearchAndFilter()
}

function applySearchAndFilter() {
    Inertia.get(
        route('suppliers'),
        {
            search: SupplierSelectionStore.searchTerm,
            filterCategories: SupplierSelectionStore.categoryFilter.join(','),
            filterTags: SupplierSelectionStore.tagFilter.join(','),
        },
        {
            preserveState: true,
            replace: true,
        },
    )
}

function resetFilterAndSearch() {
    SupplierSelectionStore.resetFields()
    applySearchAndFilter()
}

</script>
