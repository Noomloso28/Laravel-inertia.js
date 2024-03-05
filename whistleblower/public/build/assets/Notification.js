import{d as w,T as x,k as g,o as c,c as k,w as V,a as e,t as a,i as $,u as t,f as h,b as u,e as m,h as p,l as C,v as G,n as q}from"./app.js";import{_ as M}from"./AppLayout.js";import{_ as S}from"./TextInput.js";import{_ as z}from"./ReadonlyInput.js";import{_}from"./InputLabel.js";import{C as H}from"./index14.js";import"./_plugin-vue_export-helper.js";import"./LanguageSwitcher.js";const B={class:"container mx-auto mt-6 relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"},N={class:"rounded-t bg-white mb-0 px-6 py-6"},T={class:"text-center flex justify-between"},Y={class:"text-blueGray-700 text-xl font-bold mr-2"},j={class:"flex-auto px-4 lg:px-10 py-10 pt-6"},A=["onSubmit"],D=["value"],P={class:"flex flex-wrap"},U={class:"w-full lg:w-12/12 px-4 mb-4"},E={class:"text-red-600 font-bold"},I={class:"w-full lg:w-12/12 px-4"},K={class:"relative w-full mb-3"},O={key:0,xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6 mr-1 text-green-600"},J=e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),L=[J],R=e("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"})],-1),F={key:0,class:"text-red-600"},Q={class:"relative w-full mb-3"},W=["href"],X=e("i",{class:"fas fa-arrow-down"},null,-1),Z={class:"flex flex-wrap"},ee={class:"w-full lg:w-12/12 px-4"},se={class:"relative w-full mb-3"},oe={key:0,class:"text-red-600"},te={class:"relative w-full mb-3"},ae={class:"mb-4"},re={class:"relative w-full mb-3"},le={class:"flex items-center"},ie={for:"link-checkbox",class:"ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"},ne={class:"relative w-full mb-3"},de=["disabled"],be={__name:"Notification",props:{request:Array},setup(b){const r=b,n=w(!1),d=w(!1),s=x({password:r.request.password,email:"",email_notification:"",occurrence_id:r.request.id,company_id:r.request.company_id,slug:r.request.slug,subject:r.request.topic,classification:r.request.classification}),v=async()=>{s.email_notification=s.email,s.email=await y(s.email),s.post(route("occurrences.notificationStore"))};async function y(o){return o&&r.request.encryptGenerateKey?H.AES.encrypt(o,r.request.encryptGenerateKey).toString():null}const f=g(()=>{navigator.clipboard.writeText(s.password),d.value=!d.value,setTimeout(()=>d.value=!d.value,3e3)});return(o,l)=>(c(),k(M,{title:"Platform Companies"},{default:V(()=>[e("div",B,[e("div",N,[e("div",T,[e("h6",Y,a(o.$t("Your case has been submitted")),1)])]),e("div",j,[e("form",{onSubmit:$(v,["prevent"])},[e("input",{type:"hidden",value:t(s).occurrence_id,name:"occurrence_id"},null,8,D),e("div",P,[e("div",U,[e("span",E,a(o.$t("IMPORTANT"))+":",1),h(" "+a(o.$t("Your password will only be displayed once. Save and keep the password safe and do not share it with anyone. Only with this password can you retrieve your case.")),1)]),e("div",I,[e("div",K,[u(_,{for:"password",value:"Your password",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),u(z,{id:"password",type:"text",class:"mborder-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150",modelValue:t(s).password,"onUpdate:modelValue":l[0]||(l[0]=i=>t(s).password=i),autofocus:""},null,8,["modelValue"]),e("span",{onClick:l[1]||(l[1]=(...i)=>t(f)&&t(f)(...i)),id:"copy-action",class:"absolute right-0 z-2 mr-1 mt-1 bg-white p-1.5 cursor-pointer inline-flex"},[d.value?(c(),m("svg",O,L)):p("",!0),R]),t(s).errors.password?(c(),m("span",F,a(o.$t(t(s).errors.password)),1)):p("",!0)]),e("div",Q,[e("a",{href:o.route("occurrences.password.download",{password:t(s).password}),target:"_blank"},[e("span",null,[X,h(a(o.$t("Download")),1)])],8,W)])])]),e("div",Z,[e("div",ee,[e("div",se,[u(_,{for:"email",value:"Email address for notifications (optional)",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),u(S,{id:"email",type:"email",class:"mborder-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150",modelValue:t(s).email,"onUpdate:modelValue":l[2]||(l[2]=i=>t(s).email=i),autofocus:""},null,8,["modelValue"]),t(s).errors.email?(c(),m("span",oe,a(o.$t(t(s).errors.email)),1)):p("",!0)]),e("div",te,[e("p",ae,a(o.$t("Your e-mail address is stored in encrypted form and is only used for notification. Your password will not be sent by email!")),1)]),e("div",re,[e("div",le,[C(e("input",{id:"agree",name:"agree",type:"checkbox","onUpdate:modelValue":l[3]||(l[3]=i=>n.value=i),class:"w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"},null,512),[[G,n.value]]),e("label",ie,a(o.$t("I have saved the password securely")),1)])]),e("div",ne,[e("button",{class:q([{"bg-emerald-500 active:bg-emerald-600":n.value,"bg-gray-300 rounded focus:outline-none cursor-not-allowed":!n.value},"text-white font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"]),disabled:!n.value,type:"submit"},a(o.$t("Complete")),11,de)])])])],40,A)])])]),_:1}))}};export{be as default};