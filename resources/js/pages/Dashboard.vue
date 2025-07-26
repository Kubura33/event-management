<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Event } from '@/types/event';
import { Head, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { useEchoPublic } from '@laravel/echo-vue';

type ActivityLog = {
    message: string,
    timestamp: string
}
type Props = {
    numberOfEvents: number;
    numberOfTotalAttendees: number;
    upcomingEvents: Event[];
    totalEvents: number;
    activityLogs: ActivityLog[];
    topEventsByAttendance: Event[]
};

const props = defineProps<Props>()
console.log(props)

// Format date for display
const formatDate = (dateString: string) => {
    const options: Intl.DateTimeFormatOptions = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
};

// Format timestamp for display
const formatTimestamp = (timestamp: string) => {
    const date = new Date(timestamp);
    return date.toLocaleString();
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
useEchoPublic(
    "events",
    "EventCapacityUpdated",
    (e) => {
        router.reload({ only: ['numberOfTotalAttendees', 'totalEvents', 'upcomingEvents', 'topEventsByAttendance'] });
    }
)

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <!-- Summary Statistics Cards -->
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <!-- Total Events Card -->
                <div
                    class="flex flex-col justify-between rounded-xl border border-sidebar-border/70 bg-white p-6 dark:border-sidebar-border dark:bg-gray-800"
                >
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Events</div>
                    <div class="mt-2 flex items-baseline">
                        <div class="text-4xl font-semibold text-gray-900 dark:text-white">{{ totalEvents }}</div>
                    </div>
                </div>

                <!-- Total Attendee Card -->
                <div
                    class="flex flex-col justify-between rounded-xl border border-sidebar-border/70 bg-white p-6 dark:border-sidebar-border dark:bg-gray-800"
                >
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Attendees</div>
                    <div class="mt-2 flex items-baseline">
                        <transition
                            enter-active-class="transition duration-300 ease-out"
                            enter-from-class="opacity-0 scale-95"
                            enter-to-class="opacity-100 scale-100"
                            leave-active-class="transition duration-200 ease-in"
                            leave-from-class="opacity-100 scale-100"
                            leave-to-class="opacity-0 scale-95"
                            mode="out-in"
                        >
                            <div :key="numberOfTotalAttendees" class="text-4xl font-semibold text-gray-900 dark:text-white">
                                {{ numberOfTotalAttendees }}
                            </div>
                        </transition>

                    </div>
                </div>

                <!-- Upcoming Events Card -->
                <div
                    class="flex flex-col justify-between rounded-xl border border-sidebar-border/70 bg-white p-6 dark:border-sidebar-border dark:bg-gray-800"
                >
                    <div class="text-sm text-gray-500 dark:text-gray-400">Upcoming Events</div>
                    <div class="mt-2 flex items-baseline">
                        <div class="text-4xl font-semibold text-gray-900 dark:text-white">{{ upcomingEvents.length }}</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="grid gap-4 md:grid-cols-2">
                <!-- Top 5 Events Chart -->
                <div class="flex flex-col rounded-xl border border-sidebar-border/70 bg-white p-6 dark:border-sidebar-border dark:bg-gray-800">
                    <h2 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Top 5 Events by Attendance</h2>
                    <div class="space-y-4">
                        <div v-for="event in topEventsByAttendance" :key="event.id" class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-300">{{ event.title }}</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ event.attendees }} / {{ event.capacity }}</span>
                            </div>
                            <div
                                class="h-2.5 rounded-full bg-blue-600 transition-all duration-500 ease-out"
                                :style="{ width: `${(event.attendees  / event.capacity) * 100}%` }"
                            ></div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="flex flex-col rounded-xl border border-sidebar-border/70 bg-white p-6 dark:border-sidebar-border dark:bg-gray-800">
                    <h2 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Recent Activity</h2>
                    <div class="max-h-[400px] space-y-4 overflow-y-auto">
                        <div
                            v-for="activity in activityLogs"
                            :key="activity.timestamp"
                            class="border-b border-gray-200 pb-3 last:border-0 last:pb-0 dark:border-gray-700"
                        >
                            <div class="flex items-start">
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900 dark:text-white">
                                        {{activity.message}}
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        {{ formatTimestamp(activity.timestamp) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Events Calendar or Additional Content -->
            <div class="rounded-xl border border-sidebar-border/70 bg-white p-6 dark:border-sidebar-border dark:bg-gray-800">
                <h2 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Upcoming Events</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                >
                                    Event Name
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                >
                                    Date
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                >
                                    Location
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase dark:text-gray-400"
                                >
                                    Attendees
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                            <tr v-for="event in upcomingEvents" :key="event.id">
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900 dark:text-white">
                                    {{ event.title }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ formatDate(event.date) }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ event.country }}, {{ event.city}} , {{ event.address}}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ event.attendees }} / {{ event.capacity }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
