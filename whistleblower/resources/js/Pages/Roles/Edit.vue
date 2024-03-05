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
                                <h6 class="text-blueGray-700 text-xl font-bold mr-2">{{$t('Role')}} {{form.name}}</h6>

                                <Link
                                    class="bg-lightBlue-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                    :href="route('roles.index')"
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
                                        <TextLabel for="name" value="Name" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                        <input
                                          readonly
                                          class="border-0 mt-1 block w-full"
                                          id="name"
                                          type="text"
                                          ref="input"
                                          :value="form.name"
                                          v-model="form.name"

                                        />
                                        <span class="text-red-600" v-if="form.errors.name">
                                            {{ form.errors.name }}
                                        </span>
                                    </div>
                                  <!-- Permissions selection-->
                                  <div class="relative w-full mb-6">
                                    <div class="text-center flex justify-between">
                                      <TextLabel for="permission" value="Permissions" class="block uppercase text-blueGray-600 text-xs font-bold mb-2 mt-4" />
                                      <div class="flex items-center px-4">
                                        <input type="checkbox" v-model="selectAll" @change="selectAllCheckboxes" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label>{{$t('Select All')}}</label>
                                      </div>
                                    </div>

                                    <div class="inline-flex space-x-1 w-1/2 lg:w-3/12 xl:w-2/12" v-for="permission in props.permissions">
                                      <div class="flex items-center px-4" :class="disabled(permission.name) === true ? 'opacity-25' : ''">
                                        <input type="checkbox" name="permission[]" :id="'permission-'+ permission.id" :value="permission.id" v-model="form.permission" :disabled="disabled(permission.name)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300" :for="'permission-'+ permission.id">{{permissionName(permission.name)}}</label>
                                      </div>
                                    </div>
                                    <span class="text-red-600" v-if="form.errors.permission">
                                       {{ form.errors.permission }}
                                    </span>
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

    import { Head, Link, useForm } from '@inertiajs/vue3';
    import {computed, onMounted, ref} from 'vue';

    const props = defineProps({
        permissions: Object,
        role: Array,
        rolePermissions: Array,
        disabled: Array,
        color: {
            default: "light",
            validator: function (value) {
                // The value must match one of these strings
                return ["light", "dark"].indexOf(value) !== -1;
            },
        },
    });

    const form = useForm({
        name: props.role.name,
        permission : props.rolePermissions
    });
    const submit = () => {
        form.put(route('roles.update', props.role.id));
    };
    function disabled (name=''){
      return props.disabled.includes(name) ?? false;
    }


    const selectAll = ref(true)
    const selectAllCheckboxes = () => {
      form.permission = ref([]);
      props.permissions.forEach((item) => {
        let value = (selectAll.value) ? item.id : false;
        form.permission.push(value);
      });
    }


    function permissionName(name=''){
      return name.charAt(0).toUpperCase() + name.slice(1).replaceAll('-', ' ');
    }

</script>
