<template>
    <div :id="id"
         tabindex="-1"
         aria-hidden="true"
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-2xl md:h-auto relative bg-white rounded-lg shadow dark:bg-gray-700">
            <slot />
        </div>
    </div>
</template>

<script setup>

defineProps(
    {
        id: Number,
    }
)
</script>