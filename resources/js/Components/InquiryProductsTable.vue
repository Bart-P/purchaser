<template>
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
                    {{
                        index - sortPricesByQuantities(product.prices)
                            .length === -1 ? '' : ', '
                    }}
                </span>
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
</template>

<script setup>
import BaseButton from '@/Components/BaseButton.vue';
import IconButton from '@/Components/IconButton.vue';

const props = defineProps({
    products: Object,
});

function sortPricesByQuantities($prices) {

    return $prices.sort((a, b) => a.quantity - b.quantity);
}
</script>