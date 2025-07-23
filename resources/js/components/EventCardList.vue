<script setup lang="ts">
import { Event } from '@/types/event';
import { Link } from '@inertiajs/vue3';
import { useFormattedDate } from '@/composables/useFormattedDate';
import { truncateBySentence } from '@/composables/useTruncatedSentence';

const props = defineProps<{ event: Event }>();

const { formattedDate } = useFormattedDate(props.event.date);
const shortDesc = truncateBySentence(props.event.description, 4);
</script>

<template>
    <div class="event-card overflow-hidden rounded-xl bg-white shadow-md">
        <div class="md:flex">
            <div class="relative h-48 bg-gray-200 md:h-64 md:w-2/4">
                <img :src="event.imageUrl" :alt="event.title" v-if="event.imageUrl" class="h-full w-full object-cover" />
                <svg v-else class="absolute inset-0 h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm16 2H4v12h16V6zM6 9h12v2H6V9zm0 4h8v2H6v-2z"
                    />
                </svg>
                <div class="absolute top-0 right-4">
                    <span class="badge bg-indigo-600" style="top: 8px !important; right: -5px !important">{{
                        event.price ? '$' + event.price : 'Free'
                    }}</span>
                </div>
            </div>
            <div class="p-5 md:w-2/4 flex flex-col">
                <div class="mb-2 flex flex-wrap items-start justify-between">
                    <h3 class="text-xl font-semibold text-gray-900">{{ event.title }}</h3>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span>{{ formattedDate }}</span>
                    </div>
                </div>
                <p class="mb-4 text-gray-600">{{ shortDesc }}</p>
                <div class="mt-auto flex flex-wrap items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <span>New York, USA</span>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="font-medium text-indigo-600">{{ event.attendees }}</span> / {{ event.capacity }} attending
                        </div>
                    </div>
                    <Link
                        :href="route('events.show', { event: event.slug })"
                        class="mt-2 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 sm:mt-0"
                    >
                        View Details
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
