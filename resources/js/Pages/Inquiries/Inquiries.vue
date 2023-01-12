<template>
    <Head title="Anfragen" />
    
    <AuthenticatedLayout>
        <template #header>
            Alle Anfragen
        </template>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Hier kommt die Tabelle mit allen Anfragen hin</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/inertia-vue3";
</script>