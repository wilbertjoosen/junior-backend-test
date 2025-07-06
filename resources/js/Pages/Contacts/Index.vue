<script setup>
import { router, Link } from '@inertiajs/vue3'
defineProps({ contacts: Object })
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
defineOptions({ layout: AuthenticatedLayout });

function destroy(id) {
    if (confirm('Are you sure?')) {
        router.delete(`/contacts/${id}`)
    }
}
</script>

<template>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Contacts</h1>

        <Link :href="route('contacts.create')" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            Create Contact
        </Link>

        <table class="min-w-full bg-white border mt-4">
            <thead class="bg-gray-100">
            <tr>
                <th class="text-left p-2">Name</th>
                <th class="text-left p-2">Email</th>
                <th class="text-left p-2">Phone</th>
                <th class="text-left p-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="contact in contacts.data" :key="contact.id" class="border-t">
                <td class="p-2">{{ contact.name }}</td>
                <td class="p-2">{{ contact.email }}</td>
                <td class="p-2">{{ contact.phone }}</td>
                <td class="p-2">
                    <a :href="`/contacts/${contact.id}`" class="text-blue-500 mr-2">View</a>
                    <a :href="`/contacts/${contact.id}/edit`" class="text-blue-500 mr-2">Edit</a>
                    <button @click="destroy(contact.id)" class="text-red-500">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div class="mt-4 flex justify-between">
            <button
                v-if="contacts.prev_page_url"
                @click="router.visit(contacts.prev_page_url)"
                class="px-4 py-2 bg-gray-200 rounded"
            >
                Previous
            </button>
            <button
                v-if="contacts.next_page_url"
                @click="router.visit(contacts.next_page_url)"
                class="px-4 py-2 bg-gray-200 rounded"
            >
                Next
            </button>
        </div>
    </div>
</template>
