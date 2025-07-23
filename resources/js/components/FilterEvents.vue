<script setup lang="ts">
import { Category, EventFilters } from '@/types/event';
import { computed, onMounted, ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import Multiselect from 'vue-multiselect'

const props = defineProps<{ categories: Category[]; filters: EventFilters, locations: string[] }>();

const selectedCategories = ref<Category[]>([]);

const addCategoryToFilter = (category: Category): void => {
    const index = selectedCategories.value.findIndex((c) => c === category);
    if (index !== -1) {
        selectedCategories.value.splice(index, 1);
    } else {
        selectedCategories.value.push(category);
    }
};

const filterForm = useForm<EventFilters>({
    minPrice: props.filters.minPrice ?? null,
    categories: props.filters.categories ?? [],
    searchQuery: props.filters.searchQuery ?? '',
    maxPrice: props.filters.maxPrice ?? null,
    locations: props.filters.locations ?? null,
    availableSpots: props.filters.availableSpots ?? false,
    freeEvents: props.filters.freeEvents ?? false,
    onlineEvents: props.filters.onlineEvents ?? false,
    dateRange: props.filters.dateRange ?? 5,
});

const getDateString = computed((): string => {
    if (filterForm.dateRange > 0) {
        if (filterForm.dateRange > 1) {
            return 'Next ' + filterForm.dateRange + ' days';
        }
        return 'Next 1 day';
    }
    return 'Today';
});

const filter = () => {
    filterForm.categories = selectedCategories.value.map((c) => c.id);

    filterForm.get(route('browse-events'), {
        preserveState: true,
        preserveScroll: true,
    });
};

const resetFilters = () => {
    filterForm.reset()
    selectedCategories.value = []
    router.get(route('browse-events'))
}
onMounted(() => {
    if (props.filters.categories) {
        selectedCategories.value = props.categories.filter((c) => props.filters.categories.includes(c.id));
    }
});
</script>

<template>
    <div class="lg:col-span-3">
        <div class="sticky top-6 rounded-lg bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-medium text-gray-900">Filters</h2>

            <!-- Search -->
            <div class="mb-6">
                <label for="search" class="mb-1 block text-sm font-medium text-gray-700">Search</label>
                <div class="relative rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            ></path>
                        </svg>
                    </div>
                    <input
                        type="text"
                        id="search"
                        v-model="filterForm.searchQuery"
                        class="block w-full rounded-md border-gray-300 py-2 pr-12 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Search events..."
                    />
                </div>
            </div>
            <!-- Categories -->
            <div class="mb-6">
                <h3 class="mb-2 text-sm font-medium text-gray-900">Categories</h3>
                <div class="flex flex-wrap gap-2">
                    <button
                        class="category-pill rounded-full bg-gray-100 px-3 py-1 text-sm hover:bg-indigo-600 hover:text-white"
                        :class="{ active: !selectedCategories.length }"
                        @click="selectedCategories = []"
                    >
                        All
                    </button>
                    <button
                        class="category-pill cursor-pointer rounded-full bg-gray-100 px-3 py-1 text-sm hover:bg-indigo-600 hover:text-white"
                        :class="{ active: selectedCategories.some((c) => c.id === category.id) }"
                        @click="addCategoryToFilter(category)"
                        v-for="category in categories"
                        :key="category.id"
                    >
                        {{ category.name }}
                    </button>
                </div>
            </div>

            <!-- Date Range -->
            <div class="mb-6">
                <h3 class="mb-2 text-sm font-medium text-gray-900">Date Range</h3>
                <div class="space-y-2">
                    <div class="flex justify-between text-xs text-gray-500">
                        <span>Today</span>
                        <span>Next 3 months</span>
                    </div>
                    <input
                        type="range"
                        min="0"
                        max="90"
                        v-model="filterForm.dateRange"
                        class="date-range-slider h-2 w-full cursor-pointer appearance-none rounded-lg bg-gray-200"
                    />
                    <div class="text-center text-sm font-medium text-indigo-600" id="dateRangeValue">
                        {{ getDateString }}
                    </div>
                </div>
            </div>

            <!-- Price Range -->
            <div class="mb-6">
                <h3 class="mb-2 text-sm font-medium text-gray-900">Price Range</h3>
                <div class="flex items-center space-x-2">
                    <div class="relative flex-1 rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input
                            type="text"
                            v-model="filterForm.minPrice"
                            name="price-min"
                            id="price-min"
                            class="block w-full rounded-md border-gray-300 py-2 pr-3 pl-7 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Min"
                        />
                    </div>
                    <span class="text-gray-500">-</span>
                    <div class="relative flex-1 rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input
                            type="text"
                            v-model="filterForm.maxPrice"
                            name="price-max"
                            id="price-max"
                            class="block w-full rounded-md border-gray-300 py-2 pr-3 pl-7 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Max"
                        />
                    </div>
                </div>
            </div>

            <!-- Location -->
            <div class="mb-6">
                <h3 class="mb-2 text-sm font-medium text-gray-900">Location</h3>

                <multiselect id="single-select-search" v-model="filterForm.locations" :options="locations" :multiple="true" placeholder="Select one" aria-label="pick a value"></multiselect>
            </div>

            <!-- More Filters -->
            <div class="mb-6">
                <h3 class="mb-2 text-sm font-medium text-gray-900">More Filters</h3>
                <div class="space-y-2">
                    <div class="flex items-center">
                        <input
                            v-model="filterForm.freeEvents"
                            id="free-events"
                            name="free-events"
                            type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        />
                        <label for="free-events" class="ml-2 block text-sm text-gray-700">Free events only</label>
                    </div>
                    <div class="flex items-center">
                        <input
                            v-model="filterForm.availableSpots"
                            id="available-spots"
                            name="available-spots"
                            type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        />
                        <label for="available-spots" class="ml-2 block text-sm text-gray-700">Available spots only</label>
                    </div>
                    <div class="flex items-center">
                        <input
                            v-model="filterForm.onlineEvents"
                            id="online-events"
                            name="online-events"
                            type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        />
                        <label for="online-events" class="ml-2 block text-sm text-gray-700">Online events</label>
                    </div>
                </div>
            </div>

            <!-- Apply Filters Button -->
            <button @click.prevent="filter" class="w-full rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                Apply Filters
            </button>

            <!-- Reset Filters Link -->
            <button class="mt-2 w-full cursor-pointer text-sm font-medium text-indigo-600 hover:text-indigo-800" @click="resetFilters">Reset Filters</button>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style scoped>
.category-pill {
    transition: all 0.2s ease;
}

.category-pill:hover,
.category-pill.active {
    background-color: #4f46e5;
    color: white;
}

.date-range-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #4f46e5;
    cursor: pointer;
}

.date-range-slider::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #4f46e5;
    cursor: pointer;
}

.view-toggle-button {
    transition: all 0.2s ease;
}

.view-toggle-button.active {
    background-color: #4f46e5;
    color: white;
}
</style>
