import{k as C,T as G,d,u as l,o as i,e as m,a as f,c as v,w as b,f as g,t as w,j as h,h as p,n as S}from"./app.js";import{c as $}from"./AppLayout.js";const A={key:0},N=f("i",{class:"fas fa-ellipsis-v"},null,-1),R=[N],V={key:2},E={__name:"TableDropdown",props:{id:Number,group:String,permissionGroup:String,view:{type:Boolean,default:1},edit:{type:Boolean,default:1},delete:{type:Boolean,default:1}},setup(n){const r=n,u=C(()=>r.permissionGroup??r.group),s=(e,t,a="view")=>a==="view"&&!r.view||a==="edit"&&!r.edit||a==="delete"&&!r.delete||!Array.isArray(e)?!1:!!e.includes(t),k=(e,t)=>!!(s(e,"view-"+t,"view")||s(e,"update-"+t,"edit")||s(e,"delete-"+t,"delete")),D=G({id:r.id}),o=d(!1),c=d(null),y=d(null),x=e=>{e.preventDefault(),o.value?o.value=!1:(o.value=!0,$(c.value,y.value,{placement:"bottom-start"}))};function B(e){e&&confirm("Are you sure you want to Delete")&&(D.delete(route(r.group+".destroy",e)),o.value=!o)}return(e,t)=>k(e.$page.props.user.permissions,l(u))?(i(),m("div",A,[f("a",{class:"text-blueGray-500 py-1 px-3",href:"#pablo",ref_key:"btnDropdownRef",ref:c,onClick:t[0]||(t[0]=a=>x(a))},R,512),f("div",{ref_key:"popoverDropdownRef",ref:y,class:S(["bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48",{hidden:!o.value,block:o.value}])},[s(e.$page.props.user.permissions,"view-"+l(u),"view")?(i(),v(l(h),{key:0,class:"text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700",href:e.route(r.group+".show",n.id)},{default:b(()=>[g(w(e.$t("View")),1)]),_:1},8,["href"])):p("",!0),s(e.$page.props.user.permissions,"update-"+l(u),"edit")?(i(),v(l(h),{key:1,class:"text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700",href:e.route(r.group+".edit",n.id)},{default:b(()=>[g(w(e.$t("Edit")),1)]),_:1},8,["href"])):p("",!0),s(e.$page.props.user.permissions,"delete-"+l(u),"delete")?(i(),m("form",V,[f("a",{class:"text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700",href:"#",onClick:t[1]||(t[1]=a=>B(n.id))},w(e.$t("Delete")),1)])):p("",!0)],2)])):p("",!0)}};export{E as _};