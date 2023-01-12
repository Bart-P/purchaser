<script setup>
import { ref } from 'vue';
import TopNavBar from "@/Components/TopNavBar.vue";

</script>

<template>
    <div>
        <div class="min-h-screen bg-purchaser-light">
            
            <TopNavBar />

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
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
        </div>
    </div>
</template>