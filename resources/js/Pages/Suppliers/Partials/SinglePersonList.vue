<template>
    <dl :id="id"
        class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
        <div class="flex flex-col pb-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Kontakttyp</dt>
            <dd class="text-lg font-semibold">{{ person.type }}</dd>
        </div>
        <div class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Geschlecht</dt>
            <dd class="text-lg font-semibold">{{ person.gender }}</dd>
        </div>
        <div class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Vorname / Nachname</dt>
            <dd class="text-lg font-semibold">{{ person.first_name }} {{ person.last_name }}</dd>
        </div>
        <div v-if="person.position"
             class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Position</dt>
            <dd class="text-lg font-semibold">{{ person.position }}</dd>
        </div>
        <div v-if="person.phone1"
             class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Telefon</dt>
            <dd class="text-lg font-semibold">{{ person.phone1 }}</dd>
        </div>
        <div v-if="person.phone2"
             class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">Telefon 2</dt>
            <dd class="text-lg font-semibold">{{ person.phone2 }}</dd>
        </div>
        <div v-if="person.email1"
             class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">E-Mail</dt>
            <dd class="text-lg font-semibold">{{ person.email1 }}</dd>
        </div>
        <div v-if="person.email2"
             class="flex flex-col py-3">
            <dt class="mb-1 text-gray-500 text-sm dark:text-gray-400">E-Mail 2</dt>
            <dd class="text-lg font-semibold">{{ person.email2 }}</dd>
        </div>
    </dl>
</template>

<script setup>

defineProps(
    {
        person: {
            default: null,
            type   : Object,
        },
        id    : {
            default: null,
            type   : Number,
        }
    })
</script>