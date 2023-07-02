<template>
    <component :is="this.$attrs.href ? Link : 'button'" :class="(this.$attrs.disabled ? buttonStyles.disabled :
        getClass()), colorClasses" class="flex justify-center items-center">
        <slot />
    </component>
</template>

<script setup>

import { Link } from "@inertiajs/vue3";

const props = defineProps(
    {
        color: {
            type: String,
            default: 'primary'
        },
        btnType: {
            type: String,
            default: 'button'
        },
    })

let colorClasses = {}

if (props.btnType === 'rounded') {
    colorClasses = { 'w-[33px] h-[33px] rounded-full text-sm': true }
} else if (props.btnType === 'button') {
    colorClasses = { 'px-6 py-2 rounded-md': true }
}

const buttonStyles = {
    primary: {
        'cursor-pointer bg-purchaser-primary hover:bg-purchaser-primary-dark text-white': true
    },
    secondary: {
        'cursor-pointer bg-purchaser-secondary hover:bg-purchaser-primary-dark text-white': true
    },
    success: {
        'cursor-pointer bg-green-600 hover:bg-green-800 text-white': true
    },
    light: {
        'cursor-pointer bg-gray-100 hover:bg-purchaser-primary-light text-purchaser-primary-dark': true
    },
    back: {
        'cursor-pointer bg-gray-500 hover:bg-gray-600 text-white': true
    },
    edit: {
        'cursor-pointer bg-blue-600 hover:bg-blue-800 text-white': true
    },
    disabled: {
        'cursor-not-allowed bg-gray-100 text-gray-500': true
    },
    danger: {
        'cursor-pointer bg-red-600 hover:bg-red-700 text-white rounded': true
    },
}

function getClass() {
    switch (props.color) {
        case 'primary':
            return buttonStyles.primary
        case 'secondary':
            return buttonStyles.secondary
        case 'success':
            return buttonStyles.success
        case 'light':
            return buttonStyles.light
        case 'back':
            return buttonStyles.back
        case 'edit':
            return buttonStyles.edit
        case 'danger':
            return buttonStyles.danger
        default:
            return buttonStyles.primary
    }
}
</script>