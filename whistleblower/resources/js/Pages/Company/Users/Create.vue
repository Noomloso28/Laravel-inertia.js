<template>
    <AppLayout title="Platform Companies">
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div
                    :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
                >
                    <form @submit.prevent="submit">
                        <div class="rounded-t bg-white mb-0 px-6 py-6">
                            <div class="text-center flex justify-between">
                                <h6 class="text-blueGray-700 text-xl font-bold mr-2">{{$t('Add new user')}}</h6>
                                <Link
                                    class="bg-lightBlue-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                    :href="route('users.index')"
                                >
                                  {{$t('Back')}}
                                </Link>
                            </div>
                        </div>
                        <!-- form -->
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-12/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <TextLabel for="name" value="Name" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus />
                                        <span class="text-red-600" v-if="form.errors.name">
                                          {{ $t(form.errors.name) }}
                                        </span>
                                    </div>

                                    <div class="relative w-full mb-3">
                                      <TextLabel for="email" value="E-mail" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                      <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                                      <span class="text-red-600" v-if="form.errors.email">
                                            {{ $t(form.errors.email) }}
                                          </span>
                                    </div>

                                  <div class="relative w-full mb-3">
                                    <TextLabel for="password" value="Password" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" />
                                    <span class="text-red-600" v-if="form.errors.password">
                                          {{ $t(form.errors.password) }}
                                        </span>
                                  </div>

                                  <div class="relative w-full mb-3">
                                    <TextLabel for="floatingConfirmPassword" value="Confirm Password" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                    <TextInput id="floatingConfirmPassword" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" />
                                    <span class="text-red-600" v-if="form.errors.password_confirmation">
                                          {{ $t(form.errors.password_confirmation) }}
                                        </span>
                                  </div>

                                  <div class="relative w-full mb-6">
                                    <TextLabel for="role" value="Roles" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                    <select v-model="form.role_id" name="role" id="role" :value="form.role_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                      <option v-for="role in props.roles" :value="role.id">{{role.name}}</option>
                                    </select>
                                    <span class="text-red-600" v-if="form.errors.role_id">
                                          {{ $t(form.errors.role_id) }}
                                    </span>
                                  </div>

                                  <div class="relative w-full mb-6">
                                    <TextLabel for="role" value="Company" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                    <select v-model="form.company_id" name="company" id="company" :value="form.company_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                      <option v-for="company in props.companies" :value="company.id">{{company.name}}</option>
                                    </select>
                                    <span class="text-red-600" v-if="form.errors.company_id">
                                          {{ $t(form.errors.company_id) }}
                                    </span>
                                  </div>

                                    <div class="relative w-full mb-6">
                                      <TextLabel for="active" value="Active" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                      <div class="flex">
                                        <div class="flex items-center mr-4">
                                          <input v-model="form.active" checked id="active-enable" type="radio" value="1" name="active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                          <label for="active-enable" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$t('Enable')}}</label>
                                        </div>

                                        <div class="flex items-center mr-4">
                                          <input v-model="form.active" id="active-disable" type="radio" value="0" name="active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                          <label for="active-disable" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$t('Disable')}}</label>
                                        </div>

                                      </div>
                                      <span class="text-red-600" v-if="form.errors.active">
                                                  {{ $t(form.errors.active) }}
                                              </span>
                                    </div>

                                    <button
                                        class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                        type="submit"
                                    >
                                      {{$t('Create')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import TextLabel from '@/Components/InputLabel.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    roles: Array,
    companies: Array,
    color: {
        default: "light",
        validator: function (value) {
            // The value must match one of these strings
            return ["light", "dark"].indexOf(value) !== -1;
        },
    },
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role_id: '',
    active: 1,
    company_id: ''
});
const submit = () => {
    form.post(route('users.store'));
};

</script>
