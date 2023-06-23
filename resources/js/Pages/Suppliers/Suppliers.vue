<template>
    <Head title="Lieferanten" />
    <AuthenticatedLayout>
        <template #header>
            Alle Lieferanten
        </template>
        <div class="py-12">
            <PageBoxWrapper>
                <SuppliersTableNav @toggle-check-category="toggleCheckCategory" @toggle-check-tag="toggleCheckTag"
                    @search-for-term="updateSearchTerm" @reset-fields="resetFilterAndSearch" :search-term="searchTerm"
                    :suppliers="suppliers" :categories="categories" :selected-category="filterByCategory" :tags="tags"
                    :filter-by-tags="filterByTags" />

                <SuppliersTable @sort-by="sortBy" :suppliers="suppliers" :sort="sort" />
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import SuppliersTable from '@/Pages/Suppliers/Partials/SuppliersTable.vue';
import SuppliersTableNav from '@/Pages/Suppliers/Partials/SuppliersTableNav.vue';
import SupplierSelectionStore from '@/Stores/SupplierSelectionStore'
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue';

const props = defineProps(
    {
        suppliers: Object,
        categories: Object,
        tags: Object,
    }
)

const pageQuery = usePage().props.query
const sort = ref({
    direction: SupplierSelectionStore.sort.direction,
    column: SupplierSelectionStore.sort.column,
})
let searchTerm = SupplierSelectionStore.searchTerm
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

watch(
    () => SupplierSelectionStore.searchTerm,
    () => {
        searchTerm = SupplierSelectionStore.searchTerm
        console.log(searchTerm)
    }
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
    if (SupplierSelectionStore.sort.column.length > 0) {
        sort.column = SupplierSelectionStore.column
        sort.direction = SupplierSelectionStore.direction
    }

    router.get(
        route('suppliers'),
        {
            search: SupplierSelectionStore.searchTerm,
            filterCategories: SupplierSelectionStore.categoryFilter.join(','),
            filterTags: SupplierSelectionStore.tagFilter.join(','),
            sortBy: SupplierSelectionStore.sort,
        },
        {
            preserveState: true,
            replace: true,
        },
    )
}

function resetFilterAndSearch() {
    SupplierSelectionStore.resetFields()
    sort.value.direction = ''
    applySearchAndFilter()
}

function sortBy(column) {
    sort.value.direction = SupplierSelectionStore.sortBy(column)
    applySearchAndFilter()
}
</script>