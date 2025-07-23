<script setup lang="ts">
import { Event } from '@/types/event';
import GuestLayout from '@/layouts/GuestLayout.vue';
import EventShow from '@/components/EventShow.vue';
import { Button } from '@/components/ui/button';
import EventSignUpModal from '@/components/EventSignUpModal.vue';
import { ref } from 'vue';

const props = defineProps<{
    event: Event;
}>();
const showModal = ref<boolean>(false);
</script>

<template>
    <GuestLayout>
        <EventShow :event="event" />
        <EventSignUpModal @close="showModal = false" :event-title="event.title" :show="showModal" :event-id="event.id" :event-slug="event.slug" />
        <div class="mx-auto flex max-w-5xl justify-end px-4 py-10 sm:px-6 lg:px-8">
            <Button @click="showModal = true">Sign up now!</Button>
        </div>
    </GuestLayout>
</template>

<style scoped></style>
