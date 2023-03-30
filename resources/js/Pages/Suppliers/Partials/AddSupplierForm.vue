<template>
    <form @submit.prevent="submitSupplier" class="flex flex-col gap-5">
        <div class="flex justify-between">
            <h3 class="heading-3">
                Firma (erforderlich)
            </h3>
            <div class="flex gap-4 justify-end">
                <BaseButton type="submit" color="primary">
                    Speichern
                </BaseButton>
                <BaseButton :href="route('suppliers')" color="light">
                    Zurück
                </BaseButton>
            </div>
        </div>

        <!-- drawer component -->
        <div id="choose-tag-drawer"
            class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
            tabindex="-1" aria-labelledby="choose-tag-drawer-label">
            <h5 id="choose-tag-drawer-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Tag
                Auswahl</h5>
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
                                    @click="toggleCheckTag(tag)"
                                    :class="[checkedTags.some(checkedTag => checkedTag.id !== tag.id) || !checkedTags.length ? 'bg-gray-500 text-purchaser-dark' : '']"
                                    class="tag">{{ tag.name }}
                                </li>

                            </ul>
                        </li>
                    </template>

                </ul>
            </div>
        </div>

        <div class="flex gap-5">
            <div class="w-1/2">
                <InputLabel for="company" value="Firma Name *" />
                <TextInput id="company" v-model="supplierForm.name" type="text" class="mt-1 block w-full" required
                    autofocus />
            </div>

            <div class="w-1/2">
                <InputLabel for="companyEmail" value="Firma E-Mail *" />
                <TextInput id="companyEmail" v-model="supplierForm.email" type="email" class="mt-1 block w-full" required />
            </div>
        </div>

        <hr class="my-5">

        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <h4 class="heading-4">Kategorien (erforderlich)</h4>
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

        <hr class="my-5">

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
        </div>
    </form>
</template>

<script setup>

import BaseButton from '@/Components/BaseButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectCategoryDropdown from '@/Components/SelectCategoryDropdown.vue';
import TextInput from '@/Components/TextInput.vue';
import Toast from '@/Stores/toast';
import { useForm } from '@inertiajs/inertia-vue3';
import { initDrawers, initDropdowns } from 'flowbite';
import { onMounted, ref } from 'vue';

onMounted(() => {
    initDropdowns();
    initDrawers();
})

const props = defineProps(
    {
        supplier: {
            default: null,
            type: Object,
        },
        categories: Object,
        supplierCategories: {
            type: Object,
            default: null,
        },
        tags: {
            type: Object,
            default: [],
        },
        supplierTags: {
            type: Object,
            default: [],
        },
        addresses: Array,
        persons: Array,
    })

const checkedCategories = ref([])
const checkedTags = ref([])

if (props.supplierCategories) {
    assignTagsToCategories()
}

if (props.supplierTags.length) {
    checkedTags.value = props.supplierTags
}

function assignTagsToCategories() {
    checkedCategories.value =
        props.supplierCategories.map((cat) => {
            return updateCategryWithTags(cat)
        })
}

function updateCategryWithTags(category) {
    category = {
        ...category,
        tags: getTagsForCategory(category.id),
    }
    return category
}

if (props.supplierTags) {
    checkedTags.value = props.supplierTags
}

const supplierForm = useForm(
    {
        name: props.supplier?.name,
        email: props.supplier?.email,
        addresses: null,
        persons: null,
        categories: checkedCategories,
        tags: checkedTags,
    },
)

function toggleCheckCategory(category) {
    if (checkedCategories.value.some((cat => cat['id'] === category.id))) {
        checkedCategories.value = checkedCategories.value.filter((cat) => cat['id'] !== category.id)
        checkedTags.value = checkedTags.value.filter((tag) => tag.category_id !== category.id)
    } else {
        checkedCategories.value = [...checkedCategories.value, updateCategryWithTags(category)]
    }
}

function getTagsForCategory(id) {
    return [...props.tags].filter((tag) => {
        return id === tag.category_id
    })
}

function toggleCheckTag(tag) {
    if (checkedTags.value.some(checkedTag => tag['id'] === checkedTag.id)) {
        checkedTags.value = checkedTags.value.filter((checkedTag) => tag['id'] !== checkedTag.id)
    } else {
        checkedTags.value = [...checkedTags.value, tag]
    }
}

function getTagStyle(tagId, color) {
    return checkedTags.value.find((tag) => tag.id === tagId)
        ? { backgroundColor: color }
        : {}
}

function getCheckedTagsForCategoryLength(categoryId) {
    return checkedTags.value.filter(tag => tag.category_id === categoryId).length
}

function submitSupplier() {
    if (!checkedCategories.value.length) {
        Toast.add(
            {
                'message': 'Bitte mindestens eine Kategorie auswählen',
                'type': 'warning',
            });
        return
    }

    if (props.addresses.length) {
        supplierForm['addresses'] = props.addresses
    }

    if (props.persons.length) {
        supplierForm['persons'] = props.persons
    }

    if (props.supplier) {
        supplierForm.put(
            route('suppliers.put',
                {
                    'id': props.supplier.id,
                    'name': supplierForm.name,
                    'email': supplierForm.email,
                    'categories': checkedCategories,
                    'tags': checkedTags,
                }))
    } else {
        supplierForm.post(route('suppliers.store'))
    }
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
