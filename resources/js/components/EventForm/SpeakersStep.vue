<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineEmits(['next', 'back']);

type Speaker = {
    name: string;
    title: string;
    bio: string;
    linkedin: string;
    twitter: string;
    website: string;
    photo: File | null;
    photoUrl: string | null;
};

const addSpeaker = () => {
    form.speakers.push({
        name: '',
        title: '',
        bio: '',
        linkedin: '',
        twitter: '',
        website: '',
        photo: null,
        photoUrl: null,
    });
};

const form = useForm<{
    speakers: Speaker[];
    step: string;
}>({
    speakers: [
        {
            name: '',
            title: '',
            bio: '',
            linkedin: '',
            twitter: '',
            website: '',
            photo: null,
            photoUrl: null,
        },
    ],
    step: 'speakers',
});
const removeSpeaker = (index: number) => {
    form.speakers.splice(index, 1);
};

const handlePhotoUpload = (e: Event, index: number) => {
    const target = e.target as HTMLInputElement;
    const file = target?.files?.[0];
    if (file) {
        form.speakers[index].photo = file;
        form.speakers[index].photoUrl = URL.createObjectURL(file);
    }
};

const removePhoto = (index: number) => {
    form.speakers[index].photo = null;
    form.speakers[index].photoUrl = null;
};
</script>

<template>
    <div id="step-3" class="form-step">
        <h2 class="mb-6 text-xl font-bold text-gray-900">Event Speakers</h2>

        <div class="space-y-6">
            <div v-for="(speaker, index) in form.speakers" :key="index" class="rounded-lg border border-gray-200 bg-white p-4">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
                    <!-- Photo Upload -->
                    <div class="md:col-span-1">
                        <label class="mb-1 block text-sm font-medium text-gray-700">Speaker Photo</label>
                        <label class="custom-file-upload" v-if="!speaker.photoUrl">
                            <svg
                                class="mx-auto h-10 w-10 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                            <p class="mt-1 text-xs text-gray-500">Upload photo</p>
                            <input type="file" accept="image/*" class="hidden" @change="(e) => handlePhotoUpload(e, index)" />
                        </label>

                        <div v-if="speaker.photoUrl" class="file-preview">
                            <img :src="speaker.photoUrl" alt="Preview" />
                            <div class="remove-image" @click="removePhoto(index)">
                                <svg
                                    class="h-5 w-5 text-gray-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Speaker Info -->
                    <div class="md:col-span-3">
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                                <input v-model="speaker.name" type="text" class="w-full rounded-md border px-3 py-2 shadow-sm" required />
                            </div>
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">Title/Role <span class="text-red-500">*</span></label>
                                <input v-model="speaker.title" type="text" class="w-full rounded-md border px-3 py-2 shadow-sm" required />
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="mb-1 block text-sm font-medium text-gray-700">Bio <span class="text-red-500">*</span></label>
                            <textarea v-model="speaker.bio" rows="3" class="w-full rounded-md border px-3 py-2 shadow-sm" required></textarea>
                        </div>

                        <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">LinkedIn</label>
                                <input
                                    v-model="speaker.linkedin"
                                    type="url"
                                    placeholder="https://linkedin.com/in/..."
                                    class="w-full rounded-md border px-3 py-2 shadow-sm"
                                />
                            </div>
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">Twitter</label>
                                <input
                                    v-model="speaker.twitter"
                                    type="url"
                                    placeholder="https://twitter.com/..."
                                    class="w-full rounded-md border px-3 py-2 shadow-sm"
                                />
                            </div>
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">Website</label>
                                <input
                                    v-model="speaker.website"
                                    type="url"
                                    placeholder="https://..."
                                    class="w-full rounded-md border px-3 py-2 shadow-sm"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex justify-end">
                    <button
                        v-if="form.speakers.length > 1"
                        @click="removeSpeaker(index)"
                        type="button"
                        class="rounded-md bg-red-100 px-3 py-1 text-sm font-medium text-red-700 hover:bg-red-200"
                    >
                        Remove Speaker
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button
                @click="addSpeaker"
                type="button"
                class="flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                <svg class="mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Another Speaker
            </button>
        </div>

        <div class="mt-8 flex justify-between">
            <button
                @click="$emit('back')"
                type="button"
                class="rounded-md border border-gray-300 bg-white px-6 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
                Back: Schedule
            </button>
            <button
                @click="$emit('next')"
                type="button"
                class="rounded-md bg-indigo-600 px-6 py-2 text-sm font-medium text-white hover:bg-indigo-700"
            >
                Next: FAQ
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
    position: relative;
    margin-top: 1rem;
}

.file-preview img {
    max-height: 200px;
    border-radius: 0.375rem;
}

.remove-image {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 9999px;
    padding: 0.25rem;
    cursor: pointer;
}
</style>
