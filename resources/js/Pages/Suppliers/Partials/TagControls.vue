<template>
    <div class="space-x-3">
        <Transition>
            <IconButton v-show="selectedTag.id" data-dropdown-toggle="dropdownEditTag" id="toggleEditTagForm">
                <i class="fa-solid fa-pen"></i>
            </IconButton>
        </Transition>
        <Transition>
            <IconButton v-show="selectedTag.id" data-dropdown-toggle="dropdownDeleteTag" id="toggleDeleteTagForm"
                color="red">
                <i class="fa-solid fa-trash"></i>
            </IconButton>
        </Transition>
        <Transition>
            <IconButton v-show="!!categoryId" data-dropdown-toggle="dropdownAddTag" id="toggleAddTagForm" color="green">
                <i class="fa-solid fa-plus"></i>
            </IconButton>
        </Transition>
    </div>

    <form id="dropdownAddTag" @submit.prevent="addTag"
        class="!m-0 flex flex-col hidden z-10 gap-4 rounded-md bg-white shadow-md p-4">
        <h5 class="heading-5">Tag hinzufügen</h5>
        <TextInput type="text" placeholder="Name" v-model="addTagForm.name" required />
        <BaseButton type="submit" color="success">
            <i class="fa-solid fa-save"></i>
        </BaseButton>
    </form>

    <form id="dropdownEditTag" @submit.prevent="updateTag"
        class="!m-0 flex flex-col z-10 gap-4 rounded-md bg-white shadow-md p-4 hidden">
        <h5 class="heading-5">Tag bearbeiten</h5>
        <TextInput type="text" placeholder="Name" v-model="selectedTag.name" />
        <BaseButton type="submit" color="success">
            <i class="fa-solid fa-save"></i>
        </BaseButton>
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

        <BaseButton type="submit" color="danger">
            <i class="fa-solid fa-trash"></i>
        </BaseButton>
    </form>
</template>

<script setup>
import TextInput from '@/Components/TextInput.vue';
import IconButton from '@/Components/IconButton.vue';
import BaseButton from '@/Components/BaseButton.vue';
import { router, useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue'
import { initDropdowns } from 'flowbite'

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
        addTagForm.post(route('tag.store'))
        document.getElementById('toggleAddTagForm').click()
        addTagForm.reset()
    }
}

function updateTag() {
    router.patch(route('tag.patch'), props.selectedTag)
    document.getElementById('toggleEditTagForm').click()
}

function deleteTag() {
    router.delete(route('tag.destroy', props.selectedTag.id))
    document.getElementById('toggleDeleteTagForm').click()
}

</script>

<style scoped></style>