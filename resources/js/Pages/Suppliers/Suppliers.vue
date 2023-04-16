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
                            @search-for-term="updateSearchTerm" :search-term="search" :suppliers="suppliers"
                            :categories="categories" :selected-category="filterByCategory" :tags="tags" />

                        <SuppliersTable :suppliers="suppliers" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import SuppliersTable from '@/Pages/Suppliers/Partials/SuppliersTable.vue';
import { ref } from 'vue';
import SuppliersTableNav from '@/Pages/Suppliers/Partials/SuppliersTableNav.vue';
import SupplierSelectionStore from '@/Stores/SupplierSelectionStore'
import { Inertia } from '@inertiajs/inertia';

const props = defineProps(
    {
        suppliers: Object,
        search: {
            type: String,
            default: '',
        },
        categories: Object,
        tags: Object,
    }
)

const filterByCategory = ref([]);
const filterByTags = ref([]);

// TODO page should also reload data if other filter are active - cant it be handeled in the backend? Seems that it should be there. 
if (SupplierSelectionStore.categoryFilter.length) {
    applySearchAndFilter()
}

function toggleCheckCategory(category) {
    SupplierSelectionStore.addCategoryFilter(category.id)
    filterByCategories.value = { category }
    applySearchAndFilter()
}

function toggleCheckTag(tag) {
    SupplierSelectionStore.toggleTagFilter(tag.id)
    if (filterByTags.value.some((t => t['id'] === tag.id))) {
        filterByTags.value = filterByTags.value.filter((t) => t['id'] !== tag.id)
    } else {
        filterByTags.value = [...filterByTags.value, tag]
    }
}

function updateSearchTerm(searchTerm) {
    SupplierSelectionStore.addSearchTerm(searchTerm)
    applySearchAndFilter()
}

function applySearchAndFilter() {
    // let filterTags = []
    // if (props.filterByTags.length) {
    //     filterTags = props.filterByTags.map((tag) => tag.id)
    // }

    Inertia.get(
        route('suppliers'),
        {
            search: SupplierSelectionStore.searchTerm,
            filterCategories: SupplierSelectionStore.categoryFilter.join(','),
            // filterTags: filterTags.join(','),
        },
        {
            preserveState: true,
            replace: true,
        },
    )
}

</script>
