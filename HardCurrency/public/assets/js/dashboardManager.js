(function ($) {
  'use strict';
  $(async function () {

    const options = {
      method: "GET",
      headers: { "Content-Type": "application/json" }
    }
// console.log(process)
// console.log("ajaj")

    // const currencies_growth = await fetch("currencygrowth", options)
    //   .then((response) => response.json())

    // let topCurrencies = currencies_growth.currencies.slice(0, 3)

    // console.log(topCurrencies);
    
    // const months = []
    // const datasets = []
    // const total = []
    // Object.entries(currencies_growth.data).map(currency => {
    //   months.push(currency[1].month)
    //   Object.entries(currency[1].growth).map(growth => {
    //     let length = Object.entries(currencies_growth).length
    //     currencies.push(growth[1].name)
    //     total.push(growth[1].total)
    //   });
    // });


    Chart.defaults.global.legend.labels.usePointStyle = true;

    if ($("#visit-sale-chart").length) {
      Chart.defaults.global.legend.labels.usePointStyle = true;
      var ctx = document.getElementById('visit-sale-chart').getContext("2d");

      var gradientStrokeViolet = ctx.createLinearGradient(0, 0, 0, 181);
      gradientStrokeViolet.addColorStop(0, 'rgba(218, 140, 255, 1)');
      gradientStrokeViolet.addColorStop(1, 'rgba(154, 85, 255, 1)');
      var gradientLegendViolet = 'linear-gradient(to right, rgba(218, 140, 255, 1), rgba(154, 85, 255, 1))';

      var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 360);
      gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
      gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');
      var gradientLegendBlue = 'linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))';

      var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
      gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
      var gradientLegendRed = 'linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))';

      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس'],
          // labels: months,
          datasets: [
            {
              label: "دولار امريكي",
              borderColor: gradientStrokeViolet,
              backgroundColor: gradientStrokeViolet,
              hoverBackgroundColor: gradientStrokeViolet,
              legendColor: gradientLegendViolet,
              pointRadius: 0,
              fill: false,
              borderWidth: 1,
              fill: 'origin',
              data: [20, 40, 15, 35, 25, 50, 30, 20]
            },
            {
              label: "ريال سعودي",
              borderColor: gradientStrokeRed,
              backgroundColor: gradientStrokeRed,
              hoverBackgroundColor: gradientStrokeRed,
              legendColor: gradientLegendRed,
              pointRadius: 0,
              fill: false,
              borderWidth: 1,
              fill: 'origin',
              data: [40, 30, 20, 10, 50, 15, 35, 40]
            },
            {
              label: "درهم اماراتي",
              borderColor: gradientStrokeBlue,
              backgroundColor: gradientStrokeBlue,
              hoverBackgroundColor: gradientStrokeBlue,
              legendColor: gradientLegendBlue,
              pointRadius: 0,
              fill: false,
              borderWidth: 1,
              fill: 'origin',
              data: [70, 10, 30, 40, 25, 50, 15, 30]
            }
          ]
        },
        options: {
          responsive: true,
          legend: false,
          legendCallback: function (chart) {
            var text = [];
            text.push('<ul>');
            for (var i = 0; i < chart.data.datasets.length; i++) {
              text.push('<li><span class="legend-dots" style="background:' +
                chart.data.datasets[i].legendColor +
                '"></span>');
              if (chart.data.datasets[i].label) {
                text.push(chart.data.datasets[i].label);
              }
              text.push('</li>');
            }
            text.push('</ul>');
            return text.join('');
          },
          scales: {
            yAxes: [{
              ticks: {
                display: false,
                min: 0,
                stepSize: 20,
                max: 80
              },
              gridLines: {
                drawBorder: false,
                color: 'rgba(235,237,242,1)',
                zeroLineColor: 'rgba(235,237,242,1)'
              }
            }],
            xAxes: [{
              gridLines: {
                display: false,
                drawBorder: false,
                color: 'rgba(0,0,0,1)',
                zeroLineColor: 'rgba(235,237,242,1)'
              },
              ticks: {
                padding: 20,
                fontColor: "#9c9fa6",
                autoSkip: true,
              },
              categoryPercentage: 0.5,
              barPercentage: 0.5
            }]
          }
        },
        elements: {
          point: {
            radius: 0
          }
        }
      })
      $("#visit-sale-chart-legend").html(myChart.generateLegend());
    }
    if ($("#traffic-chart").length) {
      var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 181);
      gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
      gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');
      var gradientLegendBlue = 'linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))';

      var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 50);
      gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
      gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
      var gradientLegendRed = 'linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))';

      var gradientStrokeGreen = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStrokeGreen.addColorStop(0, 'rgba(6, 185, 157, 1)');
      gradientStrokeGreen.addColorStop(1, 'rgba(132, 217, 210, 1)');
      var gradientLegendGreen = 'linear-gradient(to right, rgba(6, 185, 157, 1), rgba(132, 217, 210, 1))';



      const top_branches = await fetch("top_branches", options)
      .then((response) => response.json())

      const data = top_branches.data
      const process = []
      const branches = []
      Object.entries(data).map(branch => {
        console.log("branch")
        console.log(branch)
        process.push(branch[1].processes)
        branches.push(branch[1].branch.branch_name)
      });
      console.log(branches)

      var trafficChartData = {
        datasets: [{
          data: process,
          backgroundColor: [
            gradientStrokeBlue,
            gradientStrokeGreen,
            gradientStrokeRed
          ],
          hoverBackgroundColor: [
            gradientStrokeBlue,
            gradientStrokeGreen,
            gradientStrokeRed
          ],
          borderColor: [
            gradientStrokeBlue,
            gradientStrokeGreen,
            gradientStrokeRed
          ],
          legendColor: [
            gradientLegendBlue,
            gradientLegendGreen,
            gradientLegendRed
          ]
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: branches
      };
      var trafficChartOptions = {
        responsive: true,
        animation: {
          animateScale: true,
          animateRotate: true
        },
        legend: false,
        legendCallback: function (chart) {
          var text = [];
          text.push('<ul>');
          for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) {
            text.push('<li><span class="legend-dots" style="background:' +
              trafficChartData.datasets[0].legendColor[i] +
              '"></span>');
            if (trafficChartData.labels[i]) {
              text.push(trafficChartData.labels[i]);
            }
            text.push('<span class="float-right">' + trafficChartData.datasets[0].data[i] + "%" + '</span>')
            text.push('</li>');
          }
          text.push('</ul>');
          return text.join('');
        }
      };
      var trafficChartCanvas = $("#traffic-chart").get(0).getContext("2d");
      var trafficChart = new Chart(trafficChartCanvas, {
        type: 'doughnut',
        data: trafficChartData,
        options: trafficChartOptions
      });
      $("#traffic-chart-legend").html(trafficChart.generateLegend());
    }
    if ($("#inline-datepicker").length) {
      $('#inline-datepicker').datepicker({
        enableOnReadonly: true,
        todayHighlight: true,
      });
    }
  });
})(jQuery);
