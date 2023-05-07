<template>
    <Head title="Addresse Bearbeiten" />

    <AuthenticatedLayout>
        <template #header> Addresse Bearbeiten</template>

        <PageBoxWrapper class="my-12 w-full h-full">
            <div class="flex flex-col gap-5">
                <div class="flex justify-between">
                    <h3 class="text-purchaser-primary text-xl font-bold">
                        Addresse (ID: {{ addressForm.id }}) Bearbeiten
                    </h3>

                    <div class="flex gap-4">
                        <BaseButton @click="saveAddress()" color="success">
                            Speichern
                        </BaseButton>

                        <BaseButton :href="route('suppliers.edit', addressForm.supplier_id)" color="back">
                            Zurück
                        </BaseButton>
                    </div>
                </div>

                <Transition>
                    <AlertFailed v-show="addressFormError" :message="addressFormError" />
                </Transition>

                <InputLabel for="addressType">Typ *</InputLabel>

                <select v-model="addressForm.type" required id="addressType"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-purchaser-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:bg-purchaser-primary-light dark:focus:border-purchaser-primary">
                    <option value="main">Hauptadresse</option>
                    <option value="invoice">Rechnungsadresse</option>
                    <option value="delivery">Lieferadresse</option>
                    <option value="other">Sonstige</option>
                </select>

                <div class="">
                    <InputLabel for="name1" value="Name 1 *" />

                    <TextInput v-model="addressForm.name1" required id="name1" type="text" autofocus />
                </div>

                <div class="">
                    <InputLabel for="name2" value="Name 2" />
                    <TextInput v-model="addressForm.name2" id="name2" type="text" />
                </div>

                <div class="">
                    <InputLabel for="name3" value="Name 3" />
                    <TextInput v-model="addressForm.name3" id="name3" type="text" />
                </div>
                <div class="flex gap-3">
                    <div class="w-2/3">
                        <InputLabel for="street" value="Straße *" />
                        <TextInput v-model="addressForm.street" id="street" type="text" required />
                    </div>

                    <div class="w-1/3">
                        <InputLabel for="streetNr" value="Hausnummer *" />
                        <TextInput v-model="addressForm.street_nr" id="streetNr" type="text" required />
                    </div>
                </div>

                <div class="flex gap-3">
                    <div class="w-1/3">
                        <InputLabel for="cityCode" value="PLZ *" />
                        <TextInput v-model="addressForm.city_code" id="cityCode" type="text" required />
                    </div>

                    <div class="w-2/3">
                        <InputLabel for="city" value="Stadt *" />
                        <TextInput v-model="addressForm.city" id="city" type="text" required />
                    </div>
                </div>

                <SelectCountryField @select-country="selectCountry" :country-code="addressForm.country" />

                <div class="">
                    <InputLabel for="phone" value="Telefon" />
                    <TextInput v-model="addressForm.phone" id="phone" type="text" class="mt-1 block w-full" />
                </div>
            </div>
        </PageBoxWrapper>
    </AuthenticatedLayout>
</template>

<script setup>
import AlertFailed from '@/Components/AlertFailed.vue';
import SelectCountryField from '@/Pages/Address/Partials/SelectCountryField.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue';
import BaseButton from '@/Components/BaseButton.vue';
import { router } from '@inertiajs/vue3';
import { CountryCodes } from '@/Localisation/CountryCodes';
import { ref } from 'vue';

const props = defineProps(
    {
        address: Object,
    });

let addressFormError = ref('');

let addressForm = useForm(props.address);

function selectCountry(countryCode) {
    addressForm.country = countryCode;
}

function saveAddress() {
    if (fieldsValidated()) {
        router.patch(route('address.patch', addressForm));
    } else {
        addressFormError.value =
            'Bitte alle mit * gekennzeichneten Felder befüllen';

        if (addressForm.country &&
            !CountryCodes.de.hasOwnProperty(addressForm.country.toUpperCase())) {
            addressFormError.value =
                'Land wurde nicht erkannt! Bitte Länderkod eingeben oder aus der Auswahlliste wählen.';
        }
    }
}

function fieldsValidated() {
    return (
        addressForm.type &&
        addressForm.name1 &&
        addressForm.street &&
        addressForm.street_nr &&
        addressForm.city_code &&
        addressForm.city &&
        CountryCodes.de.hasOwnProperty(addressForm.country.toUpperCase())
    );
}
</script>