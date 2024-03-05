<template>
    <AppLayout title="Occurrences Submit Form">
      <div
        class="container mx-auto mt-6 relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
      >
        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
          <form @submit.prevent="submit">
            <input type="hidden" name="_token" :value="$page.props.csrf_token">

            <div class="grid grid-cols-3 m-4">

              <div class="col-span-2 flex items-center">
                <span v-if="props.logo['attribute_value']" class="mr-6">
                  <img :src="route('media.display', props.logo['attribute_value'] ?? '' )" alt="company logo" class="h-20 w-20">
                </span>

                <h6 class="text-blueGray-400 text-sm font-bold uppercase">
                  {{props.company.name}}
                </h6>
              </div>
              <div class="LanguageSwitcher">
                <LanguageSwitcher :component="$page.component" :props="$page.props" class="mt-1" />
              </div>
            </div>

            <input type="hidden" :value="form.company_id" name="company_id">

            <div class="flex flex-wrap">
              <div class="w-full lg:w-12/12 px-4">
                <div class="relative w-full my-4">
                  <h6 class="text-blueGray-600 font-bold text-xl uppercase">
                    {{$t('Create new case')}}
                  </h6>
                </div>
                <div class="relative w-full mb-8">
                  <TextLabel for="topic" value="Matter of concern" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
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

                <div class="relative w-full mb-8">
                  <TextLabel for="topic" value="How would you like to submit your case" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />

                  <input id="classification_confidential" type="radio" v-model="form.classification" value="confidential" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                  <label for="classification_confidential" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$t('Report confidentially')}}</label>
                  <div class="mt-1">
                    <label for="classification_confidential" class="block text-sm font-medium text-gray-900 dark:text-gray-300">
                      {{$t('Submit case with your email address provided. All your information is transmitted and stored in encrypted form.')}}
                    </label>
                  </div>


                  <div class="mt-4 w-full" v-if="form.classification === 'confidential'">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                      <div class="w-full">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="text-red-600 font-bold">*</span> {{$t('Your name')}}</label>
                        <input v-model="form.confidential_name" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                      </div>
                      <div class="w-full">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><span class="text-red-600 font-bold">*</span> {{$t('Your E-mail')}}</label>
                        <input v-model="form.confidential_email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                      </div>
                    </div>
                  </div>


                  <span class="text-red-600" v-if="form.errors.classification">
                    {{ $t(form.errors.classification) }}
                  </span>

                </div>
              </div>

              <div class="w-full lg:w-12/12 px-4">
                <div class="relative w-full mb-8">
                  <input checked id="classification_anonymous" type="radio" v-model="form.classification" value="anonymous" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                  <label for="classification_anonymous" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$t('Report completely anonymously')}}</label>
                  <div class="mt-1">
                    <label for="classification_anonymous" class="block text-sm font-medium text-gray-900 dark:text-gray-300">
                      {{$t('Submit case without providing personal information. Before uploading files, please ensure that you remove all metadata that could identify you.')}}
                    </label>
                  </div>
                  <span class="text-red-600" v-if="form.errors.classification">
                    {{ $t(form.errors.classification) }}
                  </span>
                </div>
              </div>
            </div>

            <div class="flex flex-wrap">
              <div class="w-full lg:w-12/12 px-4">
                <div class="relative w-full mb-8">
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
<!--                  <ckeditor :editor="ClassicEditor" v-model="form.description" :config="editorConfig" />-->

                  <span class="text-red-600" v-if="form.errors.description">
                    {{ $t(form.errors.description) }}
                  </span>
                </div>
                <div class="relative w-full mb-8">
                  <TextLabel for="department" value="Departments" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                  <select v-model="form.department_id" name="department_id" id="department" :value="form.department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" disabled>{{ $t('Choose a department') }}</option>
                    <option v-for="department in props.departments" :value="department.id">{{ $t(department.name) }}</option>
                  </select>
                  <span class="text-red-600" v-if="form.errors.department_id">
                    {{ $t(form.errors.department_id) }}
                  </span>
                </div>
                <div class="relative w-full mb-8">
                  <TextLabel for="category" value="Category" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                  <select v-model="form.category_id" name="category_id" id="department" :value="form.category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" disabled>{{ $t('Choose a category') }}</option>
                    <option v-for="category in props.categories" :value="category.id">{{ $t(category.name) }}</option>
                  </select>
                  <span class="text-red-600" v-if="form.errors.category_id">
                    {{ $t(form.errors.category_id) }}
                  </span>
                </div>

                <div class="relative w-full mb-8">
                  <TextLabel for="category" value="File upload" class="block uppercase text-blueGray-600 text-xs font-bold mb-2" />
                  <div class="w-full">
                    <label class="flex justify-center w-full h-32 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none"
                           v-cloak
                           v-on:dragover.prevent="onUploadDragoverEvent($event)"
                           v-on:drop.prevent="onUploadDropEvent($event)">
                      <span class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <span class="font-medium text-gray-600"> {{$t('Drop files to Attach')}}, {{$t('or')}} <span class="text-blue-600 underline">{{$t('browse')}}</span>
                        </span>
                      </span>
                      <input type="file" name="file" class="hidden" @input="fileUpload($event.target.files[0] ?? '')">
                    </label>
                    <span class="w-full text-sm">{{$t('Allowed file types')}} : jpg,png,jpeg,gif,svg,txt,pdf : {{$t('Max size')}} 20MB</span>

                    <div class="py-4 md:py-4 lg:py-2 overflow-hidden">
                      <div class="max-w-screen-xl mx-auto text-center">
                        <div class="bg-white shadow overflow-hidden sm:rounded-md mt-5">
                          <ul>
                            <li
                              v-for="(file, index) in files"
                              v-bind:key="index"
                            >
                              <a @click="removeFile(file)" href="#" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out" >
                                <div class="px-4 py-4 sm:px-6">
                                  <div class="flex items-center justify-between">
                                    <div class="text-sm leading-5 font-medium text-pink-600 truncate">
                                      {{ file.name }} ({{ file.size }})
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{$t('Remove')}}
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>

                  </div>
                  <span class="text-red-600" v-if="form.errors.file">
                    {{ $t(form.errors.file) }}
                  </span>
                </div>
                <div class="relative w-full mb-8">
                  <button
                    class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                    type="submit"
                  >
                    {{$t('Submit')}}
                  </button>
                </div>
              </div>
            </div>

            <div id="image-container"></div>

          </form>
        </div>
      </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FrontEndLayout from '@/Layouts/FrontEndLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import TextLabel from '@/Components/InputLabel.vue';
import {useForm} from "@inertiajs/vue3";
import {computed, ref, onMounted} from "vue";
import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';
import CryptoJS from 'crypto-js';
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

const editorConfig = () => {
  return {
    // The configuration of the editor.
    toolbar: [
      "bold",
      "italic",
      "link",
      "undo",
      "redo",
      "numberedList",
      "bulletedList",
    ],
      colors: [{ color: 'red' }],
    // },
    // style: [],
  }
}


const files = ref([]),
  pageX = ref(0),
  pageY = ref(0),
  uploadDragoverTracking = ref(false),
  uploadDragoverEvent = ref(false),
  validateAllowFiles = ref(true);


const props = defineProps({
  departments: Array,
  categories: Array,
  company: Array,
  logo: Array,
  topic: '',
  description: '',
  slug: String,
  rsa_key: String
});

const encryptGenerateKey = ref('');
const whistleBlowerRSAKeys = ref('');
const whistleBlowerPublicAESKey = ref('');
// const whistleBlowerPrivateAESKey = ref('');

onMounted(() => {
  generateAESkey();
  encryptGenerateRSAkeys();

});


/**
 * Case AES key generated on client side.
 * @type {ComputedRef<Promise<*>>}
 */
async function generateAESkey(){
  // Check if the browser supports the Web Crypto API
  if (!window.crypto || !window.crypto.subtle) {
    throw new Error("Web Crypto API is not supported in this browser.");
  }

  let generateKey = await window.crypto.subtle.generateKey(
    {
      name: 'AES-GCM',
      length: 256,
    },
    true,
    ['encrypt', 'decrypt']
  )

  const exportedKey = await window.crypto.subtle.exportKey("jwk", generateKey);
  encryptGenerateKey.value = exportedKey.k;

  return exportedKey ?? '';
}


/**
 * All case data is encrypted using the case AES key.
 * @param dataToEncrypt
 * @returns {Promise<null|string>}
 */
async function encryptText(dataToEncrypt){

  if(dataToEncrypt && encryptGenerateKey.value){
    return  CryptoJS.AES.encrypt(dataToEncrypt, encryptGenerateKey.value).toString();
  }
  return null;
}

/**
 * Create RSA keys for private, public
 * @returns {Promise<void>}
 */
async function encryptGenerateRSAkeys(){
  let keyPair = await window.crypto.subtle.generateKey(
    {
      name: "RSA-OAEP",
      modulusLength: 2048,
      publicExponent: new Uint8Array([1, 0, 1]),
      hash: "SHA-256",
    },
    true,
    ['encrypt', 'decrypt']
  )

  /**
   * export private key
   * @type {ArrayBuffer}
   */
  let exportedPrivateKey = await window.crypto.subtle.exportKey('pkcs8', keyPair.privateKey);
  const exportedAsString = ab2str(exportedPrivateKey);
  const exportedAsPrivateBase64 = window.btoa(exportedAsString);
  const exportPrivateKey = `-----BEGIN PRIVATE KEY-----\n${exportedAsPrivateBase64}\n-----END PRIVATE KEY-----`;


    /**
   * export public key
   * @type {ArrayBuffer}
   */
  let exportedPublicKey = await window.crypto.subtle.exportKey('spki', keyPair.publicKey);
  const exportedAsPublicString = ab2str(exportedPublicKey);
  const exportedAsPublicBase64 = window.btoa(exportedAsPublicString);
  const exportPublicKey = `-----BEGIN PUBLIC KEY-----\n${exportedAsPublicBase64}\n-----END PUBLIC KEY-----`;


  whistleBlowerRSAKeys.value = {
    private_key: exportPrivateKey,
    public_key: exportPublicKey,
    raw_private_key: keyPair.privateKey,
    raw_public_key: keyPair.publicKey
  }

  await generatePublicAESkey();

}

function ab2str(buf) {
  return String.fromCharCode.apply(null, new Uint8Array(buf));
}

/**
 * Company Public RSA key encrypted AES key
 */
async function companyEncryptPublicRSAkey(){
  if(props.rsa_key){
    let publicKey = getCompanyPublicKey(props.rsa_key);
    return  CryptoJS.AES.encrypt(encryptGenerateKey.value, publicKey).toString();
  }
}
function getCompanyPublicKey(spkiPem){
  const pemHeader = "-----BEGIN PUBLIC KEY-----";
  const pemFooter = "-----END PUBLIC KEY-----";
  var pemContents = spkiPem.substring(pemHeader.length, spkiPem.length - pemFooter.length);

  return pemContents;
}

/**
 * Create AES public key.
 * @type {ComputedRef<unknown>}
 */

async function generatePublicAESkey() {

  if (typeof whistleBlowerRSAKeys.value.public_key !== 'undefined'){

    let importedRsaKey = await importPublicRSAKey(whistleBlowerRSAKeys.value.public_key);

    let encrypted = await encryptRSA(importedRsaKey, new TextEncoder().encode(encryptGenerateKey.value));
    // let encrypted = await encryptRSA(importedRsaKey, new TextEncoder().encode('ThisIsTheKeyForEncryptBeforeEncode'));
    whistleBlowerPublicAESKey.value = window.btoa(ab2str(encrypted));
  }

}
async function importPublicRSAKey(rawSpkiPem) {
  return await window.crypto.subtle.importKey(
    "spki",
    getSpkiDer(rawSpkiPem),
    {
      name: "RSA-OAEP",
      hash: "SHA-256",
    },
    true,
    ["encrypt"]
  );
}
function getSpkiDer(spkiPem){
  const pemHeader = "-----BEGIN PUBLIC KEY-----";
  const pemFooter = "-----END PUBLIC KEY-----";
  var pemContents = spkiPem.substring(pemHeader.length, spkiPem.length - pemFooter.length);
  var binaryDerString = window.atob(pemContents);
  return str2ab(binaryDerString);
}
function str2ab(str) {
  const buf = new ArrayBuffer(str.length);
  const bufView = new Uint8Array(buf);
  for (let i = 0, strLen = str.length; i < strLen; i++) {
    bufView[i] = str.charCodeAt(i);
  }
  return buf;
}

async function encryptRSA(key, plaintext) {

  let encrypted = await window.crypto.subtle.encrypt(
    {
      name: "RSA-OAEP"
    },
    key,
    plaintext
  );
  return encrypted;
}


const masterPassword = computed( () => {
  const crypto = window.crypto || window.msCrypto;

  if (typeof crypto === 'undefined') {
    throw new Error('Crypto API is not supported. Please upgrade your web browser');
  }

  const charset = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-';
  const indexes = crypto.getRandomValues(new Uint32Array(16));
  let secret = '';
  for (const index of indexes) {
    secret += charset[index % charset.length];
  }

  return secret;
});

/**
 * Random Master Password
 * @type {ComputedRef<*>}
 */
const encryptMasterPassword = computed( () => {
  return  CryptoJS.PBKDF2(masterPassword.value, '', {
    keySize: 128 / 32
  }).toString();
});

/**
 * encrypt private SRA key
 * @returns {Promise<string>}
 */
async function generateWhistlePrivateRSAkey() {
  if(encryptMasterPassword.value && typeof whistleBlowerRSAKeys.value.private_key !== 'undefined' ){

    const textBuffer = new TextEncoder().encode(whistleBlowerRSAKeys.value.private_key);
    const keyBuffer = hexStringToUint8Array(encryptMasterPassword.value);
    const iv = window.crypto.getRandomValues(new Uint8Array(12));

    const importedKey = await window.crypto.subtle.importKey(
      "raw",
      keyBuffer,
      { name: "AES-GCM" },
      false,
      ["encrypt"]
    );
    // Encrypt the text using AES-GCM
    const ciphertext = await window.crypto.subtle.encrypt(
      {
        name: "AES-GCM",
        iv: iv,
      },
      importedKey,
      textBuffer
    );

    // Concatenate the IV and ciphertext
    const encryptedData = concatenateUint8Arrays(iv, new Uint8Array(ciphertext));
    // Convert the encrypted data to a hexadecimal string
    const encryptedHex = arrayBufferToHexString(encryptedData);

    return encryptedHex;
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

// Utility function to concatenate two Uint8Arrays
function concatenateUint8Arrays(a, b) {
  const result = new Uint8Array(a.length + b.length);
  result.set(a);
  result.set(b, a.length);
  return result;
}

// Utility function to convert an ArrayBuffer to a hexadecimal string
function arrayBufferToHexString(arrayBuffer) {
  return Array.from(new Uint8Array(arrayBuffer))
    .map((byte) => byte.toString(16).padStart(2, "0"))
    .join("");
}

const fileUpload = (event) => {
  if(event){
    files.value.push(event);
  }
}
const form = useForm({
  topic: '',
  description: '',
  confidential_name: '',
  confidential_email: '',
  classification: 'anonymous',
  department_id: props.departments.id ?? '',
  category_id: props.categories.id ?? '',
  company_id: props.company.id,
  status: 'New',
  severity: 3,
  _token: String,
  file: ref(''),
  slug: props.slug,
  whistleblower_private_key: '',
  whistleblower_public_rsa_key: '',
  company_public_key: '',
  whistleblower_public_key: '',
  password: '',
  encryptGenerateKey: ''
});
/**
 * 
 * @returns {Promise<void>}
 */
const submit = async () => {
  validateAllowFiles.value = true;
  form.file = await encryptFileUpload(files.value);
  /** checking files varidate */
  if (validateAllowFiles.value === false) {
    return;
  }

  /** save **/
  form.post(route('occurrences.validateCreateForm'), {
    onSuccess: async () => {
      form.topic = await encryptText(form.topic);
      form.description = await encryptText(form.description);
      form.confidential_name = await encryptText(form.confidential_name);
      form.confidential_email = await encryptText(form.confidential_email);
      /** whistleblower table */
      form.whistleblower_private_key = await generateWhistlePrivateRSAkey();
      form.whistleblower_public_rsa_key = whistleBlowerRSAKeys.value.public_key;
      form.company_public_key = await companyEncryptPublicRSAkey();
      form.whistleblower_public_key = whistleBlowerPublicAESKey.value;
      /** send random password to download page **/
      form.password = masterPassword.value;
      form.encryptGenerateKey = encryptGenerateKey.value;

      form.post(route('occurrences.store'));
    },
  });

};

async function encryptFileUpload(files)
{
  if(files.length > 0){
    const file_encrypted_data = [];
    for (let count= 0; count < files.length; count++) {
      //varidate file types
      if (validateFiles(files[count]['type']) === false){
        continue;
      }

      let encrypted = await encryptImage(files[count]);
      let file = {
        'file_name': files[count]['name'],
        'mime_type': files[count]['type'],
        'data_base64': encrypted,
        'size': files[count]['size']
      };
      file_encrypted_data.push(JSON.stringify(file));
    }
    return file_encrypted_data;
  }
  return null;
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
      const encryptedData = CryptoJS.AES.encrypt(data, encryptGenerateKey.value).toString();
      resolve(encryptedData);
    };
    reader.readAsDataURL(file);
  });
}

function decryptImage(encryptedData, secretKey) {
  console.log([encryptedData, secretKey]);
  try {
    const decryptedData = CryptoJS.AES.decrypt(encryptedData, secretKey);
    const decryptedImageData = decryptedData.toString(CryptoJS.enc.Utf8);
    return decryptedImageData;
  } catch (error) {
    console.error("Decryption failed:", error);
    return null;
  }
}




const onUploadDragoverEvent = (e) => {
  uploadDragoverEvent.value = true;
  uploadDragoverTracking.value = true;
  pageX.value = e.pageX;
  pageY.value = e.pageY;
}

const onUploadDropEvent = (e) => {
  uploadDragoverEvent.value = false;
  uploadDragoverTracking.value = false;
  pageX.value = 0;
  pageY.value = 0;
  droppedFiles(e)
}

const droppedFiles = (e) => {
  let droppedFiles = e.dataTransfer.files;

  if (!droppedFiles) return;

  ([...droppedFiles]).forEach(f => {
    files.value.push(f);
  });
}

const droppedFileValidator = (file) =>  {
  return false;
}

const removeFile = (file) => {
  files.value = files.value.filter(f => {
    return f != file;
  });
}

</script>
<style scoped>
  .LanguageSwitcher ul {
    justify-content: end;
  }
</style>

<style type="text/css">

.ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
.ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners{
  min-height: 250px;
  height: 250px;
}

</style>

