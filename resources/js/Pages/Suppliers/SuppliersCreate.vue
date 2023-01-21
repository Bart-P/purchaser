<template>
    <Head title="Lieferanten Hinzufügen" />
    
    <AuthenticatedLayout>
        <template #header>
            Neuen Lieferant Hinzufügen
        </template>
        <div class="py-12 w-full h-full flex flex-col gap-8">
            <!-- add Company Form -->
            <PageBoxWrapper>
                <AddSupplierForm></AddSupplierForm>
            </PageBoxWrapper>
            
            <!-- Address Modal Start -->
            <div id="addAddressModal"
                 tabindex="-1"
                 aria-hidden="true"
                 class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                <div class="relative w-full h-full max-w-2xl md:h-auto relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal content -->
                    <AddAddressForm :addresses="addresses"></AddAddressForm>
                </div>
            </div>
            <!-- Address Modal End -->
            
            <!-- Addresses to save list -->
            <PageBoxWrapper>
                <!-- Address Modal toggle -->
                <div class="flex justify-between">
                    <h3 class="text-xl text-purchaser-primary font-bold rounded px-2">
                        Adressen (optional)
                    </h3>
                    <BaseButton color="primary"
                                type="button"
                                data-modal-target="addAddressModal"
                                data-modal-toggle="addAddressModal">
                        Adresse Hinzufügen
                    </BaseButton>
                </div>
                <div class="flex flex-wrap gap-8 pt-8">
                    <div v-for="(address, index) in addresses"
                         class="w-[31.5%] max-w-md min-w-[250px] p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <button class="float-right text-red-600"
                                type="submit"
                                @click="removeAddress(index)">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        
                        <SingleAddressList :id="index"
                                           :address="address" />
                    </div>
                </div>
            </PageBoxWrapper>
            
            <!-- Presons to save list -->
            <PageBoxWrapper>
                <div class="flex flex-col gap-5">
                    <!-- Person Modal toggle -->
                    <div class="flex justify-between">
                        <h3 class="text-xl text-purchaser-primary font-bold rounded px-2">
                            Personen (optional)
                        </h3>
                        <BaseButton color="primary"
                                    type="button"
                                    data-modal-target="addPersonModal"
                                    data-modal-toggle="addPersonModal">
                            Person Hinzufügen
                        </BaseButton>
                    </div>
                    
                    <!-- Person Modal Start -->
                    <div id="addPersonModal"
                         tabindex="-1"
                         aria-hidden="true"
                         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal body -->
                                <div class="flex flex-col gap-5 p-6">
                                    <h3 class="text-purchaser-primary text-xl font-bold">
                                        Person Hinzufügen</h3>
                                    
                                    
                                    <InputLabel for="personType">
                                        Kontakttyp
                                    </InputLabel>
                                    
                                    <select id="personType"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purchaser-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:bg-purchaser-primary-light dark:focus:border-purchaser-primary"
                                            required>
                                        <option selected>Bitte wählen</option>
                                        <option value="main">Hauptkontakt</option>
                                        <option value="secondary">Vertretung</option>
                                        <option value="other">Sonstige</option>
                                    </select>
                                    
                                    <InputLabel for="personType">
                                        Geschlecht
                                    </InputLabel>
                                    
                                    <select id="personType"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purchaser-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:bg-purchaser-primary-light dark:focus:border-purchaser-primary"
                                            required>
                                        <option selected>Bitte wählen</option>
                                        <option value="male">Männlich</option>
                                        <option value="female">Weiblich</option>
                                        <option value="other">Sonstige</option>
                                    </select>
                                    <div class="">
                                        <InputLabel for="firstName"
                                                    value="Vorname" />
                                        <TextInput
                                            id="firstName"
                                            type="text"
                                            class="mt-1 block w-full"
                                            autofocus
                                        />
                                    </div>
                                    
                                    <div class="">
                                        <InputLabel for="lastName"
                                                    value="Nachname" />
                                        <TextInput
                                            id="name2"
                                            type="text"
                                            class="mt-1 block w-full"
                                        />
                                    </div>
                                    
                                    <div class="">
                                        <InputLabel for="position"
                                                    value="Position" />
                                        <TextInput
                                            id="position"
                                            type="text"
                                            class="mt-1 block w-full"
                                        />
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="w-1/2">
                                            <InputLabel for="phone1"
                                                        value="Telefon 1" />
                                            <TextInput
                                                id="phone1"
                                                type="text"
                                                class="mt-1 block w-full"
                                            />
                                        </div>
                                        
                                        <div class="w-1/2">
                                            <InputLabel for="phone2"
                                                        value="Telefon 2" />
                                            <TextInput
                                                id="streetNr"
                                                type="text"
                                                class="mt-1 block w-full"
                                            />
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="w-1/2">
                                            <InputLabel for="email1"
                                                        value="E-Mail 1" />
                                            <TextInput
                                                id="email1"
                                                type="email"
                                                class="mt-1 block w-full"
                                            />
                                        </div>
                                        
                                        <div class="w-1/2">
                                            <InputLabel for="email2"
                                                        value="E-Mail2" />
                                            <TextInput
                                                id="email2"
                                                type="email"
                                                class="mt-1 block w-full"
                                            />
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Modal footer -->
                                <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <BaseButton data-modal-hide="addPersonModal"
                                                color="primary"
                                                type="button">
                                        Speichern
                                    </BaseButton>
                                    <BaseButton data-modal-hide="addPersonModal"
                                                color="light"
                                                type="button">
                                        Abbrechen
                                    </BaseButton>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Person Modal End -->
                </div>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/inertia-vue3";
import {onMounted, reactive} from "vue";
import {initModals} from "flowbite";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import BaseButton from "@/Components/BaseButton.vue";
import PageBoxWrapper from "@/Components/PageBoxWrapper.vue";
import AddSupplierForm from "@/Components/AddSupplierForm.vue";
import AddAddressForm from "@/Components/AddAddressForm.vue";
import SingleAddressList from "@/Components/SingleAddressList.vue";

onMounted(() => {
    initModals()
})

let addresses = reactive([{
    type    : 'Hauptadresse',
    name1   : 'mephistomedia GmbH',
    name2   : 'z. Hd. Herr du Bois',
    name3   : '',
    street  : 'in der Mark',
    streetNr: '107',
    cityCode: '44869',
    city    : 'Bochum',
    country : 'Deutschland',
}])


function removeAddress(id) {
    addresses.splice(id, 1)
}
</script>