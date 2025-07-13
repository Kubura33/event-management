<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { toast } from 'vue-sonner';
import { Toaster } from '@/components/ui/sonner';
import { usePage } from '@inertiajs/vue3';
import { watch } from 'vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

const props = withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

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
    <AppLayout :breadcrumbs="breadcrumbs">
        <Toaster />
        <slot />
    </AppLayout>
</template>
