<template>
    <div class="space-x-2">
        <Transition>
            <button v-show="selectedTag.id"
                class="text-blue-500 px-1 py-1 rounded-md border-blue-500 hover:bg-blue-500 hover:text-white">
                <i class="fa-solid fa-pen"></i>
            </button>
        </Transition>
        <Transition>
            <button v-show="selectedTag.id"
                class="text-red-500 px-1 py-1 rounded-md border-red-500 hover:bg-red-500 hover:text-white">
                <i class="fa-solid fa-trash"></i>
            </button>
        </Transition>
        <Transition>
            <button class="text-green-500 px-1 py-1 rounded-md hover:bg-green-500 hover:text-white" v-show="showAddTag">
                <i class="fa-solid fa-plus"></i>
            </button>
        </Transition>
    </div>
</template>

<script setup>

const props = defineProps({
    selectedTag: {
        type: Object,
        default: {}
    },
    showAddTag: Boolean,
});

</script>

<style scoped></style>
