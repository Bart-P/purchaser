<template>
    <textarea class="w-full px-0 text-gray-900 bg-white border-0 focus:ring-0" :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)" ref="input" />
</template>

<script setup>
import { onMounted, ref } from 'vue';

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineProps(['modelValue']);
defineEmits(['update:modelValue']);

const input = ref(null);

defineExpose({ focus: () => input.value.focus() });
</script>

