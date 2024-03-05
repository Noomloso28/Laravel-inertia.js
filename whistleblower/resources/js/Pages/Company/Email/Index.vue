<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import DateFormat from "@/Components/DateTime/DateFormat.vue";
import TableDropdown from "@/Components/Dropdowns/TableDropdown.vue";

import {computed, ref} from "vue";
import { Head, Link, useForm } from '@inertiajs/vue3';
import Vue3EasyDataTable from "vue3-easy-data-table";

const props = defineProps({
  email_templates: Array,
  color: {
    default: "light",
    validator: function (value) {
      // The value must match one of these strings
      return ["light", "dark"].indexOf(value) !== -1;
    },
  },
});

const searchValue = ref('');
const searchField = ["name", "id", "created_at", "updated_at"];
const sortBy= "name";
const sortType = "desc";


const headers = [
  { text: "Subject", value: "subject", sortable: true},
  { text: "Company", value: "companies.name", sortable: true},
  { text: "Type", value: "type", sortable: true},
  { text: "Created", value: "created_at", sortable: true},
  { text: "Default", value: "default", sortable: true},
  { text: "Actions", value: "actions", sortable: true},
];
const types = [
  {
    'name': 'Submited template',
    'type': 'occurrence.created'
  },
  {
    'name': 'Submited template for Login User',
    'type': 'occurrence.created.admin'
  },
  {
    'name': 'Updated template',
    'type': 'occurrence.updated'
  },
  {
    'name': 'Updated template for Login User',
    'type': 'occurrence.updated.admin'
  },
];
const getTypeName = (type_code) => {
  for (let key in types) {
    if(types[key].type === type_code){
      return types[key].name
    }
  }

  return '';
}

</script>

<template>
  <AppLayout title="Email Company">
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <div
          :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
        >
          <div class="rounded-t bg-white mb-0 px-6 py-6">
            <div class="text-center flex flex-wrap justify-between">
              <h6 class="text-blueGray-700 text-xl font-bold mr-2">{{$t('E-mail Templates')}}</h6>
              <div class="relative flex">
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                  </div>
                  <TextInput
                    id="default-search"
                    type="search"
                    class="block w-full p-1 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"

                    aria-placeholder="search..."
                    autofocus />
                </div>

                <Link
                      class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 ml-6"
                      :href="route('email.create')"
                >
                  {{$t('New')}}
                </Link>
              </div>
            </div>
          </div>

          <div class="block w-full overflow-x-auto">
            <Vue3EasyDataTable
              show-index
              :headers="headers"
              :items="props.email_templates"
              :search-field="searchField"
              :search-value="searchValue"
              :sort-by="sortBy"
              :sort-type="sortType"
              table-class-name="items-center w-full bg-transparent border-collapse md:min-w-full table"
              header-class-name="companies-header"
              header-item-class-name="bg-blueGray-50 text-blueGray-500 border-blueGray-100 x-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left px-6"
              body-row-class-name=""
              body-expand-row-class-name=""
              body-item-class-name="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left"
              :rows-per-page-message="$t('rows per page:')"
            >
              <template #header-subject="header">
                {{$t(header.text)}}
              </template>
              <template #header-companies.name="header">
                {{$t(header.text)}}
              </template>
              <template #header-created_at="header">
                {{$t(header.text)}}
              </template>
              <template #header-updated_at="header">
                {{$t(header.text)}}
              </template>
              <template #header-default="header">
                {{$t(header.text)}}
              </template>
              <template #header-actions="header">
                {{$t(header.text)}}
              </template>

              <template #item-companies.name="values">
                <span v-if="values.companies">{{values.companies.name}}</span>
                <span v-else> - </span>
              </template>

              <template #item-created_at="{created_at}">
                <DateFormat :date="created_at" hasTime="true" />
              </template>
              <template #item-type="{type}">
                {{ getTypeName(type) }}
              </template>
              <template #item-actions="{id}">
                <table-dropdown :id="id" :group="'email'" :view="false"/>
              </template>
              <template #item-default="values">
                <span v-if="values.default">{{$t('Yes')}}</span>
                <span v-else>{{$t('No')}}</span>
              </template>

            </Vue3EasyDataTable>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>

</style>
