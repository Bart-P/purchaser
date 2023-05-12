<template>
    <input id="datepicker" type="text" :value="dateToDMY(selectedDate)"
        class="border border-gray-300 rounded-md focus:ring-purchaser-primary focus:border-blue-500"
        placeholder="Datum auswählen">
</template>

<script setup>

import Datepicker from 'flowbite-datepicker/Datepicker'
import { onMounted } from 'vue';
import { dateToDMY } from '@/utils';

const props = defineProps({
    selectedDate: {
        default: null,
        type: String
    }
});

let datepickerEl

onMounted(() => {
    datepickerEl = document.getElementById('datepicker')
    new Datepicker(datepickerEl, {
        format: 'dd.mm.yyyy',
        autohide: true
    })
})

</script>