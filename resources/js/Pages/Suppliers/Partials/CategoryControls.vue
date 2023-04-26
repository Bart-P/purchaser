<template>
    <div class="space-x-3">
        <Transition>
            <IconButton v-show="selectedCategory.id" data-dropdown-toggle="dropdownEditCategory"
                id="toggleEditCategoryDropdown">
                <i class="fa-solid fa-pen"></i>
            </IconButton>
        </Transition>
        <Transition>
            <IconButton v-show="selectedCategory.id" data-dropdown-toggle="dropdownDeleteCategory" color="red"
                id="toggleDeleteCategoryDropdown">
                <i class="fa-solid fa-trash"></i>
            </IconButton>
        </Transition>
        <IconButton data-dropdown-toggle="dropdownAddCategory" color="green" type="button" id="toggleAddCategoryDropdown">
            <i class="fa-solid fa-plus"></i>
        </IconButton>
    </div>

    <form id="dropdownAddCategory" @submit.prevent="addNewCategory"
        class="!m-0 flex flex-col hidden z-10 gap-4 rounded-md bg-white shadow-md p-4">
        <h5 class="heading-5">Kategorie hinzufügen</h5>
        <TextInput type="text" placeholder="Name" v-model="addCategoryForm.name" required />
        <TextInput type="text" placeholder="Farbe" v-model="addCategoryForm.color" required />
        <BaseButton type="submit" color="success">
            <i class="fa-solid fa-save"></i>
        </BaseButton>
    </form>

    <form id="dropdownEditCategory" @submit.prevent="updateCategory"
        class="!m-0 flex flex-col z-10 gap-4 rounded-md bg-white shadow-md p-4 hidden">
        <h5 class="heading-5">Kategorie bearbeiten</h5>
        <TextInput type="text" placeholder="Name" v-model="selectedCategory.name" />
        <TextInput type="text" placeholder="Farbe" v-model="selectedCategory.color" />
        <BaseButton type="submit" color="success">
            <i class="fa-solid fa-save"></i>
        </BaseButton>
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

        <BaseButton type="submit" color="danger">
            <i class="fa-solid fa-trash"></i>
        </BaseButton>
    </form>
</template>

<script setup>

import { useForm } from '@inertiajs/inertia-vue3'
import TextInput from '@/Components/TextInput.vue'
import IconButton from '@/Components/IconButton.vue'
import BaseButton from '@/Components/BaseButton.vue'
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
