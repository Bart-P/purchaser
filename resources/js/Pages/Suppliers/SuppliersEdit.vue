<template>
    <Head title="Lieferant Bearbeiten" />
    
    <AuthenticatedLayout>
        <template #header>
            Lieferant Bearbeiten
        </template>
        <div class="py-12 w-full h-full flex flex-col gap-8">
            <!-- add Company Form -->
            <PageBoxWrapper>
                <AddSupplierForm :supplier="props.supplier"
                                 :persons="props.persons"
                                 :addresses="props.addresses" />
            </PageBoxWrapper>
            
            <BaseModal id="addAddressModal">
                <AddAddressForm :supplier="props.supplier"
                                :addresses="props.addresses" />
            </BaseModal>
            
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
                    <div v-for="(address, index) in props.addresses"
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
            
            <BaseModal id="addPersonModal">
                <AddPersonForm :persons="persons" />
            </BaseModal>
            
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
                    
                    <div class="flex flex-wrap gap-8 pt-8">
                        <template v-for="(person, index) in persons">
                            <div class="w-[31.5%] max-w-md min-w-[250px] p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <button class="float-right text-red-600"
                                        type="submit"
                                        @click="removePerson(index)">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <SinglePersonList :id="index"
                                                  :person="person" />
                            </div>
                        </template>
                    
                    </div>
                </div>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/inertia-vue3";
import {onMounted} from "vue";
import {initModals} from "flowbite";
import BaseButton from "@/Components/BaseButton.vue";
import PageBoxWrapper from "@/Components/PageBoxWrapper.vue";
import AddSupplierForm from "@/Pages/Suppliers/Partials/AddSupplierForm.vue";
import AddAddressForm from "@/Pages/Suppliers/Partials/AddAddressForm.vue";
import SingleAddressList from "@/Pages/Suppliers/Partials/SingleAddressList.vue";
import AddPersonForm from "@/Pages/Suppliers/Partials/AddPersonForm.vue";
import BaseModal from "@/Components/BaseModal.vue";
import SinglePersonList from "@/Pages/Suppliers/Partials/SinglePersonList.vue";

onMounted(() => {
    initModals()
})

const props = defineProps(
    {
        'supplier' : Object,
        'addresses': Array,
        'persons'  : Array
    })


function removeAddress(index) {
    props.addresses.splice(index, 1)
}

function removePerson(index) {
    props.persons.splice(index, 1)
}
</script>