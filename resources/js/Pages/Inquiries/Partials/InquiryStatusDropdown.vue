<template>
    <!-- Toggle status Dropdown button -->
    <button id="selectStatusDropdownBtn" data-dropdown-toggle="selectStatusDropdown" type="button" class="rounded-md">
        <StatusBadge :status="currentStatus" />
        <i class="fa-solid fa-angle-down"></i>
    </button>

    <!-- Dropdown menu -->
    <div id="selectStatusDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow px-2 py-1">
        <ul class="py-2 text-sm text-gray-700 space-y-3" aria-labelledby="selectStatusDropdownBtn">
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

onMounted(() => {
    initDropdowns()
})

const emits = defineEmits(['selectStatus']);

const props = defineProps({
    currentStatus: String,
})

const statusKeys = Object.keys(allStatus.de)

function selectStatus(status) {
    emits('selectStatus', status)
    document.getElementById('selectStatusDropdownBtn').click()
}
</script>


