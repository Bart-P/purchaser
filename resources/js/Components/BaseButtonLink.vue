<template>
    <!-- TODO get colors working as reusable component -->
    <Link v-if="!isDisabled" :href="href"
          :class="primaryColor"
          class="cursor-pointer px-6 py-2 rounded">
        <slot />
    </Link>
    <span v-else class="bg-gray-200 text-gray-600 px-6 py-2 rounded">
        <slot />
    </span>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps({
    href: String,
    color: {
        type: String,
        default: 'primary'
    },
    isDisabled: {
        type: Boolean,
        default: false,
    },
})

const primaryColor = 'bg-purchaser-primary hover:bg-purchaser-primary-dark text-white'
const secondaryColor = 'bg-purchaser-secondary hover:bg-purchaser-primary-dark text-white'

function getClass() {
    
    switch (props.color) {
        case 'primary':
            return primaryColor
        case 'secondary':
            return secondaryColor
        default:
            return primaryColor
    }
}

</script>