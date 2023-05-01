<template>
    <Head title="Person Bearbeiten" />

    <AuthenticatedLayout>
        <template #header>
            Person Bearbeiten
        </template>

        <PageBoxWrapper class="my-12 w-full h-full">
            <form class="flex flex-col gap-5 p-6">

                <div class="flex justify-between">
                    <h3 class="text-purchaser-primary text-xl font-bold">
                        Person (ID: {{ person.id }}) Bearbeiten
                    </h3>

                    <div class="flex gap-4">
                        <BaseButton @click="savePerson()" color="primary" type="button">
                            Speichern
                        </BaseButton>
                        <BaseButton :href="route('suppliers.edit', personForm.supplier_id)" color="back" type="button">
                            Zurück
                        </BaseButton>
                    </div>
                </div>

                <InputLabel for="personType">
                    Kontakttyp *
                </InputLabel>

                <select id="personType" v-model="personForm.type"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purchaser-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:bg-purchaser-primary-light dark:focus:border-purchaser-primary"
                    required>
                    <option value="main">Hauptkontakt</option>
                    <option value="secondary">Vertretung</option>
                    <option value="other">Sonstige</option>
                </select>

                <InputLabel for="personGender">
                    Geschlecht *
                </InputLabel>

                <ul
                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg sm:flex">
                    <li class="w-full border-b border-gray-300 sm:border-b-0 sm:border-r">
                        <div class="flex items-center pl-3">
                            <input id="horizontal-list-male" v-model="personForm.gender" type="radio" value="m"
                                name="list-radio"
                                class="w-4 h-4 text-purchaser-primary bg-gray-100 border-gray-300 focus:ring-purchaser-primary focus:ring-2">
                            <label for="horizontal-list-male"
                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900">Männlich</label>
                        </div>
                    </li>

                    <li class="w-full border-b border-gray-300 sm:border-b-0 sm:border-r">
                        <div class="flex items-center pl-3">
                            <input id="horizontal-list-female" v-model="personForm.gender" type="radio" value="f"
                                name="list-radio"
                                class="w-4 h-4 text-purchaser-primary bg-gray-100 border-gray-300 focus:ring-purchaser-primary focus:ring-2">
                            <label for="horizontal-list-female"
                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900">Weiblich</label>
                        </div>
                    </li>

                    <li class="w-full border-b border-gray-300 sm:border-b-0 sm:border-r">
                        <div class="flex items-center pl-3">
                            <input id="horizontal-list-other" v-model="personForm.gender" type="radio" value="o"
                                name="list-radio"
                                class="w-4 h-4 text-purchaser-primary bg-gray-100 border-gray-300 focus:ring-purchaser-primary focus:ring-2">
                            <label for="horizontal-list-other"
                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900">Andere</label>
                        </div>
                    </li>
                </ul>

                <div class="">
                    <InputLabel for="firstName" value="Vorname *" />
                    <TextInput v-model="personForm.first_name" id="firstName" type="text" class="mt-1 block w-full"
                        autofocus />
                </div>

                <div class="">
                    <InputLabel for="lastName" value="Nachname *" />
                    <TextInput v-model="personForm.last_name" id="name2" type="text" class="mt-1 block w-full" />
                </div>

                <div class="">
                    <InputLabel for="position" value="Position" />
                    <TextInput v-model="personForm.position" id="position" type="text" class="mt-1 block w-full" />
                </div>
                <div class="flex gap-3">
                    <div class="w-1/2">
                        <InputLabel for="phone1" value="Telefon 1" />
                        <TextInput v-model="personForm.phone1" id="phone1" type="text" class="mt-1 block w-full" />
                    </div>

                    <div class="w-1/2">
                        <InputLabel for="phone2" value="Telefon 2" />
                        <TextInput v-model="personForm.phone2" id="streetNr" type="text" class="mt-1 block w-full" />
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-1/2">
                        <InputLabel for="email1" value="E-Mail 1" />
                        <TextInput v-model="personForm.email1" id="email1" type="email" class="mt-1 block w-full" />
                    </div>

                    <div class="w-1/2">
                        <InputLabel for="email2" value="E-Mail2" />
                        <TextInput v-model="personForm.email2" id="email2" type="email" class="mt-1 block w-full" />
                    </div>
                </div>
                <div
                    class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">

                </div>
            </form>

        </PageBoxWrapper>


    </AuthenticatedLayout>
</template>

<script setup>

import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import BaseButton from "@/Components/BaseButton.vue";
import { router, useForm, Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PageBoxWrapper from "@/Components/PageBoxWrapper.vue";

const props = defineProps(
    {
        person: Object,
    })

let personForm = useForm(props.person)

function savePerson() {
    router.patch(route('person.patch', personForm))
}


</script>