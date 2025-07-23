<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { watch, defineProps, defineEmits } from 'vue';
import { Input } from '@/components/ui/input';
import {Label} from '@/components/ui/label';

interface Props {
    show: boolean;
    eventId: number;
    eventTitle: string;
    eventSlug: string;
}

const props = defineProps<Props>();

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'submitted'): void;
}>();

const form = useForm({
    name: '',
    email: '',
    message: '',
    event_id: props.eventId,
});

// Update event_id and reset fields when modal opens
watch(
    () => props.show,
    (val) => {
        if (val) {
            form.reset();
            form.event_id = props.eventId;
        }
    },
);

const submit = () => {
    form.post(route('event.registration', {event: props.eventSlug}), {
        onSuccess: () => {
            emit('submitted');
            emit('close');
        },
    });
};
</script>

<template>
    <Transition name="fade">
        <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
            <div class="relative w-full max-w-md rounded-xl bg-white p-6 shadow-xl">
                <button @click="$emit('close')" class="absolute top-3 right-3 text-xl text-gray-400 hover:text-gray-700">&times;</button>

                <h2 class="mb-4 text-xl font-semibold">Register for: {{ eventTitle }}</h2>

                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <Label class="block text-sm font-medium">Full Name</Label>
                        <Input v-model="form.name" type="text" class="input" placeholder="Your name" />
                    </div>

                    <div class="mb-4">
                        <Label class="block text-sm font-medium">Email <span class="text-red-500">*</span></Label>
                        <Input v-model="form.email" type="email" class="input" required placeholder="you@example.com" />
                    </div>

                    <div >
                        <Label class="block text-sm font-medium">Message (optional)</Label>
                        <textarea
                            id="message"
                            rows="4"
                            class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50"
                            required
                            v-model="form.message"
                            placeholder="Say something..."
                        ></textarea>
                    </div>
                    <p class="text-xs text-blue-500 mb-1">After the registration you will receive an email for successful registration and a link if you wish to cancel</p>
                    <p class="text-xs text-red-500 mb-4">Cash for the event will be taken once you come to the event</p>
                    <button :disabled="form.processing" class="w-full rounded bg-indigo-600 px-4 py-2 font-semibold text-white hover:bg-indigo-700">
                        {{ form.processing ? 'Submitting...' : 'Submit Registration' }}
                    </button>
                </form>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
