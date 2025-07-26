<script setup lang="ts">
import Overview from '@/components/EventShow/Overview.vue';
import { Event } from '@/types/event';
import { computed, ref } from 'vue';

import EventDetailsModal from '@/components/EventShow/EventDetailsModal.vue';
import EventHeader from '@/components/EventShow/EventHeader.vue';
import FAQ from '@/components/EventShow/FAQ.vue';
import Schedule from '@/components/EventShow/Schedule.vue';
import Speakers from '@/components/EventShow/Speakers.vue';
import EventSignUpModal from '@/components/EventSignUpModal.vue';

const props = defineProps<{
    event: Event;
}>();
const tabs = [
    { id: 1, label: 'Overview', component: Overview },
    { id: 2, label: 'Schedule', component: Schedule },
    { id: 3, label: 'Speakers', component: Speakers },
    { id: 4, label: 'Faq', component: FAQ },
];

const activeTabId = ref(1);

function setActiveTab(id: number) {
    activeTabId.value = id;
}

const activeTabComponent = computed(() => {
    return tabs.find((tab) => tab.id === activeTabId.value)?.component || Overview;
});
const showModal = ref<boolean>(false);
</script>

<template>
    <EventHeader @openRegistrationModal="showModal = true" />
    <div class="mx-auto max-w-7xl bg-[#f8f9fc] px-4 py-8 font-inter sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8">
            <div class="lg:col-span-8">
                <!-- Event Thumbnail -->
                <div class="mx-auto mb-8 max-w-4xl overflow-hidden rounded-lg shadow-sm">
                    <img src="/event-image-placeholder.png" alt="Event thumbnail" class="h-auto w-full rounded object-cover" />
                </div>

                <!-- Tabs Navigation -->
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <button
                            v-for="tab in tabs"
                            :key="tab.id"
                            @click="setActiveTab(tab.id)"
                            class="tab-button border-b-2 px-1 py-4 text-sm font-medium whitespace-nowrap"
                            :class="{
                                'border-indigo-500 text-indigo-600': activeTabId === tab.id,
                                'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': activeTabId !== tab.id,
                            }"
                        >
                            {{ tab.label }}
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="py-6">
                    <component :is="activeTabComponent" :event="event" />
                </div>
            </div>
            <!-- Mobile Sticky Register Button -->
            <div class="sticky-register fixed inset-x-0 bottom-0 border-t border-gray-200 bg-white px-4 py-3 lg:hidden">
                <button
                    id="mobile-register-button"
                    class="w-full rounded-md bg-indigo-600 px-4 py-3 text-base font-medium text-white hover:bg-indigo-700"
                >
                    Register Now - From $49
                </button>
            </div>
            <EventDetailsModal @openRegistrationModal="showModal = true" />
        </div>
    </div>
    <EventSignUpModal @close="showModal = false" :event-title="event.title" :show="showModal" :event-id="event.id" :event-slug="event.slug" />
</template>

<style scoped>
.event-header {
    background-color: #4f46e5;
    background-image: linear-gradient(to right, rgba(79, 70, 229, 0.9), rgba(124, 58, 237, 0.9));
}

.tab-button {
    transition: all 0.2s ease;
}

.tab-button.active {
    color: #4f46e5;
    border-color: #4f46e5;
}

.sticky-register {
    box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1);
}
</style>
