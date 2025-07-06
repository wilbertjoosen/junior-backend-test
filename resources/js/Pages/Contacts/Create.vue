<script setup>
import Form from './Form.vue'
import { useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
defineOptions({ layout: AuthenticatedLayout });

const form = useForm({
    name: '',
    email: '',
    phone: ''
})

function submit() {
    form.post('/contacts')
}
</script>

<template>
    <div class="max-w-xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Create Contact</h1>
        <Form :form="form" @submit="submit" />
    </div>
</template>
