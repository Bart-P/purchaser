<template>
    <Teleport to="body">
        <div v-if="showMessage"
             id="toast-success"
             class="fixed top-[5rem] left-[50%] right-[50%] translate-x-[-50%] flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg"
             role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-2xl">
                <i class="fa-solid fa-check"></i>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 text-sm font-normal">{{ showMessage }}</div>
        </div>
    </Teleport>
</template>

<script setup>

import {usePage} from "@inertiajs/inertia-vue3";
import {ref} from "vue";

let showMessage = ref(usePage().props.value.notification?.message)

// TODO  Hide does not work...
if (showMessage) {
    setTimeout(() => showMessage = ref(null), 5000)
    console.log('hidden')
}

</script>