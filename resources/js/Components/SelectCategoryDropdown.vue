<template>
    <!-- Dropdown menu -->
    <!-- The class !m-0 has to be added, else popper.js throughs a warning in the console -->

    <div id="dropdownCategorySearch"
         class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700 !m-0">
        <div class="p-3">
            <label for="category-search-input"
                   class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                         aria-hidden="true"
                         fill="currentColor"
                         viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                              clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text"
                       @keyup="applyFilterCategories"
                       id="category-search-input"
                       class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Suchen">
            </div>
        </div>
        <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownSearchButton">
            <li v-for="category in filteredCategories">
                <div class="flex items-center pl-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <input :id="'cat-' + category.id"
                           @click="$emit('toggleCheckCategory', category)"
                           type="checkbox"
                           :value="category"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="checkbox-item-11"
                           class="w-full py-2 ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                        {{ category.name }}
                    </label>
                </div>
            </li>
        </ul>
        <a href="#"
           class="flex items-center p-3 text-sm font-medium text-red-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-red-500 hover:underline">
            <svg class="w-5 h-5 mr-1"
                 aria-hidden="true"
                 fill="currentColor"
                 viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z"></path>
            </svg>
            Delete user
        </a>
    </div>
</template>

<script setup>
import {ref} from 'vue';

const props = defineProps(
    {
        categories: Object,
    })

const emit = defineEmits(['toggleCheckCategory'])

const filteredCategories = ref(props.categories)
let applyFilterTimeout = null

function applyFilterCategories() {
    let filterTerm = document.getElementById('category-search-input')
    if (!filterTerm) {
        filterTerm = ''
    }

    if (applyFilterTimeout) {
        clearTimeout(applyFilterTimeout)
    }

    applyFilterTimeout = setTimeout(() => {
        filteredCategories.value = props.categories
                                        .filter((cat) =>
                                                    cat.name.toLowerCase()
                                                       .includes(filterTerm.value.toLowerCase()))
    }, 500)
}

</script>

<style lang="scss"
       scoped>

</style>