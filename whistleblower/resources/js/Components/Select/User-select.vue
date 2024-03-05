<!-- Vue component -->
<template>
  <div class="flex">
    <multiselect v-model="selected" tag-placeholder="Add this as new user" placeholder="Search or add a user" label="name" track-by="id" :options="props.options" :custom-label="customLabel" :multiple="true" :taggable="true" @tag="addTag">
    </multiselect>
    <PrimaryButton class="ml-3" @click.prevent="$emit('assignmentUpdate', {data: selected})">
      {{ button }}
    </PrimaryButton>
  </div>
<!--  <pre class="language-json"><code>{{ selected  }}</code></pre>-->
</template>

<script setup>
  // import { computed, onMounted, onUnmounted, ref } from 'vue';
  import PrimaryButton from "../PrimaryButton.vue";
  import {ref} from "vue";

  const props = defineProps({
    value: {
      type: Array
    },
    options: {
      type: Array,
    },
    button: {
      type: String,
      default: 'Confirm',
    }
  });

  const customLabel = ({ name, email }) =>  {
    return `${name} – ${email}`
  }

  const selected = ref(props.value);

  const addTag = (newTag) => {
    const tag = {
      name: newTag,
      code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
    }
    selected.push(tag);
  }


</script>

<style>

</style>
