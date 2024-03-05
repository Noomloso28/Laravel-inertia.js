<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FrontEndLayout from '@/Layouts/FrontEndLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import TextLabel from '@/Components/InputLabel.vue';
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
  department: Array,
  companies: Array,
  slug: String
});
const form = useForm({
  // name: props.department.name,
  // company_id: props.department.company_id,
});
</script>
<style>

</style>

<template>
    <AppLayout title="Platform Companies">

      <div class="container mx-auto relative flex flex-col min-w-0 break-words w-full shadow-lg rounded-lg bg-blueGray-100 border-0">
        <div class="flex items-center justify-center h-screen">
          <div>
            <div class="flex flex-col items-center space-y-2 text-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="text-green-600 w-28 h-28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <h1 class="text-4xl font-bold">{{$t('Case successfully submitted')}} !</h1>
              <p>{{$t('You can check the status of your case by clicking the button bellow.')}}</p>
              <a :href="route('occurrences.check.report')"
                 class="inline-flex items-center px-4 py-2 text-white bg-indigo-600 border border-indigo-600 rounded rounded-full hover:bg-indigo-700 focus:outline-none focus:ring">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
                <span class="text-sm font-medium">
                  {{$t('View case')}}
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>

    </AppLayout>
</template>
