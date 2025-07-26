<script setup lang="ts">
import { Category } from '@/types/event';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineEmits(['next']);
const props = defineProps<{ categories: Category[] }>();

const overviewForm = useForm<{
    title: string;
    category_id: number | null;
    start_date: string;
    end_date: string;
    location: string;
    description: string;
    image: File | null;
    tags: string[];
}>({
    title: '',
    category_id: null,
    start_date: '',
    end_date: '',
    location: '',
    description: '',
    image: null,
    tags: [],
});

//Tags manipulation

const maxTags = 5;
const inputValue = ref('');
const tags = ref<string[]>([]);

const addTag = () => {
    const trimmed = inputValue.value.trim();
    if (trimmed && !tags.value.includes(trimmed) && tags.value.length < maxTags) {
        tags.value.push(trimmed);
    }
    inputValue.value = '';
};

const handleKey = (e: KeyboardEvent) => {
    if (e.key === 'Enter' || e.key === ',') {
        e.preventDefault();
        addTag();
    }
};

const removeTag = (tag: string) => {
    tags.value = tags.value.filter((t) => t !== tag);
};
</script>

<template>
    <div id="step-1" class="form-step active">
        <h2 class="mb-6 text-xl font-bold text-gray-900">Event Overview</h2>

        <div class="space-y-6">
            <!-- Event Name -->
            <div>
                <label for="event-name" class="mb-1 block text-sm font-medium text-gray-700">Event Name <span class="text-red-500">*</span></label>
                <input
                    type="text"
                    id="event-name"
                    name="event-name"
                    v-model="overviewForm.title"
                    required
                    class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                />
            </div>

            <!-- Event Category -->
            <div>
                <label for="event-category" class="mb-1 block text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                <select
                    id="event-category"
                    name="event-category"
                    v-model="overviewForm.category_id"
                    required
                    class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                >
                    <option value="" disabled selected>Select a category</option>
                    <option value="technology" v-for="category in categories" :key="category.id">{{ category.name }}</option>
                </select>
            </div>

            <!-- Event Dates -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="start-date" class="mb-1 block text-sm font-medium text-gray-700"
                        >Start Date <span class="text-red-500">*</span></label
                    >
                    <input
                        v-model="overviewForm.start_date"
                        type="text"
                        id="start-date"
                        name="start-date"
                        required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                    />
                </div>
                <div>
                    <label for="end-date" class="mb-1 block text-sm font-medium text-gray-700">End Date <span class="text-red-500">*</span></label>
                    <input
                        v-model="overviewForm.end_date"
                        type="text"
                        id="end-date"
                        name="end-date"
                        required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                    />
                </div>
            </div>

            <!-- Event Location -->
            <div>
                <label for="event-location" class="mb-1 block text-sm font-medium text-gray-700">Location <span class="text-red-500">*</span></label>
                <input
                    v-model="overviewForm.location"
                    type="text"
                    id="event-location"
                    name="event-location"
                    required
                    class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                />
            </div>

            <!-- Event Description -->
            <div>
                <label for="event-description" class="mb-1 block text-sm font-medium text-gray-700"
                    >Description <span class="text-red-500">*</span></label
                >
                <textarea
                    v-model="overviewForm.description"
                    id="event-description"
                    name="event-description"
                    rows="5"
                    required
                    class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                ></textarea>
                <p class="mt-1 text-sm text-gray-500">Provide a detailed description of your event. What can attendees expect?</p>
            </div>

            <!-- Event Thumbnail -->
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Event Thumbnail <span class="text-red-500">*</span></label>
                <div class="mt-1">
                    <label for="event-thumbnail" class="custom-file-upload">
                        <svg
                            class="mx-auto h-12 w-12 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                            ></path>
                        </svg>
                        <p class="mt-1 text-sm text-gray-600">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                    </label>
                    <input id="event-thumbnail" name="event-thumbnail" type="file" accept="image/*" class="hidden" required />
                    <div id="thumbnail-preview" class="file-preview">
                        <img id="thumbnail-image" src="#" alt="Thumbnail preview" />
                        <div class="remove-image" id="remove-thumbnail">
                            <svg
                                class="h-5 w-5 text-gray-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Event Tags -->
            <div>
                <label for="event-tags" class="mb-1 block text-sm font-medium text-gray-700">Tags</label>

                <div class="mb-2 flex flex-wrap gap-2">
                    <span v-for="tag in tags" :key="tag" class="flex items-center rounded-full bg-indigo-100 px-2 py-1 text-sm text-indigo-800">
                        {{ tag }}
                        <button type="button" class="ml-1 text-indigo-500 hover:text-red-500" @click="removeTag(tag)">×</button>
                    </span>
                </div>

                <input
                    v-model="inputValue"
                    @keydown="handleKey"
                    :disabled="tags.length >= maxTags"
                    type="text"
                    id="event-tags"
                    name="event-tags"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                    placeholder="Add a tag and press enter"
                />
                <p class="mt-1 text-sm text-gray-500">Press enter or comma to add tag (up to 5)</p>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button
                @click="$emit('next')"
                type="button"
                id="next-to-step-2"
                class="rounded-md bg-indigo-600 px-6 py-2 text-sm font-medium text-white hover:bg-indigo-700"
            >
                Next: Schedule
            </button>
        </div>
    </div>
</template>

<style scoped>
.custom-file-upload {
    border: 2px dashed #d1d5db;
    display: inline-block;
    padding: 30px 20px;
    cursor: pointer;
    width: 100%;
    text-align: center;
    border-radius: 0.375rem;
    transition: all 0.3s ease;
}

.custom-file-upload:hover {
    border-color: #6366f1;
}

.file-preview {
    display: none;
    position: relative;
    margin-top: 1rem;
}
</style>
