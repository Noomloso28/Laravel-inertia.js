
<template>
  <div class="flex items-center">
    <div class="w-10 flex items-center justify-center">
      <img :src="props.profile_photo_url" alt="" class="img-decrypted">
    </div>
    <div class="w-48 ml-2 flex flex-col">
      <span class="text-sm text-gray-700 font-bold truncate">{{props.name}}</span>
      <span class="text-gray-500 text-xs">{{$t('Email')}} : {{props.email}}</span>
    </div>
    <div class="w-6 flex items-center justify-center" title="View">
      <i class="fas fa-edit opacity-75"></i>
    </div>
  </div>

</template>
<script setup>
import {computed, ref, onMounted, onUnmounted, onBeforeUnmount} from "vue";

const props = defineProps({
  email: ref(''),
  name: ref(''),
  profile_photo_url: {
    type: String,
    default: 'https://ui-avatars.com/api/?name=N+o&color=7F9CF5&background=EBF4FF',
  }
});


</script>
<style scoped>
.attachment-file-img .img-decrypted{
  max-width: 200px;
  max-height: 200px;
}
</style>
