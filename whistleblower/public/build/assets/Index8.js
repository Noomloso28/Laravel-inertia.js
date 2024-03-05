import{_ as g}from"./AppLayout.js";import{_ as v}from"./TableDropdown.js";import{_ as y}from"./TextInput.js";import{D as _}from"./vue3-easy-data-table.es.js";import{_ as u}from"./DateFormat.js";import{d as $,o as c,c as m,w as a,a as r,n as k,t as s,b as o,u as p,j as V,f as l,h as N}from"./app.js";import"./_plugin-vue_export-helper.js";import"./LanguageSwitcher.js";const C={class:"flex flex-wrap mt-4"},B={class:"w-full mb-12 px-4"},T={class:"rounded-t bg-white mb-0 px-6 py-6"},G={class:"text-center flex justify-between"},z={class:"text-blueGray-700 text-xl font-bold mr-2"},A={class:"relative flex"},D={class:"relative"},j=r("div",{class:"absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"},[r("svg",{"aria-hidden":"true",class:"w-5 h-5 text-gray-500 dark:text-gray-400",fill:"currentColor",viewBox:"0 0 20 20",xmlns:"http://www.w3.org/2000/svg"},[r("path",{"fill-rule":"evenodd",d:"M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z","clip-rule":"evenodd"})])],-1),M={class:"block w-full overflow-x-auto"},Y={__name:"Index",props:{users:Array,color:{default:"light",validator:function(d){return["light","dark"].indexOf(d)!==-1}}},setup(d){const b=d,i=$(""),f=["name","id","active","created_at","email","role_id"],h="name",x="desc",w=[{text:"Name",value:"name",sortable:!0},{text:"E-mail",value:"email",sortable:!0},{text:"Status",value:"active",sortable:!0},{text:"Roles",value:"roles.name",sortable:!0},{text:"Created",value:"created_at",sortable:!0},{text:"Actions",value:"actions",sortable:!0}];return(t,n)=>(c(),m(g,{title:"Platform Companies"},{default:a(()=>[r("div",C,[r("div",B,[r("div",{class:k([[d.color==="light"?"bg-white":"bg-emerald-900 text-white"],"relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"])},[r("div",T,[r("div",G,[r("h6",z,s(t.$t("Users")),1),r("div",A,[r("div",D,[j,o(y,{id:"default-search",type:"search",class:"block w-full p-1 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500",modelValue:i.value,"onUpdate:modelValue":n[0]||(n[0]=e=>i.value=e),"aria-placeholder":"search...",autofocus:""},null,8,["modelValue"])]),t.$page.props.user.permissions.includes("create-users")?(c(),m(p(V),{key:0,class:"bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 ml-6",href:t.route("users.create")},{default:a(()=>[l(s(t.$t("New")),1)]),_:1},8,["href"])):N("",!0)])])]),r("div",M,[o(p(_),{"show-index":"",headers:w,items:b.users,"search-field":f,"search-value":i.value,"sort-by":h,"sort-type":x,"table-class-name":"items-center w-full bg-transparent border-collapse md:min-w-full table","header-class-name":"users-header","header-item-class-name":"bg-blueGray-50 text-blueGray-500 border-blueGray-100 x-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left px-6","body-row-class-name":"","body-expand-row-class-name":"","body-item-class-name":"border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left","rows-per-page-message":t.$t("rows per page:")},{"header-name":a(e=>[l(s(t.$t(e.text)),1)]),"header-email":a(e=>[l(s(t.$t(e.text)),1)]),"header-created_at":a(e=>[l(s(t.$t(e.text)),1)]),"header-status":a(e=>[l(s(t.$t(e.text)),1)]),"header-roles.name":a(e=>[l(s(t.$t(e.text)),1)]),"header-actions":a(e=>[l(s(t.$t(e.text)),1)]),"item-active":a(({active:e})=>[l(s(e?t.$t("Yes"):t.$t("No")),1)]),"item-actions":a(({id:e})=>[o(v,{id:e,group:"users",view:!1},null,8,["id"])]),"item-created_at":a(({created_at:e})=>[o(u,{date:e,hasTime:"true"},null,8,["date"])]),"item-updated_at":a(({updated_at:e})=>[o(u,{date:e,hasTime:"true"},null,8,["date"])]),_:1},8,["items","search-value","rows-per-page-message"])])],2)])])]),_:1}))}};export{Y as default};