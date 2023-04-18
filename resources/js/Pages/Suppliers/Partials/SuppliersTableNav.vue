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
                <input type="text" id="table-search" v-model="searchInput" @keyup="searchForTerm"
                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Suche">
            </div>
            <div class="h-full space-x-3">
                <BaseButton :href="route('suppliers.create')" color="primary">
                    Neu
                </BaseButton>
                <BaseButton :disabled="props.suppliersChosen.value" color="secondary">
                    Zur Anfrage Hinzufügen
                </BaseButton>
            </div>
        </div>
        <div class="space-x-3">
            <SelectItemDropdown id="categoryDropdown" @toggle-check-item="toggleCheckCategory" color="light"
                :items="categories" :checked-items="selectedCategory">
                Kategorie filter
                <transition>
                    <div v-show="selectedCategory.length"
                        class="inline-flex items-center align-middle justify-center ml-2 text-sm bg-purchaser-secondary w-6 h-6 rounded-full text-white font-bold -right-4">
                        {{ selectedCategory.length }}
                    </div>
                </transition>
            </SelectItemDropdown>

            <SelectItemDropdown id="tagDropdown" @toggle-check-item="toggleCheckTag" :is-disabled="categoryTags.length < 1"
                color="light" :items="categoryTags" :checked-items="filterByTags">
                Tag filter
                <transition>
                    <div v-show="filterByTags.length"
                        class="inline-flex items-center justify-center ml-2 text-sm bg-purchaser-secondary w-6 h-6 rounded-full text-white font-bold -right-4">
                        {{ filterByTags.length }}
                    </div>
                </transition>
            </SelectItemDropdown>
        </div>
    </div>
</template>

<script setup>

import BaseButton from '@/Components/BaseButton.vue';
import SelectItemDropdown from '@/Components/SelectItemDropdown.vue';
import { ref, watch } from 'vue';

const props = defineProps(
    {
        suppliersChosen: {
            default: ref(true),
            type: Object,
        },
        searchTerm: {
            default: '',
            type: String,
        },
        categories: {
            type: Object,
            default: {},
        },
        selectedCategory: {
            default: [],
            type: Array,
        },
        tags: Object,
        filterByTags: {
            type: Array,
            default: [],
        }
    })

const emits = defineEmits(['toggleCheckCategory', 'toggleCheckTag', 'searchForTerm']);

const categoryTags = ref([])

// CategoryTags need to be assigned once when component is loaded and everytime after selectedCategory changes
assignCategoryTags()

watch(
    () => props.selectedCategory,
    () => {
        assignCategoryTags()
    }
)

function assignCategoryTags() {
    categoryTags.value = []
    if (props.selectedCategory.length) {
        categoryTags.value = props.tags.filter((tag) => tag.category_id === props.selectedCategory[0])
    }
}

let searchInput = props.searchTerm

let timeout = null
const timeoutTime = 500
function clearCurrentTimeout() {
    if (timeout) {
        clearTimeout(timeout)
    }
}

function toggleCheckCategory(catId) {
    emits('toggleCheckCategory', catId)
}

function toggleCheckTag(tagId) {
    emits('toggleCheckTag', tagId)
}

function searchForTerm() {
    clearCurrentTimeout()
    timeout = setTimeout(() => emits('searchForTerm', searchInput), timeoutTime)
}
</script>
