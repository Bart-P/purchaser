<script setup>
import ToastList from '@/Components/ToastList.vue';
import TopNavBar from '@/Components/TopNavBar.vue';</script>

<template>
    <div>
        <div class="min-h-screen bg-purchaser-light">
            <ToastList />
            <TopNavBar />
            <!-- Page Heading -->
            <header class="bg-white shadow"
                    v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-purchaser-dark leading-tight">
                        <slot name="header" />
                    </h2>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>

            <!-- Page Footer -->
            <footer class="p-16 bg-white relative bottom-0 left-0 right-0 border-t-gray-200 border-t-[1px] shadow">
                <h3 class="text-2xl text-center text-gray-400">Made by bartp</h3>
            </footer>
        </div>
    </div>
</template>