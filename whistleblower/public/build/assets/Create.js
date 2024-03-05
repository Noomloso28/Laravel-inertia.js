import{d as _,T as x,o as d,c as v,w as p,a as e,n as h,i as k,t as l,b as n,f as w,u as a,j as $,e as i,h as u,l as c,q as V,g as C,F as B,s as f}from"./app.js";import{_ as U}from"./AppLayout.js";import{_ as G}from"./TextInput.js";import{_ as b}from"./InputLabel.js";import"./_plugin-vue_export-helper.js";import"./LanguageSwitcher.js";const N={class:"flex flex-wrap mt-4"},D={class:"w-full mb-12 px-4"},M=["onSubmit"],S={class:"rounded-t bg-white mb-0 px-6 py-6"},A={class:"text-center flex justify-between"},T={class:"text-blueGray-700 text-xl font-bold mr-2"},j={class:"flex-auto px-4 lg:px-10 py-10 pt-0"},E={class:"flex flex-wrap"},F={class:"w-full lg:w-12/12 px-4"},q={class:"relative w-full mb-3"},z={key:0,class:"text-red-600"},L={class:"relative w-full mb-6"},O=["value"],P=["value"],R={key:0,class:"text-red-600"},H={class:"relative w-full mb-6"},I={class:"flex"},J={class:"flex items-center mr-4"},K={for:"active-enable",class:"ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"},Q={class:"flex items-center mr-4"},W={for:"active-disable",class:"ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"},X={key:0,class:"text-red-600"},Y={key:0,class:"relative w-full mb-6"},Z={class:"flex"},ee={class:"flex items-center mr-4"},te={for:"default-enable",class:"ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"},ae={class:"flex items-center mr-4"},se={for:"default-disable",class:"ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"},re={key:0,class:"text-red-600"},oe={class:"bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150",type:"submit"},me={__name:"Create",props:{user_company:Array,user_companies:Array,is_admin:_(Boolean),color:{default:"light",validator:function(m){return["light","dark"].indexOf(m)!==-1}}},setup(m){const g=m,t=x({name:"",default:0,active:1,company_id:g.user_company.id}),y=()=>{t.post(route("categories.store"))};return(r,o)=>(d(),v(U,{title:"Platform Companies"},{default:p(()=>[e("div",N,[e("div",D,[e("div",{class:h([[m.color==="light"?"bg-white":"bg-emerald-900 text-white"],"relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"])},[e("form",{onSubmit:k(y,["prevent"])},[e("div",S,[e("div",A,[e("h6",T,l(r.$t("Manage")),1),n(a($),{class:"bg-lightBlue-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150",href:r.route("categories.index")},{default:p(()=>[w(l(r.$t("Back")),1)]),_:1},8,["href"])])]),e("div",j,[e("div",E,[e("div",F,[e("div",q,[n(b,{for:"ame",value:"Name",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),n(G,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:a(t).name,"onUpdate:modelValue":o[0]||(o[0]=s=>a(t).name=s),autofocus:""},null,8,["modelValue"]),a(t).errors.name?(d(),i("span",z,l(r.$t(a(t).errors.name)),1)):u("",!0)]),e("div",L,[n(b,{for:"companies",value:"Companies",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),c(e("select",{"onUpdate:modelValue":o[1]||(o[1]=s=>a(t).company_id=s),name:"company_id",id:"companies",value:a(t).company_id,class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"},[(d(!0),i(B,null,C(g.user_companies,s=>(d(),i("option",{value:s.id},l(s.name),9,P))),256))],8,O),[[V,a(t).company_id]]),a(t).errors.company_id?(d(),i("span",R,l(r.$t(a(t).errors.company_id)),1)):u("",!0)]),e("div",H,[n(b,{for:"active",value:"Active",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),e("div",I,[e("div",J,[c(e("input",{"onUpdate:modelValue":o[2]||(o[2]=s=>a(t).active=s),checked:"",id:"active-enable",type:"radio",value:"1",name:"active",class:"w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"},null,512),[[f,a(t).active]]),e("label",K,l(r.$t("Enable")),1)]),e("div",Q,[c(e("input",{"onUpdate:modelValue":o[3]||(o[3]=s=>a(t).active=s),id:"active-disable",type:"radio",value:"0",name:"active",class:"w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"},null,512),[[f,a(t).active]]),e("label",W,l(r.$t("Disable")),1)])]),a(t).errors.active?(d(),i("span",X,l(r.$t(a(t).errors.active)),1)):u("",!0)]),g.is_admin?(d(),i("div",Y,[n(b,{for:"default",value:"Type",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),e("div",Z,[e("div",ee,[c(e("input",{"onUpdate:modelValue":o[4]||(o[4]=s=>a(t).default=s),checked:"",id:"default-enable",type:"radio",value:"1",name:"default",class:"w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"},null,512),[[f,a(t).default]]),e("label",te,l(r.$t("Default")),1)]),e("div",ae,[c(e("input",{"onUpdate:modelValue":o[5]||(o[5]=s=>a(t).default=s),id:"default-disable",type:"radio",value:"0",name:"default",class:"w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"},null,512),[[f,a(t).default]]),e("label",se,l(r.$t("Custom")),1)])]),a(t).errors.default?(d(),i("span",re,l(r.$t(a(t).errors.default)),1)):u("",!0)])):u("",!0),e("button",oe,l(r.$t("Create")),1)])])])],40,M)],2)])])]),_:1}))}};export{me as default};
