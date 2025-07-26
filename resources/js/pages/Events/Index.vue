<script setup lang="ts">
import CustomPagination from '@/components/CustomPagination.vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Event, EventFilters } from '@/types/event';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { Eye, SquarePen } from 'lucide-vue-next';
import { computed, ref } from 'vue';

const isProcessing = ref<boolean>(false);

const page = usePage();
const events = computed<Event[]>(() => page.props.events.data);
const pagination = computed(() => page.props.events);
// Handle add event button click
const breadCrumbs: BreadcrumbItem[] = [
    {
        title: 'My Events',
        href: '/events',
    },
];

//Event deletion
const confirmation = ref<string>('');

const filters = ref<Partial<EventFilters>>({})
const deleteEvent = (eventSlug: string) => {
    router.delete(route('events.destroy', { event: eventSlug }), {
        onSuccess: () => {
            confirmation.value = '';
        },
        onFinish: () => {
            isProcessing.value = false;
        },
    });
};

const isConfirmed = computed(() => {
    return !(confirmation.value === 'permamently delete');
});

const getImageUrl = (event: Event): string => {
    return event.imageUrl ?? '/event-image-placeholder.png'
}

//Show Event

//Edit event
</script>

<template>
    <Head title="My events" />

    <AppLayout :breadcrumbs="breadCrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="flex">
                <Button :as="Link" :href="route('events.create')" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    Add Event
                </Button>
            </div>
            <div v-if="events.length" class="mt-4">
                <Table>
                    <TableCaption>A list of your events.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class=""> Title</TableHead>
                            <TableHead class="w-[200px]"> Image</TableHead>
                            <TableHead class="max-w-sm">Description</TableHead>
                            <TableHead>Date</TableHead>
                            <TableHead> Price</TableHead>
                            <TableHead> Attendees/Capacity</TableHead>
                            <TableHead> Address</TableHead>

                            <TableHead class="text-center"> Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="event in events" :key="event.id">
                            <TableCell class="font-medium">
                                {{ event.title }}
                            </TableCell>
                            <TableCell class="font-medium">
                                <img :src="getImageUrl(event)" alt="Event image" class="h-24 w-full object-contain" />
                            </TableCell>
                            <TableCell class="max-w-sm whitespace-normal">
                                {{ event.description }}
                            </TableCell>
                            <TableCell>
                                {{ event.date }}
                            </TableCell>
                            <TableCell>
                                {{ event.price }}
                            </TableCell>
                            <TableCell> 0/ {{ event.capacity }}</TableCell>
                            <TableCell class="max-w-xs whitespace-normal">
                                {{ event.country }}, {{ event.city }}, {{ event.address }}, ZIP: {{ event.zipcode }}
                            </TableCell>
                            <TableCell class="flex flex-col items-center justify-center gap-2">
                                <Button :as="Link" :href="route('events.show', { event: event.slug })" variant="secondary">
                                    <Eye />
                                </Button>
                                <Button :as="Link" :href="route('events.edit', { event: event.slug })" variant="outline">
                                    <SquarePen />
                                </Button>

                                <Dialog>
                                    <DialogTrigger as-child>
                                        <Button variant="destructive">X</Button>
                                    </DialogTrigger>
                                    <DialogContent>
                                        <div class="space-y-6" @submit="deleteEvent">
                                            <DialogHeader class="space-y-3">
                                                <DialogTitle>Are you sure you want to delete your event?</DialogTitle>
                                                <DialogDescription>
                                                    Once your event is deleted, all of its resources and data will also be permanently deleted. Please
                                                    enter "permamently delete" to confirm you would like to permanently delete your event.
                                                </DialogDescription>
                                            </DialogHeader>

                                            <div class="grid gap-2">
                                                <Label for="confirmation" class="sr-only">Event name</Label>
                                                <Input id="confirmation" type="text" name="confirmation" v-model="confirmation" />
                                                <!--                        <InputError :message="form.errors.eventName" />-->
                                            </div>

                                            <DialogFooter class="gap-2">
                                                <DialogClose as-child>
                                                    <Button variant="secondary"> Cancel</Button>
                                                </DialogClose>

                                                <Button
                                                    type="submit"
                                                    variant="destructive"
                                                    :disabled="isProcessing || isConfirmed"
                                                    @click="deleteEvent(event.slug)"
                                                >
                                                    Delete account
                                                </Button>
                                            </DialogFooter>
                                        </div>
                                    </DialogContent>
                                </Dialog>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
                <CustomPagination
                    :links="pagination.links"
                    :meta="{
                        current_page: pagination.current_page,
                        from: pagination.from,
                        to: pagination.to,
                        total: pagination.total,
                    }"
                    :filters="filters"
                />
            </div>
            <div v-else>
                You don't have any events
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>
