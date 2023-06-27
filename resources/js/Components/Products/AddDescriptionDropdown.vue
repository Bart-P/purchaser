<template>
    <div class="relative">
        <BaseButton color="success" btn-type="rounded" type="button" data-show-trigger="addDescriptionDropdown"
            id="addDescriptionDropdownBtn" @click="toggleAddDescriptionDropdown()">
            <i class="fa-solid fa-plus"></i>
        </BaseButton>

        <div class="absolute top-[40px] right-0" id="addDescriptionDropdown" v-click-outside="hideAddDiscriptionDropdown"
            v-show="showAddDescription">
            <form @submit.prevent="$emit('createNewDescription', descriptionLang)"
                class="!m-0 flex flex-col z-10 gap-4 rounded-md bg-white shadow-md p-4">
                <h5 class="heading-5 whitespace-nowrap">Neue Beschreibung: </h5>
                <TextInput v-model="descriptionLang" type="text" placeholder="Titel" required />
                <div class="flex gap-3 justify-end">
                    <BaseButton type="submit" color="success">
                        <i class="fa-solid fa-save"></i>
                    </BaseButton>
                    <BaseButton @click="showAddDescription = false" type="button" color="light">
                        <i class="fa-solid fa-cancel"></i>
                    </BaseButton>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>

import BaseButton from "@/Components/BaseButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";

const emits = defineEmits(['createNewDescription']);

const showAddDescription = ref(false)
const descriptionLang = ref('')

function toggleAddDescriptionDropdown() {
    showAddDescription.value = !showAddDescription.value
}

function hideAddDiscriptionDropdown() {
    if (showAddDescription.value === true) {
        showAddDescription.value = false
    }
}
</script>