<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import DateFormat from "@/Components/DateTime/DateFormat.vue";
import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';
import {ref} from "vue";

const props = defineProps({
  companies: Array,
  logos: Array,
  is_admin: ref(false),
  color: {
    default: "light",
    validator: function (value) {
      // The value must match one of these strings
      return ["light", "dark"].indexOf(value) !== -1;
    },
  },
});

const form = useForm({
  id: '',
  _token: String,
});

const companyLogo = (id) => {
  const match = props.logos.find((array) => array['company_id'] === id) ?? '';
  return match['attribute_value'] ?? null;
}

const selected = (id) => {
  form.id = id;
  form.post(route('dashboard.companies.set'), {
    preserveScroll: true,
    onSuccess: () => {
    },
  });
}

</script>

<template>
  <div class="flex flex-wrap md:flex-col items-center justify-center h-screen overflow-auto flex items-center justify-center" style="background: #edf2f7;">
    <div class="items-center text-center w-full mt-6">
      <h2 class="text-3xl font-semibold text-gray-800 md:text-4xl">{{$t('Select Your')}} <span class="text-indigo-600">{{$t('Company')}}</span></h2>
    </div>

    <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 mt-8" v-if="props.companies.length > 0">
      <div class="relative bg-white py-6 px-6 rounded-3xl w-64 my-4 shadow-xl hover:bg-gray-100 cursor-pointer" v-for="company in props.companies" :key="company" @click.prevent="selected(company.id)">
        <div class=" text-white flex items-center absolute rounded-full py-2 px-2 shadow-xl bg-green-500 left-4 -top-6" v-if="companyLogo(company.id)">
          <!-- svg  -->
          <img :src="route('media.show', companyLogo(company.id))" alt="company logo" class="avator rounded-full h-12 w-12 object-cover">
        </div>
        <div class="mt-8">
          <p class="text-xl font-semibold my-2">{{company.name}}</p>
          <div class="flex space-x-2 text-gray-400 text-sm">
            <i class="fas fa-user-friends opacity-75 mr-2 text-sm"></i>
            <p>{{company.amount}}</p>
          </div>
          <div class="flex space-x-2 text-gray-400 text-sm my-3">
            <i class="fas fa-calendar-plus opacity-75 mr-2 text-sm"></i>
            <p><DateFormat :date="company.created_at" hasTime="true" /></p>
          </div>
          <div class="border-t-2"></div>

          <div class="flex">
            <div class="my-2">
              <p class="font-semibold text-base mb-2">{{$t('Team Member')}}</p>
              <div class="flex space-x-2">
                <span v-for="users in company.lists" :key="users">
                  <img :src="users.profile_photo_url" class="w-6 h-6 rounded-full" alt="avatar"/>
                </span>
              </div>
            </div>

          </div>

          <div class="flex justify-center mt-4">
            <a class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 ml-6"
            >{{$t('Choose')}}
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="items-center text-center w-full mt-6" v-else>
      <p class="my-2">
        {{$t('No company available!')}}
      </p>

      <p class="my-2" v-if="props.is_admin">
        <Link
          class="bg-lightBlue-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
          :href="route('companies.create')"
        >
          {{$t('Create')}}
        </Link>
      </p>

      <p class="my-2" v-else>
        {{$t('Please contact an administrator')}}
      </p>

    </div>

    <div class="items-center text-center w-full mt-6">
      <LanguageSwitcher :component="$page.component" :props="$page.props" />
    </div>

  </div>

</template>

<style scoped>

</style>
