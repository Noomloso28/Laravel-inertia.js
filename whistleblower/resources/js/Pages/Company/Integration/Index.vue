<template>
  <AppLayout title="Platform Companies">
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <div
          :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
        >
            <div class="rounded-t bg-white mb-0 px-6 py-6">
              <div class="text-left flex justify-between">
                <h6 class="text-blueGray-700 text-xl font-bold mr-2">{{$t('Integration')}}</h6>
              </div>
            </div>

            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
              <div class="flex flex-wrap">
                <div class="w-full lg:w-12/12 px-4">
                  <div class="relative w-full mb-6">
                    <TextLabel for="companies" value="Companies" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                    <select @change="reportUrl(form.company_slug)" v-model="form.company_slug" name="company_id" id="companies" :value="form.company_slug" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <option disabled value="">{{$t('Please select a company')}}</option>
                      <option v-for="values in props.userCompanies" :value="values.companies.slug">{{values.companies.name}}</option>
                    </select>
                    <span class="text-red-600" v-if="form.errors.company_id">
                            {{ $t(form.errors.company_id) }}
                        </span>
                  </div>
                </div>

                <div class="w-full lg:w-12/12 px-4">
                  <div class="relative w-full mb-3">
                    <TextLabel for="password" value="The company report link" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                    <ReadonlyInput
                      id="password"
                      type="text"
                      class="mborder-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      v-model="form.url"
                      autofocus />
                    <span @click="copyUrl" id="copy-action" class="absolute right-0 z-2 mr-1 mt-1 bg-white p-1.5 cursor-pointer inline-flex">
                        <svg v-if="copied" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1 text-green-600">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                      </span>

                    <span class="text-red-600" v-if="form.errors.url">
                        {{ $t(form.errors.url) }}
                      </span>
                  </div>

                </div>

                <div class="w-full lg:w-12/12 px-4">
                  <div class="relative w-full mb-3">
                    <span class="text-sm">{{$t('Check report this link')}} : <br>
                      <NavLink :href="route('occurrences.check.report')" :active="route().current('occurrences.check.report')" class="lowercase">
                      {{route('occurrences.check.report')}}
                    </NavLink>
                    </span>
                  </div>
                </div>

              </div>
            </div>

        </div>
      </div>
    </div>

  </AppLayout>

</template>

<script setup>
  import {computed, ref, onMounted} from 'vue';
  import { Link, router, useForm } from '@inertiajs/vue3';
  import AppLayout from '@/Layouts/AppLayout.vue';
  import ActionMessage from '@/Components/ActionMessage.vue';
  import FormSection from '@/Components/FormSection.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import SecondaryButton from '@/Components/SecondaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import TextLabel from '@/Components/InputLabel.vue';
  import ReadonlyInput from '@/Components/ReadonlyInput.vue';
  import NavLink from '@/Components/NavLink.vue';

  const props = defineProps({
    userCompanies: Array,
    siteUrl: String,
    color: {
      default: "light",
      validator: function (value) {
        // The value must match one of these strings
        return ["light", "dark"].indexOf(value) !== -1;
      },
    },
  });
  const copied = ref(false);
  const reportUrl = function (slug='') {
    let siteUrl = '';
    if(slug){
      siteUrl = props.siteUrl + '/' + slug + '/report/new';
    }
    form.url =  siteUrl;
  }
  onMounted( () => {
    reportUrl();
  });


  const form = useForm({
    name: '',
    active: 0,
    company_id: 0,
    company_slug: '',
    url: ''
  });



  const copyUrl = computed(() => {
    navigator.clipboard.writeText(form.url);
    copied.value = !copied.value
    setTimeout(() => copied.value = !copied.value , 3000)
  })


</script>

<style scoped>

</style>
