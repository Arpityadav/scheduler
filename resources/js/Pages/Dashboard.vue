<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Calendar
                            class="custom-calendar max-w-full"
                            :masks="masks"
                            :attributes="attributes"
                            disable-page-swipe
                            is-expanded
                        >
                            <template v-slot:day-content="{ day, attributes }">
                                <div class="flex flex-col h-full z-10 overflow-hidden">
                                    <span class="day-label text-sm text-gray-900">{{ day.day }}</span>
                                    <div class="flex-grow overflow-y-auto overflow-x-auto">
                                        <p
                                            v-for="attr in attributes"
                                            :key="attr.key"
                                            class="text-xs leading-tight rounded-sm p-1 mt-0 mb-1"
                                            :class="attr.customData.class"
                                        >
                                            <Link :href="route('schedules.show', {schedule: attr.customData.scheduleId})">{{ attr.customData.title }}</Link>
                                        </p>
                                    </div>
                                </div>
                            </template>
                        </Calendar>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Calendar } from 'v-calendar';
import moment from 'moment';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        Calendar
    },

    created() {
        axios.get(route('schedules.index'))
            .then((response) => {
                response.data.forEach((element, indexEvent) => {
                    element.schedules.forEach((elementSchedules, indexSchedule) => {
                        this.attributes.push({
                            customData: {
                                title: element.name,
                                class: 'bg-blue-500 text-white',
                                scheduleId: elementSchedules.id,
                            },
                            dates: moment(elementSchedules.date).toDate()
                        });
                    });
                });
            });
    },

    data() {
        const month = new Date().getMonth();
        const year = new Date().getFullYear();
        return {
            masks: {
                weekdays: 'WWW',
            },
            attributes: [],
        };
    },
}
</script>


<style lang="scss" scoped>
    /*::-webkit-scrollbar {*/
    /*    width: 0px;*/
    /*}*/
    /*::-webkit-scrollbar-track {*/
    /*    display: none;*/
    /*}*/
    /deep/ .custom-calendar.vc-container {
        --day-border: 1px solid #b8c2cc;
        --day-border-highlight: 1px solid #b8c2cc;
        --day-width: 90px;
        --day-height: 90px;
        --weekday-bg: #f8fafc;
        --weekday-border: 1px solid #eaeaea;
        border-radius: 0;
        width: 100%;
        & .vc-header {
              background-color: #f1f5f8;
              padding: 10px 0;
        }
        & .vc-weeks {
            padding: 0;
        }
        & .vc-weekday {
              background-color: var(--weekday-bg);
              border-bottom: var(--weekday-border);
              border-top: var(--weekday-border);
              padding: 5px 0;
        }
        & .vc-day {
            padding: 0 5px 3px 5px;
            text-align: left;
            height: var(--day-height);
            min-width: var(--day-width);
            background-color: white;

            &.weekday-1,
            &.weekday-7 {
                background-color: #eff8ff;
            }
            &:not(.on-bottom) {
                border-bottom: var(--day-border);
                &.weekday-1 {
                    border-bottom: var(--day-border-highlight);
                }
            }
            &:not(.on-right) {
                border-right: var(--day-border);
            }
        }
        & .vc-day-dots {
            margin-bottom: 5px;
        }
    }
</style>
