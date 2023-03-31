<template>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <h4 class="heading-4">Tags (optional)</h4>
            <BaseButton color="primary" type="button" class="inline-flex items-center"
                data-drawer-target="choose-tag-drawer" data-drawer-show="choose-tag-drawer"
                aria-controls="choose-tag-drawer">
                Tag Auswählen
            </BaseButton>
        </div>

        <ul class="flex flex-wrap items-center gap-2">
            <TransitionGroup>
                <li v-for="tag in checkedTags" :key="'tag-key-' + tag.id" :style="getTagStyle(tag.id, tag.color)"
                    class="tag">
                    {{ tag.name }}
                </li>
            </TransitionGroup>

        </ul>

        <SelectTagDrawer id="choose-tag-drawer" :checked-categories="checkedCategories" :checked-tags="checkedTags"
            @toggle-check-tag="toggleCheckTag" />
    </div>
</template>

<script setup>
import BaseButton from '@/Components/BaseButton.vue';
import SelectTagDrawer from '@/Components/SelectTagDrawer.vue';

const props = defineProps({
    checkedCategories: {
        default: [],
        type: Object,
    },
    checkedTags: {
        default: [],
        type: Object,
    }
});

const emit = defineEmits(['toggleCheckTag']);

function toggleCheckTag(tag) {
    emit('toggleCheckTag', tag)
}

function getTagStyle(tagId, color) {
    return props.checkedTags.find((tag) => tag.id === tagId)
        ? { backgroundColor: color }
        : {}
}


</script>

<style lang="scss" scoped></style>
