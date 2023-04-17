<template>
    <div class="space-x-2">
        <Transition>
            <button v-show="selectedCategory.id" data-dropdown-toggle="dropdownEditCategory" id="toggleEditCategoryDropdown"
                class="text-blue-500 px-1 py-1 rounded-md border-blue-500 hover:bg-blue-500 hover:text-white">
                <i class="fa-solid fa-pen"></i>
            </button>
        </Transition>
        <Transition>
            <button v-show="selectedCategory.id" data-dropdown-toggle="dropdownDeleteCategory"
                id="toggleDeleteCategoryDropdown"
                class="text-red-500 px-1 py-1 rounded-md border-red-500 hover:bg-red-500 hover:text-white">
                <i class="fa-solid fa-trash"></i>
            </button>
        </Transition>
        <button data-dropdown-toggle="dropdownAddCategory" type="button" id="toggleAddCategoryDropdown"
            class="text-green-500 px-1 py-1 rounded-md hover:bg-green-500 hover:text-white">
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>

    <form id="dropdownAddCategory" @submit.prevent="addNewCategory"
        class="!m-0 flex flex-col hidden z-10 gap-4 rounded-md bg-white shadow-md p-4">
        <h5 class="heading-5">Kategorie hinzufügen</h5>
        <TextInput type="text" placeholder="Name" v-model="addCategoryForm.name" required />
        <TextInput type="text" placeholder="Farbe" v-model="addCategoryForm.color" required />
        <button type="submit"
            class="text-white px-2 py-1 w-full hover:text-green-500 hover:bg-white border-2 border-green-500 bg-green-500 rounded-md">
            <i class="fa-solid fa-save"></i>
        </button>
    </form>

    <form id="dropdownEditCategory" @submit.prevent="updateCategory"
        class="!m-0 flex flex-col z-10 gap-4 rounded-md bg-white shadow-md p-4 hidden">
        <h5 class="heading-5">Kategorie bearbeiten</h5>
        <TextInput type="text" placeholder="Name" v-model="selectedCategory.name" />
        <TextInput type="text" placeholder="Farbe" v-model="selectedCategory.color" />
        <button type="submit"
            class="text-white px-2 py-1 w-full hover:text-green-500 hover:bg-white border-2 border-green-500 bg-green-500 rounded-md">
            <i class="fa-solid fa-save"></i>
        </button>
    </form>

    <form id="dropdownDeleteCategory" @submit.prevent="deleteSelectedCategory"
        class="!m-0 flex flex-col hidden z-10 gap-4 rounded-md bg-white shadow-md p-4">
        <h5 class="heading-5">Kategorie Löschen</h5>
        <div class="text-center">
            <p>
                Soll die Kategorie <span class="font-bold">"{{ selectedCategory.name }}"</span>
            </p>
            <p>
                wirklich gelöscht werden?
            </p>
        </div>

        <button type="submit"
            class="text-white px-2 py-1 w-full hover:text-red-500 hover:bg-white border-2 border-red-500 bg-red-500 rounded-md">
            <i class="fa-solid fa-trash"></i>
        </button>
    </form>
</template>

<script setup>

import { useForm } from '@inertiajs/inertia-vue3'
import TextInput from '@/Components/TextInput.vue'
import { onMounted } from 'vue'
import { initDropdowns } from 'flowbite'
import { Inertia } from '@inertiajs/inertia'

onMounted(() => {
    initDropdowns()
})

const props = defineProps({
    selectedCategory: {
        default: null,
        type: Object,
    }
});

const emits = defineEmits(['resetSelectableValues']);

const addCategoryForm = useForm(
    {
        name: null,
        color: null,
    },
)

function addNewCategory() {
    if (addCategoryForm.name && addCategoryForm.color) {
        addCategoryForm.post(route('category.store'))
        document.getElementById('toggleAddCategoryDropdown').click()
        addCategoryForm.reset()
    }
}

function deleteSelectedCategory() {
    const idToDelete = props.selectedCategory.id

    if (idToDelete) {
        emits('resetSelectableValues')
        Inertia.delete(route('category.destroy', idToDelete))
        document.getElementById('toggleDeleteCategoryDropdown').click()
    }
}

function updateCategory() {
    const selectedCat = props.selectedCategory
    if (selectedCat.name && selectedCat.color) {
        Inertia.patch(route('category.patch', selectedCat))
        document.getElementById('toggleEditCategoryDropdown').click()
    }
}

</script>

<style scoped></style>
