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
        account: Object
    });
    const view = useForm({
        id: props.account.id,
        name: props.account.name,
        email: props.account.email,
        role: props.account.roles,
        active: props.account.active,
        create: props.account.created_at,
        update: props.account.updated_at,
        profile_photo_path: (props.account.profile_photo_path) ?  "/storage/" + props.account.profile_photo_path : team1
    });

</script>

<template>
    <AppLayout title="View Companies">{{props.account}}
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
                                    <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                                        <div class="relative">
                                            <img alt="profile" :src="view.profile_photo_path" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                                        <div class="py-6 px-3 mt-32 sm:mt-0">
                                            <Link
                                                class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                                :href="route('users.edit', view.id)"
                                            >
                                              {{$t('Edit')}}
                                            </Link>
                                            <Link
                                                class="bg-lightBlue-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                                :href="route('users.index')"
                                            >
                                              {{$t('Back')}}
                                            </Link>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                        <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                            <div class="mr-4 p-3 text-center">
                                                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"> 22 </span>
                                                <span class="text-sm text-blueGray-400">{{$t('Friends')}}</span>
                                            </div>
                                            <div class="mr-4 p-3 text-center">
                                                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"> 10 </span>
                                                <span class="text-sm text-blueGray-400">{{$t('Photos')}}</span>
                                            </div>
                                            <div class="lg:mr-4 p-3 text-center">
                                                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600"> 89 </span>
                                                <span class="text-sm text-blueGray-400">{{$t('Comments')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-12">
                                    <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2"> {{view.name}}  </h3>
                                    <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                                        <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i> {{view.role.name}}
                                    </div>
                                    <div class="mb-2 text-blueGray-600 mt-10">
                                        <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i> {{view.email}}
                                    </div>
                                    <div class="mb-2 text-blueGray-600">
                                        <i class="fas fa-university mr-2 text-lg text-blueGray-400"></i> {{view.create}}
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
