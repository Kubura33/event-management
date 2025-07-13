<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

const appName = 'Ventry'
</script>

<template>
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-md py-4">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-indigo-600">{{ appName }}</h1>
                <nav>
                    <Link href="/" class="text-gray-700 hover:text-indigo-500 px-3">Home</Link>
                    <Link href="/login" class="text-gray-700 hover:text-indigo-500 px-3">Login</Link>
                </nav>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-grow">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-gray-100 text-center py-4 text-sm text-gray-500">
            © {{ new Date().getFullYear() }} {{ appName }}. All rights reserved.
        </footer>
    </div>
</template>

<style scoped>

</style>
