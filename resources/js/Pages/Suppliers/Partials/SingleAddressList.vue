<template>
    <dl :id="id"
        class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
        <div class="flex flex-col pb-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Addresstyp</dt>
            <dd class="text-lg font-semibold">{{ capitalizeWord(Address.type.de[address.type]) }}</dd>
        </div>
        <div class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Name 1</dt>
            <dd class="text-lg font-semibold">{{ address.name1 }}</dd>
        </div>
        <div v-if="address.name2"
             class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Name 2</dt>
            <dd class="text-lg font-semibold">{{ address.name2 }}</dd>
        </div>
        <div v-if="address.name3"
             class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Name 3</dt>
            <dd class="text-lg font-semibold">{{ address.name3 }}</dd>
        </div>
        <div class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Straße / Nr</dt>
            <dd class="text-lg font-semibold">{{ address.street }} {{ address.street_nr }}</dd>
        </div>
        <div class="flex flex-col pt-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">PLZ / Ort</dt>
            <dd class="text-lg font-semibold">{{ address.city_code }} {{ address.city }}</dd>
        </div>
        <div class="flex flex-col pt-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Land</dt>
            <dd class="text-lg font-semibold">{{ address.country }}</dd>
        </div>
        <div v-if="address.phone"
             class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Telefon</dt>
            <dd class="text-lg font-semibold">{{ address.phone }}</dd>
        </div>
    </dl>
</template>

<script setup>

import {capitalizeWord} from "@/utils";
import {Address} from "@/Localisation/Address";

defineProps(
    {
        address: {
            default: null,
            type   : Object,
        },
        id     : {
            default: null,
            type   : Number,
        }
    })
</script>