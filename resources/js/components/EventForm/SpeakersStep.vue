<script setup lang="ts">
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

const speakers = ref<Speaker[]>([
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
]);

const addSpeaker = () => {
    speakers.value.push({
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

const removeSpeaker = (index: number) => {
    speakers.value.splice(index, 1);
};

const handlePhotoUpload = (e: Event, index: number) => {
    const target = e.target as HTMLInputElement;
    const file = target?.files?.[0];
    if (file) {
        speakers.value[index].photo = file;
        speakers.value[index].photoUrl = URL.createObjectURL(file);
    }
};

const removePhoto = (index: number) => {
    speakers.value[index].photo = null;
    speakers.value[index].photoUrl = null;
};
</script>


<template>
    <div id="step-3" class="form-step">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Event Speakers</h2>

        <div class="space-y-6">
            <div
                v-for="(speaker, index) in speakers"
                :key="index"
                class="bg-white border border-gray-200 rounded-lg p-4"
            >
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Photo Upload -->
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Speaker Photo</label>
                        <label class="custom-file-upload" v-if="!speaker.photoUrl">
                            <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <p class="mt-1 text-xs text-gray-500">Upload photo</p>
                            <input type="file" accept="image/*" class="hidden" @change="e => handlePhotoUpload(e, index)" />
                        </label>

                        <div v-if="speaker.photoUrl" class="file-preview">
                            <img :src="speaker.photoUrl" alt="Preview" />
                            <div class="remove-image" @click="removePhoto(index)">
                                <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Speaker Info -->
                    <div class="md:col-span-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                                <input v-model="speaker.name" type="text" class="w-full px-3 py-2 border rounded-md shadow-sm" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Title/Role <span class="text-red-500">*</span></label>
                                <input v-model="speaker.title" type="text" class="w-full px-3 py-2 border rounded-md shadow-sm" required />
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bio <span class="text-red-500">*</span></label>
                            <textarea v-model="speaker.bio" rows="3" class="w-full px-3 py-2 border rounded-md shadow-sm" required></textarea>
                        </div>

                        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn</label>
                                <input v-model="speaker.linkedin" type="url" placeholder="https://linkedin.com/in/..."
                                       class="w-full px-3 py-2 border rounded-md shadow-sm" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Twitter</label>
                                <input v-model="speaker.twitter" type="url" placeholder="https://twitter.com/..."
                                       class="w-full px-3 py-2 border rounded-md shadow-sm" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                                <input v-model="speaker.website" type="url" placeholder="https://..."
                                       class="w-full px-3 py-2 border rounded-md shadow-sm" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex justify-end">
                    <button v-if="speakers.length > 1" @click="removeSpeaker(index)" type="button"
                            class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-md text-sm font-medium">
                        Remove Speaker
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button @click="addSpeaker" type="button"
                    class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md text-sm font-medium flex items-center">
                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Another Speaker
            </button>
        </div>

        <div class="mt-8 flex justify-between">
            <button @click="$emit('back')" type="button"
                    class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-md text-sm font-medium">
                Back: Schedule
            </button>
            <button @click="$emit('next')" type="button"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md text-sm font-medium">
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
