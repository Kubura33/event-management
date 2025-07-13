<script setup lang="ts">
import { Event } from '@/types/event';

const props = defineProps<{
    event: Event
}>()
</script>

<template>
    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <!-- Image -->
        <div class="rounded-lg overflow-hidden shadow mb-8">
            <img
                :src="event.imageUrl"
                :alt="event.title"
                class="w-full h-auto object-cover"
            />
        </div>

        <!-- Title & Meta -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ event.title }}
            </h1>
            <p class="text-sm text-muted-foreground mt-1">
                📍 {{ event.city }}, {{ event.country }} —
                🗓 {{ event.date }}
            </p>
        </div>

        <!-- Price & Capacity -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-6">
            <div class="text-lg">
                <span class="font-semibold">Price:</span>
                <span>
            {{ event.price > 0 ? `$${event.price}` : 'Free' }}
          </span>
            </div>
            <div class="text-lg">
                <span class="font-semibold">Capacity:</span>
                <span>{{ event.capacity }} attendees</span>
            </div>
        </div>

        <!-- Description -->
        <div class="prose dark:prose-invert max-w-none">
            <p>{{ event.description }}</p>
        </div>

        <!-- Address -->
        <div class="mt-8 text-sm text-muted-foreground">
            <h2 class="text-base font-medium text-gray-900 dark:text-white">Location</h2>
            <p>
                {{ event.address }},
                {{ event.city }},
                {{ event.zipcode ? event.zipcode + ',' : '' }}
                {{ event.country }}
            </p>
        </div>
    </div>
</template>

<style scoped>

</style>
