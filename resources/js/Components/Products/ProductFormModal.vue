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
                    <InputLabel for="title" value="Titel" />

                    <TextInput v-model="productFormData.title" required id="title" type="text" class="mt-1 block w-full"
                        autofocus />
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

                            <div class="flex gap-2">
                                <BaseButton color="success" btn-type="rounded" type="button"
                                    data-dropdown-toggle="dropdownAddDescription">
                                    <i class="fa-solid fa-plus"></i>
                                </BaseButton>

                                <BaseButton color="danger" btn-type="rounded" type="button">
                                    <i class="fa-solid fa-trash"></i>
                                </BaseButton>
                            </div>

                            <form id="dropdownAddDescription"
                                @submit.prevent="createNewDescription(addDescriptionForm.lang)"
                                class="!m-0 flex flex-col hidden z-10 gap-4 rounded-md bg-white shadow-md p-4">
                                <h5 class="heading-5">Beschreibung hinzufügen:</h5>
                                <TextInput v-model="addDescriptionForm.lang" type="text" placeholder="Sprache eingeben"
                                    required />
                                <BaseButton type="submit" color="success">
                                    <i class="fa-solid fa-save"></i>
                                </BaseButton>
                            </form>
                        </div>

                        <div class="border border-gray-300 px-4 py-2 bg-white rounded-md focus:border-purchaser-primary">
                            <TextArea rows="20" :v-model="activeDescription?.description" />
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
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import { useForm } from '@inertiajs/vue3';
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

const emits = defineEmits(['closeProductFormModal']);

const emptyProduct = {
    id: null,
    inquiry_id: null,
    title: null,
    created_at: null,
    updated_at: null
}

const activeDescription = ref({})
const mainDescription = ref({})

let productFormData = useForm(emptyProduct)
const addDescriptionForm = useForm({})

if (props.product?.id) {
    productFormData = useForm(props.product)
}

function setActiveDescription(description) {
    activeDescription.value = description
}

function createNewDescription(lang) {
    const newDesc = {
        'lang': lang,
        'product_id': props.product.id,
        'description': '',
    }
    productFormData.description = [...productFormData.description, newDesc]
    console.log(productFormData.description)

    setActiveDescription(newDesc)
}

watch(
    () => props.product,
    () => {
        if (props.product) {
            productFormData = useForm(props.product)
            activeDescription.value = productFormData.description?.filter((desc) => desc.is_main != 1)[0]
            mainDescription.value = productFormData.description?.find((desc) => desc.is_main === 1)
        } else {
            productFormData = useForm(emptyProduct)
        }
    }
)
</script>