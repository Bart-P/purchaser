<template>
    <!-- Toggle status Dropdown button -->
    <button :id="btnId" :data-dropdown-toggle="id" type="button" class="rounded-md">
        <div class="flex flex-nowrap items-center">
            <StatusBadge :status="currentStatus" />
            <i class="fa-solid fa-angle-down"></i>
        </div>
    </button>

    <!-- Dropdown menu -->
    <div :id="id" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow px-2 py-1">
        <ul class="py-2 text-sm text-gray-700 space-y-3" :aria-labelledby="btnId">
            <li v-for="status in statusKeys">
                <button @click="selectStatus(status)" type="button" class="w-full align-middle">
                    <StatusBadge :status="status" />
                </button>
            </li>
        </ul>
    </div>
</template>

<script setup>
import StatusBadge from '@/Components/StatusBadge.vue'
import { allStatus, } from '@/utils'
import { onMounted } from 'vue'
import { initDropdowns } from 'flowbite'
import { router } from '@inertiajs/core';

onMounted(() => {
    initDropdowns()
})

const emits = defineEmits(['selectStatus']);

const props = defineProps({
    id: {
        type: String,
        default: 'selectStatusDropdown'
    },
    currentStatus: String,
    autoUpdateInquiry: {
        type: Object,
        defaulte: null
    }
})

const btnId = props.id + '-btn'

const statusKeys = Object.keys(allStatus.de)

function selectStatus(status) {
    if (props.autoUpdateInquiry) {
        let newInquiry = { ...props.autoUpdateInquiry }
        newInquiry.status = status
        router.patch(route('inquiries.patch', newInquiry))
    }

    emits('selectStatus', status)
    document.getElementById(btnId).click()
}
</script>

