<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link href="/">Home</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4">
        <slot>Default</slot>
    </main>
</template>

<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'
//
// const page = usePage()
// let flashSuccess;
// flashSuccess = computed(
//     () => page.props.value.flash.success,
//     () => page.props.value.flash.success,
// );
</script>
