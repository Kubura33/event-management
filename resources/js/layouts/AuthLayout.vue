<script setup lang="ts">
import AuthLayout from '@/layouts/auth/AuthSimpleLayout.vue';
import { Toaster } from '@/components/ui/sonner';
import { toast } from 'vue-sonner';
import { usePage } from '@inertiajs/vue3';
import { watch } from 'vue';

defineProps<{
    title?: string;
    description?: string;
}>();

// Get the page props
const page = usePage();

// Watch for changes in flash notification
watch(() => page.props.flash.notification, (notification) => {
    if (notification) {
        toast(notification.message);
    }
}, { immediate: true });
</script>

<template>
    <AuthLayout :title="title" :description="description">
        <Toaster />
        <slot />
    </AuthLayout>
</template>
