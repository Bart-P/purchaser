<template>
    <TransitionGroup tag="div" enter-from-class="translate-x-full opacity-0" enter-active-class="duration-500"
        leave-active-class="duration-500" leave-to-class="translate-x-full opacity-0"
        class="fixed top-4 right-4 z-50 space-y-3 w-full max-w-xs ">
        <ToastListItem v-for="(item, index) in ToastStore.items" @remove-toast="removeToast(index)" :key="item.key"
            :type="item.type" :message="item.message" />
    </TransitionGroup>
</template>

<script setup>

import ToastListItem from '@/Components/ToastListItem.vue';
import ToastStore from '@/Stores/ToastStore';
import { router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { onUnmounted } from 'vue';

const page = usePage();

let removeFinishEventListener = () => {
    router.on('finish', () => {
        if (page.props.notification.message) {
            // TODO bug fix - this is called twice.. Why? 
            // also on Supplier delete no notification comes up... 
            console.log(page.props.notification)
            ToastStore.add(
                {
                    ...page.props.notification,
                })
        }
    })

}
onUnmounted(() => {
    removeFinishEventListener()
})

function removeToast(key) {
    ToastStore.remove(key)
}

</script>


<style scoped></style>