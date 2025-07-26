<script setup lang="ts">
import { Event } from '@/types/event';

defineProps<{event?: Event}>()
</script>

<template>
    <div id="schedule" class="tab-content">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Event Schedule</h2>

        <!-- Day Tabs -->
        <div class="border-b border-gray-200 mb-6">
            <div class="flex space-x-4">
                <button class="day-tab active px-4 py-2 border-b-2 border-indigo-500 font-medium text-sm text-indigo-600" data-day="day1">
                    Day 1 (June 15)
                </button>
                <button class="day-tab px-4 py-2 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-day="day2">
                    Day 2 (June 16)
                </button>
                <button class="day-tab px-4 py-2 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300" data-day="day3">
                    Day 3 (June 17)
                </button>
            </div>
        </div>

        <!-- Day 1 Schedule (Default Active) -->
        <div id="day1" class="day-content active">
            <div class="space-y-6">
                <!-- Morning -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Morning</h3>
                    <div class="bg-white shadow overflow-hidden rounded-md">
                        <ul class="divide-y divide-gray-200">
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <p class="text-sm font-medium text-indigo-600 truncate">
                                                8:00 AM - 9:00 AM
                                            </p>
                                        </div>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Registration
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-900">
                                            Check-in and Welcome Package
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Main Lobby
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <p class="text-sm font-medium text-indigo-600 truncate">
                                                9:00 AM - 10:30 AM
                                            </p>
                                        </div>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Keynote
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-900">
                                            Opening Keynote: The Future of Technology
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Sarah Johnson, CEO of TechFuture
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Main Auditorium
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <p class="text-sm font-medium text-indigo-600 truncate">
                                                10:45 AM - 12:15 PM
                                            </p>
                                        </div>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                Panel
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-900">
                                            AI Revolution: Opportunities and Challenges
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Panel of AI Experts
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Hall A
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Afternoon -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Afternoon</h3>
                    <div class="bg-white shadow overflow-hidden rounded-md">
                        <ul class="divide-y divide-gray-200">
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <p class="text-sm font-medium text-indigo-600 truncate">
                                                1:30 PM - 3:00 PM
                                            </p>
                                        </div>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Workshop
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-900">
                                            Building Scalable Cloud Applications
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Michael Chen, Cloud Architect
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Workshop Room 1
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <p class="text-sm font-medium text-indigo-600 truncate">
                                                3:15 PM - 4:45 PM
                                            </p>
                                        </div>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Technical Talk
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-900">
                                            Blockchain Beyond Cryptocurrency
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Dr. Amara Patel, Blockchain Researcher
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Hall B
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <p class="text-sm font-medium text-indigo-600 truncate">
                                                5:00 PM - 7:00 PM
                                            </p>
                                        </div>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                Networking
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-900">
                                            Welcome Reception
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Rooftop Garden
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Day 2 Schedule (Hidden by default) -->
        <div id="day2" class="day-content hidden">
            <div class="space-y-6">
                <div class="bg-white shadow overflow-hidden rounded-md">
                    <ul class="divide-y divide-gray-200">
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <p class="text-sm font-medium text-indigo-600 truncate">
                                            9:00 AM - 10:30 AM
                                        </p>
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Keynote
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-900">
                                        Cybersecurity in the Age of AI
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Robert Lee, Security Expert
                                    </p>
                                </div>
                            </div>
                        </li>
                        <!-- More day 2 schedule items would go here -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- Day 3 Schedule (Hidden by default) -->
        <div id="day3" class="day-content hidden">
            <div class="space-y-6">
                <div class="bg-white shadow overflow-hidden rounded-md">
                    <ul class="divide-y divide-gray-200">
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <p class="text-sm font-medium text-indigo-600 truncate">
                                            9:00 AM - 10:30 AM
                                        </p>
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Workshop
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-900">
                                        Building Your First Machine Learning Model
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Dr. Maria Rodriguez, AI Researcher
                                    </p>
                                </div>
                            </div>
                        </li>
                        <!-- More day 3 schedule items would go here -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
