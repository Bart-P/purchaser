<template>
    <Teleport to="body">
        <div :id="id" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full md:h-auto bg-white rounded-lg shadow" :class="'max-w-' + width">
                <slot />
            </div>
        </div>
    </Teleport>
</template>

<script setup>

defineProps({
    id: String,
    width: {
        type: String,
        default: '2xl'
    }
})

</script>
