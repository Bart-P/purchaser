<template>
    <Head title="Anfrage" />

    <AuthenticatedLayout>
        <template #header>
            Anfrage ID: {{ props.inquiry.id }}
        </template>

        <div class="py-12">
            <PageBoxWrapper>
                <h1 class="heading-3 text-center">{{ props.inquiry.title }}</h1>
                <table class="text-left">
                    <tr class="table-row">
                        <th class="table-data">Projekt Nr:</th>
                        <td class="table-data">{{ props.inquiry.project }}</td>
                    </tr>
                    <tr class="table-row">
                        <th class="table-data">Projekt Manager:</th>
                        <td class="table-data">{{ props.inquiry.pm }}</td>
                    </tr>
                    <tr class="table-row">
                        <th class="table-data">Kunde</th>
                        <td class="table-data">{{ props.inquiry.client }}</td>
                    </tr>
                    <tr class="table-row">
                        <th class="table-data">Erstellt am</th>
                        <td class="table-data">{{ new Date(props.inquiry.created_at).toLocaleString('de').slice(0, -3) }}
                        </td>
                    </tr>
                    <tr class="table-row">
                        <th class="table-data">Letztes Update</th>
                        <td class="table-data">{{ new Date(props.inquiry.updated_at).toLocaleString('de').slice(0, -3) }}
                        </td>
                    </tr>
                </table>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue'
import { Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
    inquiry: Object
});

</script>