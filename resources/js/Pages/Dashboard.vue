<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Übersicht
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Mal gucken ob wir das Dashboard brauchen. Solle eine Übersicht sein mit offenen Anfragen und Lieferanten bei den noch angebote ausstehen</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>