<script setup lang="ts">
defineEmits(['openRegistrationModal'])
</script>

<template>
    <div class="event-header py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between">
                <div>
                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 mb-4">
                        Technology
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">Tech Conference 2023</h1>
                    <div class="flex flex-wrap items-center text-indigo-100 mt-4">
                        <div class="flex items-center mr-6 mb-2">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            <span>June 15-17, 2023</span>
                        </div>
                        <div class="flex items-center mr-6 mb-2">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Tech Innovation Center, New York</span>
                        </div>
                    </div>
                </div>
                <div class="mt-6 md:mt-0">
                    <button @click="$emit('openRegistrationModal')" id="register-button" class="bg-white text-indigo-600 hover:bg-indigo-50 px-6 py-3 rounded-md text-base font-medium shadow-sm">
                        Register Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
