<script setup lang="ts">
import EventSignUpModal from '@/components/EventSignUpModal.vue';
import { Event } from '@/types/event';
import { Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps<{ event: Event }>();

// Format date to a more readable format
const formattedDate = computed(() => {
    return new Date(props.event.date).toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
});

//Truncate description
const truncateBySentence = (text: string, maxSentences = 1.5): string => {
    const parts = text.split(/(?<=[.?!])\s+/); // split by sentence endings
    if (parts.length <= maxSentences) return text;
    return parts.slice(0, Math.ceil(maxSentences)).join(' ') + '...';
};

//Show sign up modal

const showModal = ref<boolean>(false);
</script>

<template>
    <div class="event-card relative overflow-hidden rounded-xl bg-white shadow-md">
        <div class="relative h-48 bg-gray-200">
            <img :src="event.imageUrl" :alt="event.title" v-if="event.imageUrl" class="h-full w-full object-cover" />
            <svg v-else class="absolute inset-0 h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm16 2H4v12h16V6zM6 9h12v2H6V9zm0 4h8v2H6v-2z" />
            </svg>
            <span class="badge">{{ event.price ? '$' + event.price : 'Free' }}</span>
        </div>
        <div class="p-5">
            <div class="mb-2 flex items-center text-sm text-gray-500">
                <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd"
                    />
                </svg>
                <span>{{ formattedDate }}</span>
            </div>
            <h3 class="mb-2 text-xl font-semibold text-gray-900">{{ event.title }}</h3>
            <p class="mb-4 line-clamp-2 text-gray-600">{{ truncateBySentence(event.description) }}</p>
            <div class="mb-3 flex items-center text-sm text-gray-500">
                <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        fill-rule="evenodd"
                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                        clip-rule="evenodd"
                    />
                </svg>
                <span>New York, USA</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="text-sm text-gray-500">
                        <span class="font-medium text-indigo-600">{{ event.attendees ?? 0 }}</span> / {{ event.capacity }} attending
                    </div>
                </div>
                <Link
                    :href="route('event', { event: event.slug })"
                    class="inline-flex items-center rounded-md border border-transparent bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700 hover:bg-indigo-200"
                >
                    View Details
                </Link>
            </div>
        </div>
    </div>
    <EventSignUpModal @close="showModal = false" :show="showModal" :event-id="event.slug" :event-title="event.title" />
</template>

<style scoped>

</style>
