<template>
    <Head title="Lieferanten Hinzufügen" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h3>Neuen Lieferant Hinzufügen</h3>
                <BaseButton type="button" :href="route('suppliers')" color="back" btn-type="rounded">
                    <i class="fa-solid fa-delete-left" />
                </BaseButton>
            </div>
        </template>
        <div class="py-12 w-full h-full flex flex-col gap-8">
            <!-- add Company Form -->
            <PageBoxWrapper>
                <AddSupplierForm :categories="categories" :tags="tags" :persons="persons" :addresses="addresses" />
            </PageBoxWrapper>

            <BaseModal id="addAddressModal">
                <AddAddressForm :addresses="addresses" />
            </BaseModal>

            <!-- Addresses to save list -->
            <PageBoxWrapper>
                <!-- Address Modal toggle -->
                <div class="flex justify-between">
                    <h3 class="heading-3">
                        Adressen (optional)
                    </h3>
                    <BaseButton color="primary" type="button" data-modal-target="addAddressModal"
                        data-modal-toggle="addAddressModal">
                        Adresse Hinzufügen
                    </BaseButton>
                </div>
                <div class="flex flex-wrap gap-8 pt-8">
                    <div v-for="(address, index) in addresses"
                        class="w-[31.5%] max-w-md min-w-[250px] p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <IconButton class="float-right" color="red" type="submit" @click="removeAddress(index)">
                            <i class="fa-solid fa-trash"></i>
                        </IconButton>
                        <SingleAddressList :id="index" :address="address" />
                    </div>
                </div>
            </PageBoxWrapper>

            <BaseModal id="addPersonModal">
                <AddPersonForm :persons="persons" />
            </BaseModal>

            <!-- Presons to save list -->
            <PageBoxWrapper>
                <div class="flex flex-col gap-5">
                    <!-- Person Modal toggle -->
                    <div class="flex justify-between">
                        <h3 class="heading-3">
                            Personen (optional)
                        </h3>
                        <BaseButton color="primary" type="button" data-modal-target="addPersonModal"
                            data-modal-toggle="addPersonModal">
                            Person Hinzufügen
                        </BaseButton>
                    </div>

                    <div class="flex flex-wrap gap-8 pt-8">
                        <template v-for="(person, index) in persons">
                            <div
                                class="w-[31.5%] max-w-md min-w-[250px] p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <IconButton class="float-right" color="red" type="submit" @click="removePerson(index)">
                                    <i class="fa-solid fa-trash"></i>
                                </IconButton>
                                <SinglePersonList :id="index" :person="person" />
                            </div>
                        </template>

                    </div>
                </div>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, reactive } from 'vue';
import { initModals } from 'flowbite';
import BaseButton from '@/Components/BaseButton.vue';
import IconButton from '@/Components/IconButton.vue';
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue';
import AddSupplierForm from '@/Pages/Suppliers/Partials/AddSupplierForm.vue';
import AddAddressForm from '@/Pages/Suppliers/Partials/AddAddressForm.vue';
import SingleAddressList from '@/Pages/Suppliers/Partials/SingleAddressList.vue';
import AddPersonForm from '@/Pages/Suppliers/Partials/AddPersonForm.vue';
import BaseModal from '@/Components/BaseModal.vue';
import SinglePersonList from '@/Pages/Suppliers/Partials/SinglePersonList.vue';

const props = defineProps(
    {
        categories: Object,
        tags: Object,
    })

onMounted(() => {
    initModals()
})

let addresses = reactive([])
let persons = reactive([])

function removeAddress(index) {
    addresses.splice(index, 1)
}

function removePerson(index) {
    persons.splice(index, 1)
}
</script>