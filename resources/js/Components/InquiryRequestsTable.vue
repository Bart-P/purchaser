<template>
    <h3 class="heading-3">Lieferantenanfragen</h3>
    <table class="table">
        <thead class="table-head">
            <tr>
                <th class="p-4">ID</th>
                <th class="p-4">Lieferant</th>
                <th class="p-4">Anfrage</th>
                <th class="p-4">Erstellt am</th>
                <th class="p-4">Letztes update</th>
                <th></th>
            </tr>
        </thead>

        <tr v-for="inquiryRequest in inquiryRequests" class="table-row">
            <td class="table-data">{{ inquiryRequest.id }}</td>
            <td class="table-data">{{ inquiryRequest.supplier_id }}</td>
            <td class="table-data">{{ inquiryRequest.inquiry_id }}</td>
            <td class="table-data">{{ inquiryRequest.created_at }}</td>
            <td class="table-data">{{ inquiryRequest.updated_at }}</td>
            <td class="space-x-3">
                <IconButton color="green">
                    <i class="fa-solid fa-eye"></i>
                </IconButton>
                <IconButton>
                    <i class="fa-solid fa-pen"></i>
                </IconButton>
                <IconButton color="red">
                    <i class="fa-solid fa-trash"></i>
                </IconButton>
            </td>
        </tr>
    </table>
</template>

<script setup>
import IconButton from '@/Components/IconButton.vue';

const props = defineProps({
    inquiryRequests: Object,
});
</script>
