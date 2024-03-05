<template>
  <AppLayout title="View Companies">
    <div class="flex flex-wrap mt-4">
      <div class="w-full mb-12 px-4">
        <div
          :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
        >
          <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
              <div class="w-full flex overflow-x-auto custom-scrollbar">
                <div class="flex-1 px-2">
                  <div class="h-16 flex items-center justify-between">
                    <div class="flex items-center">
                      <Link
                        class="flex items-center text-gray-700 px-2 py-1 space-x-0.5 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100" title="Back"
                        :href="route('occurrences.index')"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm font-bold">{{$t('Back')}}</span>
                      </Link>

                      <div class="flex items-center">
<!--                        <span class="bg-gray-300 h-6 w-[.5px] mx-3"></span>-->
<!--                        <div class="flex items-center space-x-2">-->
<!--                          <button title="Archive" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>-->
<!--                            </svg>-->
<!--                          </button>-->
<!--                          <button title="Mark As Spam" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>-->
<!--                            </svg>-->
<!--                          </button>-->
<!--                          <button title="Delete" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100" @click.prevent="destroy(props.occurrence.id)" v-if="$page.props.user.permissions.includes('delete-occurrences')">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>-->
<!--                            </svg>-->
<!--                          </button>-->
<!--                          <button title="Add Star" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>-->
<!--                            </svg>-->
<!--                          </button>-->
<!--                        </div>-->
<!--                        <span class="bg-gray-300 h-6 w-[.5px] mx-3"></span>-->
<!--                        <div class="flex items-center space-x-2">-->
<!--                          <button title="Mark As Unread" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
<!--                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>-->
<!--                            </svg>-->
<!--                          </button>-->

<!--                        </div>-->
                      </div>
                    </div>
                    <div class="px-2 flex items-center space-x-4">
                      <div class="flex items-center space-x-2">
                        <Link v-if="props.previous > 0" :href="route('occurrences.show', props.previous )">
                          <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-1.5 rounded-lg transition duration-150" :title="$t('Previous')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </Link>
                        <button v-else class="bg-gray-200 text-gray-400 p-1.5 rounded-lg cursor-not-allowed" :title="$t('Previous')">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </button>


                        <Link v-if="props.next_page > 0" :href="route('occurrences.show', props.next_page )">
                          <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-1.5 rounded-lg transition duration-150" :title="$t('Next')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                          </button>
                        </Link>
                        <button v-else class="bg-gray-200 text-gray-400 p-1.5 rounded-lg cursor-not-allowed" :title="$t('Next')">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                          </svg>
                        </button>

                      </div>
                    </div>
                  </div>

                  <div class="flex w-full">
                    <h4 class="text-lg text-gray-800 font-bold pb-2 mb-4 border-b-2 w-full"><TextDecryption :occurrences="props.occurrence" :encryptedText="props.occurrence.topic" /></h4>
                  </div>

                  <div class="flex flex-wrap">
                    <div class="w-full xl:w-8/12 xl:pr-4"> <!-- 75% width -->
                      <div class="mb-6">
                        <div class="flex flex-wrap items-start justify-between mb-2">
                          <div class="flex items-center">
                            <i class="fas fa-user-secret mr-2 text-lg text-blueGray-400 rounded-full w-8 h-8 border border-gray-500 text-center"></i>
                            <div class="flex flex-col ml-2">
                              <span class="text-sm font-semibold">{{props.occurrence.classification}}</span>
                              <span class="text-xs text-gray-400" v-if="props.occurrence.email">{{$t('From')}}: <TextDecryption :occurrences="props.occurrence" :encryptedText="props.occurrence.email" /></span>
                            </div>
                          </div>

                          <div class="text-sm flex flex-wrap gap-1 items-center text-gray-500">
                            <span class="mr-2"> <DateFormat :date="props.occurrence.created_at" hasTime="true" /> </span>
                          </div>
                        </div>


                        <div id="alert-message" class="bg-emerald-500 duration-300 ease-in-out ease-linear hidden my-2 p-3 rounded shadow text-white transform transition-all transition-opacity transition"></div>

                        <div class="py-6 pl-2 text-gray-700">
                          <TextDecryption :occurrences="props.occurrence" :encryptedText="props.occurrence.description" />
                        </div>


                        <div class="border-t-2 flex space-x-4 py-4">
                          <div class="max-w-100-px">
                            <label for="upload-file" class="w-16 flex items-center py-2.5 px-2 border-2 border-gray-300 rounded-lg hover:bg-gray-200 cursor-pointer">
                              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                  <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                  <path d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                </g>
                              </svg>
                            </label>
                            <input type="file" id="upload-file" name="file" class="hidden" @input="fileUpload($event.target.files[0] ?? '')">
                          </div>

                          <div class="w-auto flex flex-wrap gap-1">
                            <div class="w-70 flex items-center py-2.5 px-2 border-2 border-gray-300 rounded-lg hover:bg-gray-200" v-if="props.occurrence.files.length > 0" v-for="(file, item) in props.occurrence.files" :key="item">
                              <div class="flex items-center" v-if="file.mime_type === 'text/plain'">
                                <FileDecryption :occurrences="props.occurrence" :encryptedText="file.data_base64" :type="1" :name="file.file_name" :size="file.size" :user="file.user" />
                              </div>

                              <div class="flex items-center" v-else-if="file.mime_type === 'application/pdf'">
                                <FileDecryption :occurrences="props.occurrence" :encryptedText="file.data_base64" :type="1" :name="file.file_name" :size="file.size" :user="file.user" />
                              </div>

                              <div class="items-center" v-else>
                                <ImgDecryption :occurrences="props.occurrence" :type="1" :name="file.file_name" :size="file.size" :encryptedText="file.data_base64" :user="file.user" />
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="border-t-2 flex space-x-4 py-4 w-full">
                          <div class="max-w-100-px">
                            <div @click="toggleOpen = ! toggleOpen" class="w-16 flex items-center py-2.5 px-2 border-2 border-gray-300 rounded-lg hover:bg-gray-200 cursor-pointer">
                              <svg height="44px" width="44px" fill="#000000" viewBox="0 -64 640 640" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                  <path d="M624 208h-64v-64c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v64h-64c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h64v64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-64h64c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                                </g>
                              </svg>
                            </div>
                          </div>

                          <div class="flex flex-col w-full">
                            <div class="w-auto flex flex-wrap gap-1">
                              <div class="w-70 flex items-center py-2.5 px-2 border-2 border-gray-300 rounded-lg hover:bg-gray-200" v-if="props.assign_users_selected.length > 0" v-for="(user, item) in props.assign_users_selected" :key="item">
                                <div class="flex items-center cursor-pointer" @click="toggleOpen = ! toggleOpen">
                                  <Thumbnail :email="user.email" :name="user.name" :profile_photo_url="user.profile_photo_url" />
                                </div>
                              </div>
                            </div>

                            <transition
                              enter-active-class="transition ease-out duration-200"
                              enter-from-class="transform opacity-0 scale-95"
                              enter-to-class="transform opacity-100 scale-100"
                              leave-active-class="transition ease-in duration-75"
                              leave-from-class="transform opacity-100 scale-100"
                              leave-to-class="transform opacity-0 scale-95"
                            >
                              <div class="w-full flex items-center mt-3 py-2.5 px-2 border-2 border-emerald-700 rounded-lg hover:bg-gray-200" v-show="toggleOpen">
                                <div class="items-center w-full">
                                  <select-user :options="props.assign_users" :value="props.assign_users_selected" @assignmentUpdate="assignmentUpdate" />
                                </div>
                              </div>
                            </transition>
                          </div>

                        </div>


                        <div class="mt-8 flex items-center flex-col">
                          <div class="max-w-4xl w-full mx-auto">
                            <form @submit.prevent="submit">
                              <div class="flex-auto w-full">
                                <div class="flex flex-wrap">
                                  <div class="relative w-full mb-3">
                                    <label
                                      class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                      for="comment"
                                    >
                                      {{$t('Comment(s)')}}
                                    </label>
                                    <textarea
                                      type="text"
                                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                      rows="6"
                                      name="comment"
                                      ref="commentTextArea"
                                      v-model="form.comment"
                                    ></textarea>
                                    <span class="text-red-600" v-if="form.errors.comment">
                                          {{ $t(form.errors.comment) }}
                                    </span>
                                  </div>

                                  <button :disabled="form.processing"
                                          class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                          type="submit"
                                  >
                                    {{$t('Post comment')}}
                                  </button>
                                  <button type="reset" class="bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-gray-700 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:text-white focus:outline-none focus:ring-4 focus:ring-gray-200 font-medium hover:bg-gray-100 px-4 py-2 rounded-lg text-gray-900 text-sm" @click.prevent="commentReset">{{$t('Abort')}}</button>

                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="max-w-4xl w-full mx-auto px-4">
                            <div class="w-full" v-for="(comment, index) in props.comments">
                              <CommentArticle :id="comment.id" :name="checkProfileName(comment.user, $t)" :date="comment.created_at" :content="decryption(comment.text)" :profile_img="checkProfileImage(comment.user)" @editComment="editComment" :user_id="comment.user_id" />
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="flex flex-col gap-2 w-full xl:w-4/12"> <!-- 25% width -->
                      <div class="w-full bg-white p-8 rounded-lg shadow-md">
                        <form>
                          <!-- Post Content Section -->
                          <div class="mb-6">
                            <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">{{$t('Category')}} :</label>
                            <select v-model="category" name="category" id="category" :value="category" @change.prevent="postCategory"
                                    class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500">
                              <option v-for="category in props.categories" :value="category.id">{{$t(category.name)}}</option>
                            </select>
                          </div>
                          <div class="mb-6" v-if="props.occurrence.departments">
                            <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">{{$t('Department')}} :</label>
                            <select v-model="department" name="department" id="department" :value="department" @change.prevent="postDepartment"
                                    class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500">
                              <option v-for="department in props.departments" :value="department.id">{{$t(department.name)}}</option>
                            </select>

                          </div>
                          <div class="mb-6">
                            <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">{{$t('Status')}} :</label>
                            <select v-model="status" name="status" id="status" :value="status" @change.prevent="postStatus"
                                    class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500">
                              <option v-for="type in props.status_types" :value="type">{{$t(type)}}</option>
                            </select>
                          </div>

                          <div class="mb-6">
                            <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">{{$t('Severity')}} :</label>
                            <select v-model="severity" name="severity" id="severity" :value="severity" @change.prevent="severityStatus"
                                    class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5 resize-none focus:outline-none focus:border-blue-500">
                              <option v-for="(severity, key) in props.severity_types" :key="key" :value="key">{{$t(severity)}}</option>
                            </select>
                          </div>
                        </form>
                      </div>

                      <div class="w-full text-sm flex flex-col items-center text-gray-500">
                        <NoteArticle :occurrence="props.occurrence" :notes="props.notes" />
                      </div>
                    </div>
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
    import AppLayout from '@/Layouts/AppLayout.vue';
    import {Head, Link, router, useForm} from '@inertiajs/vue3';
    import CommentArticle from '@/Components/Comment/ArticleBlock.vue';
    import NoteArticle from '@/Components/Comment/Note.vue';
    import CryptoJS from 'crypto-js';
    import {onMounted, ref} from "vue";
    import TextDecryption from '@/Components/Crypto/Decryption/Text.vue';
    import ImgDecryption from '@/Components/Crypto/Decryption/Image.vue';
    import FileDecryption from '@/Components/Crypto/Decryption/File.vue';
    import DateFormat from "@/Components/DateTime/DateFormat.vue";
    import selectUser from '@/Components/Select/User-select.vue';
    import Thumbnail from '@/Components/User/Thumbnail.vue';
    import TextEncryption from '@/Components/Crypto/Occurrence/Action.vue';


    const props = defineProps({
        comments : Array,
        notes : Array,
        color: {
            default: "light",
            validator: function (value) {
                // The value must match one of these strings
                return ["light", "dark"].indexOf(value) !== -1;
            },
        },
        occurrence: Object,
        next_page: Number,
        previous: Number,
        status_types: Array,
        severity_types: Array,
        assign_users: Array,
        assign_users_selected: Array,
        categories: Array,
        departments: Array
    });


    onMounted(() => {
      TextEncryption.methods.setOccurrence(props.occurrence)
    });

    const status = ref(props.occurrence.status);
    const category = ref(props.occurrence.category_id);
    const department = ref(props.occurrence.department_id);

    const form = useForm({
      id: props.occurrence.id,
      comment: '',
      comment_id: '',
      occurrence: props.occurrence,
      email:  (props.occurrence.email) ? decryption(props.occurrence.email) : '',
      status: ref('')
    });

    const submit = () => {
      // form.comment = encryptText(props.occurrence, form.comment);
      form.comment = encryption(form.comment);
      form.post(route('occurrences.post.comment'));
      form.reset();
    };

    const commentReset = () => {
      form.comment_id = '';
      form.comment = '';
    }


    const commentTextArea = ref(null);
    const editComment = (id) => {
      let data = props.comments.find(comment => comment.id === id);
      if(Object.keys(data).length){
        form.comment = decryption(data.text);
        form.comment_id = data.id;
        commentTextArea.value.focus();
      }
    }

    /**
     * post page status
     */
    const postStatus = async () => {

      let data = {
            id: form.id,
            status: status.value,
            occurrence: props.occurrence,
            email:  (props.occurrence.email) ? decryption(props.occurrence.email) : '',
      };
      await ajaxCall(route('occurrences.post.status'), data);
    };

    const severity = ref(props.occurrence.severity);
    const severityStatus = async () => {
      let data = {
            id: form.id,
            severity: severity.value,
            occurrence: props.occurrence
          };
      await ajaxCall(route('occurrences.post.severity'), data);
    };
    const postCategory = async () => {
      let data = {
        id: form.id,
        category_id: category.value
      };
      await ajaxCall(route('occurrences.post.category'), data);
    };
    const postDepartment = async () => {
      let data = {
        id: form.id,
        department_id: department.value
      };
      await ajaxCall(route('occurrences.post.department'), data);
    };

    /** #################### AJax Action ######################### **/
    const ajaxCall = async (url, data) => {
      await axios({
        method: 'post',
        url: url,
        data: data
      }).then(function (response) {
        if (response.status === 200) {
          const flashMessage = document.getElementById('alert-message');
          flashMessage.innerHTML = response.data.message;
          flashMessage.style.display = 'block';

          setTimeout(() => {
            flashMessage.style.display = 'none';
          }, 2000);

          return response.data;
        }
      }).catch(function (error) {
        console.log(error.toJSON());
      });
    }

    /**
     * @param user
     * @returns {*|string}
     */
    const checkProfileImage = (user) => {
      if(user){
        return user.profile_photo_url;
      }
      return 'https://ui-avatars.com/api/?name=N+O&color=7F9CF5&background=EBF4FF';
    }

    const checkProfileName = (user, $t) => {
      if(user){
        return user.name;
      }
      return $t('Anonymous User');
    }

    /**
     * Comment Encryption and Decryption
     */
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
    function aesKey() {
      return TextEncryption.methods.aesKey();
    }

/* ############ Upload image action ######################## */
    const validateAllowFiles = ref(true);
    const fileUpload = async (file) => {
      if(file){

        if (validateFiles(file['type']) === false){
          return;
        }

        let encrypted = await encryptImage(file);
        let details = {
          'file_name': file['name'],
          'mime_type': file['type'],
          'data_base64': encrypted,
          'size': file['size']
        };

        let file_encrypted_data = JSON.stringify(details);
        try {
          await filesUpload(file_encrypted_data);
        }catch (err){
          console.log(err);
        }

      }
    }

    const filesUpload = async (data) => {
      const uploadForm = useForm({
        id: props.occurrence.id,
        file: data
      });

      /** save **/
      uploadForm.post(route('occurrences.post.files'), {
        onSuccess: async (data) => {
          // console.log(data);
        },
        onError: async () => console.log(uploadForm.errors),
      });


    }

    const validateFiles = (type) => {
      const allowedFileTypes = [
        "image/jpeg",
        "image/png",
        "image/gif",
        "image/svg+xml",
        "text/plain",
        "application/pdf"
      ];

      // Check if the file type is allowed
      if (!allowedFileTypes.includes(type)) {
        alert("File type not allowed. Please select a different file.");

        return validateAllowFiles.value = false;
      }
      return true;
    }
    async function encryptImage(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = function (event) {
          const data = event.target.result;
          const encryptedData = encryption(data);
          resolve(encryptedData);
        };
        reader.readAsDataURL(file);
      });
    }


    /** ########### Toggle for select user ***/
    const toggleOpen = ref(false);
    const assignmentUpdate = async (properties) => {
      await  assignmentSubmit(properties.data);
    }
    async function assignmentSubmit(data)
    {
      const assignmentForm = useForm({
        id: props.occurrence.id,
        users: data,
        status: true
      });
      /** save **/
      assignmentForm.post(route('occurrences.post.assignment.users'), {
        onSuccess: async (data) => {
          // console.log(data);
        },
        onError: async () => console.log(assignmentForm.errors),
      });
    }

    function destroy(id) {
      if (confirm("Are you sure you want to Delete")) {
        form.delete(route('occurrences.destroy', id), {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {

          },
        });
      }
    }

</script>



<style scoped>
  .transition {
    transition: opacity 1s;
  }
</style>
-
