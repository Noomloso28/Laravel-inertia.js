<template>
    <AppLayout title="Platform Email">
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div
                    :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
                >
                    <form @submit.prevent="submit">
                        <div class="rounded-t bg-white mb-0 px-6 py-6">
                            <div class="text-center flex justify-between">
                                <h6 class="text-blueGray-700 text-xl font-bold mr-2">{{$t('E-mail Template Editor')}}</h6>
                                <Link
                                    class="bg-lightBlue-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                    :href="route('email.index')"
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
                                        <TextLabel for="subject" value="Subject" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                        <TextInput
                                            id="subject"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.subject"
                                            autofocus />
                                        <span class="text-red-600" v-if="form.errors.subject">
                                                {{ $t(form.errors.subject) }}
                                        </span>
                                    </div>
                                  <div class="relative w-full mb-6 hidden">
                                    <TextLabel for="companies" value="Companies" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                    <select disabled v-model="form.company_id" name="company_id" id="companies" :value="form.company_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                      <option v-for="values in props.user_companies" :value="values.id">{{values.name}}</option>
                                    </select>
                                    <span class="text-red-600" v-if="form.errors.company_id">
                                          {{ $t(form.errors.company_id) }}
                                    </span>
                                  </div>
                                  <div class="relative w-full mb-6">
                                    <TextLabel for="html-template" value="HTML Template" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                    <div class="flex">
                                      <div class="w-full">
                                        <textarea id="html-template" v-model="form.html_template" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" ref="input" rows="20"></textarea>
                                      </div>
                                    </div>

                                    <div class="flex">
                                      <div class="w-full">
                                        <span class="text-sm">
                                          *Available varibles : &#123;&#123; name &#125;&#125;, &#123;&#123; email &#125;&#125;, &#123;&#123; company_name &#125;&#125;, &#123;&#123; company_logo_url &#125;&#125;, &#123;&#123; report_url &#125;&#125;
                                        </span>
                                      </div>
                                    </div>
                                    <span class="text-red-600" v-if="form.errors.html_template">
                                                {{ $t(form.errors.html_template) }}
                                            </span>
                                  </div>

                                    <button
                                        class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                        type="submit"
                                    >
                                      {{$t('Update')}}
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
import {ref} from "vue";
import Textarea from "../../../Components/Textarea.vue";

const props = defineProps({
    template: Array,
    user_companies: Array,
    is_admin: ref(Boolean),
    color: {
        default: "light",
        validator: function (value) {
            // The value must match one of these strings
            return ["light", "dark"].indexOf(value) !== -1;
        },
    },
});

const form = useForm({
    subject: props.template.subject,
    html_template: props.template.html_template,
    company_id: props.template.company_id
});
const submit = () => {
    form.put(route('email.update', props.template.id));
};

</script>
