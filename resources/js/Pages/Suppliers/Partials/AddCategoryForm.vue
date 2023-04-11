<template>
    <EditCategoriesModal :categories="categories" :tags="tags" id="editCategoryModal" />
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <h4 class="heading-4">Kategorien (erforderlich)</h4>
                <button type="button" class="text-blue-700 text-sm" data-modal-toggle="editCategoryModal">
                    <i class="fa-solid fa-pen"></i>
                </button>
            </div>
            <SelectItemDropdown @toggle-check-item="toggleCheckCategory" :checked-items="checkedCategories"
                :items="categories" item-type="category">
                Kategorie Auswahl
            </SelectItemDropdown>
        </div>

        <ul class="flex flex-wrap items-center gap-4 uppercase">
            <TransitionGroup>
                <li class="category" v-for="cat in checkedCategories" :style="{ borderColor: cat.color, color: cat.color }"
                    :key="'cat-key-' + cat.id">
                    {{ cat.name }}
                </li>
            </TransitionGroup>

            <li class="py-2 px-3 border-[1px] border-white rounded-md text-red-700 float-left"
                v-show="!checkedCategories.length">*Bitte eine Kategorie auswählen
            </li>
        </ul>

    </div>
</template>

<script setup>

import SelectItemDropdown from '@/Components/SelectItemDropdown.vue'
import EditCategoriesModal from '@/Pages/Suppliers/Partials/EditCategoriesModal.vue'
import { TransitionGroup } from 'vue'

const props = defineProps({
    categories: {
        default: null,
        type: Object,
    },
    checkedCategories: {
        default: null,
        type: Object,
    },
    tags: Object,
})

const emit = defineEmits(['toggleCheckCategory']);

function toggleCheckCategory(item) {
    emit('toggleCheckCategory', item.item)
}

</script>

<style scoped></style>
