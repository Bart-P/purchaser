<template>
    <Teleport to="body">
        <Transition>
            <div v-show="showNotification"
                 id="toast-success"
                 class="fixed top-[5rem] left-[50%] right-[50%] translate-x-[-50%] flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg transition-opacity"
                 role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-2xl">
                    <i class="fa-solid fa-check"></i>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ml-3 text-sm font-normal">
                    {{ props.message }}
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>

import {onMounted, ref} from "vue";

const emit = defineEmits(['close-flash-notification', 'test'])

let props = defineProps(
    {
        message: String
    })

let showNotification = ref(!!props.message)

onMounted(() => {
    setTimeout(() => showNotification.value = false, 5000)
})

</script>

<style>

.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}

</style>