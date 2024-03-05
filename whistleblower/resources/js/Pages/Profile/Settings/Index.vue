<template>
  <AppLayout title="Platform Companies">
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <div
          :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
        >
            <div class="rounded-t mb-0 px-4 py-3 border-0">
              <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                  <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <div>
                      <FormSection @submitted="updateEmailNotification">
                        <template #title>
                          {{$t('Email notification')}}
                        </template>

                        <template #description>
                          {{$t("Update your account's profile information and email address.")}}
                        </template>

                        <template #form>
                            <div class="inline-flex space-x-1 w-12">
                              <InputLabel for="permission" value="Occurrences" class="block uppercase text-blueGray-600 text-xs font-bold mb-2 mt-4" />
                            </div>

                            <div class="inline-flex space-x-1 w-1/2 lg:w-3/12 xl:w-2/12" v-for="occurrence in props.email.occurrences" :key="occurrence">
                              <div class="flex items-center px-4">
                                <input type="checkbox" :name="occurrence.name" :id="occurrence.name" v-model="form.occurrences[occurrence.name]['value']" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" :for="occurrence.name">{{ labelName(occurrence.label) }}</label>
                              </div>
                            </div>
                            <span class="text-red-600" v-if="form.errors.occurrences">
                              {{ $t(form.errors.occurrences) }}
                            </span>
                        </template>

                        <template #actions>
                          <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                            {{$t('Saved.')}}
                          </ActionMessage>

                          <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            {{$t('Save')}}
                          </PrimaryButton>
                        </template>
                      </FormSection>
                    </div>

                    <div class="mt-4">
                      <FormSection @submitted="updateEmailTemplate">
                        <template #title>
                          {{$t('Email template')}}
                        </template>

                        <template #description>
                          {{$t("Update your email template style.")}}
                        </template>

                        <template #custom>
                          <div class="w-full">
                            <textarea v-model="form.email_template" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" ref="input" rows="20"></textarea>
                          </div>

                          <span class="text-red-600" v-if="form.errors.email_template">
                              {{ $t(form.errors.email_template) }}
                            </span>
                        </template>

                        <template #actions>
                          <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                            {{$t('Saved.')}}
                          </ActionMessage>

                          <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            {{$t('Save')}}
                          </PrimaryButton>
                        </template>
                      </FormSection>
                    </div>

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
  import { ref } from 'vue';
  import { Link, router, useForm } from '@inertiajs/vue3';
  import AppLayout from '@/Layouts/AppLayout.vue';
  import ActionMessage from '@/Components/ActionMessage.vue';
  import FormSection from '@/Components/FormSection.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import SecondaryButton from '@/Components/SecondaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import TextArea from '@/Components/Textarea.vue';
  import Textarea from "../../../Components/Textarea.vue";


  const props = defineProps({
    email: Array,
    settings: Array,
    email_template: String,
    color: {
      default: "light",
      validator: function (value) {
        // The value must match one of these strings
        return ["light", "dark"].indexOf(value) !== -1;
      },
    },
  });
  const form = useForm({
    occurrences : props.email.occurrences,
    email_template: props.email_template
  });

  function labelName(name=''){
    return name.charAt(0).toUpperCase() + name.slice(1).replaceAll('-', ' ');
  }

  const updateEmailNotification = () => {
    form.post(route('user.settings.store'));
  }
  const checked = () => {
    form.data = ref([]);
    props.email.forEach((item) => {
      // let value = (selectAll.value) ? item.id : false;
      form.permission.push(true);
    });
  }
  const updateEmailTemplate = () => {
    form.post(route('user.store.template'));
  }

</script>

<style scoped>

</style>
