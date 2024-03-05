import{d as _,T as h,o as i,c as y,w as c,a as e,n as v,i as w,t as o,b as u,f as k,u as a,j as $,e as m,h as f,l as p,s as b}from"./app.js";import{_ as V}from"./AppLayout.js";import{_ as B}from"./TextInput.js";import{_ as x}from"./InputLabel.js";import"./_plugin-vue_export-helper.js";import"./LanguageSwitcher.js";const C={class:"flex flex-wrap mt-4"},N={class:"w-full mb-12 px-4"},U=["onSubmit"],D={class:"rounded-t bg-white mb-0 px-6 py-6"},G={class:"text-center flex justify-between"},M={class:"text-blueGray-700 text-xl font-bold mr-2"},S={class:"flex-auto px-4 lg:px-10 py-10 pt-0"},T={class:"flex flex-wrap"},j={class:"w-full lg:w-12/12 px-4"},E={class:"relative w-full mb-3"},z={key:0,class:"text-red-600"},A={key:0,class:"relative w-full mb-6"},O={class:"flex"},P={class:"flex items-center mr-4"},R={for:"default-enable",class:"ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"},q={class:"flex items-center mr-4"},F={for:"default-disable",class:"ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"},H={key:0,class:"text-red-600"},I={class:"bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150",type:"submit"},Y={__name:"Edit",props:{department:Array,is_admin:_(Boolean),color:{default:"light",validator:function(d){return["light","dark"].indexOf(d)!==-1}}},setup(d){const n=d,t=h({name:n.department.name,default:n.department.default}),g=()=>{t.put(route("departments.update",n.department.id))};return(s,l)=>(i(),y(V,{title:"Platform Companies"},{default:c(()=>[e("div",C,[e("div",N,[e("div",{class:v([[d.color==="light"?"bg-white":"bg-emerald-900 text-white"],"relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"])},[e("form",{onSubmit:w(g,["prevent"])},[e("div",D,[e("div",G,[e("h6",M,o(s.$t("Manage")),1),u(a($),{class:"bg-lightBlue-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150",href:s.route("departments.index")},{default:c(()=>[k(o(s.$t("Back")),1)]),_:1},8,["href"])])]),e("div",S,[e("div",T,[e("div",j,[e("div",E,[u(x,{for:"name",value:"Name",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),u(B,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:a(t).name,"onUpdate:modelValue":l[0]||(l[0]=r=>a(t).name=r),autofocus:""},null,8,["modelValue"]),a(t).errors.name?(i(),m("span",z,o(s.$t(a(t).errors.name)),1)):f("",!0)]),n.is_admin?(i(),m("div",A,[u(x,{for:"default",value:"Type",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),e("div",O,[e("div",P,[p(e("input",{"onUpdate:modelValue":l[1]||(l[1]=r=>a(t).default=r),checked:"",id:"default-enable",type:"radio",value:"1",name:"default",class:"w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"},null,512),[[b,a(t).default]]),e("label",R,o(s.$t("Default")),1)]),e("div",q,[p(e("input",{"onUpdate:modelValue":l[2]||(l[2]=r=>a(t).default=r),id:"default-disable",type:"radio",value:"0",name:"default",class:"w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"},null,512),[[b,a(t).default]]),e("label",F,o(s.$t("Custom")),1)])]),a(t).errors.default?(i(),m("span",H,o(s.$t(a(t).errors.default)),1)):f("",!0)])):f("",!0),e("button",I,o(s.$t("Update")),1)])])])],40,U)],2)])])]),_:1}))}};export{Y as default};