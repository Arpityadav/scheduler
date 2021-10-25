<template>
    <Head title="Create an event" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create an event
            </h2>
        </template>


        <div class="min-h-screen flex flex-col  items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <BreezeValidationErrors class="mb-4" />

                <form @submit.prevent="submit">
                    <div>
                        <BreezeLabel for="name" value="Name" />
                        <BreezeInput id="name" type="text" class="mt-1 block w-full" required v-model="form.name"  autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="description" value="Add description" />
                        <textarea  id="description" v-model="form.description"  required  class="w-full mt-1 block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" rows="4"></textarea>
                    </div>

                    <div class="mt-4">
                        <label for="startTime">Choose a starting time:</label>
                        <VueTimepicker id="startTime" v-model="form.startTime"/>
                    </div>

                    <div class="mt-4">
                        <label for="endTime">Choose an ending time:</label>
                        <VueTimepicker id="endTime" v-model="form.endTime"/>
                    </div>

                    <div class="mt-4">
                        <label for="weekdays">Choose a week:</label>

                        <select name="weekdays" id="weekdays" @change="changeDay($event)">
                            <option v-for="weekday in weekdays" :value="weekday">{{ weekday }}</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create
                        </BreezeButton>
                    </div>
                </form>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>

import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';

import VueTimepicker from "vue3-timepicker";
// CSS
import "vue3-timepicker/dist/VueTimepicker.css";

export default {
    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        BreezeAuthenticatedLayout,
        Head,
        VueTimepicker
    },

    data() {
        return {
            weekdays: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            time: '2019-02-01 01:02:01',
            form: this.$inertia.form({
                name: '',
                description: '',
                startTime: '',
                endTime: '',
                day: 'Sunday',
            })
        }
    },

    methods: {

        submit() {
            this.form.post(this.route('event.store'));
        },

        changeDay (event) {
            this.form.day = event.target.value;
        },
    }
}
</script>
