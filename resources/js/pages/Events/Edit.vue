<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Event } from '@/types/event';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { Calendar } from '@/components/ui/calendar';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import InputError from '@/components/InputError.vue';
import { ref } from 'vue';

const props = defineProps<{
    event: Event;
}>();

const breadCrumbs: BreadcrumbItem[] = [
    {
        title: 'My Events',
        href: '/events',
    },
    {
        title: 'Edit Event',
        href: route('events.edit', { id: props.event.id })
    }
];

const selectedDate = ref<Date | undefined>(props.event.date ? new Date(props.event.date) : new Date());
const imageFile = ref<File | null>(null);

const eventForm = useForm({
    title: props.event.title,
    description: props.event.description,
    date: props.event.date,
    slug: props.event.slug,
    capacity: props.event.capacity,
    price: props.event.price || 0,
    city: props.event.city,
    address: props.event.address,
    country: props.event.country,
    zipcode: props.event.zipcode || '',
    attendees: props.event.attendees || '',
    image: null as File | null,
    _method: 'PUT'
});

const handleImageUpload = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        imageFile.value = target.files[0];
        eventForm.image = target.files[0];
    }
};

const updateDate = (date: Date) => {
    selectedDate.value = date;
    eventForm.date = date.toISOString().split('T')[0];
};

const updateEvent = () => {
    eventForm.post(route('events.update', { id: props.event.id }), {
        forceFormData: true,
        onSuccess: () => {
            // Redirect or show success message
        },
    });
};
</script>

<template>
    <Head title="Edit Event" />

    <AppLayout :breadcrumbs="breadCrumbs">
        <Card class="max-w-4xl mx-auto">
            <CardHeader>
                <CardTitle>Edit Event</CardTitle>
                <CardDescription>Update your event details</CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="updateEvent" class="space-y-6 mt-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="grid gap-2 flex flex-col">
                            <Label for="title">Title</Label>
                            <Input
                                id="title"
                                type="text"
                                required
                                autofocus
                                v-model="eventForm.title"
                                placeholder="Event title"
                                class="flex-grow"
                            />
                            <InputError :message="eventForm.errors.title" />
                        </div>

                        <!-- Slug -->
                        <div class="grid gap-2 flex flex-col">
                            <Label for="slug">Slug</Label>
                            <Input
                                id="slug"
                                type="text"
                                required
                                v-model="eventForm.slug"
                                placeholder="event-slug"
                                class="flex-grow"
                            />
                            <p class="text-sm text-muted-foreground">URL-friendly name for your event</p>
                            <InputError :message="eventForm.errors.slug" />
                        </div>

                        <!-- Date -->
                        <div class="grid gap-2 flex flex-col">
                            <Label for="date">Date</Label>
                            <Calendar v-model="selectedDate" @update:modelValue="updateDate" />
                            <InputError :message="eventForm.errors.date" />
                        </div>

                        <!-- Description -->
                        <div class="grid gap-2 md:col-span-2">
                            <Label for="description">Description</Label>
                            <textarea
                                id="description"
                                rows="4"
                                class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                required
                                v-model="eventForm.description"
                                placeholder="Event description"
                            ></textarea>
                            <InputError :message="eventForm.errors.description" />
                        </div>

                        <!-- Capacity -->
                        <div class="grid gap-2">
                            <Label for="capacity">Capacity</Label>
                            <Input
                                id="capacity"
                                type="number"
                                required
                                v-model="eventForm.capacity"
                                placeholder="Maximum number of attendees"
                            />
                            <InputError :message="eventForm.errors.capacity" />
                        </div>

                        <!-- Price -->
                        <div class="grid gap-2">
                            <Label for="price">Price</Label>
                            <Input
                                id="price"
                                type="number"
                                step="0.01"
                                v-model="eventForm.price"
                                placeholder="Event price (leave empty for free events)"
                            />
                            <InputError :message="eventForm.errors.price" />
                        </div>

                        <!-- City -->
                        <div class="grid gap-2">
                            <Label for="city">City</Label>
                            <Input
                                id="city"
                                type="text"
                                required
                                v-model="eventForm.city"
                                placeholder="City"
                            />
                            <InputError :message="eventForm.errors.city" />
                        </div>

                        <!-- Country -->
                        <div class="grid gap-2">
                            <Label for="country">Country</Label>
                            <Input
                                id="country"
                                type="text"
                                required
                                v-model="eventForm.country"
                                placeholder="Country"
                            />
                            <InputError :message="eventForm.errors.country" />
                        </div>

                        <!-- Address -->
                        <div class="grid gap-2">
                            <Label for="address">Address</Label>
                            <Input
                                id="address"
                                type="text"
                                required
                                v-model="eventForm.address"
                                placeholder="Street address"
                            />
                            <InputError :message="eventForm.errors.address" />
                        </div>

                        <!-- Zipcode -->
                        <div class="grid gap-2">
                            <Label for="zipcode">Zipcode</Label>
                            <Input
                                id="zipcode"
                                type="text"
                                v-model="eventForm.zipcode"
                                placeholder="Zipcode/Postal code"
                            />
                            <InputError :message="eventForm.errors.zipcode" />
                        </div>


                        <!-- Image Upload -->
                        <div class="grid gap-2 md:col-span-2">
                            <Label for="image">Event Image</Label>
                            <div v-if="event.imageUrl" class="mb-2">
                                <p class="text-sm text-muted-foreground">Current image:</p>
                                <img :src="event.imageUrl" alt="Event image" class="h-32 object-cover rounded-md" />
                            </div>
                            <Input
                                id="image"
                                type="file"
                                accept="image/*"
                                @change="handleImageUpload"
                            />
                            <p class="text-sm text-muted-foreground">Upload a new image to replace the current one</p>
                            <div v-if="imageFile" class="mt-2">
                                <p class="text-sm text-muted-foreground">New selected image:</p>
                                <img :src="URL.createObjectURL(imageFile)" alt="Selected image" class="h-32 object-cover rounded-md mt-1" />
                            </div>
                            <InputError :message="eventForm.errors.image" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <Button type="button" variant="outline" :href="route('events.index')">Cancel</Button>
                        <Button type="submit">Update Event</Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </AppLayout>
</template>

<style scoped></style>
