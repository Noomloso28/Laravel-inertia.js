<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import team1 from "@/assets/img/team-4-470x470.png";

    const props = defineProps({
        color: {
            default: "light",
            validator: function (value) {
                // The value must match one of these strings
                return ["light", "dark"].indexOf(value) !== -1;
            },
        },
      departments: Object
    });
    const view = useForm({
        id: props.departments.id,
        name: props.departments.name,
        active: props.departments.active,
        create: props.departments.created_at,
        update: props.departments.updated_at,
    });

</script>

<template>
    <AppLayout title="View Companies">
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div
                    :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
                >
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                                <div class="flex flex-wrap justify-center">
                                    <div class="w-full lg:order-3 lg:text-right lg:self-center">
                                        <div class="py-6 px-3 mt-32 sm:mt-0">
                                            <Link
                                                class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                                :href="route('departments.edit', view.id)"
                                            >
                                              {{$t('Edit')}}
                                            </Link>
                                            <Link
                                                class="bg-lightBlue-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                                :href="route('departments.index')"
                                            >
                                              {{$t('Back')}}
                                            </Link>
                                        </div>
                                    </div>

                                </div>
                                <div class="text-center mt-12">
                                    <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2"> {{view.name}}  </h3>
                                    <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                                        <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i> {{view.create}}
                                    </div>
                                    <div class="mb-2 text-blueGray-600 mt-10">
                                        <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i> {{view.update}}
                                    </div>
                                    <div class="mb-2 text-blueGray-600">
                                        <i class="fas fa-university mr-2 text-lg text-blueGray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>

</template>



<style scoped>

</style>
