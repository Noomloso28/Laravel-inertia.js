<script setup>
  import {Head, Link, router, useForm} from '@inertiajs/vue3';
  import TextEncryption from '@/Components/Crypto/Occurrence/Action.vue';
  import Card from '@/Components/Cards/CardNote.vue';

  import {onMounted, ref} from "vue";

  const props = defineProps({
    occurrence: Array,
    notes: Array
  });

  onMounted(() => {
    TextEncryption.methods.setOccurrence(props.occurrence)
  });

  const form = useForm({
    id: '',
    note: '',
    text: '',
    occurrence_id: props.occurrence.id
  });
  const submit = () => {
    form.text = encryption(form.note);
    form.post(route('note.store'));
    form.reset();
  };

  const noteTextArea = ref(null);
  function encryption(string)
  {
    if(string){
      return TextEncryption.methods.encrypt(string);
    }
    return null;
  }
  function decryption(string)
  {
    if(string){
      return TextEncryption.methods.decrypt(string);
    }
    return null;
  }

  const editNote = (id) => {
    let data = props.notes.find(note => note.id === id);
    if(Object.keys(data).length){
      form.note = decryption(data.text);
      form.id = data.id;
      noteTextArea.value.focus();
    }
  }

  const reset = () => {
    form.id = '';
    form.note = '';
  }

</script>

<template>
  <div class="w-full flex gap-5 flex-col items-center">
    <div class="w-full bg-white p-8 rounded-lg shadow-md" v-if="$page.props.user.permissions.includes('create-notes')">
      <form @submit.prevent="submit">
        <!-- Post Content Section -->
        <div class="mb-6">
          <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">{{$t('Internal notes')}} :</label>
          <textarea name="note"
                    ref="noteTextArea"
                    v-model="form.note"
                    rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500"
                    :placeholder="$t('Write note')"></textarea>
        </div>
        <!-- Submit Button and Character Limit Section -->
        <div class="flex items-center justify-between">
          <button type="submit" class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2"> {{$t('Save')}} <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" id="send" fill="#fff">
            <path fill="none" d="M0 0h24v24H0V0z"></path>
            <path d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z"></path>
          </svg>
          </button>

          <button type="reset" class="bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-700 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:text-white focus:outline-none focus:ring-4 focus:ring-gray-200 font-medium hover:bg-gray-100 px-4 py-2 rounded-lg text-gray-900 text-sm" @click.prevent="reset">{{$t('Abort')}}</button>

        </div>
      </form>
    </div>
    <Card v-for="(note, key) in props.notes" :key="key" :value="key" :id="note.id" :active="form.id" :text="decryption(note.text)" :created_at="note.created_at" :user="note.user" @editNote="editNote" v-if="$page.props.user.permissions.includes('view-notes')"/>
  </div>
</template>

<style scoped>

</style>
