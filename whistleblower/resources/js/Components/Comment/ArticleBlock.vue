<template>
  <article class="p-6 text-base bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900">
    <div class="flex justify-between items-center mb-2">
      <div class="flex flex-wrap items-center">
        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
          <img
          class="mr-2 w-6 h-6 rounded-full"
          :src="props.profile_img"
          :alt="props.name">{{props.name}}</p>
        <p class="text-sm text-gray-600 dark:text-gray-400">
          <time pubdate :datetime="props.date" :title="props.date">
            <DateFormat :date="props.date" hasTime="true" />
          </time>
        </p>
      </div>

      <button id="dropdownComment1Button" v-on:click="toggleDropdown($event, $refs)" ref="btnDropdownRef" v-if="btnStatus($page)"
              class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
              type="button">
        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
             xmlns="http://www.w3.org/2000/svg">
          <path
            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
          </path>
        </svg>
        <span class="sr-only">{{$t('Comment settings')}}</span>
      </button>
      <!-- Dropdown menu -->
      <div :id="action" ref="popoverDropdownRef"
           class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
           v-bind:class="{
        hidden: !isDropdownVisible,
        block: isDropdownVisible,
      }">
        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
          <li v-if="$page.props.user.id === props.user_id && displayAction($page.props.user.permissions, 'update-notes')">
            <form>
              <a href="#" @click="$emit('editComment', props.id); hiddenDropdown($event)"
                 class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{$t('Edit')}}</a>
            </form>
          </li>
          <li v-if="$page.props.user.id === props.user_id || displayAction($page.props.user.permissions, 'delete-notes')">
            <form>
              <a href="#" @click="destroy(props.id)"
                 class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{$t('Remove')}}</a>
            </form>
          </li>
        </ul>
      </div>
    </div>
    <p class="text-gray-500 dark:text-gray-400">{{props.content}}</p>
  </article>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import {createPopper} from "@popperjs/core";
import {Link, useForm} from '@inertiajs/vue3';
import DateFormat from "@/Components/DateTime/DateFormat.vue";
import CryptoJS from "crypto-js";

const props = defineProps({
  id: Number,
  name: String,
  date: String,
  user_id: Number,
  content: {
    type: String,
    default: '',
  },
  profile_img: String
});

const action = computed( () => {
  return 'dropdownComment-'+ props.id
});


const isDropdownVisible = ref(false)
const toggleDropdown = (event, refs) => {
  event.preventDefault();
  isDropdownVisible.value = !isDropdownVisible.value
  createPopper(refs.btnDropdownRef, refs.popoverDropdownRef, {
    placement: "bottom-start",
  });
}
const hiddenDropdown = (event) => {
  event.preventDefault();
  isDropdownVisible.value = !isDropdownVisible.value;
}

const form = useForm({
  'id': props.id
});
function destroy(id) {
  if (id && confirm("Are you sure you want to Delete")) {
    form.id = id;
    form.delete(route('occurrences.delete.comment'));
  }
  isDropdownVisible.value = !isDropdownVisible.value
}
/**
 * display by permissions roles.
 * @param $permission
 * @param $action
 * @returns {boolean}
 */
const displayAction = ($permission, $action) =>{
  if(!Array.isArray($permission)){
    return false;
  }

  if ($permission.includes($action)){
    return true;
  }

  return false;
}
const btnStatus = ($page) => {
  if($page.props.user.id === props.user_id && displayAction($page.props.user.permissions, 'update-notes')){
    return  true;
  }
  if($page.props.user.id === props.user_id || displayAction($page.props.user.permissions, 'delete-notes')){
    return true;
  }
  return  false;
}


</script>

<style scoped>

</style>
