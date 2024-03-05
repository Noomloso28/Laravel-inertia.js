<style>

</style>

<template>
    <AppLayout title="Platform Companies">
      <div
        class="container mx-auto mt-6 relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
      >
        <div class="rounded-t bg-white mb-0 px-6 py-6">
          <div class="text-center flex justify-between">
            <h6 class="text-blueGray-700 text-xl font-bold mr-2">{{$t('Your case has been submitted')}}</h6>
          </div>
        </div>
        <div class="flex-auto px-4 lg:px-10 py-10 pt-6">
          <form @submit.prevent="submit">
            <input type="hidden" :value="form.occurrence_id" name="occurrence_id">
            <div class="flex flex-wrap">
              <div class="w-full lg:w-12/12 px-4 mb-4">
                <span class="text-red-600 font-bold">{{$t('IMPORTANT')}}:</span> {{$t('Your password will only be displayed once. Save and keep the password safe and do not share it with anyone. Only with this password can you retrieve your case.')}}
              </div>

              <div class="w-full lg:w-12/12 px-4">
                <div class="relative w-full mb-3">
                  <TextLabel for="password" value="Your password" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                  <ReadonlyInput
                    id="password"
                    type="text"
                    class="mborder-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="form.password"
                    autofocus />
                  <span @click="copyPassword" id="copy-action" class="absolute right-0 z-2 mr-1 mt-1 bg-white p-1.5 cursor-pointer inline-flex">
                    <svg v-if="copied" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1 text-green-600">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                    </svg>
                  </span>

                  <span class="text-red-600" v-if="form.errors.password">
                    {{ $t(form.errors.password) }}
                  </span>
                </div>
                <div class="relative w-full mb-3">
                  <a :href="route('occurrences.password.download', {
                    'password': form.password
                  })" target="_blank">
                    <span><i class="fas fa-arrow-down"></i>{{$t('Download')}}</span>
                  </a>
                </div>

              </div>
            </div>

            <div class="flex flex-wrap">
              <div class="w-full lg:w-12/12 px-4">
                <div class="relative w-full mb-3">
                  <TextLabel for="email" value="Email address for notifications (optional)" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                  <TextInput
                    id="email"
                    type="email"
                    class="mborder-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="form.email"
                    autofocus />
                  <span class="text-red-600" v-if="form.errors.email">
                    {{ $t(form.errors.email) }}
                  </span>
                </div>
                <div class="relative w-full mb-3">
                  <p class="mb-4">
                    {{$t('Your e-mail address is stored in encrypted form and is only used for notification. Your password will not be sent by email!')}}
                  </p>
                </div>
                <div class="relative w-full mb-3">
                  <div class="flex items-center">
                    <input id="agree" name="agree" type="checkbox" v-model="agree" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="link-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$t('I have saved the password securely')}}</label>
                  </div>
                </div>

                <div class="relative w-full mb-3">
                  <button :class="{ 'bg-emerald-500 active:bg-emerald-600': agree, 'bg-gray-300 rounded focus:outline-none cursor-not-allowed':  !agree}" :disabled="!agree"
                    class="text-white  font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                    type="submit" disabled
                  >{{$t('Complete')}}</button>
                </div>

              </div>
            </div>

          </form>
        </div>
      </div>

    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FrontEndLayout from '@/Layouts/FrontEndLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import ReadonlyInput from '@/Components/ReadonlyInput.vue';
import TextLabel from '@/Components/InputLabel.vue';
import {useForm} from "@inertiajs/vue3";
import {computed, ref} from "vue";
import CryptoJS from "crypto-js";

const props = defineProps({
  request: Array
});
const agree = ref(false);
const copied = ref(false);

const form = useForm({
  password: props.request.password,
  email: '',
  email_notification: '',
  occurrence_id: props.request.id,
  company_id: props.request.company_id,
  slug: props.request.slug,
  subject: props.request.topic,
  classification: props.request.classification
});
const submit = async () => {
  form.email_notification = form.email
  form.email = await encryptText(form.email);
  form.post(route('occurrences.notificationStore'));
};

async function encryptText(dataToEncrypt){

  if(dataToEncrypt && props.request.encryptGenerateKey){
    return  CryptoJS.AES.encrypt(dataToEncrypt, props.request.encryptGenerateKey).toString();
  }
  return null;
}

/**
 * Copy password
 * @type {ComputedRef<unknown>}
 */
const copyPassword = computed(() => {
  navigator.clipboard.writeText(form.password);
  copied.value = !copied.value
  setTimeout(() => copied.value = !copied.value , 3000)
})
</script>
