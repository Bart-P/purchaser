<template>
    <Head title="Anfrage" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <div class="">
                    Anfrage ID {{ props.inquiry.id }}:
                    <span class="text-gray-500">{{ props.inquiry.title }}</span>
                </div>
                <div class="space-x-3">
                    <BaseButton color="danger" class="!px-3 rounded-full text-sm">
                        <i class="fa-solid fa-trash"></i>
                    </BaseButton>
                    <BaseButton :href="route('inquiries')" color="back" class="!px-3 rounded-full text-sm">
                        <i class="fa-solid fa-delete-left"></i>
                    </BaseButton>
                </div>
            </div>
        </template>

        <div class="py-12 space-y-6">
            <PageBoxWrapper>
                <div class="flex justify-between items-center mb-3">
                    <h3 class="heading-3">Anfrage Daten</h3>
                    <BaseButton color="edit" class="!px-3 rounded-full text-sm">
                        <i class="fa-solid fa-pen"></i>
                    </BaseButton>
                </div>
                <div class="flex gap-3">
                    <div class="card basis-1/2">
                        <table class="text-left">
                            <tr class="table-row">
                                <th class="w-2/5">Projekt Titel</th>
                                <td class="table-data">
                                    {{ props.inquiry.title }}
                                </td>
                            </tr>
                            <tr class="table-row">
                                <th class="w-2/5">Abgabe Preis bis</th>
                                <td class="table-data">
                                    {{ new Date(props.inquiry.offers_until).toLocaleString('de').slice(0, -10) }}
                                </td>
                            </tr>
                            <tr class="table-row">
                                <th class="w-2/5">Geplater Liefertermin</th>
                                <td class="table-data">
                                    {{ new Date(props.inquiry.delivery_date).toLocaleString('de').slice(0, -10) }}
                                </td>
                            </tr>
                            <tr class="table-row">
                                <th class="w-2/5">Projekt Nr.</th>
                                <td class="table-data">
                                    {{ props.inquiry.project }}
                                </td>
                            </tr>
                            <tr class="table-row">
                                <th class="w-2/5">Leiter</th>
                                <td class="table-data">
                                    {{ props.inquiry.pm }}
                                </td>
                            </tr>
                            <tr class="table-row">
                                <th class="w-2/5">Kunde</th>
                                <td class="table-data">
                                    {{ props.inquiry.client }}
                                </td>
                            </tr>
                            <tr class="table-row">
                                <th class="w-2/5">Erstellt am</th>
                                <td class="table-data">
                                    {{ new Date(props.inquiry.created_at).toLocaleString('de').slice(0, -3) }}
                                </td>
                            </tr>
                            <tr class="">
                                <th class="w-2/5">Letztes Update</th>
                                <td class="table-data">
                                    {{ new Date(props.inquiry.updated_at).toLocaleString('de').slice(0, -3) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card basis-1/2">
                        <div class="flex flex-col content-between justify-between h-full">
                            <div class="">
                                <h4 class="heading-4 pb-3">Beschreibung</h4>
                                <p class="">
                                    {{ inquiry.description }}
                                </p>
                            </div>
                            <div class="">
                                <hr>
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
                            </div>
                        </div>
                    </div>
                </div>
            </PageBoxWrapper>
            <PageBoxWrapper>
                <div class="flex justify-between items-center mb-3">
                    <h3 class="heading-3 pb-3">Produkte</h3>
                    <BaseButton color="success" class="!px-3 rounded-full text-sm">
                        <i class="fa-solid fa-cart-plus"></i>
                    </BaseButton>
                </div>
                <table class="table">
                    <thead class="table-head">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Titel</th>
                            <th class="p-4">Auflagen</th>
                            <th class="p-4">Erstellt am</th>
                            <th class="p-4">Letztes update</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tr v-for="product in products" class="table-row">
                        <td class="table-data">{{ product.id }}</td>
                        <td class="table-data">{{ product.title }}</td>
                        <td class="table-date">
                            <span v-for="$price, index in sortPricesByQuantities(product.prices)">
                                {{ $price.quantity }}
                                {{ index - sortPricesByQuantities(product.prices).length ===
                                    -1 ? '' : ', '
                                }}</span>
                        </td>
                        <td class="table-data">{{ product.created_at }}</td>
                        <td class="table-data">{{ product.updated_at }}</td>
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
            </PageBoxWrapper>
            <PageBoxWrapper>
                <h3 class="heading-3">Lieferantenanfragen</h3>
                <table class="table">
                    <thead class="table-head">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Titel</th>
                            <th class="p-4">Auflagen</th>
                            <th class="p-4">Erstellt am</th>
                            <th class="p-4">Letztes update</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tr v-for="product in products" class="table-row">
                        <td class="table-data">{{ product.id }}</td>
                        <td class="table-data">{{ product.title }}</td>
                        <td class="table-date">
                            <span v-for="$price, index in sortPricesByQuantities(product.prices)">
                                {{ $price.quantity }}
                                {{ index - sortPricesByQuantities(product.prices).length ===
                                    -1 ? '' : ', '
                                }}</span>
                        </td>
                        <td class="table-data">{{ product.created_at }}</td>
                        <td class="table-data">{{ product.updated_at }}</td>
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
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue'
import { Head } from "@inertiajs/vue3";
import BaseButton from '@/Components/BaseButton.vue';
import IconButton from '@/Components/IconButton.vue';

const props = defineProps({
    inquiry: Object,
    products: Object,
});

function sortPricesByQuantities($prices) {

    return $prices.sort((a, b) => a.quantity - b.quantity);
}
</script>