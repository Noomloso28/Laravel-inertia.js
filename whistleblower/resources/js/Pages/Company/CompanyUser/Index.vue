<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TableDropdown from "@/Components/Dropdowns/TableDropdownMyCompany.vue";
import TextInput from '@/Components/TextInput.vue';
import Vue3EasyDataTable , { Header, Item, SortType } from "vue3-easy-data-table";
import DateFormat from "@/Components/DateTime/DateFormat.vue";

import {computed, ref} from "vue";
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    userCompanies: Array,
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
    { text: "Name", value: "companies.name", sortable: true},
    { text: "Created", value: "created_at", sortable: true},
    { text: "Updated", value: "updated_at", sortable: true},
    { text: "Actions", value: "actions", sortable: true},
];

function destroy(id) {
    if (confirm($t("Are you sure you want to Delete"))) {
        form.delete(route('posts.destroy', id));
    }
}
</script>
<style>

</style>

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
                            <h6 class="text-blueGray-700 text-xl font-bold mr-2">{{$t('My Companies')}}</h6>
                            <div class="relative flex">
                              <div class="relative">
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
                              <Link v-if="$page.props.user.permissions.includes('create-user-company')"
                                class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 ml-6"
                                :href="route('companies-user.create')"
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
                            :items="props.userCompanies"
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
                            <template #header-companies.name="header">
                              {{$t(header.text)}}
                            </template>
                            <template #header-created_at="header">
                              {{$t(header.text)}}
                            </template>
                            <template #header-updated_at="header">
                              {{$t(header.text)}}
                            </template>
                            <template #header-actions="header">
                              {{$t(header.text)}}
                            </template>

                            <template #item-actions="{id, companies}">
                              <table-dropdown :id="id" :company_id="companies.id" :group="'companies-user'" :permissionGroup="'user-company'" :view="false" :edit="false"/>
                            </template>
                            <template #item-created_at="{created_at}">
                              <DateFormat :date="created_at" hasTime="true" />
                            </template>
                            <template #item-updated_at="{updated_at}">
                              <DateFormat :date="updated_at" hasTime="true" />
                            </template>
                        </Vue3EasyDataTable>

                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
