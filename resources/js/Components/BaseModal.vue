<template>
    <Teleport to="body">
        <div :id="id" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-hidden md:inset-0 h-modal md:h-full">
            <div class="relative w-full md:h-auto max-h-screen bg-white rounded-lg shadow md:overflow-y-scroll"
                :class="'max-w-' + width">
                <slot />
            </div>
        </div>
    </Teleport>
</template>

<script setup>

const props = defineProps({
    id: String,
    width: {
        type: String,
        default: 'xl'
    }
})
</script>