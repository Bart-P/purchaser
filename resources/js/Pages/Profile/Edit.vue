<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto space-y-6">
                <PageBoxWrapper>
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </PageBoxWrapper>
                <PageBoxWrapper>
                    <UpdatePasswordForm class="max-w-xl" />
                </PageBoxWrapper>

                <PageBoxWrapper>
                    <DeleteUserForm class="max-w-xl" />
                </PageBoxWrapper>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import PageBoxWrapper from '@/Components/PageBoxWrapper.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps({
                mustVerifyEmail: Boolean,
                status         : String,
            });
</script>