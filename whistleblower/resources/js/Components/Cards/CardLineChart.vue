<template>
  <div
    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-blueGray-700"
  >
    <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full max-w-full flex-grow flex-1">
          <h2 class="text-white text-xl font-semibold">
            {{$t('Occurrences timeline')}}
          </h2>
        </div>
      </div>
    </div>
    <div class="p-4 flex-auto">
      <!-- Chart -->
      <div class="relative h-350-px">
        <canvas id="line-chart"></canvas>
      </div>
    </div>
  </div>
</template>
<script>
import Chart from "chart.js";

export default {
  props: {
    data: {
      type: Array,
      default: [],
    },
  },
  mounted: function () {
    this.$nextTick(function () {
      const locales = (this.$page.props.current_locale === 'de') ? 'de-DE' : 'en-Us';
      const currentDate = new Date();
      const currentYear = currentDate.getFullYear();
      var config = {
        type: "line",
        data: {
          labels: [
            new Date(currentYear, 0, 1).toLocaleString(locales, { month: 'long' }),
            new Date(currentYear, 1, 1).toLocaleString(locales, { month: 'long' }),
            new Date(currentYear, 2, 1).toLocaleString(locales, { month: 'long' }),
            new Date(currentYear, 3, 1).toLocaleString(locales, { month: 'long' }),
            new Date(currentYear, 4, 1).toLocaleString(locales, { month: 'long' }),
            new Date(currentYear, 5, 1).toLocaleString(locales, { month: 'long' }),
            new Date(currentYear, 6, 1).toLocaleString(locales, { month: 'long' }),
            new Date(currentYear, 7, 1).toLocaleString(locales, { month: 'long' }),
            new Date(currentYear, 8, 1).toLocaleString(locales, { month: 'long' }),
            new Date(currentYear, 9, 1).toLocaleString(locales, { month: 'long' }),
            new Date(currentYear, 10, 1).toLocaleString(locales, { month: 'long' }),
            new Date(currentYear, 11, 1).toLocaleString(locales, { month: 'long' }),
          ],
          datasets: [
            {
              label: currentYear,
              backgroundColor: "#4c51bf",
              borderColor: "#4c51bf",
              // data: [65, 78, 66, 44, 56, 67, 75],
              data: this.data[currentYear],
              fill: false,
            },
            // {
            //   label: new Date().getFullYear() - 1,
            //   fill: false,
            //   backgroundColor: "#fff",
            //   borderColor: "#fff",
            //   data: this.data[new Date().getFullYear() - 1],
            // },
          ],
        },
        options: {
          maintainAspectRatio: false,
          responsive: true,
          title: {
            display: false,
            text: "Sales Charts",
            fontColor: "white",
          },
          legend: {
            labels: {
              fontColor: "white",
            },
            align: "end",
            position: "bottom",
          },
          tooltips: {
            mode: "index",
            intersect: false,
          },
          hover: {
            mode: "nearest",
            intersect: true,
          },
          scales: {
            xAxes: [
              {
                ticks: {
                  fontColor: "rgba(255,255,255,.7)",
                },
                display: true,
                scaleLabel: {
                  display: false,
                  labelString: "Month",
                  fontColor: "white",
                },
                gridLines: {
                  display: false,
                  borderDash: [2],
                  borderDashOffset: [2],
                  color: "rgba(33, 37, 41, 0.3)",
                  zeroLineColor: "rgba(0, 0, 0, 0)",
                  zeroLineBorderDash: [2],
                  zeroLineBorderDashOffset: [2],
                },
              },
            ],
            yAxes: [
              {
                ticks: {
                  fontColor: "rgba(255,255,255,.7)",
                  min: 0,
                  beginAtZero: true,
                  callback: function(value, index, values) {
                    if (Math.floor(value) === value) {
                      return value;
                    }
                  }
                },
                display: true,
                scaleLabel: {
                  display: false,
                  labelString: "Value",
                  fontColor: "white",
                },
                gridLines: {
                  borderDash: [3],
                  borderDashOffset: [3],
                  drawBorder: false,
                  color: "rgba(255, 255, 255, 0.15)",
                  zeroLineColor: "rgba(33, 37, 41, 0)",
                  zeroLineBorderDash: [2],
                  zeroLineBorderDashOffset: [2],
                },
              },
            ],
          },
        },
      };
      var ctx = document.getElementById("line-chart").getContext("2d");
      window.myLine = new Chart(ctx, config);
    });
  },
};
</script>
