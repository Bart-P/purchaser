<template>
    <component :is="this.$attrs.href ? Link : 'button'"
               :class="this.$attrs.disabled ? buttonStyles.disabled : getClass()"
               class="cursor-pointer px-6 py-2 rounded">
        <slot />
    </component>
</template>

<script setup>

import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps(
    {
        color: {
            type   : String,
            default: 'primary'
        },
    })

const buttonStyles = {
    primary  : {
        'bg-purchaser-primary hover:bg-purchaser-primary-dark text-white': true
    },
    secondary: {
        'bg-purchaser-secondary hover:bg-purchaser-primary-dark text-white': true
    },
    light    : {
        'bg-gray-100 hover:bg-purchaser-primary-light text-purchaser-primary-dark': true
    },
    disabled : {
        'cursor-not-allowed bg-gray-100 text-gray-500 px-6 py-2 rounded': true
    },
    danger   : {
        'bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded': true
    },
}

function getClass() {
    switch (props.color) {
        case 'primary':
            return buttonStyles.primary
        case 'secondary':
            return buttonStyles.secondary
        case 'light':
            return buttonStyles.light
        case 'danger':
            return buttonStyles.danger
        default:
            return buttonStyles.primary
    }
}
</script>