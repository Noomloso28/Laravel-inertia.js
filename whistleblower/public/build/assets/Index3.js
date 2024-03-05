import{_}from"./AppLayout.js";import{_ as y}from"./TableDropdownMyCompany.js";import{_ as v}from"./TextInput.js";import{D as k}from"./vue3-easy-data-table.es.js";import{_ as c}from"./DateFormat.js";import{d as $,o as u,c as m,w as r,a,n as C,t as s,b as o,u as p,j as V,f as l,h as N}from"./app.js";import"./_plugin-vue_export-helper.js";import"./LanguageSwitcher.js";const B={class:"flex flex-wrap mt-4"},G={class:"w-full mb-12 px-4"},T={class:"rounded-t bg-white mb-0 px-6 py-6"},z={class:"text-center flex justify-between"},A={class:"text-blueGray-700 text-xl font-bold mr-2"},D={class:"relative flex"},M={class:"relative"},j=a("div",{class:"absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"},[a("svg",{"aria-hidden":"true",class:"w-5 h-5 text-gray-500 dark:text-gray-400",fill:"currentColor",viewBox:"0 0 20 20",xmlns:"http://www.w3.org/2000/svg"},[a("path",{"fill-rule":"evenodd",d:"M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z","clip-rule":"evenodd"})])],-1),U={class:"block w-full overflow-x-auto"},J={__name:"Index",props:{userCompanies:Array,color:{default:"light",validator:function(d){return["light","dark"].indexOf(d)!==-1}}},setup(d){const f=d,i=$(""),b=["name","id","created_at","updated_at"],h="name",x="desc",w=[{text:"Name",value:"companies.name",sortable:!0},{text:"Created",value:"created_at",sortable:!0},{text:"Updated",value:"updated_at",sortable:!0},{text:"Actions",value:"actions",sortable:!0}];return(t,n)=>(u(),m(_,{title:"Platform Companies"},{default:r(()=>[a("div",B,[a("div",G,[a("div",{class:C([[d.color==="light"?"bg-white":"bg-emerald-900 text-white"],"relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"])},[a("div",T,[a("div",z,[a("h6",A,s(t.$t("My Companies")),1),a("div",D,[a("div",M,[j,o(v,{id:"default-search",type:"search",class:"block w-full p-1 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500",modelValue:i.value,"onUpdate:modelValue":n[0]||(n[0]=e=>i.value=e),"aria-placeholder":"search...",autofocus:""},null,8,["modelValue"])]),t.$page.props.user.permissions.includes("create-user-company")?(u(),m(p(V),{key:0,class:"bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 ml-6",href:t.route("companies-user.create")},{default:r(()=>[l(s(t.$t("New")),1)]),_:1},8,["href"])):N("",!0)])])]),a("div",U,[o(p(k),{"show-index":"",headers:w,items:f.userCompanies,"search-field":b,"search-value":i.value,"sort-by":h,"sort-type":x,"table-class-name":"items-center w-full bg-transparent border-collapse md:min-w-full table","header-class-name":"companies-header","header-item-class-name":"bg-blueGray-50 text-blueGray-500 border-blueGray-100 x-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left px-6","body-row-class-name":"","body-expand-row-class-name":"","body-item-class-name":"border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left","rows-per-page-message":t.$t("rows per page:")},{"header-companies.name":r(e=>[l(s(t.$t(e.text)),1)]),"header-created_at":r(e=>[l(s(t.$t(e.text)),1)]),"header-updated_at":r(e=>[l(s(t.$t(e.text)),1)]),"header-actions":r(e=>[l(s(t.$t(e.text)),1)]),"item-actions":r(({id:e,companies:g})=>[o(y,{id:e,company_id:g.id,group:"companies-user",permissionGroup:"user-company",view:!1,edit:!1},null,8,["id","company_id"])]),"item-created_at":r(({created_at:e})=>[o(c,{date:e,hasTime:"true"},null,8,["date"])]),"item-updated_at":r(({updated_at:e})=>[o(c,{date:e,hasTime:"true"},null,8,["date"])]),_:1},8,["items","search-value","rows-per-page-message"])])],2)])])]),_:1}))}};export{J as default};
