export interface Event {
    id: string;
    title: string;
    date: string;
    slug: string;
    description: string;
    attendees?: string;
    capacity: number;
    imageUrl?: string;
    price?: number;
    city: string;
    address: string;
    country: string;
    zipcode?: string;
    created_at?: string;
    updated_at?: string;
}

export type Category = {
    id: string;
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
