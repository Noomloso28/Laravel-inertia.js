<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';

  const props = defineProps({
    company: Array,
    logo: Array
  });
</script>

<template>
  <AppLayout title="Platform Companies">

    <div
      class="absolute min-h-screen justify-center items-center flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
    >
      <div class="w-full container mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg text-center">

        <div class="header my-6">
          <div v-if="props.logo['attribute_value']" class="mr-6 text-center w-full">
            <img :src="route('media.display', props.logo['attribute_value'] ?? '' )" alt="company logo" class="w-64 mx-auto rounded-lg">
          </div>
          <h6 v-else class="text-blueGray-400 text-sm font-bold uppercase">
            {{props.company.name}}
          </h6>
        </div>

        <div class="content max-w-2xl mx-auto py-8">
          <div class="content-inside">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
              It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
          </div>


          <div class="content-links">
            <a :href="route('occurrences.company.slug', props.company.slug )" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Alternative</a>

            <a :href="route('occurrences.check.report')"
               class="inline-flex items-center px-4 py-2 text-white bg-indigo-600 border border-indigo-600 rounded rounded-full hover:bg-indigo-700 focus:outline-none focus:ring">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="none" viewBox="0 0 24 24"
                   stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
              </svg>
              <span class="text-sm font-medium">
                  {{$t('View case')}}
            </span>
            </a>

          </div>

        </div>





      </div>

      <div class="w-full sm:max-w-2xl px-6 py-4 overflow-hidden" v-if="!$page.props.user.id">
        <LanguageSwitcher :component="$page.component" :props="$page.props" />
      </div>
    </div>

  </AppLayout>

</template>

<style scoped>
  .m-auto {
    margin: 0 auto;
  }
</style>
