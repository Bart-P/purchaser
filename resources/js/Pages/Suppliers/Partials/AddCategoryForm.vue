<template>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <h4 class="heading-4">Kategorien (erforderlich)</h4>
                <button class="text-blue-700">
                    <i class="fa-solid fa-pen"></i>
                </button>
            </div>
            <BaseButton id="dropdownSearchButton" data-dropdown-toggle="dropdownCategorySearch"
                data-dropdown-placement="bottom" class="inline-flex items-center" type="button">Kategorie Auswählen
                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </BaseButton>
        </div>

        <ul class="flex flex-wrap items-center gap-4 uppercase">
            <TransitionGroup>
                <li class="py-2 px-3 border-[1px] font-bold border-purchaser-primary rounded-md shadow-md text-purchaser-primary"
                    v-for="cat in checkedCategories" :style="{ borderColor: cat.color, color: cat.color }"
                    :key="'cat-key-' + cat.id">
                    {{ cat.name }}
                </li>

            </TransitionGroup>

            <li class="py-2 px-3 border-[1px] border-white rounded-md text-red-700 float-left"
                v-show="!checkedCategories.length">*Bitte eine Kategorie auswählen
            </li>
        </ul>
        <SelectCategoryDropdown id="dropdownCategorySearch" @toggle-check-category="toggleCheckCategory"
            :checked-categories="checkedCategories" :categories="categories" />
    </div>
</template>

<script setup>

import BaseButton from '@/Components/BaseButton.vue';
import SelectCategoryDropdown from '@/Components/SelectCategoryDropdown.vue';

const props = defineProps({
    categories: Object,
    checkedCategories: Object,
});

const emit = defineEmits(['toggleCheckCategory']);

function toggleCheckCategory(category) {
    emit('toggleCheckCategory', category)
}

</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.2s ease-in-out;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
