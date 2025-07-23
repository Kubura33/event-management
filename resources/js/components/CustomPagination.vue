<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { EventFilters } from '@/types/event';

const props = defineProps<{
    links: {
        url: string | null;
        label: string;
        active: boolean;
    }[];
    meta: {
        current_page: number;
        from: number;
        to: number;
        total: number;
    };
    filters: EventFilters;
}>();

const goToPage = (url: string | null) => {
    if (!url) return;
    const query = new URL(url, window.location.origin).searchParams;
    const page = query.get('page');

    router.get(
        route('browse-events'),
        {
            ...props.filters,
            page,
        },
        {
            preserveScroll: true,
            preserveState: true,
        },
    );
};
</script>

<template>
    <div class="mt-8 flex items-center justify-between border-t border-gray-200 pt-6">
        <div class="hidden w-full sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ meta.from }}</span>
                    to
                    <span class="font-medium">{{ meta.to }}</span>
                    of
                    <span class="font-medium">{{ meta.total }}</span>
                    results
                </p>
            </div>

            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <template v-for="(link, index) in links" :key="index">
                        <button
                            v-if="link.url"
                            @click="goToPage(link.url)"
                            v-html="link.label"
                            :class="[
                                'relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 focus:z-20 focus:outline-offset-0 cursor-pointer',
                                link.active ? 'z-10 bg-indigo-600 font-semibold text-white' : 'text-gray-700 ',
                                index === 0 ? 'rounded-l-md' : '',
                                index === links.length - 1 ? 'rounded-r-md' : '',
                            ]"
                        />
                        <span v-else v-html="link.label" class="px-4 py-2 text-sm text-gray-400 ring-1 ring-gray-300 ring-inset" />
                    </template>
                </nav>
            </div>
        </div>
    </div>
</template>
