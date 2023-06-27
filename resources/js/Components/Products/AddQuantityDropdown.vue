<template>
    <div class="relative">
        <BaseButton @click="toggleShowQuantityDropdown" btn-type="rounded" color="success" type="button"
            data-show-trigger="dropdownAddQuantity">
            <i class="fa-solid fa-plus"></i>
        </BaseButton>

        <div class="absolute top-[40px] left-0">
            <form id="dropdownAddQuantity" @submit.prevent="" v-show="showAddQuantity"
                v-click-outside="hideAddQuantityDropdown"
                class="!m-0 flex flex-col z-10 gap-4 rounded-md bg-white shadow-md p-4">
                <h5 class="heading-5 whitespace-nowrap">Auflage hinzufügen:</h5>
                <TextInput type="number" placeholder="Auflage" required />
                <BaseButton type="submit" color="success">
                    <i class="fa-solid fa-save"></i>
                </BaseButton>
            </form>
        </div>
    </div>
</template>

<script setup>

import BaseButton from "@/Components/BaseButton.vue";
import TextInput from "@/Components/TextInput.vue";

import { ref } from 'vue';

const showAddQuantity = ref(false)

function hideAddQuantityDropdown() {
    if (showAddQuantity.value === true) {
        showAddQuantity.value = false
    }
}

function toggleShowQuantityDropdown() {
    showAddQuantity.value = !showAddQuantity.value
}
</script>