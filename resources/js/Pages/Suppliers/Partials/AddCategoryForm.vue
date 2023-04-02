<template>
    <BaseModal id="editCategoryModal">
        <div class="flex w-full p-4 gap-4">
            <div class="basis-1/3 space-y-2">
                <div class="flex items-center justify-between gap-2">
                    <h4 class="heading-4">Kategorien</h4>
                    <div class="space-x-2">
                        <button data-dropdown-toggle="dropdownAddCategory" type="button"
                            class="text-green-500 px-1 py-1 rounded-md hover:bg-green-500 hover:text-white">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <Transition>
                            <button v-show="selectedCategory.id"
                                class="text-blue-500 px-1 py-1 rounded-md border-blue-500 hover:bg-blue-500 hover:text-white">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </Transition>
                        <Transition>
                            <button v-show="selectedCategory.id"
                                class="text-red-500 px-1 py-1 rounded-md border-red-500 hover:bg-red-500 hover:text-white">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </Transition>
                    </div>
                </div>
                <ul class="space-y-2">
                    <div id="dropdownAddCategory" class="hidden z-10 flex flex-col gap-4 rounded-md bg-white shadow-md p-4">
                        <h5 class="heading-5">Kategorie hinzufügen</h5>
                        <TextInput type="text" placeholder="Name"></TextInput>
                        <TextInput type="text" placeholder="Farbe"></TextInput>
                        <button
                            class="text-white px-2 py-1 w-full hover:text-green-500 hover:bg-white border-2 border-green-500 bg-green-500 rounded-md">
                            <i class="fa-solid fa-save"></i>
                        </button>
                    </div>
                    <button v-for="category in categories" class="w-full text-start" @click="toggleEditCategory(category)">
                        <li class="category border-gray-500 text-gray-500"
                            :style="category.id === selectedCategory.id ? { color: category.color, borderColor: category.color, borderWidth: '2px' } : {}">
                            {{ category.name }}
                        </li>
                    </button>
                </ul>
            </div>
            <div class="basis-2/3 space-y-2">
                <div class="flex items-center justify-between gap-2">
                    <h4 class="heading-4">Tags</h4>
                    <div class="space-x-2">
                        <button class="text-green-500 px-1 py-1 rounded-md hover:bg-green-500 hover:text-white">
                            <i class="fa-solid fa-plus"></i>
                        </button>
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
                </ul>
            </div>
        </div>

    </BaseModal>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <h4 class="heading-4">Kategorien (erforderlich)</h4>
                <button type="button" class="text-blue-700 text-sm" data-modal-toggle="editCategoryModal">
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
                <li class="category" v-for="cat in checkedCategories" :style="{ borderColor: cat.color, color: cat.color }"
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
import BaseModal from '@/Components/BaseModal.vue';
import SelectCategoryDropdown from '@/Components/SelectCategoryDropdown.vue';
import { Transition, TransitionGroup, onMounted, ref } from 'vue';
import { initDropdowns } from 'flowbite';
import TextInput from '@/Components/TextInput.vue';

onMounted(() => {
    initDropdowns()
})
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

let categoryTags = ref([])
let selectedCategory = ref({})
let selectedTag = ref({})

const emit = defineEmits(['toggleCheckCategory']);

function toggleCheckCategory(category) {
    emit('toggleCheckCategory', category)
}

function toggleEditCategory(category) {
    if (selectedCategory.value.id === category.id) {
        selectedCategory.value = {}
        categoryTags.value = []
        selectedTag.value = {}
        return
    }

    selectedTag.value = {}
    selectedCategory.value = category
    categoryTags.value = props.tags.filter(tag => {
        return category.id === tag.category_id
    })
}

function toggleEditTag(tag) {
    if (selectedTag.value.id === tag.id) {
        selectedTag.value = []
        return
    }

    selectedTag.value = tag
}

</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity .2s ease-in-out;
}

.v-enter-active {
    transition-delay: .2s;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
