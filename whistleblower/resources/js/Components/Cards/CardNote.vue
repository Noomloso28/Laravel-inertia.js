<script setup>
  import {ref} from "vue";
  import DateFormat from "@/Components/DateTime/DateFormat.vue";
  import {useForm} from "@inertiajs/vue3";

  const props = defineProps({
    id: ref(0),
    text: ref(''),
    created_at: ref(''),
    active: ref(''),
    user: Array
  });
  const form = useForm({
    'id': props.id
  });

  const checkProfileImage = (user) => {
    if(user){
      return user.profile_photo_url;
    }
    return 'https://ui-avatars.com/api/?name=N+O&color=7F9CF5&background=EBF4FF';
  }
  function destroy(id) {
    if (id && confirm("Are you sure you want to Delete")) {
      form.delete(route('note.destroy', id));
    }
  }
  const activeItem = (id) => {
    return id === props.active
  }
</script>

<template>
    <div :id="'section-'+ props.id" :class="{ 'border-emerald-700': activeItem(props.id),  'border-gray-200': !activeItem(props.id)}" class="w-full relative h-auto flex flex-col justify-between dark:bg-gray-800 bg-white dark:border-gray-700 rounded-lg border py-5 px-4 w-full shadow-md">
      <a class="cursor-pointer note-close" @click="destroy(props.id)" v-if="$page.props.user.permissions.includes('delete-notes')"></a>
      <div class="mb-4">
        <p class="text-gray-800 dark:text-gray-100 text-sm">{{props.text}}</p>
      </div>
      <div class="flex items-center w-full text-gray-800 dark:text-gray-100">

        <div class="flex flex-wrap w-full items-start justify-between">
          <div class="flex items-center">
            <span class="inline-flex items-center mr-2 text-sm text-gray-900 dark:text-white">
              <img
                  class="w-6 h-6 rounded-full"
                  :src="checkProfileImage(props.user)"
                  :alt="props.user.name" />
            </span>
            <div class="flex flex-col ml-2">
              <span class="text-sm font-semibold">{{props.user.name}}</span>
              <span class="text-xs text-gray-400"><DateFormat :date="props.created_at" :hasTime="false" /></span>
            </div>
          </div>

          <div class="text-sm flex flex-wrap gap-1 items-center text-gray-500">
            <button @click="$emit('editNote', props.id);" v-if="$page.props.user.permissions.includes('update-notes')" class="w-8 h-8 rounded-full bg-emerald-600 dark:bg-gray-100 dark:text-gray-800 text-white flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-blue-500" aria-label="edit note" role="button">
              <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z"></path>
                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
</template>

<style scoped>
  .note-close{
    display: block;
    width: 15px;
    height: 15px;
    background: url(/build/assets/close.png) center center no-repeat;
    background-size: cover;
    text-align: right;
    outline: 0;
    filter: alpha(Opacity=70);
    opacity: .7;
    transition: opacity .2s;
    position: absolute;
    top: 5px;
    right: 10px;
  }

</style>
