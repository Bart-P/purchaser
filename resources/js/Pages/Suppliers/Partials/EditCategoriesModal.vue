<template>
    <BaseModal :id="id" width="6xl">
        <div class="flex w-full p-4 gap-4">
            <div class="basis-1/3 space-y-2">
                <div class="flex items-center justify-between gap-2">
                    <h4 class="heading-4">Kategorien</h4>

                    <CategoryControls @reset-selectable-values="resetSelectableValues"
                        :selected-category="selectedCategory" />
                </div>
                <ul class="space-y-2">
                    <button v-for="category in categories" class="w-full text-start" @click="toggleEditCategory(category)">
                        <li class="category border-gray-400 text-gray-400"
                            :style="category.id === selectedCategory?.id ? { color: category.color, borderColor: category.color } : {}">
                            {{ category.name }}
                        </li>
                    </button>
                </ul>
            </div>
            <div class="basis-2/3 space-y-2">
                <div class="flex items-center justify-between gap-2">
                    <h4 class="heading-4">Tags</h4>
                    <TagControls :category-id="selectedCategory?.id" :selected-tag="selectedTag" />
                </div>

                <ul class="flex flex-wrap gap-2">
                    <TransitionGroup>
                        <li class="tag bg-gray-500 cursor-pointer" v-for="tag in selectedCategory.tags"
                            :key="tag.name + tag.id" @click="toggleEditTag(tag)"
                            :style="tag.id === selectedTag.id ? { backgroundColor: tag.color } : {}">
                            {{ tag.name }}
                        </li>
                    </TransitionGroup>

                    <Transition>
                        <li v-show="!selectedCategory?.tags && !selectedCategory?.name" class="text-gray-600">
                            Bitte eine Kategorie auswählen und Tags anzuzeigen!
                        </li>
                    </Transition>
                    <Transition>
                        <li v-if="selectedCategory?.tags"
                            v-show="!Object.keys(selectedCategory?.tags).length && selectedCategory?.name"
                            class="text-gray-600">
                            Diese Kategorie hat noch keine Tags!
                        </li>
                    </Transition>
                </ul>
            </div>
        </div>
    </BaseModal>
</template>

<script setup>
import BaseModal from '@/Components/BaseModal.vue'
import { Transition, TransitionGroup, ref, watch } from 'vue'
import CategoryControls from '@/Pages/Suppliers/Partials/CategoryControls.vue'
import TagControls from '@/Pages/Suppliers/Partials/TagControls.vue'

const props = defineProps({
    id: String,
    categories: {
        default: null,
        type: Object,
    },
    tags: {
        default: null,
        type: Object,
    }
})

const selectedCategory = ref({})
const selectedTag = ref({})

watch(
    () => props.tags,
    () => {
        const reloadedCategory = props.categories.find(cat => cat.id === selectedCategory.value.id)
        selectedCategory.value = {}

        // reloadedCategory returns 0 if not found, this prevents console type error
        if (reloadedCategory) {
            selectedCategory.value = reloadedCategory
        }
    }
)

function resetSelectableValues() {
    selectedCategory.value = {}
    selectedTag.value = {}
}

function toggleEditCategory(category) {
    if (selectedCategory.value.id === category.id) {
        resetSelectableValues()
        return
    }

    selectedTag.value = {}
    selectedCategory.value = category
}

function toggleEditTag(tag) {
    if (selectedTag.value.id === tag.id) {
        selectedTag.value = {}
        return
    }

    selectedTag.value = tag
}
</script>