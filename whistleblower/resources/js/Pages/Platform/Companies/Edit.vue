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

                                      <div v-if="! photoPreview && findAttributeByKey('logo')" class="mt-2">
                                        <img :src="route('media.show', findAttributeByKey('logo') ?? '' )" alt="company logo" class="rounded-full h-20 w-20 object-cover">
                                      </div>

                                      <!-- New Photo Preview -->
                                      <div v-if="photoPreview"  class="mt-2">
                                          <span
                                            class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                            :style="'background-image: url(\'' + photoPreview + '\');'"
                                          />
                                      </div>
                                      <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                                        {{$t('Select A Logo')}}
                                      </SecondaryButton>

                                      <SecondaryButton
                                        v-if="photoPreview || findAttributeByKey('logo')"
                                        type="button"
                                        class="mt-2"
                                        @click.prevent="deletePhoto(findAttributeByKey('logo'))"
                                      >
                                        {{$t('Remove Photo')}}
                                      </SecondaryButton>

                                      <span class="text-red-600" v-if="form.errors.photo">
                                        {{ $t(form.errors.photo) }}
                                      </span>
                                    </div>

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

                                    <div class="relative w-full mb-3 mt-6">
                                      <div class="text-center flex justify-between">
                                        <TextLabel for="categories" value="Categories" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                        <div class="flex items-center px-4 gap-1">
                                          <input id="select_all" name="select_all" v-model="selectAll" @change="selectAllCheckboxes" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                          <label for="select_all">{{$t('Select All')}}</label>
                                        </div>
                                      </div>
                                      <div class="inline-flex space-x-1 w-1/2 lg:w-3/12 xl:w-2/12" v-for="catagory in props.catagories">
                                        <div class="flex items-center px-4">
                                          <input v-model="form.companyCategories" type="checkbox" name="category[]" :id="'catagory-'+ catagory.id" :value="catagory.id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                          <label class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" :for="'catagory-'+ catagory.id">{{ $t(catagory.name) }}</label>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="relative w-full mb-3 mt-6">
                                      <div class="text-center flex justify-between">
                                        <TextLabel for="departments" value="Departments" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                        <div class="flex items-center px-4 gap-1">
                                          <input id="select_all_departments" name="select_all_departments" v-model="selectAllDepartmensts" @change="selectAllDepartmentCheckboxes" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                          <label for="select_all_departments">{{$t('Select All')}}</label>
                                        </div>
                                      </div>
                                      <div class="inline-flex space-x-1 w-1/2 lg:w-3/12 xl:w-2/12" v-for="department in props.departments">
                                        <div class="flex items-center px-4">
                                          <input v-model="form.companyDepartments" type="checkbox" name="department[]" :id="'department-'+ department.id" :value="department.id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                          <label class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" :for="'department-'+ department.id">{{ $t(department.name) }}</label>
                                        </div>
                                      </div>
                                    </div>

                                    <button
                                        class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                        type="submit"
                                    >
                                      {{$t('Update')}}
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
        company: Object,
        settings: Array,
        catagories: Array,
        departments: Array,
        companyCategories: Array,
        companyDepartments: Array,
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
    const updatePhotoPreview = () => {
      const photo = photoInput.value.files[0];

      if (! photo) return;
      const reader = new FileReader();

      reader.onload = (e) => {
        photoPreview.value = e.target.result;
      };

      reader.readAsDataURL(photo);
    }

    const deletePhoto = (uuid) => {
      if(confirm("Are you sure you want to Delete")){
        if (uuid !== null){
          router.delete(route('companies.delete.logo', uuid), {
            preserveScroll: true,
            onSuccess: () => {
              photoPreview.value = null;
              clearPhotoFileInput();
            },
          });
        }else {
          /** remove photo preview in case selected but not want */
          photoPreview.value = null;
          clearPhotoFileInput();
        }

      }

    };
    const clearPhotoFileInput = () => {
      if (photoInput.value?.value) {
        photoInput.value.value = null;
      }
    };

    /**
     * get attribute by attribute name and return attribute value
     * @param key
     * @returns {*|null}
     */
    const findAttributeByKey = (key) => {
      let result = null;
      if(props.settings){
        let attribute = props.settings.filter( values => values.attribute_name === key );
        if(attribute.length > 0){
          return attribute[0]['attribute_value'];
        }
      }
      return result;
    }

    const form = useForm({
        name: props.company.name,
        photo: null,
        companyCategories: props.companyCategories,
        companyDepartments: props.companyDepartments,
    });
    const submit = () => {
        if (photoInput.value) {
          form.photo = photoInput.value.files[0];
        }
        form.post(route('companies.update', props.company.id));
    };

    const selectAll = ref(true);
    const selectAllCheckboxes = () => {
      form.companyCategories = ref([]);
      props.catagories.forEach((item) => {
        let value = (selectAll.value) ? item.id : false;
        form.companyCategories.push(value);
      });
    }

    const selectAllDepartmensts = ref(true);
    const selectAllDepartmentCheckboxes = () => {
      form.companyDepartments = ref([]);
      props.departments.forEach((item) => {
        let value = (selectAllDepartmensts.value) ? item.id : false;
        form.companyDepartments.push(value);
      });
    }

</script>
