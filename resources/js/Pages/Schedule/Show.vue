<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Schedule Details
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-2xl mb-8">Schedule on {{ schedule.date }} from {{ schedule.startTime }} to {{ schedule.endTime }}</h2>

                        <h4 class="text-xl text-gray-700">Event Details:</h4>

                        <p>Name: {{schedule.event.name}}</p>
                        <p>Description: {{schedule.event.description}}</p>
                        <p>Day: {{schedule.event.day}}</p>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    props: ['schedule'],

    components: {
        BreezeAuthenticatedLayout,
        Head
    },

}
</script>

