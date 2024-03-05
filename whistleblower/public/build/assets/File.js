import{C as r}from"./index14.js";import{_ as g}from"./_plugin-vue_export-helper.js";import{d as l,o as i,e as p,a as c,t as o,y as x,z as w,G as v}from"./app.js";const k=d=>(x("data-v-c881d16c"),d=d(),w(),d),B=["href"],S={class:"w-10 flex items-center justify-center"},M=["src"],E={class:"w-48 ml-2 flex flex-col"},b={class:"text-sm text-gray-700 font-bold truncate"},A={class:"text-gray-500 text-xs"},H={key:0,class:"text-gray-500 text-xs"},I={key:1,class:"text-gray-500 text-xs"},$=k(()=>c("div",{class:"w-6 flex items-center justify-center",title:"View"},[c("svg",{class:"h-6 w-6 icon line-color",fill:"#000000",viewBox:"0 0 36 36",preserveAspectRatio:"xMidYMid meet",xmlns:"http://www.w3.org/2000/svg","xmlns:xlink":"http://www.w3.org/1999/xlink"},[c("path",{d:"M33.62,17.53c-3.37-6.23-9.28-10-15.82-10S5.34,11.3,2,17.53L1.72,18l.26.48c3.37,6.23,9.28,10,15.82,10s12.46-3.72,15.82-10l.26-.48ZM17.8,26.43C12.17,26.43,7,23.29,4,18c3-5.29,8.17-8.43,13.8-8.43S28.54,12.72,31.59,18C28.54,23.29,23.42,26.43,17.8,26.43Z",class:"clr-i-outline clr-i-outline-path-1"}),c("path",{d:"M18.09,11.17A6.86,6.86,0,1,0,25,18,6.86,6.86,0,0,0,18.09,11.17Zm0,11.72A4.86,4.86,0,1,1,23,18,4.87,4.87,0,0,1,18.09,22.89Z",class:"clr-i-outline clr-i-outline-path-2"}),c("rect",{x:"0",y:"0",width:"36",height:"36","fill-opacity":"0"})])],-1)),V=["href"],C=["src"],Z={__name:"Image",props:{occurrences:Object,encryptedText:String,type:l(0),name:l(""),size:l(0),user:l("")},setup(d){const e=d;function y(n,t){let s=u(n);return r.AES.decrypt(t,s).toString(r.enc.Utf8)}function u(n){if(typeof n.whistleblower.company_public_key<"u"&&typeof n.companies.rsa_key<"u"){let t=m(n.companies.rsa_key);return r.AES.decrypt(n.whistleblower.company_public_key,t).toString(r.enc.Utf8)}}function m(n){const t="-----BEGIN PUBLIC KEY-----",s="-----END PUBLIC KEY-----";return n.substring(t.length,n.length-s.length)}const h=n=>{const t=["Bytes","KB","MB","GB","TB"];if(n===0)return"0 Byte";const s=parseInt(Math.floor(Math.log(n)/Math.log(1024)));return Math.round(n/Math.pow(1024,s),2)+" "+t[s]};return(n,t)=>e.type===1?(i(),p("a",{key:0,href:y(e.occurrences,e.encryptedText),"data-lightbox":"image-gallery",class:"flex items-center"},[c("div",S,[c("img",{src:y(e.occurrences,e.encryptedText),alt:"",class:"img-decrypted"},null,8,M)]),c("div",E,[c("span",b,o(e.name),1),c("span",A,o(h(e.size)),1),e.user?(i(),p("span",H,o(n.$t("By"))+" : "+o(e.user.name),1)):(i(),p("span",I,o(n.$t("By"))+" : "+o(n.$t(e.occurrences.classification)),1))]),$],8,B)):(i(),p("a",{key:1,href:y(e.occurrences,e.encryptedText),"data-lightbox":"image-gallery"},[c("img",{src:y(e.occurrences,e.encryptedText),alt:"",class:"img-decrypted"},null,8,C)],8,V))}},Y=g(Z,[["__scopeId","data-v-c881d16c"]]),T=v('<div class="w-10 flex items-center justify-center"><svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 121.83"><path class="cls-1" d="M102.42,37H81.92a8.52,8.52,0,0,1-8.85-8.7V7.53H21a.58.58,0,0,0-.41.18.45.45,0,0,0-.18.42V113.71a.7.7,0,0,0,.18.41.51.51,0,0,0,.41.18h80.84c.18,0,.17-.09.26-.18s.34-.28.34-.41V37Zm7.47,79.08a5.77,5.77,0,0,1-5.76,5.76H18.66a5.77,5.77,0,0,1-5.76-5.76V5.76a5.7,5.7,0,0,1,1.69-4.07A5.77,5.77,0,0,1,18.66,0H76.9a4.22,4.22,0,0,1,2.46.82l29.75,30.12a2.57,2.57,0,0,1,.78,2.6v82.53ZM80,27.69,79.57,9.63,100.66,31l-18.14-.81A2.4,2.4,0,0,1,80,27.69Z"></path><path class="cls-2" d="M6.71,46.28H116.17A6.73,6.73,0,0,1,122.88,53v45.1a6.73,6.73,0,0,1-6.71,6.71H6.71A6.73,6.73,0,0,1,0,98.09V53a6.73,6.73,0,0,1,6.71-6.71Z"></path><path class="cls-3" d="M16.33,59.78h16.2c3.53,0,6.17.83,7.94,2.51s2.63,4.08,2.63,7.18a9.71,9.71,0,0,1-2.88,7.47c-1.91,1.8-4.84,2.69-8.77,2.69H26.1V91.3H16.33V59.78ZM26.1,73.25h2.4a6.22,6.22,0,0,0,4-1,3.17,3.17,0,0,0,1.14-2.51,3.51,3.51,0,0,0-1-2.52c-.66-.69-1.91-1-3.75-1H26.1v7ZM48.3,59.78H62.78a17.47,17.47,0,0,1,6.92,1.16,11.23,11.23,0,0,1,4.35,3.33,13.66,13.66,0,0,1,2.49,5,23.36,23.36,0,0,1,.78,6.11,21.16,21.16,0,0,1-1.15,7.84A13,13,0,0,1,73,87.93a10.38,10.38,0,0,1-4.39,2.51,22.39,22.39,0,0,1-5.81.86H48.3V59.78ZM58,66.91V84.13h2.4a10.16,10.16,0,0,0,4.36-.68,4.65,4.65,0,0,0,2-2.36,14.84,14.84,0,0,0,.73-5.48q0-5-1.63-6.85c-1.09-1.23-2.91-1.85-5.44-1.85Zm24.43-7.13h24.09v6.78H92.24v5.5h12.24v6.39H92.24V91.3H82.46V59.78Z"></path></svg></div>',1),K={class:"w-48 ml-2 flex flex-col"},z={class:"text-sm text-gray-700 font-bold truncate"},P={class:"text-gray-500 text-xs"},U={key:0,class:"text-gray-500 text-xs"},j={key:1,class:"text-gray-500 text-xs"},D=c("div",{class:"w-6 flex items-center justify-center",title:"Download"},[c("svg",{xmlns:"http://www.w3.org/2000/svg",class:"text-gray-500 hover:text-gray-600 h-6 w-6",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[c("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"})])],-1),F={__name:"File",props:{occurrences:Object,encryptedText:String,name:l(""),type:l(0),size:l(0),user:l("")},setup(d){const e=d;function y(t,s){let a=u(t);return r.AES.decrypt(s,a).toString(r.enc.Utf8)}function u(t){if(typeof t.whistleblower.company_public_key<"u"&&typeof t.companies.rsa_key<"u"){let s=m(t.companies.rsa_key);return r.AES.decrypt(t.whistleblower.company_public_key,s).toString(r.enc.Utf8)}}function m(t){const s="-----BEGIN PUBLIC KEY-----",a="-----END PUBLIC KEY-----";return t.substring(s.length,t.length-a.length)}function h(t,s,a){let f=y(t,a);var _=document.createElement("a");_.href=f,_.download=s,_.click()}const n=t=>{const s=["Bytes","KB","MB","GB","TB"];if(t===0)return"0 Byte";const a=parseInt(Math.floor(Math.log(t)/Math.log(1024)));return Math.round(t/Math.pow(1024,a),2)+" "+s[a]};return(t,s)=>e.type===1?(i(),p("a",{key:0,href:"#",class:"flex items-center",onClick:s[0]||(s[0]=a=>h(e.occurrences,e.name,e.encryptedText))},[T,c("div",K,[c("span",z,o(e.name),1),c("span",P,o(n(e.size)),1),e.user?(i(),p("span",U,o(t.$t("By"))+" : "+o(e.user.name),1)):(i(),p("span",j,o(t.$t("By"))+" : "+o(t.$t(e.occurrences.classification)),1))]),D])):(i(),p("a",{key:1,href:"#",onClick:s[1]||(s[1]=a=>h(e.occurrences,e.name,e.encryptedText))},o(e.name),1))}};export{Y as I,F as _};
