<template>
  <div
    class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
  >
    <div class="rounded-t mb-0 px-4 py-3 border-0">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
          <h3 class="font-semibold text-base text-blueGray-700">
            {{$t('Notifications')}}
          </h3>
        </div>
        <div
          class="relative w-full px-4 max-w-full flex-grow flex-1 text-right"
        >
          <Link
                class="bg-indigo-500 text-white active:bg-indigo-600 font-bold uppercase text-xs px-3 py-1 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                :href="route('notification.index')"
          >
            {{$t('See all')}}
          </Link>

        </div>
      </div>
    </div>
    <div class="block w-full overflow-x-auto">
      <table class="items-center w-full bg-transparent border-collapse md:min-w-full">
        <thead>
        <tr>
          <th
            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
          >
            {{$t('Subject')}}
          </th>
          <th
            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
          >
            {{$t('From')}}
          </th>
          <th
            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
          >
            {{$t('Time')}}
          </th>
          <th
            class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
          >
            {{$t('Action')}}
          </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="notification in props.notifications" :key="notification.id">
          <th
            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs p-4 text-left"
          >
            <Decryption :occurrences="notification.occurrence" :encryptedText="notification.data.topic" />
          </th>
          <td
            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
            v-text="notification.data.classification"
          >
          </td>
          <td
            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
          >
            <DateFormat :date="notification.updated_at" hasTime="true" />
          </td>
          <td
            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
          >
            <Link @click="actionView(notification.id, notification.data.url)" :href="notification.data.url" class="bg-emerald-400 text-white active:bg-emerald-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
              {{$t('View')}}
            </Link>

          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>

</template>

<script setup>
import { reactive } from 'vue';
import {Link, useForm, router} from '@inertiajs/vue3';
import DateFormat from "@/Components/DateTime/DateFormat.vue";
import NavLink from '@/Components/NavLink.vue';
import Decryption from '@/Components/Crypto/Decryption/Text.vue';
import CryptoJS from "crypto-js";

const props = defineProps({
  notifications: Object
});
const form = useForm({});

const actionView = (id, redirect_url) => {
  const url =redirect_url;
  form.put(route('notification.read', id),{
    onFinish: () => {
      router.get(url);
    },
  });
}
</script>
