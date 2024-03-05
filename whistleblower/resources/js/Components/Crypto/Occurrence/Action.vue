<script>
  import CryptoJS from "crypto-js";
  import {ref} from "vue";

  const occurrence = ref(false);

  /** Encrypt Action **/
  function encrypt(dataToEncrypt){
    if(occurrence.value){
      let AESkey = generatePublicAESkey(occurrence.value);
      if(dataToEncrypt && AESkey){
        return  CryptoJS.AES.encrypt(dataToEncrypt, AESkey).toString();
      }
    }
    return null;
  }
  function decrypt(encryptedText)
  {
    if(occurrence.value){
      let AESkey = generatePublicAESkey(occurrence.value);
      try {
        return  CryptoJS.AES.decrypt(encryptedText, AESkey).toString(CryptoJS.enc.Utf8);
      }catch (err){
        return  CryptoJS.AES.decrypt(encryptedText, AESkey).toString(CryptoJS.enc.Latin1);
      }
    }
    return null;
  }
  function aesKey()
  {
    if(occurrence.value){
      return generatePublicAESkey(occurrence.value);
    }
    return null;
  }

  function generatePublicAESkey(occurrence) {
    if (typeof occurrence.whistleblower.company_public_key !== 'undefined' &&
      typeof occurrence.companies.rsa_key !== 'undefined'){

      let companyPublicKey = getRealCompanyPublicKey(occurrence.companies.rsa_key);

      try {
        return  CryptoJS.AES.decrypt(occurrence.whistleblower.company_public_key , companyPublicKey ).toString(CryptoJS.enc.Utf8);
      }catch (err){
        return  CryptoJS.AES.decrypt(occurrence.whistleblower.company_public_key , companyPublicKey ).toString(CryptoJS.enc.Latin1);
      }
    }
  }
  function getRealCompanyPublicKey(spkiPem) {
    const pemHeader = "-----BEGIN PUBLIC KEY-----";
    const pemFooter = "-----END PUBLIC KEY-----";
    return  spkiPem.substring(pemHeader.length, spkiPem.length - pemFooter.length);
  }

  function setOccurrence(values)
  {
    return occurrence.value = values;
  }

  export default {
    methods: {
      setOccurrence,
      encrypt,
		  decrypt,
      aesKey
    },

  };

</script>

<template>

</template>

<style scoped>

</style>
