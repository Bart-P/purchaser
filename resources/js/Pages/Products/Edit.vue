<template>
    <Head title='Anfrage Bearbeiten' />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h1>
                    <b>ID: {{ product.id }}</b> Produkt
                    <span v-if="product">Bearbeiten</span>
                    <span v-else>Hinzufügen</span>
                </h1>
                <div class="flex gap-2">
                    <BaseButton color="success" btn-type="rounded">
                        <i class="fa-solid fa-save"></i>
                    </BaseButton>
                    <BaseButton @click="back" color="back" btn-type="rounded">
                        <i class="fa-solid fa-delete-left"></i>
                    </BaseButton>
                </div>
            </div>
        </template>

        <div class="py-12 space-y-6">
            <PageBoxWrapper class="relative">
                <form>
                    <!-- TODO restyle the whole thing -->
                    <div class="flex flex-col gap-5">
                        <div class="flex gap-6">
                            <h3 class="py-3 text-purchaser-primary font-bold whitespace-nowrap">Produkt Titel:</h3>

                            <TextInput v-model="productFormData.title" required id="title" type="text"
                                class="mt-1 block w-full" autofocus />
                        </div>
                        <div class="">
                            <h3 class="py-3 text-purchaser-primary font-bold">Auflagen</h3>
                            <div class="flex gap-2">
                                <span class="border py-1 px-2 rounded-full border-gray-300 self-center"
                                    v-for="price in productFormData?.prices">{{
                                        price.quantity + " St." }}
                                </span>
                                <AddQuantityDropdown />
                            </div>
                        </div>

                        <div class="flex gap-3 w-full">
                            <div :class="productFormData.descriptions?.length > 1 ? 'w-1/2' : 'w-full'">
                                <h3 class="py-3 text-purchaser-primary font-bold">
                                    Beschreibung:
                                </h3>

                                <div
                                    class="border border-gray-300 px-4 py-2 bg-white rounded-md focus:border-purchaser-primary">
                                    <TextArea rows="20" :value="mainDescription?.description" />
                                </div>
                            </div>

                            <div v-show="productFormData.descriptions?.length > 1" class="w-1/2">
                                <div class="flex justify-between mb-2">
                                    <ul class="flex gap-2 ms-2 w-full">
                                        <li v-for="desc in productFormData.descriptions?.filter((desc) => !desc.is_main)">
                                            <BaseButton @click="setActiveDescription(desc)" class="!py-2 !px-3"
                                                type="button"
                                                :color="activeDescription.id === desc.id ? 'primary' : 'light'">
                                                {{ desc.lang }}
                                            </BaseButton>
                                        </li>
                                    </ul>

                                    <div v-if="productFormData.descriptions?.filter((desc) => desc.id == 'temp').length > 0"
                                        class="flex gap-2">
                                        <BaseButton @click="saveProductDescription()" color="success" btn-type="rounded"
                                            id="addDescriptionDropdown" type="button">
                                            <i class="fa-solid fa-save"></i>
                                        </BaseButton>

                                        <BaseButton color="secondary" btn-type="rounded" type="button"
                                            @click="removeTempDescription()">
                                            <i class="fa-solid fa-cancel"></i>
                                        </BaseButton>
                                    </div>

                                    <div v-else class="flex gap-2">
                                        <AddDescriptionDropdown @create-new-description="createNewDescription" />
                                        <DeleteDescriptionDropdown id="deleteDescriptionDropdownButton"
                                            v-if="activeDescription" @delete-product-description="deleteProductDescription"
                                            :description-id-to-delete="activeDescription['id']" />
                                    </div>
                                </div>

                                <div v-if="activeDescription?.description || activeDescription?.description === ''"
                                    class="border border-gray-300 px-4 py-2 bg-white rounded-md focus:border-purchaser-primary">
                                    <TextArea rows="20" v-model="activeDescription.description" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import PageBoxWrapper from "@/Components/PageBoxWrapper.vue";
import BaseButton from "@/Components/BaseButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import AddQuantityDropdown from '@/Components/Products/AddQuantityDropdown.vue'
import AddDescriptionDropdown from '@/Components/Products/AddDescriptionDropdown.vue'
import DeleteDescriptionDropdown from '@/Components/Products/DeleteDescriptionDropdown.vue'
import { router, useForm } from "@inertiajs/vue3";
import { ref, watch, onMounted } from "vue";
import { initDropdowns } from "flowbite";

onMounted(() => {
    initDropdowns()
})

const props = defineProps(
    {
        product: Object,
        descriptions: Object,
        prices: Object,
    })

const emits = defineEmits(['deleteProductDescription']);

const emptyProduct = {
    id: null,
    inquiry_id: null,
    title: null,
    prices: null,
    descriptions: null,
    created_at: null,
    updated_at: null
}

const activeDescription = ref(null)
const mainDescription = ref(null)
let productFormData = useForm(emptyProduct)
const addDescriptionForm = useForm({})

// if there is a product, set it up
if (props.product) {
    resetProduct()
}

function resetProduct() {
    if (props.product.id) {
        productFormData = useForm(
            {
                ...props.product,
                descriptions: props.descriptions,
                prices: props.prices
            }
        )

        const nonActiveDescriptions = props.descriptions.filter((desc) => desc.is_main !== 1)
        activeDescription.value = nonActiveDescriptions[nonActiveDescriptions.length - 1]
        mainDescription.value = productFormData.descriptions?.filter((desc) => desc.is_main === 1)[0]
    } else {
        productFormData = useForm(emptyProduct)
        mainDescription.value = null
        activeDescription.value = null
    }
}

// if product changes, reload it
watch(
    [
        () => props.product,
        () => props.descriptions
    ],
    () => resetProduct()
)

function createNewDescription(lang) {
    const newDesc = {
        'id': 'temp',
        'lang': lang,
        'product_id': props.product.id,
        'is_main': false,
        'title': '',
        'description': '',
    }

    if (productFormData.descriptions.length) {
        productFormData.descriptions = [...productFormData.descriptions, newDesc]
    } else {
        productFormData.descriptions = [newDesc]
    }

    setActiveDescription(newDesc)
}

function setActiveDescription(description) {
    activeDescription.value = description
}

function removeTempDescription() {
    productFormData.descriptions = productFormData.descriptions.filter((desc) => desc.id !== 'temp')
    resetProduct()
}

function saveProductDescription() {
    const product = productFormData.descriptions.find((desc) => {
        return desc.id == 'temp'
    })
    addDescriptionForm.lang = ''

    return router.post(route('product.store-description', product))
}

function deleteProductDescription() {
    document.getElementById('deleteDescriptionDropdownButton').click()
    return router.post(route('product.destroy-description', { id: activeDescription.value.id }))
}

function back() {
    window.history.back()
}
</script>