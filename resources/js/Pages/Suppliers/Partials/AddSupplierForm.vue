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
                <BaseButton type="button" :href="route('suppliers')" color="light">
                    Zurück
                </BaseButton>
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

        <AddCategoryForm @toggle-check-category="toggleCheckCategory" :tags="tags" :categories="categories"
            :checked-categories="checkedCategories" />

        <hr class="my-5">

        <AddTagForm @toggle-check-tag="toggleCheckTag" :checked-categories="checkedCategories"
            :checked-tags="checkedTags" />
    </form>
</template>

<script setup>

import BaseButton from '@/Components/BaseButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import AddCategoryForm from '@/Pages/Suppliers/Partials/AddCategoryForm.vue';
import AddTagForm from '@/Pages/Suppliers/Partials/AddTagForm.vue';
import TextInput from '@/Components/TextInput.vue';
import ToastStore from '@/Stores/ToastStore';
import { useForm } from '@inertiajs/inertia-vue3';
import { initDrawers, initDropdowns } from 'flowbite';
import { onMounted, ref, watch } from 'vue';

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
        categories: {
            type: Object,
            default: null,
        },
        supplierCategories: {
            type: Object,
            default: null,
        },
        tags: {
            type: Object,
            default: [],
        },
        supplierTags: {
            type: Array,
            default: [],
        },
        addresses: Array,
        persons: Array,
    })

const checkedCategories = ref([])
const checkedTags = ref([])

// set checkedCategories on page load an when supplierCategories are edited/deleted.
if (props.supplierCategories) checkedCategories.value = props.supplierCategories
watch(
    () => props.supplierCategories,
    () => checkedCategories.value = props.supplierCategories
)

if (props.supplierTags.length) {
    checkedTags.value = props.supplierTags
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

function toggleCheckCategory(categoryId) {
    if (checkedCategories.value.some((cat => cat['id'] === categoryId))) {
        checkedCategories.value = checkedCategories.value.filter((cat) => cat['id'] !== categoryId)
        checkedTags.value = checkedTags.value.filter((tag) => tag.category_id !== categoryId)
    } else {
        checkedCategories.value = [...checkedCategories.value, props.categories.find(cat => cat.id === categoryId)]
    }
}

function toggleCheckTag(tag) {
    if (checkedTags.value.some(checkedTag => tag['id'] === checkedTag.id)) {
        checkedTags.value = checkedTags.value.filter((checkedTag) => tag['id'] !== checkedTag.id)
    } else {
        checkedTags.value = [...checkedTags.value, tag]
    }
}

function submitSupplier() {
    if (!checkedCategories.value.length) {
        ToastStore.add(
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

<style scoped></style>
