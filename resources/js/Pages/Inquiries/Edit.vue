<template>
    <Head title='Anfrage Bearbeiten' />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <div class="">Anfrage (ID {{ inquiryDataForm.id }}) Daten Bearbeiten:</div>
                <div class="space-x-3">
                    <BaseButton color="danger" class="!px-3 rounded-full text-sm">
                        <i class="fa-solid fa-trash"></i>
                    </BaseButton>
                    <BaseButton :href="route('inquiries.show', inquiry.id)" color="back" class="!px-3 rounded-full text-sm">
                        <i class="fa-solid fa-delete-left"></i>
                    </BaseButton>
                </div>
            </div>
        </template>

        <div class="py-12">
            <PageBoxWrapper>
                <div class="flex gap-3 w-full">
                    <form class="w-1/2" @submit.prevent="" action="#">
                        <div>
                            <InputLabel for="title">Titel:</InputLabel>
                            <TextInput id="title" v-model="inquiryDataForm.title" type="text" name="title"></TextInput>
                        </div>
                        <div>
                            <InputLabel for="status">Status:</InputLabel>
                            <TextInput id="status" v-model="inquiryDataForm.status" type="text" name="title"></TextInput>
                        </div>
                    </form>
                    <form class="w-1/2">
                        <div class="">
                            <!-- TODO - style textarea, new component?  -->
                            <InputLabel for="description">Beschreibung</InputLabel>
                            <TextInput id="description" v-model="inquiryDataForm.description" type="textarea"
                                name="description">
                            </TextInput>
                        </div>
                    </form>
                </div>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue'
import BaseButton from '@/Components/BaseButton.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    inquiry: Object,
})

const inquiryDataForm = useForm(props.inquiry)

</script>