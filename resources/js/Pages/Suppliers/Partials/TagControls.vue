<template>
    <div class="space-x-2">
        <Transition>
            <button v-show="selectedTag.id" data-dropdown-toggle="dropdownEditTag" id="toggleEditTagForm"
                class="text-blue-500 px-1 py-1 rounded-md border-blue-500 hover:bg-blue-500 hover:text-white">
                <i class="fa-solid fa-pen"></i>
            </button>
        </Transition>
        <Transition>
            <button v-show="selectedTag.id" data-dropdown-toggle="dropdownDeleteTag" id="toggleDeleteTagForm"
                class="text-red-500 px-1 py-1 rounded-md border-red-500 hover:bg-red-500 hover:text-white">
                <i class="fa-solid fa-trash"></i>
            </button>
        </Transition>
        <Transition>
            <button v-show="!!categoryId" data-dropdown-toggle="dropdownAddTag" id="toggleAddTagForm"
                class="text-green-500 px-1 py-1 rounded-md hover:bg-green-500 hover:text-white">
                <i class="fa-solid fa-plus"></i>
            </button>
        </Transition>
    </div>

    <form id="dropdownAddTag" @submit.prevent="addTag"
        class="!m-0 flex flex-col hidden z-10 gap-4 rounded-md bg-white shadow-md p-4">
        <h5 class="heading-5">Tag hinzufügen</h5>
        <TextInput type="text" placeholder="Name" v-model="addTagForm.name" required />
        <button type="submit"
            class="text-white px-2 py-1 w-full hover:text-green-500 hover:bg-white border-2 border-green-500 bg-green-500 rounded-md">
            <i class="fa-solid fa-save"></i>
        </button>
    </form>

    <form id="dropdownEditTag" @submit.prevent="updateTag"
        class="!m-0 flex flex-col z-10 gap-4 rounded-md bg-white shadow-md p-4 hidden">
        <h5 class="heading-5">Tag bearbeiten</h5>
        <TextInput type="text" placeholder="Name" v-model="selectedTag.name" />
        <button type="submit"
            class="text-white px-2 py-1 w-full hover:text-green-500 hover:bg-white border-2 border-green-500 bg-green-500 rounded-md">
            <i class="fa-solid fa-save"></i>
        </button>
    </form>

    <form id="dropdownDeleteTag" @submit.prevent="deleteTag"
        class="!m-0 flex flex-col hidden z-10 gap-4 rounded-md bg-white shadow-md p-4">
        <h5 class="heading-5">Tag Löschen</h5>
        <div class="text-center">
            <p>
                Soll der Tag <span class="font-bold uppercase">"{{ selectedTag.name }}"</span>
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
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { onMounted } from 'vue'
import { initDropdowns } from 'flowbite'
import { Inertia } from '@inertiajs/inertia';

onMounted(() => {
    initDropdowns()
})

const props = defineProps({
    selectedTag: {
        type: Object,
        default: {}
    },
    categoryId: Number,
});

const addTagForm = useForm(
    {
        name: null,
        categoryId: null,
    },
)

function addTag() {
    addTagForm.categoryId = props.categoryId

    if (addTagForm.name && addTagForm.categoryId) {
        console.log(addTagForm.categoryId)
        addTagForm.post(route('tag.store'))
        document.getElementById('toggleAddTagForm').click()
        addTagForm.reset()
    }
}

function updateTag() {
    Inertia.patch(route('tag.patch'), props.selectedTag)
    document.getElementById('toggleEditTagForm').click()
}

function deleteTag() {
    Inertia.delete(route('tag.destroy', props.selectedTag.id))
    document.getElementById('toggleDeleteTagForm').click()
}

</script>

<style scoped></style>
