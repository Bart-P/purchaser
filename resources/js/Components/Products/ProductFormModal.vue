<template>
    <BaseModal :id="id" width="7xl">
        <form>
            <!-- Modal body -->
            <div class="flex flex-col gap-5 p-6">
                <h3 class="text-purchaser-primary text-xl font-bold">
                    Produkt
                    <span v-if="product">Bearbeiten</span>
                    <span v-else>Hinzufügen</span>
                </h3>

                <div class="">
                    <h3 class="py-3 text-purchaser-primary font-bold">Produkt Titel:</h3>

                    <TextInput v-model="productFormData.title" required id="title" type="text" class="mt-1 block w-full"
                        autofocus />
                </div>
                <div class="">
                    <h3 class="py-3 text-purchaser-primary font-bold">Auflagen</h3>


                    <div class="flex gap-2">
                        <span class="border py-1 px-2 rounded-full border-gray-300 self-center"
                            v-for="price in productFormData?.prices">{{
                                price.quantity + " St." }}
                        </span>
                        <BaseButton btn-type="rounded" color="success" type="button"
                            data-dropdown-toggle="dropdownAddQuantity"><i class="fa-solid fa-plus"></i>
                        </BaseButton>
                    </div>

                    <form id="dropdownAddQuantity" @submit.prevent=""
                        class="!m-0 flex flex-col hidden z-10 gap-4 rounded-md bg-white shadow-md p-4">
                        <h5 class="heading-5">Auflage hinzufügen:</h5>
                        <TextInput type="number" placeholder="Auflage eingeben" required />
                        <BaseButton type="submit" color="success">
                            <i class="fa-solid fa-save"></i>
                        </BaseButton>
                    </form>
                </div>

                <div class="flex gap-3 w-full">
                    <div :class="productFormData.description?.length > 1 ? 'w-1/2' : 'w-full'">
                        <h3 class="py-3 text-purchaser-primary font-bold">
                            Beschreibung:
                        </h3>

                        <div class="border border-gray-300 px-4 py-2 bg-white rounded-md focus:border-purchaser-primary">
                            <TextArea rows="20" :value="mainDescription?.description" />
                        </div>
                    </div>

                    <div v-show="productFormData.description?.length > 1" class="w-1/2">
                        <div class="flex justify-between mb-2">
                            <ul class="flex gap-2 ms-2 w-full">
                                <li v-for="desc in productFormData.description?.filter((desc) => !desc.is_main)">
                                    <BaseButton @click="setActiveDescription(desc)" class="!py-2 !px-3" type="button"
                                        :color="activeDescription.id === desc.id ? 'primary' : 'light'">
                                        {{ desc.lang }}
                                    </BaseButton>
                                </li>
                            </ul>

                            <!-- TODO delete now works, after a description is created it cannot be deleted! fix it! -->
                            <div v-if="productFormData.description?.filter((desc) => desc.id == 'temp').length > 0"
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
                                <div class="relative">
                                    <BaseButton color="success" btn-type="rounded" type="button"
                                        id="addDescriptionDropdownBtn" @click="toggleAddDescriptionDropdown()">
                                        <i class="fa-solid fa-plus"></i>
                                    </BaseButton>

                                    <div class="absolute top-[40px] right-0" v-show="showAddDescription">
                                        <form id="addDescriptionDropdown"
                                            @submit.prevent="createNewDescription(addDescriptionForm.lang)"
                                            class="!m-0 flex flex-col z-10 gap-4 rounded-md bg-white shadow-md p-4">
                                            <h5 class="heading-5 whitespace-nowrap">Neue Beschreibung: </h5>
                                            <TextInput v-model="addDescriptionForm.lang" type="text" placeholder="Titel"
                                                required />
                                            <div class="flex gap-3 justify-end">
                                                <BaseButton type="submit" color="success">
                                                    <i class="fa-solid fa-save"></i>
                                                </BaseButton>
                                                <BaseButton @click="showAddDescription = false" type="button" color="light">
                                                    <i class="fa-solid fa-cancel"></i>
                                                </BaseButton>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="relative">
                                    <BaseButton color="danger" btn-type="rounded" type="button"
                                        id="deleteDescriptionDropdownBtn" @click="toggleDeleteDescriptionDropdown">
                                        <i class="fa-solid fa-trash"></i>
                                    </BaseButton>

                                    <div class="absolute top-[40px] right-0" v-show="showDeleteDescription">
                                        <div id="deleteProductDescriptionDropdown"
                                            class="!m-0 flex flex-col z-10 gap-4 rounded-md bg-white shadow-md p-4">
                                            <h5 class="heading-5 text-center text-red-600">Bist du sicher?</h5>
                                            <p class="whitespace-nowrap" v-if="activeDescription">Beschreibung ID: {{
                                                activeDescription['id'] }} unwiederruflich löschen</p>

                                            <div class="flex gap-3 justify-end">
                                                <BaseButton @click="deleteProductDescription()" type="button"
                                                    color="danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </BaseButton>
                                                <BaseButton @click="showDeleteDescription = false" type="button"
                                                    color="light">
                                                    <i class="fa-solid fa-cancel"></i>
                                                </BaseButton>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div v-if="activeDescription?.description || activeDescription?.description === ''"
                            class="border border-gray-300 px-4 py-2 bg-white rounded-md focus:border-purchaser-primary">
                            <TextArea rows="20" v-model="activeDescription.description" />
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b">
                    <BaseButton color="primary" @click.prevent="" type="submit">
                        Speichern
                    </BaseButton>

                    <BaseButton @click="$emit('closeProductFormModal')" color="back" type="button">
                        Abbrechen
                    </BaseButton>
                </div>
            </div>
        </form>
    </BaseModal>
</template>

<script setup>

import BaseModal from "@/Components/BaseModal.vue";
import BaseButton from "@/Components/BaseButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import { router, useForm } from "@inertiajs/vue3";
import { ref, watch, onMounted } from "vue";
import { initDropdowns } from "flowbite";


onMounted(() => {
    initDropdowns()
})

const props = defineProps(
    {
        id: String,
        product: Object,
    })

const emits = defineEmits(['closeProductFormModal', 'deleteProductDescription']);

const emptyProduct = {
    id: null,
    inquiry_id: null,
    title: null,
    prices: null,
    description: null,
    created_at: null,
    updated_at: null
}

const activeDescription = ref(null)
const mainDescription = ref(null)

let productFormData = useForm(emptyProduct)
const addDescriptionForm = useForm({})

if (props.product) {
    productFormData = useForm(props.product)
}

function setActiveDescription(description) {
    activeDescription.value = description
}

function createNewDescription(lang) {
    const newDesc = {
        'id': 'temp',
        'lang': lang,
        'product_id': props.product.id,
        'is_main': false,
        'title': '',
        'description': '',
    }

    if (productFormData.description.length) {
        productFormData.description = [...productFormData.description, newDesc]
    } else {
        productFormData.description = [newDesc]
    }

    setActiveDescription(newDesc)
}

function removeTempDescription() {
    productFormData.description = productFormData.description.filter((desc) => desc.id !== 'temp')
    resetProduct()
}

function saveProductDescription() {
    // TODO after delete or save both buttons cant be clicked..
    const product = productFormData.description.find((desc) => {
        return desc.id == 'temp'
    })
    addDescriptionForm.lang = ''

    showAddDescription.value = false

    return router.post(route('product.store-description', product))
}

function deleteProductDescription() {
    emits('deleteProductDescription', activeDescription.value.id)
    showDeleteDescription.value = false
}

function resetProduct() {
    if (props.product) {
        productFormData = useForm(props.product)
        activeDescription.value = props.product?.description.filter((desc) => desc.is_main !== 1)[0]
        mainDescription.value = productFormData.description?.filter((desc) => desc.is_main === 1)[0]

    } else {
        productFormData = useForm(emptyProduct)
        mainDescription.value = null
        activeDescription.value = null
    }
}

watch(
    () => props.product,
    () => resetProduct()
)
</script>