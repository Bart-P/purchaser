<template>
    <Head title="Addresse Bearbeiten" />

    <AuthenticatedLayout>
        <template #header>
            Addresse Bearbeiten
        </template>

        <PageBoxWrapper class="my-12 w-full h-full">
            <div class="flex flex-col gap-5">
                <div class="flex justify-between">
                    <h3 class="text-purchaser-primary text-xl font-bold">
                        Addresse (ID: {{ addressForm.id }}) Bearbeiten</h3>

                    <div class="flex gap-4">
                        <BaseButton @click="saveAddress()"
                                    color="success">
                            Speichern
                        </BaseButton>

                        <BaseButton :href="route('suppliers.edit', addressForm.supplier_id)"
                                    color="light">
                            Zurück
                        </BaseButton>
                    </div>
                </div>
                <Transition>
                    <AlertFailed v-show="addressFormError"
                                 :message="addressFormError" />
                </Transition>
                <InputLabel for="addressType">Typ *</InputLabel>
                <select v-model="addressForm.type"
                        required
                        id="addressType"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-purchaser-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:bg-purchaser-primary-light dark:focus:border-purchaser-primary">
                    <option value="main">Hauptadresse
                    </option>
                    <option value="invoice">Rechnungsadresse</option>
                    <option value="delivery">Lieferadresse</option>
                    <option value="other">Sonstige</option>
                </select>

                <div class="">
                    <InputLabel for="name1"
                                value="Name 1 *" />

                    <TextInput v-model="addressForm.name1"
                               required
                               id="name1"
                               type="text"
                               class="mt-1 block w-full"
                               autofocus />
                </div>

                <div class="">
                    <InputLabel for="name2"
                                value="Name 2" />
                    <TextInput v-model="addressForm.name2"
                               id="name2"
                               type="text"
                               class="mt-1 block w-full"
                    />
                </div>

                <div class="">
                    <InputLabel for="name3"
                                value="Name 3" />
                    <TextInput v-model="addressForm.name3"
                               id="name3"
                               type="text"
                               class="mt-1 block w-full"
                    />
                </div>
                <div class="flex gap-3">
                    <div class="w-2/3">
                        <InputLabel for="street"
                                    value="Straße *" />
                        <TextInput v-model="addressForm.street"
                                   id="street"
                                   type="text"
                                   class="mt-1 block w-full"
                                   required
                        />
                    </div>

                    <div class="w-1/3">
                        <InputLabel for="streetNr"
                                    value="Hausnummer *" />
                        <TextInput v-model="addressForm.street_nr"
                                   id="streetNr"
                                   type="text"
                                   class="mt-1 block w-full"
                                   required
                        />
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="w-1/3">
                        <InputLabel for="cityCode"
                                    value="PLZ *" />
                        <TextInput v-model="addressForm.city_code"
                                   id="cityCode"
                                   type="text"
                                   class="mt-1 block w-full"
                                   required
                        />
                    </div>

                    <div class="w-2/3">
                        <InputLabel for="city"
                                    value="Stadt *" />
                        <TextInput v-model="addressForm.city"
                                   id="city"
                                   type="text"
                                   class="mt-1 block w-full"
                                   required
                        />
                    </div>
                </div>

                <div class="">
                    <InputLabel for="country"
                                value="Land *" />
                    <div class="flex items-center gap-4">
                        <TextInput v-model="addressForm.country"
                                   id="country"
                                   type="text"
                                   class="mt-1 block w-[50px] text-center uppercase"
                                   required
                        />
                        <BaseButton @click="toggleCountryDropdown()"
                                    color="light"
                                    class="flex justify-between items-center border-gray-300 border-[1px] rounded-lg bg-gray-50 min-w-[300px]"
                                    type="button">
                            <Transition>
                                <div v-if="computed(() => CountryCodes.de[addressForm.country.toUpperCase()]).value">
                                    {{
                                        computed(() => CountryCodes.de[addressForm.country.toUpperCase()]).value
                                    }}
                                </div>
                                <div v-else>Auswählen</div>
                            </Transition>
                            <svg class="w-4 h-4 ml-2"
                                 aria-hidden="true"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </BaseButton>

                        <div class="relative overflow-visible">
                            <!-- Dropdown menu -->
                            <Transition>
                                <div v-show="showCountryDropdown"
                                     class="z-10 bg-white rounded-lg shadow w-60 dark:bg-gray-700 absolute bottom-[25px] right-4 w-[300px]">
                                    <ul class="h-96 py-2 overflow-y-auto text-gray-700 dark:text-gray-200">
                                        <li v-for="country in countryCodesShort">
                                            <div @click="selectCountry(country)"
                                                 class="cursor-pointer flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                {{ country }} - {{ CountryCodes.de[country] }}
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </Transition>

                        </div>
                    </div>
                </div>

                <div class="">
                    <InputLabel for="phone"
                                value="Telefon" />
                    <TextInput v-model="addressForm.phone"
                               id="phone"
                               type="text"
                               class="mt-1 block w-full"
                    />
                </div>
            </div>
        </PageBoxWrapper>
    </AuthenticatedLayout>

</template>

<script setup>
import AlertFailed from '@/Components/AlertFailed.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue';
import BaseButton from '@/Components/BaseButton.vue';
import {Inertia} from '@inertiajs/inertia';
import {CountryCodes} from '@/Localisation/CountryCodes';
import {computed, ref} from 'vue';

const props = defineProps(
    {
        address: Object,
    })

const countryCodesShort = Object.keys(CountryCodes.de)
let addressFormError = ref('')

let showCountryDropdown = ref(false)
let addressForm = useForm(props.address)

function toggleCountryDropdown() {
    showCountryDropdown.value = !showCountryDropdown.value
}

function selectCountry(countryCode) {
    addressForm.country = countryCode
    toggleCountryDropdown()
}

function saveAddress() {
    if (fieldsValidated()) {
        Inertia.patch(route('address.patch', addressForm))
    } else {
        addressFormError.value = 'Bitte alle mit * gekennzeichneten Felder befüllen'

        if (addressForm.country && !CountryCodes.de.hasOwnProperty(
            addressForm.country.toUpperCase())) {
            addressFormError.value = 'Land wurde nicht erkannt! Bitte Länderkod eingeben oder aus der Auswahlliste wählen.'
        }
    }
}

function fieldsValidated() {
    return addressForm.type
        && addressForm.name1
        && addressForm.street
        && addressForm.street_nr
        && addressForm.city_code
        && addressForm.city
        && CountryCodes.de.hasOwnProperty(addressForm.country.toUpperCase())
}

</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.2s ease-in-out;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>