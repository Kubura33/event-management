<script setup lang="ts">
import { BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Event } from '@/types/event'
import EventCard from '@/components/EventCard.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { ref, computed } from 'vue';

interface Props {
    events: Event[]
}

const props = defineProps<Props>()
const searchQuery = ref('');
const searchLocation = ref('');

// Filter events based on search queries
const filteredEvents = computed(() => {
    if (!searchQuery.value && !searchLocation.value) return props.events;

    return props.events.filter(event => {
        const matchesTitle = event.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
                            event.description.toLowerCase().includes(searchQuery.value.toLowerCase());

        const matchesLocation = !searchLocation.value ||
                               event.city.toLowerCase().includes(searchLocation.value.toLowerCase()) ||
                               event.country.toLowerCase().includes(searchLocation.value.toLowerCase());

        return matchesTitle && matchesLocation;
    });
});

// Handle add event button click
const handleAddEvent = () => {
    // Navigate to event creation page or open modal
    console.log('Add event clicked');
    // You can implement the actual navigation or modal opening here
};

const breadCrumbs: BreadcrumbItem[] = [
    {
        title: 'My Events',
        href: '/events'
    }
]
</script>

<template>
    <Head title="My events" />

    <AppLayout :breadcrumbs="breadCrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <!-- Header with Add Event button and search -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-2">
                <Button @click="handleAddEvent" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Event
                </Button>

                <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                    <div class="relative w-full sm:w-64">
                        <Input
                            v-model="searchQuery"
                            placeholder="Search events..."
                            class="pr-8"
                        />
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 absolute right-3 top-1/2 transform -translate-y-1/2 text-muted-foreground"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <div class="relative w-full sm:w-48">
                        <Input
                            v-model="searchLocation"
                            placeholder="Filter by location"
                            class="pr-8"
                        />
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 absolute right-3 top-1/2 transform -translate-y-1/2 text-muted-foreground"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Results count -->
            <p class="text-sm text-muted-foreground">
                Showing {{ filteredEvents.length }} {{ filteredEvents.length === 1 ? 'event' : 'events' }}
            </p>

            <!-- Grid of event cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <EventCard
                    v-for="event in filteredEvents"
                    :key="event.id"
                    :event="event"
                    @edit="(event) => console.log('Edit event', event)"
                    @delete="(event) => console.log('Delete event', event)"
                />
            </div>

            <!-- Empty state -->
            <div v-if="filteredEvents.length === 0" class="flex flex-col items-center justify-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-muted-foreground mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="text-lg font-medium">No events found</h3>
                <p class="text-muted-foreground text-sm mt-1">Try adjusting your search or create a new event.</p>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
</style>
