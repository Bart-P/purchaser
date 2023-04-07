<template>
    <BaseModal :id="id">
        <div class="flex w-full p-4 gap-4">
            <div class="basis-1/3 space-y-2">
                <div class="flex items-center justify-between gap-2">
                    <h4 class="heading-4">Kategorien</h4>

                    <CategoryControlls @reset-selectable-values="resetSelectableValues"
                        :selected-category="selectedCategory"></CategoryControlls>
                </div>
                <ul class="space-y-2">
                    <button v-for="category in categories" class="w-full text-start" @click="toggleEditCategory(category)">
                        <li class="category border-gray-400 text-gray-400"
                            :style="category.id === selectedCategory.id ? { color: category.color, borderColor: category.color } : {}">
                            {{ category.name }}
                        </li>
                    </button>
                </ul>
            </div>
            <div class="basis-2/3 space-y-2">
                <div class="flex items-center justify-between gap-2">
                    <h4 class="heading-4">Tags</h4>
                    <div class="space-x-2">
                        <Transition>
                            <button v-show="selectedTag.id"
                                class="text-blue-500 px-1 py-1 rounded-md border-blue-500 hover:bg-blue-500 hover:text-white">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </Transition>
                        <Transition>
                            <button v-show="selectedTag.id"
                                class="text-red-500 px-1 py-1 rounded-md border-red-500 hover:bg-red-500 hover:text-white">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </Transition>
                        <Transition>
                            <button class="text-green-500 px-1 py-1 rounded-md hover:bg-green-500 hover:text-white"
                                v-show="selectedCategory.id">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </Transition>
                    </div>
                </div>

                <ul class="flex flex-wrap gap-2">
                    <TransitionGroup>
                        <li class="tag bg-gray-500 cursor-pointer" v-for="tag in categoryTags" :key="tag.name + tag.id"
                            @click="toggleEditTag(tag)"
                            :style="tag.id === selectedTag.id ? { backgroundColor: tag.color } : {}">
                            {{ tag.name }}
                        </li>
                    </TransitionGroup>

                    <Transition>
                        <li v-show="!categoryTags.length && !selectedCategory.name" class="text-gray-600">
                            Bitte eine Kategorie auswählen und Tags anzuzeigen!
                        </li>
                    </Transition>
                    <Transition>
                        <li v-show="!categoryTags.length && selectedCategory.name" class="text-gray-600">
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
import { Transition, TransitionGroup, ref, onMounted } from 'vue'
import CategoryControlls from '@/Pages/Suppliers/Partials/CategoryControlls.vue'
import { initDropdowns } from 'flowbite'

onMounted(() => {
    initDropdowns()
})

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
});

let categoryTags = ref([])
let selectedCategory = ref({})
let selectedTag = ref({})

function resetSelectableValues() {
    selectedCategory.value = {}
    categoryTags.value = []
    selectedTag.value = {}
}

function toggleEditCategory(category) {
    if (selectedCategory.value.id === category.id) {
        resetSelectableValues()
        return
    }

    selectedTag.value = {}
    selectedCategory.value = { ...category }
    categoryTags.value = props.tags.filter(tag => {
        return category.id === tag.category_id
    })
}

function toggleEditTag(tag) {
    if (selectedTag.value.id === tag.id) {
        selectedTag.value = []
        return
    }

    selectedTag.value = { ...tag }
}

</script>

<style scoped></style>
