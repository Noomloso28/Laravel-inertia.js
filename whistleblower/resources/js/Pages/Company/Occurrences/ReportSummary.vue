<template>
  <AppLayout title="Check Report">
    <div class="min-h-screen justify-center items-center flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
      <div class="w-full sm:max-w-7xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="rounded-t mb-0 px-4 py-3 border-0" v-if="props.occurrence.topic">
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
                      <span class="bg-gray-300 h-6 w-[.5px] mx-3"></span>
                      <div class="flex items-center space-x-2">
                        <button @click.prevent="reload($event)" title="reload" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100 cursor-pointer">
                          <svg width="20px" height="20px" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M1.84998 7.49998C1.84998 4.66458 4.05979 1.84998 7.49998 1.84998C10.2783 1.84998 11.6515 3.9064 12.2367 5H10.5C10.2239 5 10 5.22386 10 5.5C10 5.77614 10.2239 6 10.5 6H13.5C13.7761 6 14 5.77614 14 5.5V2.5C14 2.22386 13.7761 2 13.5 2C13.2239 2 13 2.22386 13 2.5V4.31318C12.2955 3.07126 10.6659 0.849976 7.49998 0.849976C3.43716 0.849976 0.849976 4.18537 0.849976 7.49998C0.849976 10.8146 3.43716 14.15 7.49998 14.15C9.44382 14.15 11.0622 13.3808 12.2145 12.2084C12.8315 11.5806 13.3133 10.839 13.6418 10.0407C13.7469 9.78536 13.6251 9.49315 13.3698 9.38806C13.1144 9.28296 12.8222 9.40478 12.7171 9.66014C12.4363 10.3425 12.0251 10.9745 11.5013 11.5074C10.5295 12.4963 9.16504 13.15 7.49998 13.15C4.05979 13.15 1.84998 10.3354 1.84998 7.49998Z" fill="#000000"></path>
                            </g>
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="px-2 flex items-center space-x-4">

                  </div>
                </div>
                <div class="mb-6">

                  <h4 class="text-lg text-gray-800 font-bold pb-2 mb-4 border-b-2">{{$t('Your case')}} : {{decryptByAESkey(props.occurrence.topic)}}</h4>
                  <div class="flex flex-wrap items-start justify-between mb-2">
                    <div class="flex items-center">
                      <i class="fas fa-user-secret mr-2 text-lg text-blueGray-400 rounded-full w-8 h-8 border border-gray-500 text-center"></i>
                      <div class="flex flex-col ml-2">
                        <span class="text-sm font-semibold">{{props.occurrence.classification}}</span>
                        <span class="text-xs text-gray-400" v-if="props.occurrence.email">{{$t('From')}}: {{decryptByAESkey(props.occurrence.email)}}</span>
                      </div>
                    </div>

                    <div class="text-sm text-gray-500">
                      <span><i class="fas fa-fire mr-2 text-blueGray-400"></i>{{$t('Severity')}} : {{$t(severityName(props.occurrence.severity))}} | </span>
                      <span><i class="fas fa-hourglass mr-2 text-blueGray-400"></i>{{$t('Status')}} : {{$t(props.occurrence.status)}} | </span>
                      <span><i class="fas fa-folder-open mr-2 text-blueGray-400"></i>{{$t('Category')}} : {{props.occurrence.categories.name}} | </span>
                      <span v-if="props.occurrence.departments"><i class="fas fa-code-branch mr-2 text-blueGray-400"></i>{{$t('Department')}} : {{props.occurrence.departments.name}} | </span>
                      <span ><DateFormat :date="props.occurrence.created_at" hasTime="true" /> </span>
                    </div>

                  </div>
                  <div class="py-6 pl-2 text-gray-700">
                    {{decryptByAESkey(props.occurrence.description)}}
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
                          <FileDecryption :occurrences="props.occurrence" :encryptedText="file.data_base64" :type="1" :name="file.file_name" :size="file.size"  />
                        </div>

                        <div class="flex items-center" v-else-if="file.mime_type === 'application/pdf'">
                          <FileDecryption :occurrences="props.occurrence" :encryptedText="file.data_base64" :type="1" :name="file.file_name" :size="file.size"  />
                        </div>

                        <div class="items-center" v-else>
                          <ImgDecryption :occurrences="props.occurrence" :type="1" :name="file.file_name" :size="file.size" :encryptedText="file.data_base64" />
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
            </div>

          </div>
        </div>

        <!-- comment -->
        <div class="mt-8 flex items-center flex-col space-x-4" v-if="props.occurrence.topic">
          <div class="max-w-4xl w-full mx-auto px-4">
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
                </div>
              </div>
            </form>
          </div>
          <div class="max-w-4xl w-full mx-auto px-4">
            <div class="w-full" v-for="(comment, index) in props.comments">
              <CommentArticle :id="comment.id" :name="checkProfileName(comment.user, $t)" :date="comment.created_at" :content="decryptByAESkey(comment.text)" :profile_img="checkProfileImage(comment.user)" @editComment="editComment" :user_id="comment.user_id" />
            </div>
          </div>
        </div>
        <div class="w-full lg:w-12/12 px-4 mt-6" v-else>
          {{$t('Could not find report')}}
        </div>
        <!-- comment -->

        <div class="w-full flex mt-4 lg:w-12/12 px-6 text-left">
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
            </div>
          </div>
        </div>

      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DateFormat from "@/Components/DateTime/DateFormat.vue";
import {computed, ref, onMounted, onUnmounted, onBeforeUnmount} from "vue";
import CryptoJS from 'crypto-js';
import {Link, router, useForm} from "@inertiajs/vue3";
import CommentArticle from '@/Components/Comment/ArticleBlock.vue';
import TextDecryption from '@/Components/Crypto/Decryption/Text.vue';
import ImgDecryption from '@/Components/Crypto/Decryption/Image.vue';
import FileDecryption from '@/Components/Crypto/Decryption/File.vue';

const props = defineProps({
  access_keys: Array,
  occurrence: Array,
  password: ref(''),
  full_password: ref(''),
  comments : Array,
  severity_types: Array
});
const reload = async (e) => {
  e.preventDefault();

  let form = useForm({
    password: props.full_password
  });

  form.post(route('occurrences.post.report.reload'), {
    onSuccess: async () => {
      return true;
    },
    onError: async () => console.log(form.errors),
  });

  return true;
}

const severityName = (id) => {
  if (!props.severity_types.hasOwnProperty(id)) {
    id = 3;
  }

  return props.severity_types[id];
}

/** varibles group **/
const whistleAESkey = ref('');

onMounted(async () => {

  const private_key = await decryptWithAESforPrivateKey(props.access_keys.whistleblower_private_key, encryptMasterPassword.value);
  await decryptAESkey(private_key, props.access_keys.whistleblower_public_key);

});

const form = useForm({
  id: props.occurrence.id,
  comment: '',
  comment_id: '',
  occurrence: props.occurrence,
});
const submit = async () => {
  if(!form.comment){
    return;
  }

  const result = await axios({
    method: 'post',
    url: route('occurrences.post.comment.guest'),
    data: {
      id: form.id,
      comment: await encryptText(form.comment),
      comment_id: form.comment_id,
      password: props.full_password,
      occurrence: props.occurrence
    }
  }).then(function (response) {
    if (response.status === 200) {
      props.comments = response.data.comments;
      form.reset();
    }
  }).catch(function (error) {
    console.log(error.toJSON());
  });

};
const editComment = (id) => {
  let data = props.comments.find(comment => comment.id === id);
  if(Object.keys(data).length){
    form.comment = data.text;
    form.comment_id = data.id;
  }
}
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
  return $t('Whistleblower User');
}

const encryptMasterPassword = computed( () => {
  return  CryptoJS.PBKDF2(props.password, '', {
    keySize: 128 / 32
  }).toString();
});


async function decryptWithAESforPrivateKey(encryptedHex, key) {
  // Convert the encrypted data and key strings to ArrayBuffers
  const encryptedData = hexStringToUint8Array(encryptedHex);
  const keyBuffer = hexStringToUint8Array(key);

  const iv = encryptedData.slice(0, 12);
  // Extract the ciphertext (the rest of the bytes) from the encrypted data
  const ciphertext = encryptedData.slice(12);
  try {
    // Import the key for AES-GCM decryption
    const importedKey = await window.crypto.subtle.importKey(
      "raw",
      keyBuffer,
      { name: "AES-GCM" },
      false,
      ["decrypt"]
    );
    // Decrypt the ciphertext using AES-GCM
    const decryptedData = await crypto.subtle.decrypt(
      {
        name: "AES-GCM",
        iv: iv,
      },
      importedKey,
      ciphertext
    );
    // Convert the decrypted data (ArrayBuffer) to a string
    return new TextDecoder().decode(decryptedData);

  }catch (error) {
    console.error("Error decrypting the data:", error);
  }
}

// Utility function to convert a hexadecimal string to Uint8Array
function hexStringToUint8Array(hexString) {
  const bytes = [];
  for (let i = 0; i < hexString.length; i += 2) {
    bytes.push(parseInt(hexString.substr(i, 2), 16));
  }
  return new Uint8Array(bytes);
}


async function decryptAESkey(private_key, encrypted_rsa_key){

  let importedRsaPrivateKey = await importPrivateRSAKey(private_key);
  let encryptedAESKey = window.atob(encrypted_rsa_key);
  let encryptedArrayBuffer = str2ab(encryptedAESKey);
  let decryptedAESKey = await decryptRSA(importedRsaPrivateKey, encryptedArrayBuffer);
  let aesKey = new TextDecoder().decode(decryptedAESKey);

  return whistleAESkey.value = aesKey;
}
async function decryptRSA(key, plaintext) {
  let decrypted = await window.crypto.subtle.decrypt(
    {
      name: "RSA-OAEP"
    },
    key,
    plaintext
  );
  return decrypted;
}
async function importPrivateRSAKey(rawPkcs8Pem) {
  return await window.crypto.subtle.importKey(
    "pkcs8",
    getPkcs8Der(rawPkcs8Pem),
    {
      name: "RSA-OAEP",
      hash: "SHA-256",
    },
    true,
    ["decrypt"]
  );
}
function getPkcs8Der(pem){
  const pemHeader = "-----BEGIN PRIVATE KEY-----";
  const pemFooter = "-----END PRIVATE KEY-----";
  const pemContents = pem.substring(
    pemHeader.length,
    pem.length - pemFooter.length,
  );
  // base64 decode the string to get the binary data
  const binaryDerString = window.atob(pemContents);
  // convert from a binary string to an ArrayBuffer
  return  str2ab(binaryDerString);
}

function str2ab(str) {
  const buf = new ArrayBuffer(str.length);
  const bufView = new Uint8Array(buf);
  for (let i = 0, strLen = str.length; i < strLen; i++) {
    bufView[i] = str.charCodeAt(i);
  }
  return buf;
}

function decryptByAESkey(encryptedText)
{
  try {
    return CryptoJS.AES.decrypt(encryptedText, whistleAESkey.value).toString(CryptoJS.enc.Utf8);
  }catch (err){
    return CryptoJS.AES.decrypt(encryptedText, whistleAESkey.value).toString(CryptoJS.enc.Latin1);
  }
}

async function encryptText(dataToEncrypt){

  if(dataToEncrypt && whistleAESkey.value){
    return  CryptoJS.AES.encrypt(dataToEncrypt, whistleAESkey.value).toString();
  }
  return null;
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
  await axios({
    method: 'post',
    url: route('occurrences.post.report.files'),
    data: {
      id: props.occurrence.id,
      file: data,
      password: props.full_password,
    }
  }).then(function (response) {
    if (response.status === 200) {
      props.occurrence = response.data.occurrence;
    }
  }).catch(function (error) {
    console.log(error.toJSON());
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

      const encryptedData = CryptoJS.AES.encrypt(data, whistleAESkey.value).toString();
      resolve(encryptedData);
    };
    reader.readAsDataURL(file);
  });
}

</script>

<style scoped>

</style>
