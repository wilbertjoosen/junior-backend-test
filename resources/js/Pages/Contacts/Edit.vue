<script setup>
import Form from './Form.vue'
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
defineOptions({ layout: AuthenticatedLayout });

// ✅ Explicitly assign props
const props = defineProps({
    contact: Object,
})

// ✅ Use the prop via `props.contact`
const form = useForm({ ...props.contact })

function submit() {
    form.put(`/contacts/${props.contact.id}`)
}
</script>

<template>
    <div class="max-w-xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Contact</h1>
        <Form :form="form" @submit="submit" />
    </div>
</template>
