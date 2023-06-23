<template>
    <div class="pb-6 bg-white dark:bg-gray-900 w-full space-y-4">
        <div class=" flex justify-between">
            <div class="flex align-middle justify-center items-center gap-3">
                <div class="">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="table-search" v-model="searchInput" @keyup="searchForTerm"
                            class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-md w-80 bg-gray-50 focus:ring-purchaser-primary focus:border-purchaser-primary"
                            placeholder="Suche">
                    </div>
                </div>
                <div class="flex gap-3">
                    <SelectItemDropdown id="categoryDropdown" @toggle-check-item="toggleCheckCategory" color="light"
                        :items="categories" :checked-items="selectedCategory">
                        Kategorie filter <i class="ml-2 fa-solid fa-angle-down"></i>
                        <transition>
                            <div v-show="selectedCategory.length"
                                class="inline-flex items-center align-middle justify-center ml-2 text-sm bg-purchaser-secondary w-6 h-6 rounded-full text-white font-bold -right-4">
                                {{ selectedCategory.length }}
                            </div>
                        </transition>
                    </SelectItemDropdown>

                    <SelectItemDropdown id="tagDropdown" @toggle-check-item="toggleCheckTag"
                        :is-disabled="categoryTags.length < 1" color="light" :items="categoryTags"
                        :checked-items="filterByTags">
                        Tag filter <i class="ml-2 fa-solid fa-angle-down"></i>
                        <transition>
                            <div v-show="filterByTags.length"
                                class="inline-flex items-center justify-center ml-2 text-sm bg-purchaser-secondary w-6 h-6 rounded-full text-white font-bold -right-4">
                                {{ filterByTags.length }}
                            </div>
                        </transition>
                    </SelectItemDropdown>

                    <BaseButton @click="resetFields" color="secondary" btn-type="rounded"
                        :disabled="filterByTags.length + categoryTags.length + selectedCategory.id + searchInput.length < 1">
                        <i class="fa-solid fa-filter-circle-xmark"></i>
                    </BaseButton>
                </div>
            </div>
            <div class="h-full flex gap-3">
                <BaseButton :disabled="props.suppliersChosen.value" color="secondary">
                    Zur Anfrage Hinzufügen
                </BaseButton>

                <BaseButton :href="route('suppliers.create')" color="success" btn-type="rounded">
                    <i class="fa-solid fa-plus" />
                </BaseButton>
            </div>
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

const emits = defineEmits(['toggleCheckCategory', 'toggleCheckTag', 'searchForTerm', 'resetFields']);

const categoryTags = ref([])

// CategoryTags need to be assigned once when component is loaded and everytime after selectedCategory changes. 
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

function resetFields() {
    searchInput = props.searchTerm
    emits('resetFields')
}
</script>