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
                            :suppliers="suppliers" :categories="categories" :filter-by-categories="filterByCategories"
                            :filter-by-tags="filterByTags" :tags="tags" />

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

const props = defineProps(
    {
        suppliers: Object,
        search: {
            type: Object,
            default: ref(''),
        },
        categories: Object,
        tags: Object,
    }
)

const filterByCategories = ref([]);
const filterByTags = ref([]);

function toggleCheckCategory(category) {
    filterByTags.value = []
    if (filterByCategories.value.some((cat => cat['id'] === category.id))) {
        filterByCategories.value = filterByCategories.value.filter((cat) => cat['id'] !== category.id)
    } else {
        filterByCategories.value = [category]
    }
}

function toggleCheckTag(tag) {
    SupplierSelectionStore.toggleTagFilter(tag.id)
    if (filterByTags.value.some((t => t['id'] === tag.id))) {
        filterByTags.value = filterByTags.value.filter((t) => t['id'] !== tag.id)
    } else {
        filterByTags.value = [...filterByTags.value, tag]
    }
}

</script>
