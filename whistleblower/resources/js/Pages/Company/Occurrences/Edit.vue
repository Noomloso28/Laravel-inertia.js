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
                                    :href="route('occurrences.index')"
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
                                    <TextLabel for="topic" value="Topic" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                    <TextInput
                                      id="topic"
                                      type="text"
                                      class="mborder-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                      v-model="form.topic"
                                      autofocus />
                                    <span class="text-red-600" v-if="form.errors.topic">
                                      {{ $t(form.errors.topic) }}
                                    </span>
                                  </div>

                                  <div class="relative w-full mb-3">
                                    <input id="classification_confidential" type="radio" v-model="form.classification" value="confidential" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="classification_confidential" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$t('Confidential')}}</label>
                                    <div>
                                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                      It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </div>
                                    <span class="text-red-600" v-if="form.errors.classification">
                                      {{ $t(form.errors.classification) }}
                                    </span>
                                  </div>

                                  <div class="relative w-full mb-3">
                                    <input checked id="classification_anonymous" type="radio" v-model="form.classification" value="anonymous" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="classification_anonymous" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$t('Anonymous')}}</label>
                                    <div>
                                      It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
                                      Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                    </div>
                                    <span class="text-red-600" v-if="form.errors.classification">
                                        {{ $t(form.errors.classification) }}
                                      </span>
                                  </div>

                                  <div class="relative w-full mb-3">
                                    <label
                                      class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                      htmlFor="grid-password"
                                    >
                                      {{$t('Description')}}
                                    </label>
                                    <textarea
                                      type="text"
                                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                      rows="6"
                                      v-model="form.description"
                                    ></textarea>
                                    <span class="text-red-600" v-if="form.errors.description">
                                      {{ $t(form.errors.description) }}
                                    </span>
                                  </div>

                                  <div class="relative w-full mb-3">
                                    <TextLabel for="department" value="Departments" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                    <select v-model="form.department_id" name="department_id" id="department" :value="form.department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                      <option value="">{{$t('Choose a department')}}</option>
                                      <option v-for="department in props.departments" :value="department.id">{{department.name}}</option>
                                    </select>
                                    <span class="text-red-600" v-if="form.errors.department_id">
                                      {{ $t(form.errors.department_id) }}
                                    </span>
                                  </div>

                                  <div class="relative w-full mb-3">
                                    <TextLabel for="category" value="Category" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                    <select v-model="form.category_id" name="category_id" id="department" :value="form.category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                      <option value="">{{$t('Choose a category')}}</option>
                                      <option v-for="category in props.categories" :value="category.id">{{category.name}}</option>
                                    </select>
                                    <span class="text-red-600" v-if="form.errors.category_id">
                                      {{ $t(form.errors.category_id) }}
                                    </span>
                                  </div>

                                  <div class="relative w-full mb-6">
                                    <TextLabel for="companies" value="Companies" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                                    <select v-model="form.company_id" name="company_id" id="companies" :value="form.company_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                      <option v-for="company in props.companies" :value="company.id">{{company.name}}</option>
                                    </select>
                                    <span class="text-red-600" v-if="form.errors.company_id">
                                          {{ $t(form.errors.company_id) }}
                                    </span>
                                  </div>

                                  <!--div class="relative w-full mb-3" v-if="displayAction($page.props.user.permissions, 'create-notes') || displayAction($page.props.user.permissions, 'update-notes')"-->
                                  <div class="relative w-full mb-3">
                                    <label
                                      class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                      for="comment"
                                    >
                                      {{$t('Comment')}}
                                    </label>
                                    <textarea
                                      type="text"
                                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                      rows="6"
                                      name="comment"
                                      v-model="form.comment"
                                    ></textarea>
                                    <span class="text-red-600" v-if="form.errors.comment">
                                      {{ $t(form.errors.comment) }}
                                    </span>
                                  </div>

                                    <button
                                        class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                        type="submit"
                                    >
                                      {{$t('Update')}}
                                    </button>
                                </div>

                              <div class="max-w-2xl mx-auto px-4">

                                <div class="w-full" v-for="(comment, index) in props.comments">
                                  <CommentArticle :id="comment.id" :name="comment.user.name" :date="comment.created_at" :content="comment.text" :profile_img="comment.user.profile_photo_url" @editComment="editComment" :user_id="comment.user_id" />
                                </div>

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
    import CommentArticle from '@/Components/Comment/ArticleBlock.vue';

    import { Head, Link, useForm } from '@inertiajs/vue3';
    import {computed} from "vue";

    const props = defineProps({
      occurrences: Array,
      departments: Array,
      categories: Array,
      companies: Array,
      comments : Array,
        color: {
            default: "light",
            validator: function (value) {
                // The value must match one of these strings
                return ["light", "dark"].indexOf(value) !== -1;
            },
        },
    });

    const form = useForm({
        company_id: props.occurrences.company_id ?? 0,
        topic: props.occurrences.topic,
        description: props.occurrences.description,
        comment: '',
        comment_id: '',
        classification: props.occurrences.classification,
        department_id: props.occurrences.department_id ?? '',
        category_id: props.occurrences.category_id ?? 0,
        status: props.occurrences.status,
        severity: props.occurrences.severity
    });
    const submit = () => {
        form.put(route('occurrences.update', props.occurrences.id));
        form.reset('comment');
    };

    const editComment = (id) => {
      let data = props.comments.find(comment => comment.id === id);
      if(Object.keys(data).length){
        form.comment = data.text;
        form.comment_id = data.id;
      }
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

</script>
