<script setup lang="ts">
import EventSignUpModal from '@/components/EventSignUpModal.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
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
    <Card class="w-full h-full flex flex-col justify-between">
        <!-- Image -->
        <div class="relative">
            <img
                :src="event.imageUrl || '/ventry-logo.png'"
                alt="Event image"
                class="h-64 w-full object-cover"
            />
            <div class="absolute top-2 right-2 rounded bg-black/70 px-2 py-1 text-xs text-white">
                {{ formattedDate }}
            </div>
        </div>

        <!-- Header -->
        <CardHeader class="min-h-[50px]">
            <CardTitle>{{ event.title }}</CardTitle>
            <CardDescription>
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            fill-rule="evenodd"
                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    {{ event.city }}, {{ event.country }}
                </div>
            </CardDescription>
        </CardHeader>

        <!-- Content (flex-grow ensures it fills) -->
        <CardContent class="flex flex-col flex-grow justify-between min-h-[200px]">
            <!-- Truncated Description -->
            <p class="text-sm text-gray-700 mb-4 line-clamp-3">
                {{ truncateBySentence(event.description) }}
            </p>

            <div class="text-sm space-y-4">
                <!-- Location -->
                <div>
                    <p class="font-medium">Location</p>
                    <p class="text-muted-foreground">{{ event.address }}</p>
                    <p v-if="event.zipcode" class="text-muted-foreground">ZIP: {{ event.zipcode }}</p>
                </div>

                <!-- Attendance -->
                <div>
                    <p class="font-medium mb-1">Attendance</p>
                    <div class="h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                        <div
                            class="h-2.5 rounded-full bg-blue-600 transition-all duration-300"
                            :style="{ width: `${event.capacity > 0 ? ((parseInt(event.attendees || '0') / event.capacity) * 100) : 0}%` }"
                        ></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ event.attendees || 0 }}/{{ event.capacity }}
                    </p>
                </div>

                <!-- Price -->
                <div v-if="event.price">
                    <p class="font-medium">Price</p>
                    <p>${{ event.price }}</p>
                </div>
            </div>
        </CardContent>

        <!-- Footer -->
        <CardFooter class="mt-auto flex justify-end gap-2">
            <Button variant="outline" :as="Link" :href="route('event', { event: event.slug })">See more</Button>
            <Button @click="showModal = true">Sign up</Button>
        </CardFooter>
    </Card>


    <EventSignUpModal @close="showModal = false" :show="showModal" :event-id="event.slug" :event-title="event.title" :event-slug="event.slug" />
</template>

<style scoped></style>
