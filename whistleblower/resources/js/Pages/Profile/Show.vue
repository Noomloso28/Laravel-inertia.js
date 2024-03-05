<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
    color: {
        default: "light",
        validator: function (value) {
            return ["light", "dark"].indexOf(value) !== -1;
        },
    },
});
</script>

<template>
    <AppLayout title="Profile">
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div
                    :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
                >
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                                <div>
<!--                                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">-->
<!--                                        Profile-->
<!--                                    </h2>-->
                                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                        <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                                            <UpdateProfileInformationForm :user="$page.props.user" />

                                            <SectionBorder />
                                        </div>

                                        <div v-if="$page.props.jetstream.canUpdatePassword">
                                            <UpdatePasswordForm class="mt-10 sm:mt-0" />

                                            <SectionBorder />
                                        </div>

                                        <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                                            <TwoFactorAuthenticationForm
                                                :requires-confirmation="confirmsTwoFactorAuthentication"
                                                class="mt-10 sm:mt-0"
                                            />

                                            <SectionBorder />
                                        </div>

                                        <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" />

                                        <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                                            <SectionBorder />

                                            <DeleteUserForm class="mt-10 sm:mt-0" />
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
