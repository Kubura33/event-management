<script setup lang="ts">
defineProps<{currentStep: number}>()
const stepLabels = ['Overview', 'Schedule', 'Speakers', 'FAQ'];

</script>

<template>
    <div class="mb-8 w-full">
        <div class="flex items-center">
            <template v-for="step in 4" :key="step">
                <!-- Step -->
                <div class="flex items-center relative">
                    <div
                        class="step-indicator rounded-full h-10 w-10 flex items-center justify-center text-sm font-medium"
                        :class="{
                            active: currentStep === step,
                            completed: currentStep > step,
                            'bg-gray-200 text-gray-600': currentStep < step
                        }"
                    >
                        {{ step }}
                    </div>
                    <div class="hidden sm:block ml-3 text-sm font-medium"
                         :class="{
                            'text-gray-900': currentStep === step,
                            'text-gray-500': currentStep !== step
                         }"
                    >
                        {{ stepLabels[step - 1] }}
                    </div>
                </div>

                <!-- Line (except after last step) -->
                <div v-if="step < 4" class="flex-1 mx-4">
                    <div class="h-1 w-full step-line"
                         :class="{ active: currentStep > step }"
                    ></div>
                </div>
            </template>
        </div>
    </div>
</template>


<style scoped>
.step-indicator {
    transition: all 0.3s ease;
}
.step-indicator.active {
    background-color: #4f46e5; /* Indigo */
    color: white;
}
.step-indicator.completed {
    background-color: #10b981; /* Emerald */
    color: white;
}
.step-line {
    background-color: #e5e7eb; /* gray-200 */
    transition: all 0.3s ease;
}
.step-line.active {
    background-color: #4f46e5; /* Indigo */
}
</style>
