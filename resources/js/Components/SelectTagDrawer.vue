<template>
    <div id="choose-tag-drawer"
        class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
        tabindex="-1" aria-labelledby="choose-tag-drawer-label">
        <h5 id="choose-tag-drawer-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
            Tag Auswahl
        </h5>
        <button type="button" data-drawer-hide="choose-tag-drawer" aria-controls="choose-tag-drawer"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="py-4 overflow-y-auto">
            <ul class="space-y-2">
                <template v-for="category in checkedCategories">
                    <li v-if="category.tags.length" class="border-t-2 border-purchaser-primary cursor-pointer">
                        <h4 class="heading-4">
                            {{ category.name }}
                            <span class="float-right text-purchaser-dark text-base font-bold"
                                v-show="getCheckedTagsForCategoryLength(category.id)">
                                {{ getCheckedTagsForCategoryLength(category.id) }}
                            </span>
                        </h4>
                        <ul class="space-y-2 py-2 mt-2">
                            <li v-for="tag in category.tags" :style="getTagStyle(tag.id, category.color)"
                                @click="$emit('toggleCheckTag', tag)"
                                :class="[checkedTags.some(checkedTag => checkedTag.id !== tag.id) || !checkedTags.length ? 'bg-gray-500 text-purchaser-dark' : '']"
                                class="tag">{{ tag.name }}
                            </li>

                        </ul>
                    </li>
                </template>

            </ul>
        </div>
    </div>
</template>

<script setup>

const props = defineProps(
    {
        categories: Object,
        checkedCategories: Object,
        tags: Object,
        checkedTags: {
            default: [],
            type: Object,
        }
    });

const emits = defineEmits(['toggleCheckTag']);

function getCheckedTagsForCategoryLength(categoryId) {
    return props.checkedTags.filter(tag => tag.category_id === categoryId).length
}

function getTagStyle(tagId, color) {
    return props.checkedTags.find((tag) => tag.id === tagId)
        ? { backgroundColor: color }
        : {}
}


</script>

<style lang="scss" scoped></style>
