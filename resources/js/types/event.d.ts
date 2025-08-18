export interface Event {
    id: number;
    title: string;
    date: string;
    slug: string;
    description: string;
    attendees?: number;
    capacity: number;
    image_url?: string;
    price?: number;
    city: string;
    address: string;
    country: string;
    zipcode?: string;
    created_at?: string;
    updated_at?: string;
    category_id?: number;
    start_date?: string;
    end_date?: string;
    tags?: string[];
    schedules?: any[];
    speakers?: any[];
    faqs?: any[];
}

export type Category = {
    id: number;
    name: string;
    created_at: string;
    updated_at: string;
};

export type EventFilters = {
    minPrice: number | null;
    categories: string[];
    searchQuery: string;
    maxPrice: number | null;
    locations: string[] | null;
    availableSpots: boolean;
    freeEvents: boolean;
    onlineEvents: boolean;
    dateRange: number;
};
