<template>
  <div
    class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded"
  >
    <div class="rounded-t mb-0 px-4 py-3 bg-transparent">
      <div class="flex flex-wrap items-center">
        <div class="relative w-full max-w-full flex-grow flex-1">
          <h2 class="text-blueGray-700 text-xl font-semibold">
            {{$t('Occurrences total')}}
          </h2>
        </div>
      </div>
    </div>
    <div class="p-4 flex-auto">
      <div class="relative h-350-px">
        <canvas id="bar-chart"></canvas>
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
    // const dataset = [
    //   { date: '2023-05-01', value: 10 },
    //   { date: '2023-05-05', value: 20 },
    //   { date: '2023-05-15', value: 15 },
    //   { date: '2023-06-01', value: 5 },
    // ];

    const currentDate = new Date();
    const currentMonth = currentDate.getMonth() + 1;
    const previousMonth = currentDate.getMonth();

    // ############ Get Data for Current Month ################ //
    // Get the first day of the current month
    const dateFormat = currentDate.getFullYear() +"-"+ currentMonth +"-0" + 1;
    const firstDayOfMonth = new Date(dateFormat);
    // Filter the dataset to include only data points within the current month
    const filteredData = () => {
      if(this.data[currentMonth]){
        return this.data[currentMonth].filter(data => {
          const dataDate = new Date(data.day);
          return dataDate >= firstDayOfMonth;
        });
      }
      return null;
    }

    // Extract the dates and values from the filtered dataset
    const labels = () => {
      if (filteredData()){
        return filteredData().map(data => data.day);
      }
      return '';
    }

    const values = () => {
      if(filteredData()) {
        return filteredData().map(data => data.total);
      }
      return '';
    }

    const locales = (this.$page.props.current_locale === 'de') ? 'de-DE' : 'en-Us';

    // ############ Get Data for previous Month ################ //
    const previousDateFormat = currentDate.getFullYear() +"-"+ previousMonth +"-0" + 1;
    const firstDayOfpreviosMonth = new Date(previousDateFormat);
    const previousDatafilter = () => {
      if(this.data[previousMonth]){
        return this.data[previousMonth].filter(data => {
          const dataDate = new Date(data.day);
          return dataDate >= firstDayOfpreviosMonth;
        });
      }
      return null;
    }

    const previousValues = () => {
      if(previousDatafilter()){
        return previousDatafilter().map(data => data.total);
      }
      return '';
    }

    this.$nextTick(function () {
      let config = {
        type: "bar",
        data: {
          labels: labels(),
          datasets: [
            {
              label: new Date().toLocaleString(locales, { month: 'long' }),
              backgroundColor: "#ed64a6",
              borderColor: "#ed64a6",
              // data: [30, 78, 56, 34, 100, 45, 13],
              data: values(),
              fill: false,
              barThickness: 8,
            },
            {
              label: new Date(new Date().getFullYear(), new Date().getMonth() - 1, 1).toLocaleString(locales, { month: "long" }),
              fill: false,
              backgroundColor: "#4c51bf",
              borderColor: "#4c51bf",
              // data: [27, 68, 86, 74, 10, 4, 87],
              data: previousValues(),
              barThickness: 8,
            },
          ],
        },
        options: {
          maintainAspectRatio: false,
          responsive: true,
          title: {
            display: false,
            text: "Orders Chart",
          },
          tooltips: {
            mode: "index",
            intersect: false,
          },
          hover: {
            mode: "nearest",
            intersect: true,
          },
          legend: {
            labels: {
              fontColor: "rgba(0,0,0,.4)",
            },
            align: "end",
            position: "bottom",
          },
          scales: {
            xAxes: [
              {
                display: false,
                scaleLabel: {
                  display: true,
                  labelString: "Month",
                },
                gridLines: {
                  borderDash: [2],
                  borderDashOffset: [2],
                  color: "rgba(33, 37, 41, 0.3)",
                  zeroLineColor: "rgba(33, 37, 41, 0.3)",
                  zeroLineBorderDash: [2],
                  zeroLineBorderDashOffset: [2],
                },
              },
            ],
            yAxes: [
              {
                ticks: {
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
                },
                gridLines: {
                  borderDash: [2],
                  drawBorder: false,
                  borderDashOffset: [2],
                  color: "rgba(33, 37, 41, 0.2)",
                  zeroLineColor: "rgba(33, 37, 41, 0.15)",
                  zeroLineBorderDash: [2],
                  zeroLineBorderDashOffset: [2],
                },
              },
            ],
          },
        },
      };
      let ctx = document.getElementById("bar-chart").getContext("2d");
      window.myBar = new Chart(ctx, config);
    });
  },
};
</script>
