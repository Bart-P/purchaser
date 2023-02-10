<template>
    <BaseModal :id="id">
        <div class="p-6 text-center">
            <i class="fa-solid fa-triangle-exclamation mx-auto mb-4 text-red-600 text-5xl dark:text-gray-200"></i>
            <h3 class="mb-5 text-2xl font-normal text-gray-600">Bist du sicher?</h3>
            <p class="mb-5 text-lg text-gray-600">
                <slot name="text"></slot>
            </p>
            <div class="flex gap-5 w-full items-center justify-center">
                <slot name="buttons"></slot>
            </div>
        </div>
    </BaseModal>
</template>

<script setup>

import BaseModal from "@/Components/BaseModal.vue";

defineProps(
    {
        id: String
    })
</script>