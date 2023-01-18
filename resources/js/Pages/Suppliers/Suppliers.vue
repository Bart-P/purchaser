<template>
    <Head title="Lieferanten" />
    
    <AuthenticatedLayout>
        <template #header>
            Alle Lieferanten
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg py-4">
                        <SuppliersTableNav :suppliers="suppliers" />
                        
                        <SuppliersTable :suppliers="suppliers" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/inertia-vue3";
import SuppliersTable from "@/Pages/Suppliers/Partials/SuppliersTable.vue";
import {ref} from "vue";
import SuppliersTableNav from "@/Pages/Suppliers/Partials/SuppliersTableNav.vue";

const props = defineProps(
    {
        suppliers: Object,
        search   : {
            type   : Object,
            default: ref(''),
        }
    })

</script>