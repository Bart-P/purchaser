<template>
    <input type="date" @input="$emit('update:modelValue', $event.target.value)" placeholder="Datum auswählen"
        :value="modelValue"
        class="border border-gray-300 rounded-md focus:ring-purchaser-primary focus:border-purchaser-primary">
</template>

<script setup>

const props = defineProps({
    modelValue: {
        type: String,
    },
});

const emits = defineEmits(['update:modelValue']);
</script>