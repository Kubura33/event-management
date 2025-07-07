<script setup lang="ts">
import { Event } from '@/types/event'
import {
  Card,
  CardHeader,
  CardTitle,
  CardDescription,
  CardContent,
  CardFooter
} from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { computed } from 'vue'

const props = defineProps<{event: Event}>()

// Format date to a more readable format
const formattedDate = computed(() => {
  return new Date(props.event.date).toLocaleDateString('en-US', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
})
</script>

<template>
  <Card class="w-full overflow-hidden">
    <div class="relative">
      <img
        :src="event.imageUrl || 'https://imgs.search.brave.com/RT802e_LwBpcWwI7b6Ns61xhw4S_aVL7a55bM-tjgoM/rs:fit:0:180:1:0/g:ce/aHR0cHM6Ly9iLnRo/dW1icy5yZWRkaXRt/ZWRpYS5jb20vd2FR/dVVjOXo0Y25HTk5a/UGR4YzlPQTB1UWpm/aGdBcGtzRWxxaDg2/aFN1RS5qcGc'"
        alt="Event image"
        class="w-full h-48 object-cover"
      />
      <div class="absolute top-2 right-2 bg-black/70 text-white px-2 py-1 rounded text-xs">
        {{ formattedDate }}
      </div>
    </div>

    <CardHeader>
      <CardTitle>{{ event.title }}</CardTitle>
      <CardDescription>
        <div class="flex items-center gap-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
          </svg>
          {{ event.city }}, {{ event.country }}
        </div>
      </CardDescription>
    </CardHeader>

    <CardContent>
      <p class="text-sm mb-4">{{ event.description }}</p>

      <div class="grid grid-cols-2 gap-4 text-sm">
        <div>
          <p class="font-medium">Location</p>
          <p class="text-muted-foreground">{{ event.address }}</p>
          <p v-if="event.zipcode" class="text-muted-foreground">ZIP: {{ event.zipcode }}</p>
        </div>

        <div>
          <p class="font-medium">Attendance</p>
          <div class="flex items-center gap-2">
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
              <div
                class="bg-blue-600 h-2.5 rounded-full"
                :style="{width: `${(parseInt(event.attendees || '0') / event.capacity) * 100}%`}"
              ></div>
            </div>
            <span class="text-xs">{{ event.attendees || 0 }}/{{ event.capacity }}</span>
          </div>

          <p v-if="event.price" class="mt-2">
            <span class="font-medium">Price:</span> ${{ event.price }}
          </p>
        </div>
      </div>
    </CardContent>

    <CardFooter class="flex justify-end gap-2">
      <Button
        variant="outline"
        @click="$emit('edit', event)"
      >
        Edit
      </Button>
      <Button
        variant="destructive"
        @click="$emit('delete', event)"
      >
        Delete
      </Button>
    </CardFooter>
  </Card>
</template>

<style scoped>
</style>
