import{T as m,o as r,c as u,w as f,a as e,i as _,t as a,b as l,u as t,e as d,h as i}from"./app.js";import{_ as w}from"./AppLayout.js";import{_ as h}from"./TextInput.js";import{_ as b}from"./InputLabel.js";import{_ as x}from"./LanguageSwitcher.js";import"./_plugin-vue_export-helper.js";const v={class:"min-h-screen justify-center items-center flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"},g={class:"w-full sm:max-w-2xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"},y=["onSubmit"],k={class:"text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase"},$={class:"flex flex-wrap"},S={class:"w-full lg:w-12/12 px-4"},V={class:"relative w-full mb-3"},G={key:0,class:"text-red-600"},B={class:"relative w-full mb-3"},C={class:"bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150",type:"submit"},N={key:0,class:"w-full sm:max-w-2xl px-6 py-4 overflow-hidden"},T={__name:"Check",setup(R){const o=m({password:"",_token:String}),p=()=>{o.post(route("occurrences.show.report"),{preserveScroll:!0,onSuccess:s=>{}})};return(s,n)=>(r(),u(w,{title:"Check Report"},{default:f(()=>[e("div",v,[e("div",g,[e("form",{onSubmit:_(p,["prevent"])},[e("h6",k,a(s.$t("Report Form")),1),e("div",$,[e("div",S,[e("div",V,[l(b,{for:"password",value:"Password code",class:"block uppercase text-blueGray-600 text-xs font-bold mb-2"}),l(h,{id:"password",type:"text",class:"mborder-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150",modelValue:t(o).password,"onUpdate:modelValue":n[0]||(n[0]=c=>t(o).password=c),autofocus:""},null,8,["modelValue"]),t(o).errors.password?(r(),d("span",G,a(s.$t(t(o).errors.password)),1)):i("",!0)]),e("div",B,[e("button",C,a(s.$t("Submit")),1)])])])],40,y)]),s.$page.props.user.id?i("",!0):(r(),d("div",N,[l(x,{component:s.$page.component,props:s.$page.props},null,8,["component","props"])]))])]),_:1}))}};export{T as default};