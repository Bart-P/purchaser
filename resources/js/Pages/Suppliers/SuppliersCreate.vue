<template>
    <Head title="Lieferanten Hinzufügen" />
    
    <AuthenticatedLayout>
        <template #header>
            Neuen Lieferant Hinzufügen
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form class="py-3 px-3">
                        Neue Form kommt hier hin
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/inertia-vue3";
</script>