<template>
    <table class="table">
        <thead class="table-head">
            <tr>
                <th scope="col" class="px-6 py-3  max-w-[30px]">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Projekt
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Titel
                </th>
                <th scope="col" class="px-6 py-3">
                    PM
                </th>
                <th scope="col" class="px-6 py-3">
                    Letzte Änderung
                </th>
                <th></th>
            </tr>
        </thead>

        <tbody class="text-black">
            <tr v-for="inquiry in inquiries" class="table-row">
                <td class="table-data">{{ inquiry.id }}</td>
                <td class="table-data">{{ inquiry.project }}</td>
                <td class="table-data">
                    <InquiryStatusDropdown :id="'InquiryStatusDropdown-' + inquiry.id" :current-status="inquiry.status"
                        :auto-update-inquiry="inquiry" />
                </td>
                <td class="table-data">{{ inquiry.title }}</td>
                <td class="table-data">{{ inquiry.pm }}</td>
                <td class="table-data">{{ dateToDMYHM(inquiry.updated_at) }}</td>
                <td class="table-data flex gap-3">
                    <IconButton color="green" :href="route('inquiries.show', inquiry.id)">
                        <i class="fa-solid fa-eye"></i>
                    </IconButton>
                    <IconButton :href="route('inquiries.edit', inquiry.id)" color="blue">
                        <i class="fa-solid fa-pen"></i>
                    </IconButton>
                    <DeleteInquiryWithConfirmation :id="'DeleteModalWithIcon-' + inquiry.id" :inquiry="inquiry"
                        button-type="icon" />
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
import IconButton from '@/Components/IconButton.vue';
import DeleteInquiryWithConfirmation from '@/Pages/Inquiries/Partials/DeleteInquiryWithConfirmation.vue';
import InquiryStatusDropdown from '@/Pages/Inquiries/Partials/InquiryStatusDropdown.vue';
import { dateToDMYHM } from '@/utils';

const props = defineProps({
    'inquiries': Object,
});

</script>