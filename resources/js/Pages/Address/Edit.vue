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
                    <TextInput v-model="addressForm.country"
                               id="country"
                               type="text"
                               class="mt-1 block w-full"
                               required
                    />
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
import {Head, useForm} from "@inertiajs/inertia-vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PageBoxWrapper from "@/Components/PageBoxWrapper.vue";
import BaseButton from "@/Components/BaseButton.vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps(
    {
        address: Object
    })

let addressForm = useForm(props.address)

function saveAddress() {
    Inertia.patch(route('address.patch', addressForm))
}

</script>