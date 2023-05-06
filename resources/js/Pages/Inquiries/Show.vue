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
                <InquiryData :inquiry="inquiry"></InquiryData>
            </PageBoxWrapper>
            <PageBoxWrapper>
                <InquiryProductsTable :products="products"></InquiryProductsTable>
            </PageBoxWrapper>
            <!-- TODO Extract to its own component -->
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
import InquiryData from '@/Components/InquiryData.vue'
import InquiryProductsTable from '@/Components/InquiryProductsTable.vue'

const props = defineProps({
    inquiry: Object,
    products: Object,
    inquiryRequests: Object,
});

function sortPricesByQuantities($prices) {

    return $prices.sort((a, b) => a.quantity - b.quantity);
}
</script>