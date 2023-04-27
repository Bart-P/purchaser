<template>
    <Head title="Anfrage" />

    <AuthenticatedLayout>
        <template #header>
            Anfrage ID: {{ props.inquiry.id }}
        </template>

        <div class="py-12">
            <PageBoxWrapper>
                <h1 class="heading-1">{{ props.inquiry.title }}</h1>
            </PageBoxWrapper>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue'
import Head from '@inertiajs/inertia-vue3'

const props = defineProps({
    inquiry: Object
});

</script>


