<script setup lang="ts">
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import {Event} from '@/types/event';

defineEmits(['next', 'back']);

const props = defineProps<{event: Event, step: string, event_id?: number | null}>()
console.log(props.event, props.step)
type ScheduleItem = {
    title: string;
    description: string;
    date: string;
    startTime: string;
    endTime: string;
};

const addScheduleItem = () => {
    form.schedules.push({
        title: '',
        description: '',
        date: '',
        startTime: '',
        endTime: '',
    });
};

const form = useForm<{
    schedules: ScheduleItem[];
    step: string;
}>({
    schedules: [{
        title: '',
        description: '',
        date: '',
        startTime: '',
        endTime: '',
    }],
    step: "schedules"
})

const removeScheduleItem = (index: number) => {
    form.schedules.splice(index, 1);
};

const submitStep = () => {
    const payload: any = { ...form.data(), step: 'schedules' };
    if (props.event_id) {
        payload.event_id = props.event_id;
    }
    form.post(route('events.store'), {
        forceFormData: true,
        data: payload,
        onSuccess: () => emit('next')
    });
};
</script>
<template>
    <div id="step-2" class="form-step">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Event Schedule</h2>

        <div class="space-y-8">
            <div
                v-for="(item, index) in form.schedules"
                :key="index"
                class="border border-gray-200 rounded-lg p-4"
            >
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Item {{ index + 1 }}</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input
                            type="date"
                            v-model="item.date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                        <div class="flex space-x-2">
                            <input
                                type="time"
                                v-model="item.startTime"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            />
                            <span class="flex items-center">-</span>
                            <input
                                type="time"
                                v-model="item.endTime"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            />
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title & Description</label>
                        <input
                            type="text"
                            placeholder="Session Title"
                            v-model="item.title"
                            class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                        <textarea
                            placeholder="Brief description"
                            rows="2"
                            v-model="item.description"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                    </div>

                    <div class="md:col-span-1 flex items-end">
                        <button
                            v-if="form.schedules.length > 1"
                            type="button"
                            @click="removeScheduleItem(index)"
                            class="w-full bg-red-100 hover:bg-red-200 text-red-700 px-3 py-2 rounded-md text-sm font-medium"
                        >
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button
                type="button"
                @click="addScheduleItem"
                class="text-sm text-indigo-600 hover:text-indigo-500 font-medium flex items-center"
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
                Add Schedule Item
            </button>
        </div>

        <div class="mt-8 flex justify-between">
            <button
                @click="$emit('back')"
                type="button"
                class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-2 rounded-md text-sm font-medium"
            >
                Back: Overview
            </button>
            <button
                type="button"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md text-sm font-medium"
            >
                Next: Speakers
            </button>
        </div>
    </div>
</template>


<style scoped>

</style>
