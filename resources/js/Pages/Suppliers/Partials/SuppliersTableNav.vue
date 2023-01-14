<template>
    <div class="px-6 py-4 bg-white dark:bg-gray-900 w-full flex justify-between">
        
        <div class="h-full flex gap-4">
            <Link :href="route('suppliers.create')" class="cursor-pointer bg-purchaser-primary hover:bg-purchaser-primary-dark text-white px-6 py-2 rounded">Neu</Link>
            <button disabled class="bg-gray-100 text-gray-500 px-6 py-2 rounded">Zur Anfrage Hinzufügen</button>
            <button disabled class="bg-gray-100 text-gray-500 px-6 py-2 rounded">Löschen</button>
        </div>
        <label for="table-search"
               class="sr-only">Search</label>
        <div class="relative mt-1">
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
                   id="table-search"
                   v-model="searchInput"
                   @keyup="searchFor"
                   class="block
                          p-2
                          pl-10
                          text-sm
                          text-gray-900
                          border
                          border-gray-300
                          rounded-lg
                          w-80
                          bg-gray-50
                          focus:ring-blue-500
                          focus:border-blue-500
                          dark:bg-gray-700
                          dark:border-gray-600
                          dark:placeholder-gray-400
                          dark:text-white
                          dark:focus:ring-blue-500
                          dark:focus:border-blue-500"
                   placeholder="Suche">
        </div>
    </div>
</template>

<script setup>

import {Inertia} from "@inertiajs/inertia";
import {ref} from "vue";
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps({
    search: {
        default: ref(''),
        type: Object
    }
})

let searchInput = props.search.value || ''
let timeOut = null

function searchFor() {
    clearTimeout(timeOut)
    props.search.value = searchInput
    
    timeOut = setTimeout(() => {
        Inertia.get(
            route('suppliers'),
            {search: props.search.value},
            {
                preserveState: true,
                replace: true,
            }
        )
    }, 500)
}
</script>