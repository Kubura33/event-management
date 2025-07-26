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
    </GuestLayout>
</template>

<style scoped></style>
