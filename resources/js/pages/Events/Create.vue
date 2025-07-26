<script setup lang="ts">
import FAQStep from '@/components/EventForm/FAQStep.vue';
import FormStepIndicator from '@/components/EventForm/FormStepIndicator.vue';
import OverviewStep from '@/components/EventForm/OverviewStep.vue';
import ScheduleStep from '@/components/EventForm/ScheduleStep.vue';
import SpeakersStep from '@/components/EventForm/SpeakersStep.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Category } from '@/types/event';
import { Head, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const breadCrumbs: BreadcrumbItem[] = [
    {
        title: 'My Events',
        href: '/events',
    },
    {
        title: 'Create an event',
        href: route('events.create'),
    },
];

const props = defineProps<{ categories: Category[] }>();

const stepProps = {
    1: { categories: props.categories },         // For OverviewStep.vue
    2: { }, // For ScheduleStep.vue
    3: {  },           // For SpeakersStep.vue
    4: {  },               // For FAQStep.vue
} as Record<number, Record<string, any>>;

const imageFile = ref<File | null>(null);
const chosenCategory = ref<Category | null>(null);
const eventForm = useForm<{
    category_id: number | null;
    title: string;
    description: string;
    date: string;
    capacity: number;
    price: number;
    city: string;
    address: string;
    country: string;
    zipcode: string;
    image: File | null;
}>({
    category_id: null,
    title: '',
    description: '',
    date: '',
    capacity: 0,
    price: 0,
    city: '',
    address: '',
    country: '',
    zipcode: '',
    image: null as File | null,
});

const imagePreviewUrl = ref<string | null>(null);
const handleImageUpload = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        const file = target.files[0];
        imageFile.value = file;
        imagePreviewUrl.value = URL.createObjectURL(file);
        eventForm.image = target.files[0];
    }
};

const addEvent = () => {
    eventForm.category_id = chosenCategory.value?.id;
    eventForm.post(route('events.store'), {
        forceFormData: true,
        onSuccess: () => {},
    });
};

const steps = [
    { id: 1, name: 'Overview', component: OverviewStep },
    { id: 2, name: 'Schedule', component: ScheduleStep },
    { id: 3, name: 'Speakers', component: SpeakersStep },
    { id: 4, name: 'FAQ', component: FAQStep },
];
const activeStep = ref(1)

const goNext = () => {
    if (activeStep.value < steps.length) {
        activeStep.value++;
    }
};

const goBack = () => {
    if (activeStep.value > 1) {
        activeStep.value--;
    }
};
const activeStepComponent = computed(() => {
    return steps.find((step) => step.id === activeStep.value)?.component || OverviewStep
})
</script>

<template>
    <Head title="Create an event" />
    <AppLayout :breadcrumbs="breadCrumbs">
        <div class="max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
            <FormStepIndicator :current-step="activeStep" />
            <div class="mb-8 w-full rounded-lg bg-white p-6 shadow-sm">
                <form id="event-form">
                    <component v-bind="stepProps[activeStep]" @next="goNext" @back="goBack" :is="activeStepComponent" />
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.form-header {
    background-color: #4f46e5;
    background-image: linear-gradient(to right, rgba(79, 70, 229, 0.9), rgba(124, 58, 237, 0.9));
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
