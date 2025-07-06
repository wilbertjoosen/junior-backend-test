<template>
    <div class="max-w-xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">View Contact</h1>

        <div class="bg-white shadow rounded p-6">
            <p><strong>Name:</strong> {{ contact.name }}</p>
            <p><strong>Email:</strong> {{ contact.email }}</p>
            <p><strong>Phone:</strong> {{ contact.phone }}</p>
        </div>

        <div class="mt-4">
            <Link :href="route('contacts.index')" class="text-blue-500 hover:underline">← Back to Contacts</Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
defineOptions({ layout: AuthenticatedLayout });
defineProps({
    contact: Object
});
</script>
