<template>
    <!--
        ** https://www.chatterbuzzmedia.com/web-design-pricing-calculator/
        https://getphound.com/website-pricing-calculator/
   -->
    <Head title="Welcome" />
    <Banner />

    <div class="container w-full flex flex-wrap mx-auto px-2 pt-8 lg:pt-16 mt-1">
        <!--Section container-->
        <section class="w-full lg:w-3/5">

<!--            &lt;!&ndash;Title&ndash;&gt;-->
<!--            <h1 class="flex items-center font-sans font-bold break-normal text-gray-700 px-2 text-xl mt-12 lg:mt-0 md:text-2xl">-->
<!--                Website cost calculator-->
<!--            </h1>-->

<!--            &lt;!&ndash;divider&ndash;&gt;-->
<!--            <SectionBorder />-->
<!--            -->
<!--            <SecondaryHeader>Enter the startup expenses that apply to your business.</SecondaryHeader>-->

            <div class="p-8 mt-6 mb-6 lg:mt-0 leading-normal rounded shadow-lg bg-white">
                <form @change.prevent="summary">
                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <InputLabel>About project</InputLabel>
                        </div>
                        <div class="md:w-2/3">
                            <div class="mt-2">
                                <label class="inline-flex items-center text-sm font-medium" for="new_project">
                                    <input v-model="form.project" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" id="new_project" value="new_project" checked>
                                    <span class="ml-2">New Project</span>
                                </label>
                                <label class="inline-flex items-center ml-6 text-sm font-medium" for="redesign">
                                    <input v-model="form.project" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" id="redesign" value="redesign">
                                    <span class="ml-2">Redesign / Developments</span>
                                </label>
                            </div>
                            <p class="py-2 text-sm text-gray-600">add notes about populating the field</p>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <InputLabel>Time for project</InputLabel>
                        </div>
                        <div class="md:w-2/3">
                            <div class="">
                                <label class="flex items-center text-sm font-medium py-1" for="time_2_3_months">
                                    <input v-model="form.times" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" id="time_2_3_months" name="times" checked value="time_2_3_months">
                                    <span class="ml-2">Normal (2-3 months)</span>
                                </label>
                                <label class="flex items-center text-sm font-medium py-1" for="time_1_month">
                                    <input v-model="form.times" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" id="time_1_month" name="times" value="time_1_month">
                                    <span class="ml-2">Express (1 month)</span>
                                </label>
                                <label class="flex items-center text-sm font-medium py-1" for="time_1_week">
                                    <input v-model="form.times" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" id="time_1_week" name="times" value="time_1_week">
                                    <span class="ml-2">Deadline (1 week)</span>
                                </label>
                            </div>
                            <p class="py-2 text-sm text-gray-600">add notes about populating the field</p>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <InputLabel>Website Type</InputLabel>
                        </div>
                        <div class="md:w-2/3">
                            <div class="">
                                <label class="flex items-center text-sm font-medium py-1" for="static_type">
                                    <input id="static_type" v-model="form.type" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" name="type" value="static_type">
                                    <span class="ml-2">Static HTML</span>
                                </label>
                                <label class="flex items-center text-sm font-medium py-1" for="business_type">
                                    <input id="business_type" v-model="form.type" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" name="type" value="business_type">
                                    <span class="ml-2">Business Website</span>
                                </label>
                                <label class="flex items-center text-sm font-medium py-1" for="blog_type">
                                    <input id="blog_type" v-model="form.type" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" name="type" value="blog_type">
                                    <span class="ml-2">Blog/Personal</span>
                                </label>
                                <label class="flex items-center text-sm font-medium py-1" for="ecommerce_type">
                                    <input id="ecommerce_type" v-model="form.type" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" name="type" value="ecommerce_type">
                                    <span class="ml-2">Ecommerce</span>
                                </label>
                                <label class="flex items-center text-sm font-medium py-1" for="no_design">
                                    <input id="no_design" v-model="form.type" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" name="type" value="no_design">
                                    <span class="ml-2">Other</span>
                                </label>
                            </div>
                            <p class="py-2 text-sm text-gray-600">add notes about populating the field</p>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <InputLabel>Require CMS system</InputLabel>
                        </div>
                        <div class="md:w-2/3">
                            <div class="">
                                <label class="flex items-center text-sm font-medium py-1" for="wordpress">
                                    <input v-model="form.cms" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" id="wordpress" name="cms" checked value="wordpress">
                                    <span class="ml-2">Wordpress</span>
                                    <a class="w-5 ml-1 cursor-pointer" data-te-toggle="tooltip"
                                       title="WordPress is a free software that allows users to create and manage websites and blogs. It's easy to use and highly customizable, with a wide range of themes and plugins available to enhance its functionality and appearance. It's used by over 40% of websites on the internet and is suitable for personal blogs, business websites, e-commerce stores, and more.">
                                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"></path>
                                        </svg>
                                    </a>
                                </label>
                                <label class="flex items-center text-sm font-medium py-1" for="magento">
                                    <input v-model="form.cms" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" id="magento" name="cms" value="magento">
                                    <span class="ml-2">Magento</span>
                                    <a class="w-5 ml-1 cursor-pointer" data-te-toggle="tooltip"
                                       title="Magento is an open-source e-commerce platform used to create and manage online stores. It offers customizable themes and templates, payment and shipping options, inventory management, and marketing tools. It is highly scalable and suitable for businesses of all sizes.">
                                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"></path>
                                        </svg>
                                    </a>
                                </label>
                                <label class="flex items-center text-sm font-medium py-1" for="shopware">
                                    <input v-model="form.cms" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" id="shopware" name="cms" value="shopware">
                                    <span class="ml-2">Shopware</span>
                                    <a class="w-5 ml-1 cursor-pointer" data-te-toggle="tooltip"
                                       title="Shopware is an e-commerce platform that allows businesses to create and manage online stores. It offers customizable themes, payment and shipping options, and marketing tools. Its modular architecture makes it flexible and easy to integrate with third-party software.">
                                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"></path>
                                        </svg>
                                    </a>
                                </label>
                                <label class="flex items-center text-sm font-medium py-1" for="woo_commerce">
                                    <input v-model="form.cms" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" id="woo_commerce" name="cms" value="woo_commerce">
                                    <span class="ml-2">Woo Commerce</span>
                                    <a class="w-5 ml-1 cursor-pointer" data-te-toggle="tooltip"
                                       title="WooCommerce is an open-source e-commerce plugin for WordPress. It enables businesses to create and manage online stores, sell products and services, and offers customizable themes, payment and shipping options, and marketing tools. It is highly scalable, flexible, and has a large community of users and developers who provide support and plugins.">
                                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"></path>
                                        </svg>
                                    </a>
                                </label>
                                <label class="flex items-center text-sm font-medium py-1" for="no_cms">
                                    <input v-model="form.cms" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" id="no_cms" name="cms" value="no_cms">
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                            <p class="py-2 text-sm text-gray-600">add notes about populating the field</p>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <InputLabel for="numberPage">Number of page(s)</InputLabel>
                        </div>
                        <div class="md:w-2/3">
                            <div class="flex flex-col space-y-2 w-full mb-6">
                                <input v-model="form.numberPage" type="range" class="w-full" min="0" max="50" step="10" value="10" name="numberPage" />
                                <ul class="flex justify-between w-full px-[10px]">
                                    <li class="flex justify-center relative text-sm font-medium"><span class="absolute">1</span></li>
                                    <li class="flex justify-center relative text-sm font-medium"><span class="absolute">10</span></li>
                                    <li class="flex justify-center relative text-sm font-medium"><span class="absolute">20</span></li>
                                    <li class="flex justify-center relative text-sm font-medium"><span class="absolute">30</span></li>
                                    <li class="flex justify-center relative text-sm font-medium"><span class="absolute">40</span></li>
                                    <li class="flex justify-center relative text-sm font-medium"><span class="absolute">50+</span></li>
                                </ul>
                            </div>

<!--                            <div class="mt-2">-->
<!--                                <select name="" class="form-select block w-full focus:bg-white" id="my-select">-->
<!--                                    <option value="1-10">1-10</option>-->
<!--                                    <option value="10-50">10-50</option>-->
<!--                                    <option value="50-150">50-150</option>-->
<!--                                    <option value="50-150">50-150</option>-->
<!--                                    <option value="250">250+</option>-->
<!--                                </select>-->
<!--                            </div>-->
                            <p class="py-2 text-sm text-gray-600">add notes about populating the field</p>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <InputLabel for="design">Style of design (UI/UX)</InputLabel>
                        </div>
                        <div class="md:w-2/3">
                            <div class="mt-2">
                                <select v-model="form.design" name="design" class="form-select block w-full focus:bg-white text-sm font-medium" id="website-design" ref="selectElement">
                                    <option value="no_design">No design needed</option>
                                    <option value="simple_design">Simple yet attractive</option>
                                    <option value="moderately_design">Moderately stylized</option>
                                    <option value="high-end_design">High end</option>
                                    <option value="world-class_design">World Class</option>
                                </select>
                            </div>
                            <p class="py-2 text-sm text-gray-600">add notes about populating the field</p>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <InputLabel for="domain">Require Domain</InputLabel>
                        </div>
                        <div class="md:w-2/3">
                            <div class="">
<!--                                <OptionsYesNo name="domain" v-model="form.domainPrice" :value="true" checked="Yes"  />-->
                                <label class="inline-flex items-center text-sm font-medium">
                                    <input v-model="form.domainPrice" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" value="1">
                                    <span class="ml-2">Yes</span>
                                </label>
                                <label class="inline-flex items-center ml-6 text-sm font-medium">
                                    <input v-model="form.domainPrice" type="radio" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" value="0">
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                            <p class="py-2 text-sm text-gray-600">add notes about populating the field</p>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <InputLabel for="hosting">Require Hosting</InputLabel>
                        </div>
                        <div class="md:w-2/3">
                            <div class="">
<!--                                <OptionsYesNo v-model="form.hostingPrice" name="hosting" :value="true" checked="Yes" />-->
                                <label class="inline-flex items-center text-sm font-medium">
                                    <input v-model="form.hostingPrice" type="radio" name="hosting" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" value="1">
                                    <span class="ml-2">Yes</span>
                                </label>
                                <label class="inline-flex items-center ml-6 text-sm font-medium">
                                    <input v-model="form.hostingPrice" type="radio" name="hosting" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" value="0">
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                            <p class="py-2 text-sm text-gray-600">add notes about populating the field</p>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <InputLabel for="responsive">Responsive design</InputLabel>
                        </div>
                        <div class="md:w-2/3">
                            <div class="">
<!--                                <OptionsYesNo v-model="form.responsivePrice" name="responsive" :value="true" checked="Yes" />-->
                                <label class="inline-flex items-center text-sm font-medium">
                                    <input v-model="form.responsivePrice" type="radio" name="responsive" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" value="1">
                                    <span class="ml-2">Yes</span>
                                </label>
                                <label class="inline-flex items-center ml-6 text-sm font-medium">
                                    <input v-model="form.responsivePrice" type="radio" name="responsive" class="ppearance-none rounded-full border-2 border-white ring-2 ring-blue-600 ring-opacity-100" value="0">
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                            <p class="py-2 text-sm text-gray-600">add notes about populating the field</p>
                        </div>
                    </div>


                    <div class="md:flex mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-checkbox">
                                Addons
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <div>
                                <label class="inline-flex items-center text-sm font-medium">
                                    <input v-model="form.logoPrice" value="1" type="checkbox" class="form-checkbox text-indigo-600">
                                    <span class="ml-2">Logo design</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center text-sm font-medium">
                                    <input v-model="form.multiLangualPrice" value="1" type="checkbox" class="form-checkbox text-indigo-600">
                                    <span class="ml-2">Multilingual</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center text-sm font-medium">
                                    <input v-model="form.newsletterPrice" value="1" type="checkbox" class="form-checkbox text-indigo-600">
                                    <span class="ml-2">Automated newsletter</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center text-sm font-medium">
                                    <input v-model="form.onlineBookingPrice" value="1" type="checkbox" class="form-checkbox text-indigo-600">
                                    <span class="ml-2">Online Booking system</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center text-sm font-medium">
                                    <input v-model="form.eventReservationPrice" value="1" type="checkbox" class="form-checkbox text-indigo-600">
                                    <span class="ml-2">Event planning / reservations</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center text-sm font-medium">
                                    <input v-model="form.livechatPrice" value="1" type="checkbox" class="form-checkbox text-indigo-600">
                                    <span class="ml-2">Live chat</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center text-sm font-medium">
                                    <input v-model="form.seoPrice" value="1" type="checkbox" class="form-checkbox text-indigo-600">
                                    <span class="ml-2">SEO</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center text-sm font-medium">
                                    <input v-model="form.seaPrice" value="1" type="checkbox" class="form-checkbox text-indigo-600">
                                    <span class="ml-2">SEA</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center text-sm font-medium">
                                    <input v-model="form.animationPrice" value="1" type="checkbox" class="form-checkbox text-indigo-600">
                                    <span class="ml-2">Animation</span>
                                </label>
                            </div>
                            <p class="py-2 text-sm text-gray-600">add notes about populating the field</p>
                        </div>
                    </div>

                </form>
            </div>

        </section>
        <!--/Section container-->

        <div class="w-full lg:w-2/5 px-6 text-xl text-gray-800 leading-normal">
            <div class="w-full sticky inset-0 hidden lg:h-auto overflow-x-hidden overflow-y-auto lg:overflow-y-hidden lg:block mt-0 my-2 lg:my-0 border border-gray-400 lg:border-transparent bg-white shadow lg:shadow-none lg:bg-transparent z-20" style="top:6em;" id="menu-content">
                <div class="summary">

                    <div class="p-8">
                        <h2 class="text-sm font-medium">Cost Summary</h2>
                        <div class="bg-white rounded mt-4 shadow-lg py-6">
                            <div class="px-8">
                                <div class="flex items-end">
                                    <select class="text-sm font-medium focus:outline-none -ml-1" name="" id="">
                                        <option value="">Product (Billed Monthly)</option>
                                        <option value="">Product (Billed Annually)</option>
                                    </select>
                                    <span class="text-sm ml-auto font-semibold">$20</span>
                                    <span class="text-xs text-gray-500 mb-px">/mo</span>
                                </div>
                                <span class="text-xs text-gray-500 mt-2">Save 20% with annual billing</span>
                            </div>

                            <div class="px-8 mt-4" v-if="form.project && form.projectPrice">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">{{getLabel(form.project)}}</span>
                                    <span class="text-sm text-gray-500 mb-px">{{form.projectPrice}}</span>
                                </div>
                            </div>

                            <div class="px-8 mt-4" v-if="form.times && form.timesPrice">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">{{getLabel(form.times)}}</span>
                                    <span class="text-sm text-gray-500 mb-px">{{form.timesPrice}}</span>
                                </div>
                            </div>

                            <div class="px-8 mt-4" v-if="form.type && form.typePrice">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">{{getLabel(form.type)}}</span>
                                    <span class="text-sm text-gray-500 mb-px">{{form.typePrice}}</span>
                                </div>
                            </div>

                            <div class="px-8 mt-4" v-if="form.cms && form.cmsPrice">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">{{getLabel(form.cms)}}</span>
                                    <span class="text-sm text-gray-500 mb-px">{{form.cmsPrice}}</span>
                                </div>
                            </div>

                            <div class="px-8 mt-4" v-if="form.numberPage">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">Number of page(s)</span>
                                    <span class="text-sm text-gray-500 mb-px">{{(form.numberPage <= 0) ? 1 : form.numberPage}}</span>
                                </div>
                            </div>

                            <div class="px-8 mt-4" v-if="form.design && form.designPrice">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">Design</span>
                                    <span class="text-sm text-gray-500 mb-px">{{getSelectedOptionText(form.design)}}</span>
                                </div>
                            </div>

                            <div class="px-8 mt-4" v-if="form.domainPrice > 0">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">Domain</span>
                                    <span class="text-sm text-gray-500 mb-px">{{getPrice('domain')}}</span>
                                </div>
                            </div>

                            <div class="px-8 mt-4" v-if="form.hostingPrice > 0">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">Hosting</span>
                                    <span class="text-sm text-gray-500 mb-px">{{getPrice('hosting')}}</span>
                                </div>
                            </div>

                            <div class="px-8 mt-4" v-if="form.responsivePrice > 0">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">Responsive</span>
                                    <span class="text-sm text-gray-500 mb-px">Yes</span>
                                </div>
                            </div>

                            <div class="px-8 mt-4" v-if="form.logoPrice > 0">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">Logo</span>
                                    <span class="text-sm text-gray-500 mb-px">{{getPrice('logo')}}</span>
                                </div>
                            </div>

                            <div class="px-8 mt-4" v-if="form.multiLangualPrice > 0">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">Multilingual</span>
                                    <span class="text-sm text-gray-500 mb-px">{{getPrice('multi_langual')}}</span>
                                </div>
                            </div>

                            <div class="px-8 mt-4" v-if="form.onlineBookingPrice > 0">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">Booking system</span>
                                    <span class="text-sm text-gray-500 mb-px">{{getPrice('online_booking')}}</span>
                                </div>
                            </div>
                            <div class="px-8 mt-4" v-if="form.eventReservationPrice > 0">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">Reservations</span>
                                    <span class="text-sm text-gray-500 mb-px">{{getPrice('event_reservation')}}</span>
                                </div>
                            </div>
                            <div class="px-8 mt-4" v-if="form.livechatPrice > 0">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">Live chat</span>
                                    <span class="text-sm text-gray-500 mb-px">{{getPrice('livechat')}}</span>
                                </div>
                            </div>
                            <div class="px-8 mt-4" v-if="form.seoPrice > 0">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">SEO</span>
                                    <span class="text-sm text-gray-500 mb-px">{{getPrice('seo')}}</span>
                                </div>
                            </div>
                            <div class="px-8 mt-4" v-if="form.seaPrice > 0">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">SEA</span>
                                    <span class="text-sm text-gray-500 mb-px">{{getPrice('sea')}}</span>
                                </div>
                            </div>
                            <div class="px-8 mt-4" v-if="form.animationPrice > 0">
                                <div class="flex items-end justify-between">
                                    <span class="text-sm font-semibold">Animation</span>
                                    <span class="text-sm text-gray-500 mb-px">{{getPrice('animation')}}</span>
                                </div>
                            </div>

                            <div class="px-8 mt-4 border-t pt-4">
                                <div class="flex items-end justify-between">
                                    <span class="font-semibold">Today you pay (AUD)</span>
                                    <span class="font-semibold">${{costSummary}}</span>
                                </div>
                                <span class="text-xs text-gray-500 mt-2">After 1 month free: $22/mo.</span>
                            </div>
<!--                            <div class="flex items-center px-8 mt-8">-->
<!--                                <input id="termsConditions" type="checkbox">-->
<!--                                <label class="text-xs text-gray-500 ml-2" for="termsConditions">I agree to the terms and conditions.</label>-->
<!--                            </div>-->
                            <div class="flex flex-col px-8 pt-4">
                                <button @click.prevent="submit" class="flex items-center justify-center bg-blue-600 text-sm font-medium w-full h-10 rounded text-blue-50 hover:bg-blue-700">Download PDF</button>
<!--                                <button class="text-xs text-blue-500 mt-3 underline">Have a coupon code?</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="flex justify-center items-center w-screen h-screen bg-white">
                <!-- COMPONENT CODE -->
                <div class="container mx-auto my-4 px-4 lg:px-20">

                    <div class="w-full p-8 my-4 md:px-12 lg:w-9/12 lg:pl-20 lg:pr-40 mr-auto rounded-2xl shadow-2xl">
                        <div class="flex">
                            <h1 class="font-bold uppercase text-5xl">Send us a <br /> message</h1>
                        </div>
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mt-5">
                            <input class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
                                   type="text" placeholder="First Name*" />
                            <input class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
                                   type="text" placeholder="Last Name*" />
                            <input class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
                                   type="email" placeholder="Email*" />
                            <input class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
                                   type="number" placeholder="Phone*" />
                        </div>
                        <div class="my-4">
                            <textarea placeholder="Message*" class="w-full h-32 bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"></textarea>
                        </div>
                        <div class="my-2 w-1/2 lg:w-1/4">
                            <button class="uppercase text-sm font-bold tracking-wide bg-blue-900 text-gray-100 p-3 rounded-lg w-full
                      focus:outline-none focus:shadow-outline">
                                Send Message
                            </button>
                        </div>
                    </div>

                    <div
                        class="w-full lg:-mt-96 lg:w-2/6 px-8 py-12 ml-auto bg-blue-900 rounded-2xl">
                        <div class="flex flex-col text-white">
                            <h1 class="font-bold uppercase text-4xl my-4">Drop in our office</h1>
                            <p class="text-gray-400">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                tincidunt arcu diam,
                                eu feugiat felis fermentum id. Curabitur vitae nibh viverra, auctor turpis sed, scelerisque ex.
                            </p>

                            <div class="flex my-4 w-2/3 lg:w-1/2">
                                <div class="flex flex-col">
                                    <i class="fas fa-map-marker-alt pt-2 pr-2" />
                                </div>
                                <div class="flex flex-col">
                                    <h2 class="text-2xl">Main Office</h2>
                                    <p class="text-gray-400">5555 Tailwind RD, Pleasant Grove, UT 73533</p>
                                </div>
                            </div>

                            <div class="flex my-4 w-2/3 lg:w-1/2">
                                <div class="flex flex-col">
                                    <i class="fas fa-phone-alt pt-2 pr-2" />
                                </div>
                                <div class="flex flex-col">
                                    <h2 class="text-2xl">Call Us</h2>
                                    <p class="text-gray-400">Tel: xxx-xxx-xxx</p>
                                    <p class="text-gray-400">Fax: xxx-xxx-xxx</p>
                                </div>
                            </div>

                            <div class="flex my-4 w-2/3 lg:w-1/2">
                                <a href="https://www.facebook.com/ENLIGHTENEERING/" target="_blank" rel="noreferrer" class="rounded-full bg-white h-8 w-8 inline-block mx-1 text-center pt-1">
                                    <i class="fab fa-facebook-f text-blue-900" />
                                </a>
                                <a href="https://www.linkedin.com/company/enlighteneering-inc-" target="_blank" rel="noreferrer" class="rounded-full bg-white h-8 w-8 inline-block mx-1 text-center pt-1">
                                    <i class="fab fa-linkedin-in text-blue-900" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COMPONENT CODE -->
            </div>
        </div>

        <!--Back link -->
        <div class="w-full lg:w-4/5 lg:ml-auto text-base md:text-sm text-gray-600 px-4 py-24 mb-12">
            <span class="text-base text-yellow-600 font-bold">&lt;</span> <a href="#" class="text-base md:text-sm text-yellow-600 font-bold no-underline hover:underline">Back link</a>
        </div>

    </div>
</template>

<script setup>
import {computed, ref, onMounted} from "vue";
import { Head, Link, useForm } from '@inertiajs/vue3';
import SectionBorder from '@/Components/SectionBorder.vue';
import SecondaryHeader from '@/Components/SecondaryHeader.vue';
import InputLabel from '@/Components/InputLabel.vue';
import OptionsYesNo from '@/Components/OptionsYesNo.vue';
import Banner from '@/Components/Banner.vue';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    data: Array
});

const costSummary = ref(0);
const selectedOptionText = ref('');
const selectElement = ref(null);

const form = useForm({
    project: 'new_project',
    projectPrice: 0,

    type: 'static_type',
    typePrice: 0,

    times: 'time_2_3_months',
    timesPrice: 0,

    numberPage: 1,

    cms: 'wordpress',
    cmsPrice: 0,

    design: 'simple_design',
    designPrice: 0,

    dbIntegration: '',
    dbIntegrationPrice: 0,

    /** Addons **/
    domainPrice : 0,
    hostingPrice : 0,
    responsivePrice : ref(1),
    multiLangualPrice : 0,
    marketPrice: 0,
    newsletterPrice: 0,
    onlineBookingPrice: 0,
    eventReservationPrice: 0,
    livechatPrice: 0,
    seoPrice: 0,
    seaPrice: 0,
    logoPrice: 0,
    animationPrice: 0,
    summary: 0,
});
const summary = () => {
    form.projectPrice = getPrice(form.project);
    form.timesPrice = getPrice(form.times);
    let numberPagePrice = getPrice('number-page') * form.numberPage;
    if(form.numberPage <= 0){
        numberPagePrice = getPrice('number-page') * 1;
    }

    form.typePrice = getPrice(form.type);
    form.cmsPrice = getPrice(form.cms);
    form.designPrice = getPrice(form.design);
    let domainPrice = form.domainPrice ? getPrice('domain') : 0;
    let hostingPrice = form.hostingPrice ? getPrice('hosting') : 0;
    let responsivePrice = form.responsivePrice ? getPrice('responsive') : 0;
    let multiLangualPrice = form.multiLangualPrice ? getPrice('multi_langual') : 0;
    let marketPrice = form.marketPrice ? getPrice('market') : 0;
    let newsletterPrice = form.newsletterPrice ? getPrice('newsletter') : 0;
    let onlineBookingPrice = form.onlineBookingPrice ? getPrice('online_booking') : 0;
    let eventReservationPrice = form.eventReservationPrice ? getPrice('event_reservation') : 0;
    let livechatPrice = form.livechatPrice ? getPrice('livechat') : 0;
    let seoPrice = form.seoPrice ? getPrice('seo') : 0;
    let seaPrice = form.seaPrice ? getPrice('sea') : 0;
    let logoPrice = form.logoPrice ? getPrice('logo') : 0;
    let animationPrice = form.animationPrice ? getPrice('animation') : 0;


    costSummary.value = form.typePrice + form.projectPrice + form.timesPrice
        + numberPagePrice + form.cmsPrice + form.designPrice +domainPrice
        + hostingPrice + responsivePrice + multiLangualPrice + marketPrice
        + newsletterPrice + onlineBookingPrice + eventReservationPrice + livechatPrice
        + seoPrice + seaPrice + animationPrice;
}
const getLabel = (attribute) => {
    const label = document.querySelector("label[for='"+attribute+"'] span").firstChild.textContent;
    return label ?? '';
}

const getSelectedOptionText = (selected) => {
    const selectedOption =Array.from(selectElement.value.options).find(option => option.value === selected)
    selectedOptionText.value = selectedOption ? selectedOption.text : '';

    return selectedOptionText.value;
}

function getPrice(attribute){
    if(attribute in props.data){
        return props.data[attribute]['price'] ?? 0;
    }
    return 0;
}

onMounted(() => {
    summary();
});

const submit = () => {
    form.summary = costSummary.value;
    form.post(route('quotations.index'));
};

</script>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
