<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Event } from '@/types/event';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import InputError from '@/components/InputError.vue';
import { ref } from 'vue';

const breadCrumbs: BreadcrumbItem[] = [
    {
        title: 'My Events',
        href: '/events',
    },
    {
        title: 'Create an event',
        href: route('events.create')
    }
];

const imageFile = ref<File | null>(null);

const eventForm = useForm({
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

const imagePreviewUrl = ref<string | null>(null)
const handleImageUpload = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        const file = target.files[0]
        imageFile.value = file;
        imagePreviewUrl.value = URL.createObjectURL(file)
        eventForm.image = target.files[0];
    }
};

const addEvent = () => {
    console.log(eventForm)
    eventForm.post(route('events.store'), {
        forceFormData: true,
        onSuccess: () => {

        },
    });
};
</script>

<template>
    <Head title="Create an event" />
    <AppLayout :breadcrumbs="breadCrumbs">
        {{eventForm.errors}}
        <Card class="max-w-4xl min-w-xl mx-auto mt-5">
            <CardHeader>
                <CardTitle>Create an Event</CardTitle>
                <CardDescription>Fill in the details to create a new event</CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="addEvent" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="gap-2 flex flex-col md:col-span-2">
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

                        <!-- Date -->
                        <div class=" gap-2 flex flex-col md:col-span-2">
                            <Label for="title">Date, with starting hours</Label>
                            <Input
                                id="date"
                                type="text"
                                required
                                autofocus
                                v-model="eventForm.date"
                                placeholder="Event date e.g: 2025-05-05 17:00"
                                class="flex-grow"
                            />
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
                            <Input
                                id="image"
                                type="file"
                                accept="image/*"
                                @change="handleImageUpload"
                            />
                            <p class="text-sm text-muted-foreground">Upload an image for your event</p>
                            <div v-if="imagePreviewUrl" class="mt-2">
                                <p class="text-sm text-muted-foreground">Selected image:</p>
                                <img :src="imagePreviewUrl" alt="Selected image" class="h-32 object-cover rounded-md mt-1" />
                            </div>
                            <InputError :message="eventForm.errors.image" />
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <Button type="submit" class="w-full md:w-auto">Create Event</Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </AppLayout>
</template>

<style scoped></style>
