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
            
            <BaseModal id="addAddressModal">
                <AddAddressForm :addresses="addresses"></AddAddressForm>
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
            
            <BaseModal id="addPersonModal">
                <AddPersonForm />
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
import BaseButton from "@/Components/BaseButton.vue";
import PageBoxWrapper from "@/Components/PageBoxWrapper.vue";
import AddSupplierForm from "@/Components/AddSupplierForm.vue";
import AddAddressForm from "@/Components/AddAddressForm.vue";
import SingleAddressList from "@/Components/SingleAddressList.vue";
import AddPersonForm from "@/Components/AddPersonForm.vue";
import BaseModal from "@/Components/BaseModal.vue";

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