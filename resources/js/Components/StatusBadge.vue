<template>
    <span :class="colorClasses[status]" class="border border-1 mr-2 px-2.5 py-0.5 rounded-full">
        {{ getStatusForLang(status, lang) }}
    </span>
</template>

<script setup>
import { getStatusForLang } from '@/utils'

const props = defineProps({
    status: String,
    lang: {
        type: String,
        default: 'de'
    }
});

const colorClasses = {
    'created': 'bg-fuchsia-100 text-fuchsia-800 border-fuchsia-800',
    'send': 'bg-blue-100 text-blue-800 border-blue-800',
    'waiting': 'bg-yellow-100 text-yellow-800 border-yellow-800',
    'done': 'bg-green-100 text-green-800 border-green-800',
    'closed': 'bg-gray-100 text-gray-800 border-gray-800',
}
</script>


