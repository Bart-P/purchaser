<template>
    <component :is="this.$attrs.href ? Link : 'button'" :class="this.$attrs.disabled ? buttonStyles.disabled : getClass()">
        <slot />
    </component>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps(
    {
        color: {
            type: String,
            default: 'blue'
        },
    })

const buttonStyles = {
    blue: {
        'cursor-pointer text-blue-600 hover:text-blue-800': true
    },
    red: {
        'cursor-pointer text-red-600 hover:text-red-800': true
    },
    green: {
        'cursor-pointer text-green-600 hover:text-green-800': true
    },
    gray: {
        'cursor-pointer text-gray-600 hover:text-gray-800': true
    },
    disabled: {
        'cursor-not-allowed text-gray-400': true
    },
}

function getClass() {
    switch (props.color) {
        case 'blue':
            return buttonStyles.blue
        case 'red':
            return buttonStyles.red
        case 'green':
            return buttonStyles.green
        case 'gray':
            return buttonStyles.gray
        default:
            return buttonStyles.blue
    }
}
</script>