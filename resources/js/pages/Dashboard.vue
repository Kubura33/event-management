<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Event } from '@/types/event';
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

type Props = {
    numberOfEvents: number;
    numberOfTotalAttendees: number;
    upcomingEvents: Event[];
    totalEvents: number;
    activityLogs: [];
};

const props = defineProps<Props>()
console.log(props)
// Mock data for events
const events = ref([
    {
        id: 1,
        name: 'Tech Conference 2023',
        date: '2023-12-15',
        location: 'San Francisco',
        attendees: 120,
        capacity: 150,
    },
    { id: 2, name: 'Music Festival', date: '2023-11-20', location: 'Los Angeles', attendees: 85, capacity: 200 },
    { id: 3, name: 'Startup Meetup', date: '2023-12-05', location: 'New York', attendees: 65, capacity: 100 },
    { id: 4, name: 'Art Exhibition', date: '2023-11-25', location: 'Chicago', attendees: 45, capacity: 80 },
    { id: 5, name: 'Charity Gala', date: '2023-12-10', location: 'Miami', attendees: 95, capacity: 120 },
    { id: 6, name: 'Workshop on AI', date: '2023-12-18', location: 'Seattle', attendees: 35, capacity: 50 },
    { id: 7, name: 'Food Festival', date: '2023-11-30', location: 'Austin', attendees: 75, capacity: 100 },
]);

// Mock data for recent activity
const recentActivity = ref([
    {
        id: 1,
        user: 'John Doe',
        action: 'signed up for',
        event: 'Tech Conference 2023',
        timestamp: '2023-11-10T14:30:00',
    },
    { id: 2, user: 'Jane Smith', action: 'signed up for', event: 'Music Festival', timestamp: '2023-11-09T10:15:00' },
    { id: 3, user: 'Mike Johnson', action: 'signed up for', event: 'Startup Meetup', timestamp: '2023-11-08T16:45:00' },
    {
        id: 4,
        user: 'Sarah Williams',
        action: 'signed up for',
        event: 'Art Exhibition',
        timestamp: '2023-11-07T09:20:00',
    },
    { id: 5, user: 'David Brown', action: 'signed up for', event: 'Charity Gala', timestamp: '2023-11-06T13:10:00' },
    { id: 6, user: 'Emily Davis', action: 'signed up for', event: 'Workshop on AI', timestamp: '2023-11-05T11:30:00' },
    { id: 7, user: 'Alex Wilson', action: 'signed up for', event: 'Food Festival', timestamp: '2023-11-04T15:45:00' },
    {
        id: 8,
        user: 'Lisa Taylor',
        action: 'signed up for',
        event: 'Tech Conference 2023',
        timestamp: '2023-11-03T12:20:00',
    },
]);

// Computed properties for dashboard statistics


// Get top 5 events by attendance
const topEvents = computed(() => {
    return [...events.value].sort((a, b) => b.attendees - a.attendees).slice(0, 5);
});

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
                        <div class="text-4xl font-semibold text-gray-900 dark:text-white">{{ numberOfTotalAttendees }}</div>
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
                        <div v-for="event in topEvents" :key="event.id" class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-300">{{ event.name }}</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ event.attendees }} / {{ event.capacity }}</span>
                            </div>
                            <div class="h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                                <div class="h-2.5 rounded-full bg-blue-600" :style="{ width: `${(event.attendees / event.capacity) * 100}%` }"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="flex flex-col rounded-xl border border-sidebar-border/70 bg-white p-6 dark:border-sidebar-border dark:bg-gray-800">
                    <h2 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Recent Activity</h2>
                    <div class="max-h-[400px] space-y-4 overflow-y-auto">
                        <div
                            v-for="activity in recentActivity"
                            :key="activity.id"
                            class="border-b border-gray-200 pb-3 last:border-0 last:pb-0 dark:border-gray-700"
                        >
                            <div class="flex items-start">
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900 dark:text-white">
                                        <span class="font-medium">{{ activity.user }}</span>
                                        {{ activity.action }}
                                        <span class="font-medium">{{ activity.event }}</span>
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
                            <tr v-for="event in events" :key="event.id">
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900 dark:text-white">
                                    {{ event.name }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ formatDate(event.date) }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ event.location }}
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
