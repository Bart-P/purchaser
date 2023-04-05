<template>
    <!-- Dropdown menu -->
    <!-- The class !m-0 has to be added to the dropdown, else popper.js throughs a warning in the console -->
    <div id="dropdownCategorySearch" class="z-10 hidden bg-white rounded-md shadow w-60 dark:bg-gray-700 !m-0">
        <div class="p-3">
            <label for="category-search-input" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="category-search-input" v-model="filterTerm"
                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-purchaser-primary focus:border-purchaser-primary"
                    placeholder="Suchen">
            </div>
        </div>
        <ul class="max-h-72 min-h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownSearchButton">
            <li v-for="category in filteredCategories">
                <div @click="$emit('toggleCheckCategory', category)"
                    class="flex items-center pl-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <input :id="'cat-' + category.id" type="checkbox" :value="category"
                        :checked="categoryIsChecked(category.id)"
                        class="w-4 h-4 text-purchaser-primary bg-gray-100 border-gray-300 rounded-md focus:ring-purchaser-primary focus:ring-1 dark:bg-gray-600 dark:border-gray-500">
                    <label for="checkbox-item-11" class="w-full py-2 ml-2 text-sm font-medium text-gray-900 rounded-md">
                        {{ category.name }}
                    </label>
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { computed } from '@vue/reactivity';
import { ref } from 'vue';

const props = defineProps(
    {
        categories: Object,
        checkedCategories: {
            type: Object,
            default: null,
        },
    })

const emit = defineEmits(['toggleCheckCategory'])

let filterTerm = ref('')
let filteredCategories = computed(() => {
    return props.categories.filter((cat) => {
        return cat.name.toLowerCase()
            .includes(filterTerm.value.toLowerCase())
    })
})

function categoryIsChecked(categoryId) {
    if (!props.checkedCategories) {
        return false
    }

    return Boolean(Object.values(props.checkedCategories)
        .some(cat => cat.id === categoryId))
}

</script>
