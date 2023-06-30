<template>
    <div class="relative">
        <BaseButton color="danger" btn-type="rounded" type="button" data-show-trigger="deleteProductDescriptionDropdown"
            id="deleteDescriptionDropdownBtn" @click="toggleDeleteDescriptionDropdown()">
            <i class="fa-solid fa-trash"></i>
        </BaseButton>

        <div class="absolute top-[40px] right-0" v-show="showDeleteDescription"
            v-click-outside="hideDeleteDiscriptionDropdown" id="deleteProductDescriptionDropdown">
            <div class="!m-0 flex flex-col z-10 gap-4 rounded-md bg-white shadow-md p-4">
                <h5 class="heading-4 text-center text-red-600">Bist du sicher?</h5>
                <p class="whitespace-nowrap">Beschreibung ID: {{
                    descriptionIdToDelete }} unwiederruflich löschen
                </p>
                <div class="flex gap-3 justify-end">
                    <BaseButton @click="$emit('deleteProductDescription', descriptionIdToDelete)" type="button"
                        color="danger">
                        <i class="fa-solid fa-trash"></i>
                    </BaseButton>

                    <BaseButton @click="showDeleteDescription = false" type="button" color="light">
                        <i class="fa-solid fa-cancel"></i>
                    </BaseButton>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import BaseButton from "@/Components/BaseButton.vue";
import { ref } from "vue";

const emits = defineEmits(['deleteProductDescription'])

const props = defineProps({
    descriptionIdToDelete: Number
})

const showDeleteDescription = ref(false)

function toggleDeleteDescriptionDropdown() {
    showDeleteDescription.value = !showDeleteDescription.value
}

function hideDeleteDiscriptionDropdown() {
    if (showDeleteDescription.value === true) {
        showDeleteDescription.value = false
    }
}

</script>



