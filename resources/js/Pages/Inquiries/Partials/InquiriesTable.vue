<template>
    <table class="table">
        <thead class="table-head">
            <tr>
                <th scope="col" class="px-6 py-3  max-w-[30px]">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Titel
                </th>
                <th scope="col" class="px-6 py-3">
                    Projektnummer
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
                <td class="table-data">{{ inquiry.status }}</td>
                <td class="table-data">{{ inquiry.title }}</td>
                <td class="table-data">{{ inquiry.project }}</td>
                <td class="table-data">{{ inquiry.pm }}</td>
                <td class="table-data">{{ new Date(inquiry.updated_at).toLocaleString('de').slice(0, -3) }}</td>
                <td class="table-data">
                    <button>button</button>
                </td>
            </tr>

        </tbody>
    </table>
</template>

<script setup>

const props = defineProps({
    'inquiries': Object,
});

</script>