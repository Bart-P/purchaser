<template>
    <form @submit.prevent="submitSupplier"
          class="flex flex-col gap-5">
        <div class="flex justify-between">
            <h3 class="heading-3">
                Firma (erforderlich)
            </h3>
            <div class="flex gap-4 justify-end">
                <BaseButton type="submit"
                            color="primary">Speichern
                </BaseButton>
                <BaseButton :href="route('suppliers')"
                            color="light">Zurück
                </BaseButton>
            </div>
        </div>

        <div class="flex gap-5">
            <div class="w-1/2">
                <InputLabel for="company"
                            value="Firma Name *" />
                <TextInput
                    id="company"
                    v-model="supplierForm.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
            </div>

            <div class="w-1/2">
                <InputLabel for="companyEmail"
                            value="Firma E-Mail *" />
                <TextInput
                    id="companyEmail"
                    v-model="supplierForm.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                />
            </div>
        </div>

        <hr class="my-5">

        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="heading-4">Kategorien</h3>
                <BaseButton id="dropdownSearchButton"
                            data-dropdown-toggle="dropdownCategorySearch"
                            data-dropdown-placement="bottom"
                            class="inline-flex items-center"
                            type="button">Kategorie Auswählen
                    <svg class="w-4 h-4 ml-2"
                         aria-hidden="true"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M19 9l-7 7-7-7"></path>
                    </svg>
                </BaseButton>
            </div>

            <ul class="flex flex-wrap items-center gap-4 uppercase">
                <TransitionGroup>
                    <li class="py-2 px-3 border-[1px] border-purchaser-primary rounded-md shadow-md text-purchaser-primary"
                        v-for="cat in checkedCategories"
                        :key="'cat-key-' + cat.id">
                        {{ cat.name }}
                    </li>
                </TransitionGroup>
            </ul>

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
                               placeholder="Search user">
                    </div>
                </div>
                <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownSearchButton">
                    <li v-for="category in filteredCategories">
                        <div class="flex items-center pl-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input :id="'cat-' + category.id"
                                   v-model="checkedCategories"
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
        </div>
    </form>
</template>

<script setup>

import BaseButton from '@/Components/BaseButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/inertia-vue3';
import {initDropdowns} from 'flowbite';
import {onMounted, ref} from 'vue';

onMounted(() => {
    initDropdowns();
})

const props = defineProps(
    {
        supplier  : {
            default: null,
            type   : Object,
        },
        categories: Object,
        addresses : Array,
        persons   : Array,
    })

const checkedCategories = ref([]);
const filteredCategories = ref(props.categories)

const supplierForm = useForm(
    {
        name     : props.supplier?.name,
        email    : props.supplier?.email,
        addresses: null,
        persons  : null,
    },
)

// TODO - restyle category element and abstract it to its own component, so it can be reused

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

function submitSupplier() {
    if (props.addresses.length) {
        supplierForm['addresses'] = props.addresses
    }

    if (props.persons.length) {
        supplierForm['persons'] = props.persons
    }

    if (props.supplier) {
        supplierForm.put(route('suppliers.put',
                               {
                                   'id'   : props.supplier.id,
                                   'name' : supplierForm.name,
                                   'email': supplierForm.email,
                               }))
    } else {
        supplierForm.post(route('suppliers.store'))
    }

}
</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.2s ease-in-out;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}

</style>