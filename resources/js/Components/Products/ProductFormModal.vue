<template>
    <BaseModal :id="id" width="6xl">
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

                <div v-if="productFormData.description" v-for="(desc, index) in productFormData.description">
                    <InputLabel :for="'description' + index" :value="'Beschreibung ' + (index + 1)" />
                    <div class="border border-gray-300 px-4 py-2 bg-white rounded-md focus:border-purchaser-primary">
                        <TextArea :id="'description' + index" :key="'description-' + index" v-model="desc.description"
                            required />
                    </div>
                </div>

                <!-- Modal footer -->
                <div
                    class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
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
import { watch } from "vue";

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

let productFormData = useForm(emptyProduct)

if (props.product?.id) {
    productFormData = useForm(props.product)
}

watch(
    () => props.product,
    () => {
        if (props.product) {
            productFormData = useForm(props.product)
        } else {
            productFormData = useForm(emptyProduct)
        }
    }
)
</script>