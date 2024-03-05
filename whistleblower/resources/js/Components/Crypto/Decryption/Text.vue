
<template>
  <span v-text="decryptByAESkey(props.occurrences, props.encryptedText)"></span>
</template>
<script setup>
import {computed, ref, onMounted, onUnmounted, onBeforeUnmount} from "vue";
import CryptoJS from 'crypto-js';

const props = defineProps({
  occurrences: Object,
  encryptedText: String
});

function decryptByAESkey(occurrence, encryptedText)
{
  let AESkey = generatePublicAESkey(occurrence);
  try {
    return  CryptoJS.AES.decrypt(encryptedText, AESkey).toString(CryptoJS.enc.Utf8);
  }catch (err){
    return CryptoJS.AES.decrypt(encryptedText, AESkey).toString(CryptoJS.enc.Latin1);
  }

}
function generatePublicAESkey(occurrence) {
  if (typeof occurrence.whistleblower.company_public_key !== 'undefined' &&
    typeof occurrence.companies.rsa_key !== 'undefined'){

    let companyPublicKey = getRealCompanyPublicKey(occurrence.companies.rsa_key);

    try {
      return   CryptoJS.AES.decrypt(occurrence.whistleblower.company_public_key , companyPublicKey ).toString(CryptoJS.enc.Utf8);
    }catch (e) {
      return   CryptoJS.AES.decrypt(occurrence.whistleblower.company_public_key , companyPublicKey ).toString(CryptoJS.enc.Latin1);
    }

  }
}
function getRealCompanyPublicKey(spkiPem) {
  const pemHeader = "-----BEGIN PUBLIC KEY-----";
  const pemFooter = "-----END PUBLIC KEY-----";
  return  spkiPem.substring(pemHeader.length, spkiPem.length - pemFooter.length);
}
</script>
