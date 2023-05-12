<template>
    <div class="">
        <input :id="pickerId" type="text"
            class="border border-gray-300 rounded-md focus:ring-purchaser-primary focus:border-purchaser-primary"
            placeholder="Datum auswählen">
    </div>
</template>

<script setup>

import Datepicker from 'flowbite-datepicker/Datepicker'
import { onMounted } from 'vue';

const props = defineProps({
    selectedDate: {
        default: null,
        type: String
    },
    pickerId: String,
});

const emits = defineEmits(['setPickerDate']);

let datepickerEl = null
let picker = null

onMounted(() => {
    datepickerEl = document.getElementById(props.pickerId)
    picker = new Datepicker(datepickerEl, {
        format: 'dd.mm.yyyy',
        autohide: true
    })

    if (props.selectedDate) {
        picker.setDate(props.selectedDate)
    }
})

</script>