import{T as p,o as d,c as f,w as c,a as e,n as h,i as x,t as l,b as n,f as _,u as s,j as b,e as w,h as v}from"./app.js";import{_ as g}from"./AppLayout.js";import{_ as y}from"./TextInput.js";import{_ as k}from"./InputLabel.js";import"./_plugin-vue_export-helper.js";import"./LanguageSwitcher.js";const V={class:"flex flex-wrap mt-4"},$={class:"w-full mb-12 px-4"},B=["onSubmit"],N={class:"rounded-t bg-white mb-0 px-6 py-6"},C={class:"text-center flex justify-between"},j={class:"text-blueGray-700 text-xl font-bold mr-2"},S={class:"flex-auto px-4 lg:px-10 py-10 pt-0"},E={class:"flex flex-wrap"},G={class:"w-full lg:w-12/12 px-4"},M={class:"relative w-full mb-3"},O={key:0,class:"text-red-600"},T={class:"bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150",type:"submit"},F={__name:"Edit",props:{company:Object,color:{default:"light",validator:function(a){return["light","dark"].indexOf(a)!==-1}}},setup(a){const i=a,t=p({name:i.company.name}),m=()=>{t.put(route("companies-user.update",i.company.id))};return(o,r)=>(d(),f(g,{title:"Platform Companies"},{default:c(()=>[e("div",V,[e("div",$,[e("div",{class:h([[a.color==="light"?"bg-white":"bg-emerald-900 text-white"],"relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"])},[e("form",{onSubmit:x(m,["prevent"])},[e("div",N,[e("div",C,[e("h6",j,l(o.$t("Manage")),1),n(s(b),{class:"bg-lightBlue-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150",href:o.route("companies-user.index")},{default:c(()=>[_(l(o.$t("Back")),1)]),_:1},8,["href"])])]),e("div",S,[e("div",E,[e("div",G,[e("div",M,[n(k,{for:"name",value:"Name",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),n(y,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:s(t).name,"onUpdate:modelValue":r[0]||(r[0]=u=>s(t).name=u),autofocus:""},null,8,["modelValue"]),s(t).errors.name?(d(),w("span",O,l(o.$t(s(t).errors.name)),1)):v("",!0)]),e("button",T,l(o.$t("Update")),1)])])])],40,B)],2)])])]),_:1}))}};export{F as default};