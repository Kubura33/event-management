<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { Event } from '@/types/event'
import { BreadcrumbItem } from '@/types';
import EventShow from '@/components/EventShow.vue';

const props = defineProps<{
    event: Event
}>()
const breadCrumbs: BreadcrumbItem[] = [
    {
        title: 'My Events',
        href: '/events',
    },
    {
        title: 'Show Event',
        href: route('events.show', { id: props.event.id })
    }
];
</script>

<template>
    <Head :title="event.title" />

    <AppLayout :breadcrumbs="breadCrumbs">
        <EventShow :event="event" />
    </AppLayout>
</template>
