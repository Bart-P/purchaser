<template>
    <div class="flex flex-col items-center py-8">
        <div class="flex gap-5 xs:mt-0">
            <!-- Buttons -->
            <ul class="flex gap-1 items-center">
                <li v-if="props.data.current_page > 3">
                    <Link :href="props.data.first_page_url"
                        class="cursor-default px-4 py-2 rounded text-white bg-purchaser-primary cursor-pointer hover:bg-purchaser-primary-dark">
                    <i class="fa-solid fa-angles-left"></i>
                    </Link>
                </li>
                <li>
                    <Link v-if="props.data.prev_page_url" :href="props.data.prev_page_url"
                        class="cursor-default px-4 py-2 rounded text-white bg-purchaser-primary cursor-pointer hover:bg-purchaser-primary-dark">
                    <i class="fa-solid fa-angle-left"></i>
                    </Link>
                </li>
                <li v-for="link in linksToShow(props.data.links)">
                    <Link :href="link.url"
                        class="cursor-pointer px-4 py-2 rounded hover:bg-purchaser-primary-dark hover:text-white"
                        :class="{ 'bg-purchaser-primary text-white ': link.active }">
                    {{ link.label }}
                    </Link>
                </li>
                <li>
                    <Link v-if="props.data.next_page_url" :href="props.data.next_page_url"
                        class="cursor-default px-4 py-2 rounded text-white bg-purchaser-primary cursor-pointer hover:bg-purchaser-primary-dark transition ease-in-out">
                    <i class="fa-solid fa-angle-right"></i>
                    </Link>
                </li>
                <li v-if="props.data.current_page + 2 < props.data.last_page">
                    <Link :href="props.data.last_page_url"
                        class="cursor-default px-4 py-2 rounded text-white bg-purchaser-primary cursor-pointer hover:bg-purchaser-primary-dark ">
                    <i class="fa-solid fa-angles-right"></i>
                    </Link>
                </li>
            </ul>
        </div>

        <!-- Help text -->
        <span class="text-sm text-gray-700 dark:text-gray-400 mt-8">
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ props.data.from }}
            </span>
            bis
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ props.data.to }}
            </span>
            von
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ props.data.total }}
            </span>
            Einträgen
        </span>
    </div>
</template>

<script setup>

import { Link } from "@inertiajs/vue3";

const props = defineProps({
    'data': Object,
})

const linksToShow = links => {
    let firstElement = props.data.current_page - 2;
    if (firstElement <= 0) firstElement = 1

    let lastElement = props.data.current_page + 3;
    if (lastElement >= links.length) lastElement = -1

    return links.slice(firstElement, lastElement)
}

</script>