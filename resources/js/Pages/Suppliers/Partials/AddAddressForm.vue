<template>
    <form>
        <!-- Modal body -->
        <div class="flex flex-col gap-5 p-6">
            <h3 class="text-purchaser-primary text-xl font-bold">Addresse Hinzufügen</h3>
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

            <SelectCountryField :country-code="addressForm.country"
                                @select-country="selectCountry" />

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

        <!-- Modal footer -->
        <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
            <BaseButton
                color="primary"
                @click.prevent="addAddress()"
                type="submit">
                Speichern
            </BaseButton>
            <BaseButton data-modal-hide="addAddressModal"
                        color="light"
                        type="button">
                Abbrechen
            </BaseButton>
        </div>
    </form>
</template>

<script setup>

import BaseButton from '@/Components/BaseButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {CountryCodes} from '@/Localisation/CountryCodes';
import SelectCountryField from '@/Pages/Address/Partials/SelectCountryField.vue';
import toast from '@/Stores/toast';
import {Inertia} from '@inertiajs/inertia';
import {useForm} from '@inertiajs/inertia-vue3';

const props = defineProps(
    {
        addresses: Array,
        supplier : {
            default: null,
            type   : Object,
        },
    },
)

const emit = defineEmits(['addAddress'])

const addressForm = useForm(
    {
        type       : 'main',
        id         : null,
        supplier_id: null,
        name1      : null,
        name2      : null,
        name3      : null,
        street     : null,
        street_nr  : null,
        city_code  : null,
        city       : null,
        country    : null,
        phone      : null,
    })

function addAddress() {

    if (!addressForm.type || !addressForm.name1 || !addressForm.street || !addressForm.street_nr || !addressForm.city_code || !addressForm.city || !addressForm.country) {
        toast.add({
                      type   : 'warning',
                      message: 'Bitte alle mit * gekennzeichneten Felder befüllen!',
                  })
        return
    }

    if (addressForm.country && !CountryCodes.de.hasOwnProperty(addressForm.country)) {
        toast.add({
                      type   : 'warning',
                      message: 'Länderkod nicht erkannt!',
                  })
        return
    }

    if (props.supplier?.id && !addressForm.id) {
        saveNewAddressForSupplier(addressForm.data())
        return
    }

    props.addresses.push(addressForm.data())
    addressForm.reset()
    toast.add({
                  type   : 'success',
                  message: 'Addresse Hinzugefügt! Bitte weitere eingeben oder auf Abbrechen drücken.',
              })
}

function saveNewAddressForSupplier(addressData) {
    addressData['supplier_id'] = props.supplier.id
    Inertia.post(route('address.store'), addressData)
}

function selectCountry(countryCode) {
    addressForm.country = countryCode
}

</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: all 0.3s ease-out;
}

.v-enter-from,
.v-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>