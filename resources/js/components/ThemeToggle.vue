<script setup lang="ts">
import { useAppearance } from '@/composables/useAppearance';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Button } from '@/components/ui/button';
import { Moon, Sun, Monitor } from 'lucide-vue-next';

const { appearance, updateAppearance } = useAppearance();
</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" size="icon" class="relative">
        <Sun v-if="appearance === 'light'" class="h-5 w-5" />
        <Moon v-else-if="appearance === 'dark'" class="h-5 w-5" />
        <Monitor v-else class="h-5 w-5" />
        <span class="sr-only">Toggle theme</span>
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuItem @click="updateAppearance('light')">
        <Sun class="mr-2 h-4 w-4" />
        <span>Light</span>
      </DropdownMenuItem>
      <DropdownMenuItem @click="updateAppearance('dark')">
        <Moon class="mr-2 h-4 w-4" />
        <span>Dark</span>
      </DropdownMenuItem>
      <DropdownMenuItem @click="updateAppearance('system')">
        <Monitor class="mr-2 h-4 w-4" />
        <span>System</span>
      </DropdownMenuItem>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
