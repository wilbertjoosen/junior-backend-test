<script setup>
import { usePage, Link } from '@inertiajs/vue3'

const { props } = usePage()
const flash = props.flash?.success
</script>

<template>
    <div class="min-h-screen bg-gray-100 text-gray-900">
        <nav class="bg-white border-b px-6 py-4 flex justify-between items-center">
            <!-- Left: Brand -->
            <div class="flex items-center space-x-6">
                <Link href="/" class="font-semibold text-xl text-gray-800">Contact App</Link>

                <!-- Navigation links -->
                <Link
                    href="/contacts"
                    class="text-gray-600 hover:text-gray-900 text-sm"
                    :class="{ 'font-bold underline': $page.url.startsWith('/contacts') }"
                >
                    Contacts
                </Link>
            </div>

            <!-- Right: (Optional user/account menu) -->
            <div>
                <!-- Add logout or profile dropdown here if needed -->
            </div>
        </nav>

        <!-- Flash message -->
        <div v-if="flash" class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 m-4 rounded">
            {{ flash }}
        </div>

        <main class="p-6">
            <slot />
        </main>
    </div>
</template>
