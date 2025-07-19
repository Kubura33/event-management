<script setup lang="ts">

</script>

<template>
    <div class="lg:col-span-3">
        <div class="bg-white rounded-lg shadow-sm p-6 sticky top-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Filters</h2>

            <!-- Search -->
            <div class="mb-6">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 pr-12 py-2 sm:text-sm border-gray-300 rounded-md" placeholder="Search events...">
                </div>
            </div>

            <!-- Categories -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-900 mb-2">Categories</h3>
                <div class="flex flex-wrap gap-2">
                    <button class="category-pill px-3 py-1 bg-gray-100 hover:bg-indigo-600 hover:text-white rounded-full text-sm active">All</button>
                    <button class="category-pill px-3 py-1 bg-gray-100 hover:bg-indigo-600 hover:text-white rounded-full text-sm">Music</button>
                    <button class="category-pill px-3 py-1 bg-gray-100 hover:bg-indigo-600 hover:text-white rounded-full text-sm">Business</button>
                    <button class="category-pill px-3 py-1 bg-gray-100 hover:bg-indigo-600 hover:text-white rounded-full text-sm">Food</button>
                    <button class="category-pill px-3 py-1 bg-gray-100 hover:bg-indigo-600 hover:text-white rounded-full text-sm">Arts</button>
                    <button class="category-pill px-3 py-1 bg-gray-100 hover:bg-indigo-600 hover:text-white rounded-full text-sm">Sports</button>
                    <button class="category-pill px-3 py-1 bg-gray-100 hover:bg-indigo-600 hover:text-white rounded-full text-sm">Tech</button>
                </div>
            </div>

            <!-- Date Range -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-900 mb-2">Date Range</h3>
                <div class="space-y-2">
                    <div class="flex justify-between text-xs text-gray-500">
                        <span>Today</span>
                        <span>Next 3 months</span>
                    </div>
                    <input type="range" min="0" max="90" value="30" class="date-range-slider w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                    <div class="text-center text-sm font-medium text-indigo-600" id="dateRangeValue">Next 30 days</div>
                </div>
            </div>

            <!-- Price Range -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-900 mb-2">Price Range</h3>
                <div class="flex items-center space-x-2">
                    <div class="relative rounded-md shadow-sm flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="text" name="price-min" id="price-min" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-3 py-2 sm:text-sm border-gray-300 rounded-md" placeholder="Min">
                    </div>
                    <span class="text-gray-500">-</span>
                    <div class="relative rounded-md shadow-sm flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="text" name="price-max" id="price-max" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-3 py-2 sm:text-sm border-gray-300 rounded-md" placeholder="Max">
                    </div>
                </div>
            </div>

            <!-- Location -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-900 mb-2">Location</h3>
                <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option>All Locations</option>
                    <option>New York, USA</option>
                    <option>London, UK</option>
                    <option>Paris, France</option>
                    <option>Tokyo, Japan</option>
                    <option>Sydney, Australia</option>
                    <option>Berlin, Germany</option>
                </select>
            </div>

            <!-- More Filters -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-900 mb-2">More Filters</h3>
                <div class="space-y-2">
                    <div class="flex items-center">
                        <input id="free-events" name="free-events" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="free-events" class="ml-2 block text-sm text-gray-700">Free events only</label>
                    </div>
                    <div class="flex items-center">
                        <input id="available-spots" name="available-spots" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="available-spots" class="ml-2 block text-sm text-gray-700">Available spots only</label>
                    </div>
                    <div class="flex items-center">
                        <input id="online-events" name="online-events" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="online-events" class="ml-2 block text-sm text-gray-700">Online events</label>
                    </div>
                </div>
            </div>

            <!-- Apply Filters Button -->
            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md text-sm font-medium">
                Apply Filters
            </button>

            <!-- Reset Filters Link -->
            <button class="w-full text-indigo-600 hover:text-indigo-800 text-sm font-medium mt-2">
                Reset Filters
            </button>
        </div>
    </div>
</template>

<style scoped>
.category-pill {
    transition: all 0.2s ease;
}
.category-pill:hover, .category-pill.active {
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
