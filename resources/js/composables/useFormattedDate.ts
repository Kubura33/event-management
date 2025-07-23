// composables/useFormattedDate.ts
import { computed } from 'vue'

export function useFormattedDate(date: string | number | Date, locale = 'en-US') {
    const formattedDate = computed(() => {
        return new Date(date).toLocaleDateString(locale, {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        })
    })

    return { formattedDate }
}
