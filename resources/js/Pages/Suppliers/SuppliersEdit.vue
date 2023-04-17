<template>
    <Head title="Lieferant Bearbeiten" />

    <DeleteConfirmationModal id="deleteAddressModal">
        <template #text>
            Die Addresse
            <span class="font-bold">{{ addressToDelete.name }} (ID: {{ addressToDelete.id }})</span>
            wird unwiederruflich gelöscht!
        </template>
        <template #buttons>
            <BaseButton @click="deleteAddress()" color="danger">
                Löschen
            </BaseButton>

            <BaseButton @click="deleteAddressModal.hide()" color="light">
                Abbrechen
            </BaseButton>
        </template>
    </DeleteConfirmationModal>

    <DeleteConfirmationModal id="deletePersonModal">
        <template #text>
            Die die Person
            <span class="font-bold">{{ personToDelete.fname }} {{ personToDelete.lname }} (ID: {{
                personToDelete.id
            }})</span>
            wird unwiederruflich gelöscht!
        </template>
        <template #buttons>
            <BaseButton @click="deletePerson()" color="danger">
                Löschen
            </BaseButton>

            <BaseButton @click="deletePersonModal.hide()" color="light">
                Abbrechen
            </BaseButton>
        </template>
    </DeleteConfirmationModal>

    <AuthenticatedLayout>
        <template #header>
            Lieferant Bearbeiten
        </template>
        <div class="py-12 w-full h-full flex flex-col gap-8">
            <!-- add Company Form -->
            <PageBoxWrapper>
                <AddSupplierForm :supplier="supplier" :persons="persons" :addresses="addresses" :categories="categories"
                    :tags="tags" :supplier-tags="supplierTags" :supplier-categories="supplierCategories" />
            </PageBoxWrapper>

            <BaseModal id="addAddressModal">
                <AddAddressForm :supplier="supplier" :addresses="addresses" />
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
                        <div class="float-right flex gap-4">
                            <Link v-if="address.id" :href="route('address.edit', address.id)" class="text-blue-600">
                            <i class="fa-solid fa-pen"></i>
                            </Link>
                            <button class="text-red-600" type="submit" data-modal-target="deleteAddressModal"
                                @click="setAddressToDelete(address.id, address.name1)">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>

                        <SingleAddressList :id="index" :address="address" />
                    </div>
                </div>
            </PageBoxWrapper>

            <BaseModal id="addPersonModal">
                <AddPersonForm :supplier="supplier" :persons="persons" />
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

                                <div class="float-right flex gap-4">
                                    <Link v-if="person.id" :href="route('person.edit', person.id)" class="text-blue-600">
                                    <i class="fa-solid fa-pen"></i>
                                    </Link>
                                    <button class="float-right text-red-600" type="submit"
                                        @click="setPersonToDelete(person.first_name, person.last_name, person.id)">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
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
import { Head, Link } from '@inertiajs/inertia-vue3';
import { onMounted, ref } from 'vue';
import { initModals } from 'flowbite';
import BaseButton from '@/Components/BaseButton.vue';
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue';
import AddSupplierForm from '@/Pages/Suppliers/Partials/AddSupplierForm.vue';
import AddAddressForm from '@/Pages/Suppliers/Partials/AddAddressForm.vue';
import SingleAddressList from '@/Pages/Suppliers/Partials/SingleAddressList.vue';
import AddPersonForm from '@/Pages/Suppliers/Partials/AddPersonForm.vue';
import BaseModal from '@/Components/BaseModal.vue';
import SinglePersonList from '@/Pages/Suppliers/Partials/SinglePersonList.vue';
import DeleteConfirmationModal from '@/Components/DeleteConfirmationModal.vue';
import { Inertia } from '@inertiajs/inertia';
import { Modal } from 'flowbite';

onMounted(() => {
    initModals()
    deleteAddressModal = new Modal(document.getElementById('deleteAddressModal'))
    deletePersonModal = new Modal(document.getElementById('deletePersonModal'))
})

const props = defineProps(
    {
        supplier: Object,
        addresses: {
            default: [],
            type: Array,
        },
        persons: {
            default: [],
            type: Array,
        },
        categories: Object,
        supplierCategories: {
            default: [],
            type: Array,
        },
        tags: Object,
        supplierTags: {
            default: [],
            type: Array,
        },
    })

let deleteAddressModal = null
let deletePersonModal = null
let addressToDelete = ref({})
let personToDelete = ref({})

function setAddressToDelete(addressId, addressName) {
    deleteAddressModal.toggle()
    addressToDelete.value = {
        id: addressId,
        name: addressName,
    };
}

function setPersonToDelete(fname, lname, id) {
    deletePersonModal.show()
    personToDelete.value = {
        id: id,
        fname: fname,
        lname: lname,
    }
}

function deleteAddress() {
    Inertia.delete(route('address.destroy', addressToDelete.value.id))
    deleteAddressModal.hide()
}

function deletePerson() {
    Inertia.delete(route('person.destroy', personToDelete.value.id))
    deletePersonModal.hide()
}
</script>
