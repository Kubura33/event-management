<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import NavigationHeader from '@/components/Guest/NavigationHeader.vue';
import Footer from '@/components/Guest/Footer.vue';

const appName = 'Ventry'
</script>

<template>
    <div class="min-h-screen flex flex-col bg-[#f8f9fc] font-inter">
        <!-- Header -->
        <NavigationHeader />

        <!-- Content -->
        <main class="flex-grow">
            <slot />
        </main>

        <Footer />
    </div>
</template>

<style scoped>

</style>
