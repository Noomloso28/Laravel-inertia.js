<template>
  <AppLayout title="Check Report">
    <div
      class="min-h-screen justify-center items-center flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
    >

      <div class="w-full sm:max-w-2xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form @submit.prevent="submit">
          <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
            {{$t('Report Form')}}
          </h6>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-12/12 px-4">
              <div class="relative w-full mb-3">
                <TextLabel for="password" value="Password code" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                <TextInput
                  id="password"
                  type="text"
                  class="mborder-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.password"
                  autofocus />
                <span class="text-red-600" v-if="form.errors.password">
                    {{ $t(form.errors.password) }}
                  </span>
              </div>
              <div class="relative w-full mb-3">
                <button
                  class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                  type="submit"
                >
                  {{$t('Submit')}}
                </button>
              </div>
            </div>

          </div>
        </form>
      </div>
      <div class="w-full sm:max-w-2xl px-6 py-4 overflow-hidden" v-if="!$page.props.user.id">
        <LanguageSwitcher :component="$page.component" :props="$page.props" />
      </div>

    </div>

  </AppLayout>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';
import FrontEndLayout from '@/Layouts/FrontEndLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import TextLabel from '@/Components/InputLabel.vue';
import {ref} from "vue";
import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';


const form = useForm({
  password: '',
  _token: String,
});

const submit = () => {
  form.post(route('occurrences.show.report'), {
    preserveScroll: true,
    onSuccess: (value) => {

    },
  });
};

</script>

<style scoped>

</style>
