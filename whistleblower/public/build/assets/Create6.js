import{T as k,o as d,c as h,w as _,a as t,n as V,i as $,t as r,b as i,f as C,u as s,j as G,e as n,h as u,l as b,q as g,g as v,F as x,s as y}from"./app.js";import{_ as U}from"./AppLayout.js";import{_ as f}from"./TextInput.js";import{_ as c}from"./InputLabel.js";import"./_plugin-vue_export-helper.js";import"./LanguageSwitcher.js";const B={class:"flex flex-wrap mt-4"},N={class:"w-full mb-12 px-4"},P=["onSubmit"],A={class:"rounded-t bg-white mb-0 px-6 py-6"},S={class:"text-center flex justify-between"},D={class:"text-blueGray-700 text-xl font-bold mr-2"},E={class:"flex-auto px-4 lg:px-10 py-10 pt-0"},M={class:"flex flex-wrap"},j={class:"w-full lg:w-12/12 px-4"},F={class:"relative w-full mb-3"},R={key:0,class:"text-red-600"},T={class:"relative w-full mb-3"},q={key:0,class:"text-red-600"},z={class:"relative w-full mb-3"},L={key:0,class:"text-red-600"},O={class:"relative w-full mb-3"},H={key:0,class:"text-red-600"},I={class:"relative w-full mb-6"},J=["value"],K=["value"],Q={key:0,class:"text-red-600"},W={class:"relative w-full mb-6"},X=["value"],Y=["value"],Z={key:0,class:"text-red-600"},ee={class:"relative w-full mb-6"},se={class:"flex"},te={class:"flex items-center mr-4"},oe={for:"active-enable",class:"ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"},ae={class:"flex items-center mr-4"},re={for:"active-disable",class:"ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"},le={key:0,class:"text-red-600"},de={class:"bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150",type:"submit"},fe={__name:"Create",props:{roles:Array,companies:Array,color:{default:"light",validator:function(m){return["light","dark"].indexOf(m)!==-1}}},setup(m){const p=m,e=k({name:"",email:"",password:"",password_confirmation:"",role_id:"",active:1,company_id:""}),w=()=>{e.post(route("users.store"))};return(l,a)=>(d(),h(U,{title:"Platform Companies"},{default:_(()=>[t("div",B,[t("div",N,[t("div",{class:V([[m.color==="light"?"bg-white":"bg-emerald-900 text-white"],"relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"])},[t("form",{onSubmit:$(w,["prevent"])},[t("div",A,[t("div",S,[t("h6",D,r(l.$t("Add new user")),1),i(s(G),{class:"bg-lightBlue-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150",href:l.route("users.index")},{default:_(()=>[C(r(l.$t("Back")),1)]),_:1},8,["href"])])]),t("div",E,[t("div",M,[t("div",j,[t("div",F,[i(c,{for:"name",value:"Name",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),i(f,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:s(e).name,"onUpdate:modelValue":a[0]||(a[0]=o=>s(e).name=o),autofocus:""},null,8,["modelValue"]),s(e).errors.name?(d(),n("span",R,r(l.$t(s(e).errors.name)),1)):u("",!0)]),t("div",T,[i(c,{for:"email",value:"E-mail",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),i(f,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":a[1]||(a[1]=o=>s(e).email=o)},null,8,["modelValue"]),s(e).errors.email?(d(),n("span",q,r(l.$t(s(e).errors.email)),1)):u("",!0)]),t("div",z,[i(c,{for:"password",value:"Password",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),i(f,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":a[2]||(a[2]=o=>s(e).password=o)},null,8,["modelValue"]),s(e).errors.password?(d(),n("span",L,r(l.$t(s(e).errors.password)),1)):u("",!0)]),t("div",O,[i(c,{for:"floatingConfirmPassword",value:"Confirm Password",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),i(f,{id:"floatingConfirmPassword",type:"password",class:"mt-1 block w-full",modelValue:s(e).password_confirmation,"onUpdate:modelValue":a[3]||(a[3]=o=>s(e).password_confirmation=o)},null,8,["modelValue"]),s(e).errors.password_confirmation?(d(),n("span",H,r(l.$t(s(e).errors.password_confirmation)),1)):u("",!0)]),t("div",I,[i(c,{for:"role",value:"Roles",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),b(t("select",{"onUpdate:modelValue":a[4]||(a[4]=o=>s(e).role_id=o),name:"role",id:"role",value:s(e).role_id,class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"},[(d(!0),n(x,null,v(p.roles,o=>(d(),n("option",{value:o.id},r(o.name),9,K))),256))],8,J),[[g,s(e).role_id]]),s(e).errors.role_id?(d(),n("span",Q,r(l.$t(s(e).errors.role_id)),1)):u("",!0)]),t("div",W,[i(c,{for:"role",value:"Company",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),b(t("select",{"onUpdate:modelValue":a[5]||(a[5]=o=>s(e).company_id=o),name:"company",id:"company",value:s(e).company_id,class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"},[(d(!0),n(x,null,v(p.companies,o=>(d(),n("option",{value:o.id},r(o.name),9,Y))),256))],8,X),[[g,s(e).company_id]]),s(e).errors.company_id?(d(),n("span",Z,r(l.$t(s(e).errors.company_id)),1)):u("",!0)]),t("div",ee,[i(c,{for:"active",value:"Active",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),t("div",se,[t("div",te,[b(t("input",{"onUpdate:modelValue":a[6]||(a[6]=o=>s(e).active=o),checked:"",id:"active-enable",type:"radio",value:"1",name:"active",class:"w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"},null,512),[[y,s(e).active]]),t("label",oe,r(l.$t("Enable")),1)]),t("div",ae,[b(t("input",{"onUpdate:modelValue":a[7]||(a[7]=o=>s(e).active=o),id:"active-disable",type:"radio",value:"0",name:"active",class:"w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"},null,512),[[y,s(e).active]]),t("label",re,r(l.$t("Disable")),1)])]),s(e).errors.active?(d(),n("span",le,r(l.$t(s(e).errors.active)),1)):u("",!0)]),t("button",de,r(l.$t("Create")),1)])])])],40,P)],2)])])]),_:1}))}};export{fe as default};
