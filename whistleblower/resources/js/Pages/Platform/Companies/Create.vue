<template>
    <AppLayout title="Platform Companies">
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div
                    :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
                >
                    <form @submit.prevent="submit">
                        <div class="rounded-t bg-white mb-0 px-6 py-6">
                            <div class="text-center flex justify-between">
                                <h6 class="text-blueGray-700 text-xl font-bold mr-2">{{$t('Manage')}}</h6>
                                <Link
                                    class="bg-lightBlue-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                    :href="route('companies.index')"
                                >
                                  {{$t('Back')}}
                                </Link>
                            </div>
                        </div>
                        <!-- form -->
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-12/12 px-4">
                                    <div class="relative w-full mb-3">
                                      <TextLabel for="name" value="Logo" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                      <input
                                        ref="photoInput"
                                        type="file"
                                        class="hidden"
                                        @change="updatePhotoPreview"
                                      >
                                      <!-- New Photo Preview -->
                                      <div v-if="photoPreview" class="mt-2">
                                        <span
                                          class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                          :style="'background-image: url(\'' + photoPreview + '\');'"
                                        />
                                      </div>
                                      <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                                        {{$t('Select A Logo')}}
                                        </SecondaryButton>
                                        <span class="text-red-600" v-if="form.errors.photo">
                                                  {{ $t(form.errors.photo) }}
                                        </span>
                                      </div>

                                  <SecondaryButton
                                    v-if="photoPreview"
                                    type="button"
                                    class="mt-2"
                                    @click.prevent="deletePhoto()"
                                  >
                                    {{$t('Remove Photo')}}
                                  </SecondaryButton>

                                    <div class="relative w-full mb-3">
                                        <TextLabel for="name" value="Name" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                        <TextInput
                                            id="name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.name"
                                            autofocus />
                                        <span class="text-red-600" v-if="form.errors.name">
                                                {{ $t(form.errors.name) }}
                                        </span>
                                    </div>
                                    <button
                                        class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                        type="submit"
                                    >
                                      {{$t('Create')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import TextLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

import {Head, Link, router, useForm} from '@inertiajs/vue3';
import {ref} from "vue";

const props = defineProps({
    color: {
        default: "light",
        validator: function (value) {
            // The value must match one of these strings
            return ["light", "dark"].indexOf(value) !== -1;
        },
    },
});
const photoInput = ref(null);
const photoPreview = ref(null);
const selectNewPhoto = () => {
  photoInput.value.click();
  updatePhotoPreview()
};
const uploadLogo = () => {
  if (photoInput.value) {
    form.photo = photoInput.value.files[0];
  }
};

const updatePhotoPreview = () => {
  const photo = photoInput.value.files[0];

  if (! photo) return;
  const reader = new FileReader();

  reader.onload = (e) => {
    photoPreview.value = e.target.result;
  };

  reader.readAsDataURL(photo);
}

const deletePhoto = () => {
  photoPreview.value = null;
  clearPhotoFileInput();
};
const clearPhotoFileInput = () => {
  if (photoInput.value?.value) {
    photoInput.value.value = null;
  }
};

const form = useForm({
    name: '',
    slug: '',
    photo: null,
});
const submit = () => {
    uploadLogo();
    form.post(route('companies.store'));
};

</script>
