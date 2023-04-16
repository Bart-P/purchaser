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
                            @search-for-term="updateSearchTerm" :search-term="searchTerm" :suppliers="suppliers"
                            :categories="categories" :selected-category="filterByCategory" :tags="tags"
                            :filter-by-tags="filterByTags" />

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
import { computed } from '@vue/reactivity';

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

const pageQuery = usePage().props.value.query
const searchTerm = SupplierSelectionStore.searchTerm
const filterByCategory = computed(() => {
    return props.categories.filter((cat) => cat.id === SupplierSelectionStore.categoryFilter[0])
})

// TODO filterByTags has to work same as filterByCategory 
const filterByTags = SupplierSelectionStore.tagFilter

if (!pageQuery.page && (searchTerm || filterByCategory)) {
    applySearchAndFilter()
}

function toggleCheckCategory(category) {
    SupplierSelectionStore.toggleCategoryFilter(category.id)
    applySearchAndFilter()
}

function toggleCheckTag(tag) {
    SupplierSelectionStore.toggleTagFilter(tag.id)
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
