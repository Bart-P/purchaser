<template>
    <div class="px-6 py-4 bg-white dark:bg-gray-900 w-full space-y-4">
        <div class=" flex justify-between">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search" v-model="searchInput" @keyup="searchFor"
                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Suche">
            </div>
            <transition>
                <div v-show="filterByCategories.length" class="flex justify-center align-middle">
                    <span>
                        Aktive Filter: {{ filterByCategories.length }}
                    </span>
                </div>
            </transition>
            <div class="h-full space-x-3">
                <BaseButton :href="route('suppliers.create')" color="primary">Neu
                </BaseButton>
                <BaseButton :disabled="props.suppliersChosen.value" color="secondary">Zur Anfrage Hinzufügen
                </BaseButton>
            </div>
        </div>
        <div class="space-x-3">
            <SelectCategoryDropdown @toggle-check-category="toggleCheckCategory" color="light" :categories="categories"
                :checked-categories="filterByCategories">
                Kategorie filter
            </SelectCategoryDropdown>
            <transition>
            </transition>
            <BaseButton>Tags filter</BaseButton>

        </div>
    </div>
</template>

<script setup>

import BaseButton from '@/Components/BaseButton.vue';
import SelectCategoryDropdown from '@/Components/SelectCategoryDropdown.vue';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const props = defineProps(
    {
        search: {
            default: ref(''),
            type: Object,
        },
        suppliersChosen: {
            default: ref(true),
            type: Object,
        },
        categories: {
            type: Object,
            default: {},
        },
        filterByCategories: {
            type: Object,
            default: {},
        }
    })

const emits = defineEmits(['toggleCheckCategory']);

const queryParams = usePage().props.value.ziggy.query;

if (props.categories && queryParams.filterCategories) {
    // emit toggle 
    for (let i = 0; i < props.categories.length; i++) {
        const filterCategoryIdList = queryParams.filterCategories.split(',')
        if (filterCategoryIdList.filter(id => id == props.categories[i].id).length) {
            emits('toggleCheckCategory', props.categories[i])
        }
    }
}

let searchInput = queryParams.search || props.search.value || ''
let timeOut = null

if (searchInput) searchFor()

function searchFor() {
    clearTimeout(timeOut)
    props.search.value = searchInput

    let filterCategories = []

    timeOut = setTimeout(() => {
        if (props.filterByCategories.length) {
            filterCategories = props.filterByCategories.map((cat) => cat.id)
        }

        Inertia.get(
            route('suppliers'),
            {
                search: props.search.value,
                filterCategories: filterCategories.join(','),
            },
            {
                preserveState: true,
                replace: true,
            },
        )
    }, 500)
}

function toggleCheckCategory(cat) {
    emits('toggleCheckCategory', cat)
    searchFor()
}

</script>
