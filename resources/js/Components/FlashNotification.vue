<template>
    <Teleport to="body">
        <Transition>
            <div v-show="store.flash.message"
                 id="toast-success"
                 class="fixed top-[5rem] left-[50%] right-[50%] translate-x-[-50%] flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg transition-opacity"
                 role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-2xl bg-green-100">
                    <i class="fa-solid fa-check text-green-500"></i>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ml-3 text-sm font-normal">
                    {{ store.flash.message }}
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
import {store} from "@/store";
import {watch} from "vue";
import {usePage} from "@inertiajs/inertia-vue3";

if (usePage().props.value.notification.message) {
    store.flash.message = usePage().props.value.notification.message
    setTimeout(() => {
        store.flash.message = ''
    }, 5000)
}

watch(() => store.flash.message,
      () => {
          setTimeout(() => {
              store.flash.message = ''
              store.flash.type = 'success'
          }, 5000)
      }
)
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