<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Event } from '@/types/event';
import { Head, Link } from '@inertiajs/vue3';
import { SquarePen, Eye } from 'lucide-vue-next';
import { Pagination, PaginationContent, PaginationItem, PaginationPrevious } from '@/components/ui/pagination';
import { router } from '@inertiajs/vue3';

interface Paginated<T> {
    data: T[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    from: number;
    to: number;
    // add more fields from Laravel pagination if needed
}

interface Props {
    events: Paginated<Event>;
}

function handlePageChange(newPage: number) {
    router.get(route('events.index'), { page: newPage }, {
        preserveScroll: true,
        preserveState: true
    });
}
const props = defineProps<Props>();
// Handle add event button click

const breadCrumbs: BreadcrumbItem[] = [
    {
        title: 'My Events',
        href: '/events',
    },
];
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
            <div>
                <Table>
                    <TableCaption>A list of your events.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class=""> Title </TableHead>
                            <TableHead class="w-[200px]"> Image </TableHead>
                            <TableHead class="max-w-sm">Description</TableHead>
                            <TableHead>Date</TableHead>
                            <TableHead> Price </TableHead>
                            <TableHead> Attendees/Capacity </TableHead>
                            <TableHead> Address </TableHead>

                            <TableHead class="text-center"> Actions </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="event in events.data" :key="event.id">
                            <TableCell class="font-medium">
                                {{ event.title }}
                            </TableCell>
                            <TableCell class="font-medium">
                                <img
                                    :src="event.imageUrl || 'https://imgs.search.brave.com/RT802e_LwBpcWwI7b6Ns61xhw4S_aVL7a55bM-tjgoM/rs:fit:0:180:1:0/g:ce/aHR0cHM6Ly9iLnRo/dW1icy5yZWRkaXRt/ZWRpYS5jb20vd2FR/dVVjOXo0Y25HTk5a/UGR4YzlPQTB1UWpm/aGdBcGtzRWxxaDg2/aFN1RS5qcGc'"
                                    alt="Event image"
                                    class="w-full h-24 object-cover"
                                />
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
                            <TableCell> 0/ {{ event.capacity }} </TableCell>
                            <TableCell class="max-w-xs whitespace-normal">
                                {{ event.country }}, {{ event.city }}, {{ event.address }}, ZIP: {{ event.zipcode }}
                            </TableCell>
                            <TableCell class="flex flex-col items-center justify-center gap-2">
                                <Button variant="secondary"> <Eye /> </Button>
                                <Button variant="outline">
                                    <SquarePen />
                                </Button>
                                <Button variant="destructive">X</Button>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
                <Pagination @update:page="handlePageChange" v-slot="{ page }" :items-per-page="events.per_page" :total="events.total" :default-page="events.current_page">
                    <PaginationContent v-slot="{ items }">
                        <PaginationPrevious />

                        <template v-for="(item, index) in items" :key="index">
                            <PaginationItem
                                v-if="item.type === 'page'"
                                :value="item.value"
                                :is-active="item.value === page"
                            >
                                {{ item.value }}
                            </PaginationItem>
                        </template>

                        <PaginationEllipsis :index="4" />

                        <PaginationNext />
                    </PaginationContent>
                </Pagination>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>
