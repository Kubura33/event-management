<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

defineEmits(['back']);

type FAQItem = {
    question: string;
    answer: string;
};

const form = useForm<{
    faqs: FAQItem[];
    step: string;
    final: boolean;
}>({
    faqs: [
        {
            question: '',
            answer: '',
        },
    ],
    step: 'faqs',
    final: true
});

const addFAQ = () => {
    form.faqs.push({
        question: '',
        answer: '',
    });
};

const removeFAQ = (index: number) => {
    form.faqs.splice(index, 1);
};
</script>

<template>
    <!-- Step 4: FAQ -->
    <div id="step-4" class="form-step">
        <h2 class="mb-6 text-xl font-bold text-gray-900">Frequently Asked Questions</h2>
        <p class="mb-6 text-gray-600">Add common questions and answers that attendees might have about your event.</p>

        <div class="space-y-4">
            <div v-for="(faq, index) in form.faqs" :key="index" class="rounded-lg border border-gray-200 bg-white p-4">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700"> Question <span class="text-red-500">*</span> </label>
                        <input
                            type="text"
                            v-model="faq.question"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            required
                        />
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700"> Answer <span class="text-red-500">*</span> </label>
                        <textarea
                            v-model="faq.answer"
                            rows="3"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            required
                        ></textarea>
                    </div>
                </div>

                <div class="mt-4 flex justify-end">
                    <button
                        v-if="form.faqs.length > 1"
                        @click="removeFAQ(index)"
                        type="button"
                        class="rounded-md bg-red-100 px-3 py-1 text-sm font-medium text-red-700 hover:bg-red-200"
                    >
                        Remove Question
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button
                type="button"
                @click="addFAQ"
                class="flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                <svg class="mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Another Question
            </button>
        </div>

        <div class="mt-8 flex justify-between">
            <button
                @click="$emit('back')"
                type="button"
                class="rounded-md border border-gray-300 bg-white px-6 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Back: Speakers
            </button>
            <button type="submit" class="rounded-md bg-green-600 px-6 py-2 text-sm font-medium text-white hover:bg-green-700">Create Event</button>
        </div>
    </div>
</template>

<style scoped></style>
