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

                <!-- TODO figure this one out, tabbed does not work at all.. maybe start from the beginning...  -->
                <div class="mb-4 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="descriptionTab"
                        data-tabs-toggle="#descriptionTabContent" role="tablist">
                        <li v-for="desc in productFormData.description" class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" :id="'description-tab-btn-' + desc.id"
                                :data-tabs-target="'#description-id-' + desc.id" type="button" role="tab"
                                :aria-controls="'description-control-id-' + desc.id" aria-selected="true">{{ desc.title }}
                            </button>
                        </li>
                        <!-- <li class="mr-2" role="presentation"> -->
                        <!--     <button -->
                        <!--         class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" -->
                        <!--         id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" -->
                        <!--         aria-controls="dashboard" aria-selected="false">Dashboard</button> -->
                        <!-- </li> -->
                        <!-- <li class="mr-2" role="presentation"> -->
                        <!--     <button -->
                        <!--         class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" -->
                        <!--         id="settings-tab" data-tabs-target="#settings" type="button" role="tab" -->
                        <!--         aria-controls="settings" aria-selected="false">Settings</button> -->
                        <!-- </li> -->
                        <!-- <li role="presentation"> -->
                        <!--     <button -->
                        <!--         class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" -->
                        <!--         id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" -->
                        <!--         aria-controls="contacts" aria-selected="false">Contacts</button> -->
                        <!-- </li> -->
                    </ul>
                </div>
                <div id="descriptionTabContent">
                    <div v-if="productFormData.description" v-for="(desc, index) in productFormData.description"
                        :id="'description-id-' + desc.id" role="tabpanel" :aria-labelledby="'description-tab-btn-' +
                            desc.id" class="hidden">
                        <InputLabel :for="'description' + index" :value="'Beschreibung ' + (index + 1)" />
                        <div class="border border-gray-300 px-4 py-2 bg-white rounded-md focus:border-purchaser-primary">
                            <TextArea :id="'description' + index" :key="'description-' + index" v-model="desc.description"
                                required />
                        </div>
                    </div>
                    <!-- <div class="hidden p-4 rounded-lg bg-gray-50" :id="'description-control-id-' + desc.id" role="tabpanel" -->
                    <!--     :aria-labelledby="'description-tab-btn-' + desc.id"> -->
                    <!--     <p class="text-sm text-gray-500">This is some placeholder content the <strong -->
                    <!--             class="font-medium text-gray-800">Profile tab's associated content</strong>. -->
                    <!--         Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript -->
                    <!--         swaps classes to control the content visibility and styling.</p> -->
                    <!-- </div> -->
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