import{k as v,T as g,o as a,e as d,a as i,c as u,w as f,f as w,t as l,u as m,j as c,h as p,n as k}from"./app.js";import{c as D}from"./AppLayout.js";const S={key:0},$=i("i",{class:"fas fa-ellipsis-v"},null,-1),B=[$],C={key:2},P={data(){return{dropdownPopoverShow:!1}},methods:{toggleDropdown:function(n){n.preventDefault(),this.dropdownPopoverShow?this.dropdownPopoverShow=!1:(this.dropdownPopoverShow=!0,D(this.$refs.btnDropdownRef,this.$refs.popoverDropdownRef,{placement:"bottom-start"}))}}},N=Object.assign(P,{__name:"TableDropdownMyCompany",props:{id:Number,company_id:Number,group:String,permissionGroup:String,view:{type:Boolean,default:1},edit:{type:Boolean,default:1},delete:{type:Boolean,default:1}},setup(n){const o=n;v(()=>o.permissionGroup??o.group);const r=(e,t,s="view")=>s==="view"&&!o.view||s==="edit"&&!o.edit||s==="delete"&&!o.delete||!Array.isArray(e)?!1:!!e.includes(t),y=e=>!!(r(e,"view-users-in-company","view")||r(e,"update-users-in-company","edit")||r(e,"delete-users-in-company","delete")),h=g({id:o.id});function b(e){return e&&confirm("Are you sure you want to Delete")?(h.delete(route(o.group+".destroy",e)),!0):!1}return(e,t)=>y(e.$page.props.user.permissions)?(a(),d("div",S,[i("a",{class:"text-blueGray-500 py-1 px-3",href:"#pablo",ref:"btnDropdownRef",onClick:t[0]||(t[0]=s=>e.toggleDropdown(s))},B,512),i("div",{ref:"popoverDropdownRef",class:k(["bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48",{hidden:!e.dropdownPopoverShow,block:e.dropdownPopoverShow}])},[r(e.$page.props.user.permissions,"view-users-in-company","view")?(a(),u(m(c),{key:0,class:"text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700",href:e.route("companies.show",o.company_id)},{default:f(()=>[w(l(e.$t("View")),1)]),_:1},8,["href"])):p("",!0),r(e.$page.props.user.permissions,"update-users-in-company","edit")?(a(),u(m(c),{key:1,class:"text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700",href:e.route("companies.edit",o.company_id)},{default:f(()=>[w(l(e.$t("Edit")),1)]),_:1},8,["href"])):p("",!0),r(e.$page.props.user.permissions,"delete-users-in-company","delete")?(a(),d("form",C,[i("a",{class:"text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700",href:"#",onClick:t[1]||(t[1]=s=>{e.$emit("freshCompany",{id:o.id,company_id:o.company_id,confirm:b(n.id)})})},l(e.$t("Delete")),1)])):p("",!0)],2)])):p("",!0)}});export{N as _};
