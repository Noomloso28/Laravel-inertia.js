<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { trans } from 'laravel-vue-i18n';
import CardLineChart from "@/Components/Cards/CardLineChart.vue";
import CardBarChart from "@/Components/Cards/CardBarChart.vue";
import CardPageVisits from "@/Components/Cards/CardPageVisits.vue";
import CardSocialTraffic from "@/Components/Cards/CardSocialTraffic.vue";
import CardStats from "@/Components/Cards/CardStats.vue";
import Notifications from '@/Components/Notifications.vue';

defineProps({
  notifications: Object,
  occurrences_months: Array,
  month_reports: Array,
  color: {
        default: "light",
        validator: function (value) {
            return ["light", "dark"].indexOf(value) !== -1;
        },
    },
});

</script>

<template>
    <AppLayout title="Dashboard">
      <!-- Header -->
<!--      <div class="flex flex-wrap">-->
<!--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">-->
<!--          <card-stats-->
<!--            statSubtitle="NEW Report"-->
<!--            statTitle="10"-->
<!--            statArrow="up"-->
<!--            statPercent="10"-->
<!--            statPercentColor="text-emerald-500"-->
<!--            statDescripiron="Show all"-->
<!--            statIconName="far fa-chart-bar"-->
<!--            statIconColor="bg-red-500"-->
<!--          />-->
<!--        </div>-->
<!--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">-->
<!--          <card-stats-->
<!--            statSubtitle="Report in process"-->
<!--            statTitle="9"-->
<!--            statArrow="down"-->
<!--            statPercent="3.48"-->
<!--            statPercentColor="text-red-500"-->
<!--            statDescripiron="Since last week"-->
<!--            statIconName="fas fa-chart-pie"-->
<!--            statIconColor="bg-orange-500"-->
<!--          />-->
<!--        </div>-->
<!--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">-->
<!--          <card-stats-->
<!--            statSubtitle="Closed report"-->
<!--            statTitle="12"-->
<!--            statArrow="down"-->
<!--            statPercent="1.10"-->
<!--            statPercentColor="text-orange-500"-->
<!--            statDescripiron="Since yesterday"-->
<!--            statIconName="fas fa-users"-->
<!--            statIconColor="bg-pink-500"-->
<!--          />-->
<!--        </div>-->
<!--        <div class="w-full lg:w-6/12 xl:w-3/12 px-4">-->
<!--          <card-stats-->
<!--            statSubtitle="All reports"-->
<!--            statTitle="200"-->
<!--            statArrow="up"-->
<!--            statPercent="12"-->
<!--            statPercentColor="text-emerald-500"-->
<!--            statDescripiron="Since last month"-->
<!--            statIconName="fas fa-percent"-->
<!--            statIconColor="bg-emerald-500"-->
<!--          />-->
<!--        </div>-->
<!--      </div>-->

        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12">
              <div class="flex flex-wrap">
                <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4">
                  <card-line-chart :data="occurrences_months" />
                </div>
                <div class="w-full xl:w-4/12 px-4">
                  <card-bar-chart :data="month_reports" />
                </div>
              </div>
              <div class="flex flex-wrap mt-4">
                <div class="w-full mb-12 xl:mb-0 px-4">
                  <div class="notifications">
                    <notifications :notifications="notifications" />
                  </div>
                </div>
<!--                <div class="w-full xl:w-4/12 px-4">-->
<!--                  <card-social-traffic />-->
<!--                </div>-->
              </div>

            </div>
        </div>
    </AppLayout>
</template>
