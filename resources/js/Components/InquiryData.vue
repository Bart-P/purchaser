<template>
    <div class="flex justify-between items-center mb-3">
        <h3 class="heading-3">Anfrage Daten</h3>
        <BaseButton :href="route('inquiries.edit', inquiry.id)" color="edit" class="!px-3 rounded-full text-sm">
            <i class="fa-solid fa-pen"></i>
        </BaseButton>
    </div>

    <div class="flex gap-3">
        <div class="card basis-1/2">
            <table class="text-left">
                <tr class="table-row">
                    <th class="w-2/5">Projekt Titel</th>
                    <td class="table-data">
                        {{ inquiry.title }}
                    </td>
                </tr>
                <tr class="table-row">
                    <th class="w-2/5">Status</th>
                    <td class="table-data">
                        <StatusBadge :status="inquiry.status" />
                    </td>
                </tr>
                <tr class="table-row">
                    <th class="w-2/5">Abgabe Preis bis</th>
                    <td class="table-data">
                        {{ dateToDMY(inquiry.offers_until) }}
                    </td>
                </tr>
                <tr class="table-row">
                    <th class="w-2/5">Geplater Liefertermin</th>
                    <td class="table-data">
                        {{ dateToDMY(inquiry.delivery_date) }}
                    </td>
                </tr>
                <tr class="table-row">
                    <th class="w-2/5">Projekt Nr.</th>
                    <td class="table-data">
                        {{ inquiry.project }}
                    </td>
                </tr>
                <tr class="table-row">
                    <th class="w-2/5">Leiter</th>
                    <td class="table-data">
                        {{ inquiry.pm }}
                    </td>
                </tr>
                <tr class="table-row">
                    <th class="w-2/5">Kunde</th>
                    <td class="table-data">
                        {{ inquiry.client }}
                    </td>
                </tr>
                <tr class="table-row">
                    <th class="w-2/5">Erstellt am</th>
                    <td class="table-data">
                        {{ dateToDMYHM(inquiry.created_at) }}
                    </td>
                </tr>
                <tr class="">
                    <th class="w-2/5">Letztes Update</th>
                    <td class="table-data">
                        {{ dateToDMYHM(inquiry.updated_at) }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="card basis-1/2">
            <div class="flex flex-col content-between gap-3 h-full">
                <div class="">
                    <h4 class="heading-4 py-3">Anhänge</h4>
                    <ul class="flex flex-wrap mb-6 text-gray-900 dark:text-white">
                        <!-- TODO - make uploads work -->
                        <li>
                            <a href="#" class="hover:underline mr-3">bild1.jpg;</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline mr-3">bild2.jpg;</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline mr-3">bild3.jpg;</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline mr-3">bild4.jpg;</a>
                        </li>
                    </ul>
                    <hr>
                </div>
                <div class="h-full">
                    <h4 class="heading-4 pb-3">Beschreibung</h4>
                    <p v-html="inquiry.description" style="white-space: pre-wrap" class="overflow-hidden"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import BaseButton from '@/Components/BaseButton.vue';
import { dateToDMY, dateToDMYHM } from '@/utils';
import StatusBadge from './StatusBadge.vue';

const props = defineProps({
    inquiry: Object,
});

</script>