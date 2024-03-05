<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TableDropdown from "@/Components/Dropdowns/TableDropdown.vue";
import TextInput from '@/Components/TextInput.vue';
import Vue3EasyDataTable , { Header, Item, SortType, FilterOption } from "vue3-easy-data-table";
import TextDecryption from '@/Components/Crypto/Decryption/Text.vue';
import ImgDecryption from '@/Components/Crypto/Decryption/Image.vue';
import FileDecryption from '@/Components/Crypto/Decryption/File.vue';
import TextLabel from '@/Components/InputLabel.vue';

import {computed, onMounted, ref} from "vue";
import { Head, Link, useForm } from '@inertiajs/vue3';
import CryptoJS from "crypto-js";
import {auto} from "@popperjs/core";

const props = defineProps({
  user_company: Array,
  occurrences: Array,
  companies: Array,
  medias: Array,
  categories: Array,
  departments: Array,
  severity_types: Array,
  color: {
    default: "light",
    validator: function (value) {
      // The value must match one of these strings
      return ["light", "dark"].indexOf(value) !== -1;
    },
  },
});
const searchValue = ref('');
const searchField = ["topic", "id","description", "classification", "categories.name", "departments.name", "status", "actions"];
const sortBy= "id";
const sortType = "desc";


const headers = [
  { text: "Topic", value: "topic", sortable: true},
  { text: "Classification", value: "classification", sortable: true, width: 150},
  // { text: "Company", value: "companies.name", sortable: true},
  { text: "Categories", value: "categories.name", sortable: true, width: 150},
  { text: "Department", value: "departments.name", sortable: true, width: 150},
  { text: "Severity", value: "severity", sortable: true, width: 100},
  { text: "Status", value: "status", sortable: true, width: 100},
  { text: "Actions", value: "actions", sortable: true, width: 100},
];

const descriptions = props.occurrences;
const form = useForm({
  company_slug: props.user_company.slug,
});

const showCategoriesFilter = ref(false);
const categoriesCriteria = ref('all');
const showDepartmentsFilter = ref(false);
const departmentsCriteria = ref('all');

const filterOptions = computed(() => {
  const filterOptionsArray = [];
  if (categoriesCriteria.value !== 'all') {
    filterOptionsArray.push({
      field: 'categories.name',
      comparison: '=',
      criteria: categoriesCriteria.value,
    });
  }
  if (departmentsCriteria.value !== 'all') {
    filterOptionsArray.push({
      field: 'departments.name',
      comparison: '=',
      criteria: departmentsCriteria.value,
    });
  }
  return filterOptionsArray;
});


const submit = () => {
  form.get(route('occurrences.create'), form.company_slug);
};

function destroy(id) {
  if (confirm("Are you sure you want to Delete")) {
    form.delete(route('occurrences.destroy', id));
  }
}

const severityText = (key, $t) => {
  let html = '';
  switch (key) {
    case 1:
      html = '<span class="text-gray-800 dark:text-gray-400">'+ $t(props.severity_types[key]) +'</span>';
      break;
    case 2:
      html = '<span class="text-blue-800 dark:text-blue-400">'+ $t(props.severity_types[key]) +'</span>';
      break;
    case 3:
      html = '<span class="text-green-800 dark:text-green-400">'+ $t(props.severity_types[key]) +'</span>';
      break;
    case 4:
      html = '<span class="text-yellow-800 dark:text-yellow-400">'+ $t(props.severity_types[key]) +'</span>';
      break;
    case 5:
      html = '<span class="text-red-800 dark:text-red-400">'+ $t(props.severity_types[key]) +'</span>';
      break;
    default:
      html = "";
  }

  return html;
}
</script>


<template>
  <AppLayout title="Platform Companies">
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <div
          :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
        >
          <div class="rounded-t bg-white mb-0 px-6 py-6">

            <div class="text-center flex justify-between">
              <h6 class="text-blueGray-700 text-xl font-bold mr-2">{{$t('Occurrences')}}</h6>
              <div class="relative flex">
                <div class="relative flex mr-3">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                  </div>
                  <TextInput
                    id="default-search"
                    type="search"
                    class="block w-full p-1 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    v-model="searchValue"
                    aria-placeholder="search..."
                    autofocus />
                </div>
                <div class="relative inline-flex">
<!--                  <TextLabel for="companies" value="Company" class="flex items-center uppercase text-blueGray-600 text-sm font-medium font-bold" />-->
<!--                  <select v-model="form.company_slug" name="company_id" id="companies" :value="form.company_slug" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-6 p-0 mx-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">-->
<!--                    <option v-for="company in props.companies" :value="company.slug">{{company.name}}</option>-->
<!--                  </select>-->
<!--                  <span class="text-red-600" v-if="form.errors.company_slug">-->
<!--                  {{ $t(form.errors.company_slug) }}-->
<!--                </span>-->
                </div>
                <button @click.prevent="submit"
                        class="text-white  font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 bg-emerald-500 active:bg-emerald-600"
                        type="submit"
                >{{$t('New')}}</button>
              </div>
            </div>
          </div>


          <div class="block w-full overflow-x-auto">
            <Vue3EasyDataTable
              show-index
              :headers="headers"
              :items="props.occurrences"
              :search-field="searchField"
              :search-value="searchValue"
              :sort-by="sortBy"
              :sort-type="sortType"
              table-class-name="items-center w-full bg-transparent border-collapse md:min-w-full table"
              header-class-name="categories-header"
              header-item-class-name="bg-blueGray-50 text-blueGray-500 border-blueGray-100 x-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left px-6"
              body-row-class-name="occurences-rows"
              body-expand-row-class-name=""
              body-item-class-name="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-normal p-4 text-left item-content"
              :rows-per-page-message="$t('rows per page:')"
              :filter-options="filterOptions"
            >
              <template #header-topic="header">
                {{$t(header.text)}}
              </template>
              <template #header-classification="header">
                {{$t(header.text)}}
              </template>
<!--              <template #header-companies.name="header">-->
<!--                {{$t(header.text)}}-->
<!--              </template>-->
              <template #header-categories.name="header">
                <div class="filter-column flex align-middle">
                  <img class="filter-icon mr-2 w-5" @click.stop="showCategoriesFilter=!showCategoriesFilter" alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAx9JREFUaEPtmUuojVEUx383E0SRSFFIGSAlDBiIKAwYeIXyJvIoFInyKhQDBgh5K28GDLwjAxNJCkWEAQbEAGWi9Ne6+tzznfOt/e1zrnPz7dG95/zXf+3/XmuvvfY+DbTw0dDC589/IaAvsAqYAHSuYcQ+A9eBM8Blr5+sCGjy54B+XsIq4D4BY4GHHq4sAYeA+UZ0DHjrIc2J6QHMMdvDwAIPT5aAJ7b6m4FNHsJIjHxsBJ4C/T1cWQI+AF2B5hag/dCpGgK2A2uB+8AY4JuHNCemnW3iYcBpYIaHJysCI4A7RnQAWOwhzYnZDywy26nAeQ9PlgBxbLAU0t/LgL0e4kDMUmCP2WgPbPHaewSIS6sxGfhhqXTP68CBG26p0xq4AExx2PyBeAX0NCd9gAcm4kuIozLYjsY7BHhhvG9CeL0CxDk+cUIeSZwPIf6aYlXv59mHOumvhJKFCBD3OmCrOVkJ7A51mMCvAHbZ/+uBbXm4QgXIh0rcNOCnhfx2DsejLHVaWe8zPQfHb5M8ArqZc/VHj0zEx4AJqCFU0zbQTlydL+8C7P+C5hEgAjVbV43pBDA7YALHgVmGHwdcC7AtgeYVIKLVwA5jVB3f55jIXEAFQGMNsNNhUxESI0DEWv2ZwCtgKJCVSjeB0cDJRBSiNMQKmAhctBlMAi5VmI3OkOf2vSKh9lxjENA+Q4XuBl/TMLECxPkdaAssT7QDab5UaU7ZFyoAzwAdkK8dIZCAwbUSoGZPTV9Wy93Y62sejQvXG3jpEFD2flCNCMQI0Ny1hySk0rhhLX0Jph4EOAJQHlIIsAtP3j0QtfrJzRRDFLsHYnzn6oWaOowRoDKqdyfdByqNu8DIeiyjA4DHjhDoktOrHgW0AZY4TuL3wMF6FOBY/MqQoowWZTQyif51CnUAbllLXUlK2afGagg4as/iCwE9x5cbad2ot4zqotSlVlVIfX53e/DSgRMiQFhdK1N7/QTRWUBvpyWjGhHwZnFaBLy2ZXGFgIAlLCJQ7IGAdEmDtvgUkij96qkfMar2i2dzVqHIAKabFwJqsqwBpL8AiSSfMe3JHmMAAAAASUVORK5CYII=">
                  {{$t(header.text)}}
                  <div class="filter-menu p-3 z-2 absolute bg-white border border-blueGray-300" v-if="showCategoriesFilter">
                    <select
                        class="category-selector p-1 text-xs"
                        v-model="categoriesCriteria"
                        name="category"
                    >
                      <option value="all">{{$t('All')}}</option>
                      <option v-for="category in props.categories" :value="category.name">{{$t(category.name)}}</option>
                    </select>
                  </div>
                </div>

              </template>
              <template #header-departments.name="header">
                <div class="filter-column flex align-middle">
                  <img class="filter-icon mr-2 w-5" @click.stop="showDepartmentsFilter=!showDepartmentsFilter" alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAx9JREFUaEPtmUuojVEUx383E0SRSFFIGSAlDBiIKAwYeIXyJvIoFInyKhQDBgh5K28GDLwjAxNJCkWEAQbEAGWi9Ne6+tzznfOt/e1zrnPz7dG95/zXf+3/XmuvvfY+DbTw0dDC589/IaAvsAqYAHSuYcQ+A9eBM8Blr5+sCGjy54B+XsIq4D4BY4GHHq4sAYeA+UZ0DHjrIc2J6QHMMdvDwAIPT5aAJ7b6m4FNHsJIjHxsBJ4C/T1cWQI+AF2B5hag/dCpGgK2A2uB+8AY4JuHNCemnW3iYcBpYIaHJysCI4A7RnQAWOwhzYnZDywy26nAeQ9PlgBxbLAU0t/LgL0e4kDMUmCP2WgPbPHaewSIS6sxGfhhqXTP68CBG26p0xq4AExx2PyBeAX0NCd9gAcm4kuIozLYjsY7BHhhvG9CeL0CxDk+cUIeSZwPIf6aYlXv59mHOumvhJKFCBD3OmCrOVkJ7A51mMCvAHbZ/+uBbXm4QgXIh0rcNOCnhfx2DsejLHVaWe8zPQfHb5M8ArqZc/VHj0zEx4AJqCFU0zbQTlydL+8C7P+C5hEgAjVbV43pBDA7YALHgVmGHwdcC7AtgeYVIKLVwA5jVB3f55jIXEAFQGMNsNNhUxESI0DEWv2ZwCtgKJCVSjeB0cDJRBSiNMQKmAhctBlMAi5VmI3OkOf2vSKh9lxjENA+Q4XuBl/TMLECxPkdaAssT7QDab5UaU7ZFyoAzwAdkK8dIZCAwbUSoGZPTV9Wy93Y62sejQvXG3jpEFD2flCNCMQI0Ny1hySk0rhhLX0Jph4EOAJQHlIIsAtP3j0QtfrJzRRDFLsHYnzn6oWaOowRoDKqdyfdByqNu8DIeiyjA4DHjhDoktOrHgW0AZY4TuL3wMF6FOBY/MqQoowWZTQyif51CnUAbllLXUlK2afGagg4as/iCwE9x5cbad2ot4zqotSlVlVIfX53e/DSgRMiQFhdK1N7/QTRWUBvpyWjGhHwZnFaBLy2ZXGFgIAlLCJQ7IGAdEmDtvgUkij96qkfMar2i2dzVqHIAKabFwJqsqwBpL8AiSSfMe3JHmMAAAAASUVORK5CYII=">
                  {{$t(header.text)}}
                  <div class="filter-menu p-3 z-2 absolute bg-white border border-blueGray-300" v-if="showDepartmentsFilter">
                    <select
                        class="department-selector p-1 text-xs"
                        v-model="departmentsCriteria"
                        name="department"
                    >
                      <option value="all">{{$t('All')}}</option>
                      <option v-for="department in props.departments" :value="department.name">{{$t(department.name)}}</option>
                    </select>
                  </div>
                </div>
              </template>

              <template #header-status="header">
                {{$t(header.text)}}
              </template>
              <template #header-actions="header">
                {{$t(header.text)}}
              </template>

              <template #item-categories.name="{categories}">
                {{$t(categories.name)}}
              </template>

              <template #item-departments.name="{departments}">
                {{$t(departments.name)}}
              </template>

              <template #item-severity="{severity}">
                <div v-html="severityText(severity, $t)"></div>
              </template>

              <template #item-status="{status}">
                {{$t(status)}}
              </template>

              <template #item-topic="value">
                <Link :href="route('occurrences.show', value.id )">
                  <TextDecryption :occurrences="value" :encryptedText="value.topic" />
                </Link>
              </template>


              <template #expand="descriptions">
                <div class="text-xs whitespace-normal p-4 text-left">
                  <TextDecryption :occurrences="descriptions" :encryptedText="descriptions.description" />
                </div>
              </template>
              <template #item-actions="{id}">
                <table-dropdown :id="id" :edit="false" :group="'occurrences'"/>
              </template>
            </Vue3EasyDataTable>

          </div>
        </div>
      </div>
    </div>

  </AppLayout>
</template>
<style scoped>
  .filter-menu{
    top: 35px;
    width: auto;
  }

</style>
<style>
  .occurences-rows td:first-child,
  .occurences-rows td.can-expand{
    width: 35px;
  }
</style>
