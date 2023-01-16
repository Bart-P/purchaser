<template>
    <Head title="Lieferanten Hinzufügen" />
    
    <AuthenticatedLayout>
        <template #header>
            Neuen Lieferant Hinzufügen
        </template>
        <div class="py-12 w-full h-full flex flex-col gap-8">
            <div class="max-w-7xl mx-auto px-6 w-full">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-8">
                    <div class="flex flex-col gap-6">
                        <form class="flex flex-col gap-5">
                            <div class="flex justify-between">
                                <h3 class="text-xl text-purchaser-primary font-bold rounded px-2">Firma (erforderlich)</h3>
                                <div class="flex gap-4 justify-end">
                                    <BaseButton @click.prevent color="primary">Speichern</BaseButton>
                                    <BaseButton :href="route('suppliers')" color="light">Zurück</BaseButton>
                                </div>
                            </div>
                            <div class="flex gap-5">
                                <div class="w-1/2">
                                    <InputLabel for="company" value="Firma Name *" />
                                    <TextInput
                                        id="company"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        autofocus
                                    />
                                </div>
    
                                <div class="w-1/2">
                                    <InputLabel for="company-email" value="Firma E-Mail *" />
                                    <TextInput
                                        id="company-email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        required
                                    />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                
            <div class="max-w-7xl mx-auto px-6 px-4 w-full">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-8">
                    <form class="flex flex-col gap-5">
                        <h3 class="text-xl text-purchaser-primary font-bold rounded px-2">Adresse (optional)</h3>
                        <div class="flex flex-col gap-5">
                            <div class="">
                                <InputLabel for="name1" value="Name 1" />
                                <TextInput
                                    id="name1"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autofocus
                                />
                            </div>
            
                            <div class="">
                                <InputLabel for="name2" value="Name 2" />
                                <TextInput
                                    id="name2"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                            </div>
            
                            <div class="">
                                <InputLabel for="name3" value="Name 3" />
                                <TextInput
                                    id="name3"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                            </div>
                            <div class="flex gap-3">
                                <div class="w-2/3">
                                    <InputLabel for="street" value="Straße" />
                                    <TextInput
                                        id="street"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                </div>
                
                                <div class="w-1/3">
                                    <InputLabel for="streetNr" value="Hausnummer" />
                                    <TextInput
                                        id="streetNr"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-1/3">
                                    <InputLabel for="cityCode" value="PLZ" />
                                    <TextInput
                                        id="cityCode"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                </div>
                
                                <div class="w-2/3">
                                    <InputLabel for="city" value="Stadt" />
                                    <TextInput
                                        id="city"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
            <div class="max-w-7xl mx-auto px-6 px-4 w-full">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-8">
                    <div class="flex flex-col gap-6">
                        <form class="flex flex-col gap-5">
                            <h3 class="text-xl text-purchaser-primary font-bold rounded px-2">Person (optional)</h3>
                            <div class="flex flex-col gap-5">
                                <div class="">
                                    <InputLabel for="firstName" value="Vorname" />
                                    <TextInput
                                        id="firstName"
                                        type="text"
                                        class="mt-1 block w-full"
                                        autofocus
                                    />
                                </div>
                            
                                <div class="">
                                    <InputLabel for="lastName" value="Nachname" />
                                    <TextInput
                                        id="name2"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                </div>
                            
                                <div class="">
                                    <InputLabel for="position" value="Position" />
                                    <TextInput
                                        id="position"
                                        type="text"
                                        class="mt-1 block w-full"
                                    />
                                </div>
                                <div class="flex gap-3">
                                    <div class="w-1/2">
                                        <InputLabel for="phone1" value="Telefon 1" />
                                        <TextInput
                                            id="phone1"
                                            type="text"
                                            class="mt-1 block w-full"
                                        />
                                    </div>
                                
                                    <div class="w-1/2">
                                        <InputLabel for="phone2" value="Telefon 2" />
                                        <TextInput
                                            id="streetNr"
                                            type="text"
                                            class="mt-1 block w-full"
                                        />
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <div class="w-1/2">
                                        <InputLabel for="email1" value="E-Mail 1" />
                                        <TextInput
                                            id="email1"
                                            type="email"
                                            class="mt-1 block w-full"
                                        />
                                    </div>
                                
                                    <div class="w-1/2">
                                        <InputLabel for="email2" value="E-Mail2" />
                                        <TextInput
                                            id="email2"
                                            type="email"
                                            class="mt-1 block w-full"
                                        />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/inertia-vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import BaseButton from "@/Components/BaseButton.vue";
</script>