import{_ as n}from"./AppLayout.js";import l from"./DeleteUserForm.js";import c from"./LogoutOtherBrowserSessionsForm.js";import{S as a}from"./SectionBorder.js";import p from"./TwoFactorAuthenticationForm.js";import d from"./UpdatePasswordForm.js";import f from"./UpdateProfileInformationForm.js";import{o as r,c as u,w as _,a as t,n as h,e as i,b as e,h as m,F as w}from"./app.js";import"./_plugin-vue_export-helper.js";import"./LanguageSwitcher.js";import"./DialogModal.js";import"./SectionTitle.js";import"./DangerButton.js";import"./InputError.js";import"./SecondaryButton.js";import"./TextInput.js";import"./ActionMessage.js";import"./PrimaryButton.js";import"./InputLabel.js";import"./FormSection.js";const x={class:"flex flex-wrap mt-4"},g={class:"w-full mb-12 px-4"},v={class:"rounded-t mb-0 px-4 py-3 border-0"},$={class:"flex flex-wrap items-center"},k={class:"relative w-full px-4 max-w-full flex-grow flex-1"},b={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},y={key:0},B={key:1},F={key:2},Q={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array,color:{default:"light",validator:function(o){return["light","dark"].indexOf(o)!==-1}}},setup(o){return(s,A)=>(r(),u(n,{title:"Profile"},{default:_(()=>[t("div",x,[t("div",g,[t("div",{class:h([[o.color==="light"?"bg-white":"bg-emerald-900 text-white"],"relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"])},[t("div",v,[t("div",$,[t("div",k,[t("div",null,[t("div",b,[s.$page.props.jetstream.canUpdateProfileInformation?(r(),i("div",y,[e(f,{user:s.$page.props.user},null,8,["user"]),e(a)])):m("",!0),s.$page.props.jetstream.canUpdatePassword?(r(),i("div",B,[e(d,{class:"mt-10 sm:mt-0"}),e(a)])):m("",!0),s.$page.props.jetstream.canManageTwoFactorAuthentication?(r(),i("div",F,[e(p,{"requires-confirmation":o.confirmsTwoFactorAuthentication,class:"mt-10 sm:mt-0"},null,8,["requires-confirmation"]),e(a)])):m("",!0),e(c,{sessions:o.sessions,class:"mt-10 sm:mt-0"},null,8,["sessions"]),s.$page.props.jetstream.hasAccountDeletionFeatures?(r(),i(w,{key:3},[e(a),e(l,{class:"mt-10 sm:mt-0"})],64)):m("",!0)])])])])])],2)])])]),_:1}))}};export{Q as default};
