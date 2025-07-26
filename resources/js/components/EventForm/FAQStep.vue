<script setup lang="ts">
import { ref } from 'vue';

defineEmits(['back']);

type FAQItem = {
    question: string;
    answer: string;
};

const faqs = ref<FAQItem[]>([
    {
        question: '',
        answer: '',
    },
]);

const addFAQ = () => {
    faqs.value.push({
        question: '',
        answer: '',
    });
};

const removeFAQ = (index: number) => {
    faqs.value.splice(index, 1);
};
</script>


<template>
    <!-- Step 4: FAQ -->
    <div id="step-4" class="form-step">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Frequently Asked Questions</h2>
        <p class="text-gray-600 mb-6">
            Add common questions and answers that attendees might have about your event.
        </p>

        <div class="space-y-4">
            <div
                v-for="(faq, index) in faqs"
                :key="index"
                class="bg-white border border-gray-200 rounded-lg p-4"
            >
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Question <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            v-model="faq.question"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            required
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Answer <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            v-model="faq.answer"
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            required
                        ></textarea>
                    </div>
                </div>

                <div class="mt-4 flex justify-end">
                    <button
                        v-if="faqs.length > 1"
                        @click="removeFAQ(index)"
                        type="button"
                        class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-md text-sm font-medium"
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
                class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm font-medium flex items-center"
            >
                <svg
                    class="h-5 w-5 mr-1"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    ></path>
                </svg>
                Add Another Question
            </button>
        </div>

        <div class="mt-8 flex justify-between">
            <button
                @click="$emit('back')"
                type="button"
                class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-md text-sm font-medium"
            >
                Back: Speakers
            </button>
            <button
                type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md text-sm font-medium"
            >
                Create Event
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>
