import{T as f,o as w,e as _,b as o,u as e,Z as g,w as l,a as r,n as V,f as b,t as k,i as v,F as y}from"./app.js";import{A as $}from"./AuthenticationCard.js";import{_ as P}from"./AuthenticationCardLogo.js";import{_ as i}from"./InputError.js";import{_ as m}from"./InputLabel.js";import{_ as S}from"./PrimaryButton.js";import{_ as n}from"./TextInput.js";import"./_plugin-vue_export-helper.js";const x=["onSubmit"],C={class:"mt-4"},h={class:"mt-4"},q={class:"flex items-center justify-end mt-4"},j={__name:"ResetPassword",props:{email:String,token:String},setup(p){const d=p,s=f({token:d.token,email:d.email,password:"",password_confirmation:""}),u=()=>{s.post(route("password.update"),{onFinish:()=>s.reset("password","password_confirmation")})};return(c,a)=>(w(),_(y,null,[o(e(g),{title:"Reset Password"}),o($,null,{logo:l(()=>[o(P)]),default:l(()=>[r("form",{onSubmit:v(u,["prevent"])},[r("div",null,[o(m,{for:"email",value:"Email"}),o(n,{id:"email",modelValue:e(s).email,"onUpdate:modelValue":a[0]||(a[0]=t=>e(s).email=t),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),o(i,{class:"mt-2",message:e(s).errors.email},null,8,["message"])]),r("div",C,[o(m,{for:"password",value:"Password"}),o(n,{id:"password",modelValue:e(s).password,"onUpdate:modelValue":a[1]||(a[1]=t=>e(s).password=t),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(i,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),r("div",h,[o(m,{for:"password_confirmation",value:"Confirm Password"}),o(n,{id:"password_confirmation",modelValue:e(s).password_confirmation,"onUpdate:modelValue":a[2]||(a[2]=t=>e(s).password_confirmation=t),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(i,{class:"mt-2",message:e(s).errors.password_confirmation},null,8,["message"])]),r("div",q,[o(S,{class:V({"opacity-25":e(s).processing}),disabled:e(s).processing},{default:l(()=>[b(k(c.$t("Reset Password")),1)]),_:1},8,["class","disabled"])])],40,x)]),_:1})],64))}};export{j as default};