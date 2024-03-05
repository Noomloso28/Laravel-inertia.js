<template>
  <ul class="flex text-center justify-center">
    <li v-if="$page.props.current_locale !== 'en'">
      <a href="#" class="p-2 flex" @click.prevent="switchLang($inertia, 'en')">
        <img src="/images/flags/gb.svg" alt="English" class="h-5" />
      </a>
    </li>
    <li v-if="$page.props.current_locale !== 'de'">
      <a href="#" class="p-2 flex" @click.prevent="switchLang($inertia, 'de')">
        <img src="/images/flags/de.svg" alt="German" class="h-5" />
      </a>
    </li>
  </ul>

</template>

<script setup>
const switchLang = ($inertia, lang) => {

  axios.get(`/lang/${lang}`).then(() => {
    window.location.reload();
    $inertia.reload({ preserveScroll: true, preserveState: true });
  });
}
</script>

<style scoped>

</style>
