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
                                <h6 class="text-blueGray-700 text-xl font-bold mr-2">{{$t('Add')}}</h6>
                                <Link
                                    class="bg-lightBlue-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                    :href="route('companies-user.lists')"
                                >
                                  {{$t('Back')}}
                                </Link>
                            </div>
                        </div>
                        <!-- form -->
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-12/12 px-4">
                                  <div class="relative w-full mb-6">
                                    <TextLabel for="companies" value="Companies" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                    <select v-model="form.company_id" @change="users(form.company_id)" name="company_id" id="companies" :value="form.company_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                      <option v-for="company in props.companies" :value="company.id">{{company.name}}</option>
                                    </select>
                                    <span class="text-red-600" v-if="form.errors.company_id">
                                          {{ $t(form.errors.company_id) }}
                                    </span>
                                  </div>
                                  <div class="relative w-full mb-6">
                                    <TextLabel for="users" value="Users" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                    <select v-model="form.user_id" name="user_id" id="users" :value="form.user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                      <option v-for="user in availableUser" :value="user.id">{{user.name}}</option>
                                    </select>
                                    <span class="text-red-600" v-if="form.errors.user_id">
                                          {{ $t(form.errors.user_id) }}
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
import {computed, onMounted, ref} from "vue";

const props = defineProps({
    companies: Array,
    users: Array,
    userCompanies: Array,
    color: {
        default: "light",
        validator: function (value) {
            // The value must match one of these strings
            return ["light", "dark"].indexOf(value) !== -1;
        },
    },
});

const availableUser = ref([]);
/**
 * get exit users by actived company
 * */
const users = (id = 0) => {

  let exitUsers = props.userCompanies.filter(values => values.company_id === id),
      exitUserIds = [];

  if(exitUsers.length > 0){
    exitUserIds = exitUsers.map(values => values.user_id);
  }
  /** check exits user */
  return  availableUser.value = props.users.filter(values => exitUserIds.includes(values.id) === false) ?? [];
}

const form = useForm({
  company_id: '',
  user_id: '',
});

onMounted(() => {
  form.company_id = localStorage.getItem('selectedOption') ? parseInt(localStorage.getItem('selectedOption')) : '';
  users(form.company_id);
})
const submit = () => {
    form.post(route('companies-user.save'));
};

</script>
