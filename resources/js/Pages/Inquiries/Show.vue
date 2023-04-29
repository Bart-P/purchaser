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
                    <BaseButton color="edit" class="!px-3 rounded-full text-sm">
                        <i class="fa-solid fa-pen"></i>
                    </BaseButton>
                    <BaseButton color="back" class="!px-3 rounded-full text-sm">
                        <i class="fa-solid fa-delete-left"></i>
                    </BaseButton>
                </div>
            </div>
        </template>

        <div class="py-12">
            <PageBoxWrapper>
                <div class="flex gap-3">
                    <div class="card basis-1/3">
                        <h3 class="heading-3">Anfrage Daten</h3>
                        <table class="text-left">
                            <tr class="table-row">
                                <th class="w-2/5">Projekt Titel:</th>
                                <td class="table-data">
                                    {{ props.inquiry.title }}
                                </td>
                            </tr>
                            <tr class="table-row">
                                <th class="w-2/5">Projekt Nr:</th>
                                <td class="table-data">
                                    {{ props.inquiry.project }}
                                </td>
                            </tr>
                            <tr class="table-row">
                                <th class="w-2/5">Leiter:</th>
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
                            <tr class="table-row">
                                <th class="w-2/5">Letztes Update</th>
                                <td class="table-data">
                                    {{ new Date(props.inquiry.updated_at).toLocaleString('de').slice(0, -3) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card basis-2/3">
                        <div class="flex flex-col content-between justify-between h-full">
                            <div class="">
                                <h3 class="heading-3 pb-3">Beschreibung</h3>
                                <p class="">
                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo ad harum quaerat alias
                                    quae
                                    autem
                                    excepturi voluptas tenetur!
                                    Dolorum cum facere eveniet ducimus incidunt facilis voluptates
                                    quaerat, commodi non omnis.
                                </p>
                            </div>
                            <div class="">
                                <hr>
                                <h3 class="heading-3 py-3">Anhänge</h3>
                                <ul class="flex flex-wrap mb-6 text-gray-900 dark:text-white">
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
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue'
import { Head } from "@inertiajs/inertia-vue3";
import BaseButton from '@/Components/BaseButton.vue';

const props = defineProps({
    inquiry: Object
});

</script>