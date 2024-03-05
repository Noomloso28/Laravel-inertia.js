
<template>
  <a :href="decryptByAESkey(props.occurrences, props.encryptedText)" :data-lightbox="'image-gallery'" class="flex items-center" v-if="props.type === 1">
    <div class="w-10 flex items-center justify-center">
      <img :src="decryptByAESkey(props.occurrences, props.encryptedText)" alt="" class="img-decrypted">
    </div>
    <div class="w-48 ml-2 flex flex-col">
      <span class="text-sm text-gray-700 font-bold truncate">{{props.name}}</span>
      <span class="text-gray-500 text-xs">{{calculateSize(props.size)}}</span>
      <span class="text-gray-500 text-xs" v-if="props.user">{{$t('By')}} : {{props.user.name}}</span>
      <span class="text-gray-500 text-xs" v-else>{{$t('By')}} : {{$t(props.occurrences.classification)}}</span>
    </div>
    <div class="w-6 flex items-center justify-center" title="View">
      <svg class="h-6 w-6 icon line-color" fill="#000000" viewBox="0 0 36 36"  preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <path d="M33.62,17.53c-3.37-6.23-9.28-10-15.82-10S5.34,11.3,2,17.53L1.72,18l.26.48c3.37,6.23,9.28,10,15.82,10s12.46-3.72,15.82-10l.26-.48ZM17.8,26.43C12.17,26.43,7,23.29,4,18c3-5.29,8.17-8.43,13.8-8.43S28.54,12.72,31.59,18C28.54,23.29,23.42,26.43,17.8,26.43Z" class="clr-i-outline clr-i-outline-path-1"></path><path d="M18.09,11.17A6.86,6.86,0,1,0,25,18,6.86,6.86,0,0,0,18.09,11.17Zm0,11.72A4.86,4.86,0,1,1,23,18,4.87,4.87,0,0,1,18.09,22.89Z" class="clr-i-outline clr-i-outline-path-2"></path>
        <rect x="0" y="0" width="36" height="36" fill-opacity="0"/>
      </svg>
    </div>
  </a>

  <a :href="decryptByAESkey(props.occurrences, props.encryptedText)" :data-lightbox="'image-gallery'" v-else>
    <img :src="decryptByAESkey(props.occurrences, props.encryptedText)" alt="" class="img-decrypted">
  </a>

</template>
<script setup>
import {computed, ref, onMounted, onUnmounted, onBeforeUnmount} from "vue";
import CryptoJS from 'crypto-js';

const props = defineProps({
  occurrences: Object,
  encryptedText: String,
  type: ref(0),
  name: ref(''),
  size: ref(0),
  user: ref('')
});

function decryptByAESkey(occurrence, encryptedText)
{
  let AESkey = generatePublicAESkey(occurrence);
  return  CryptoJS.AES.decrypt(encryptedText, AESkey).toString(CryptoJS.enc.Utf8);
}
function generatePublicAESkey(occurrence) {
  if (typeof occurrence.whistleblower.company_public_key !== 'undefined' &&
    typeof occurrence.companies.rsa_key !== 'undefined'){

    let companyPublicKey = getRealCompanyPublicKey(occurrence.companies.rsa_key);
    return   CryptoJS.AES.decrypt(occurrence.whistleblower.company_public_key , companyPublicKey ).toString(CryptoJS.enc.Utf8);
  }
}
function getRealCompanyPublicKey(spkiPem) {
  const pemHeader = "-----BEGIN PUBLIC KEY-----";
  const pemFooter = "-----END PUBLIC KEY-----";
  return  spkiPem.substring(pemHeader.length, spkiPem.length - pemFooter.length);
}

const calculateSize = (bytes) => {
  const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
  if (bytes === 0) return '0 Byte';

  const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
  return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

</script>
<style scoped>
.attachment-file-img .img-decrypted{
  max-width: 200px;
  max-height: 200px;
}
</style>
