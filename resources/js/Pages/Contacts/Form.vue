<script setup>
defineProps({ form: Object })
defineEmits(['submit'])
</script>

<template>
    <form @submit.prevent="$emit('submit')" class="space-y-4">
        <div>
            <label class="block font-medium">Name</label>
            <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" />
            <div v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</div>
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input v-model="form.email" type="email" class="w-full border rounded px-3 py-2" />
            <div v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</div>
        </div>

        <div>
            <label class="block font-medium">Phone</label>
            <input v-model="form.phone" type="text" class="w-full border rounded px-3 py-2" />
            <div v-if="form.errors.phone" class="text-red-500 text-sm">{{ form.errors.phone }}</div>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>
</template>
