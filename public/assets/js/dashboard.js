(function ($) {
    "use strict";
    $(function () {
        Chart.defaults.global.legend.labels.usePointStyle = true;

        if ($("#traffic-chart").length) {
            Chart.defaults.global.legend.labels.usePointStyle = true;
            var ctx = document.getElementById("traffic-chart").getContext("2d");

            var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 181);
            gradientStrokeBlue.addColorStop(0, "rgba(54, 215, 232, 1)");
            gradientStrokeBlue.addColorStop(1, "rgba(177, 148, 250, 1)");
            var gradientLegendBlue =
                "linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))";

            var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 50);
            gradientStrokeRed.addColorStop(0, "rgba(255, 191, 150, 1)");
            gradientStrokeRed.addColorStop(1, "rgba(254, 112, 150, 1)");
            var gradientLegendRed =
                "linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))";

            var suratMasuk = $("#traffic-chart").data("sm-bln");
            var suratKeluar = $("#traffic-chart").data("sk-bln");

            var trafficChartData = {
                datasets: [
                    {
                        data: [suratMasuk, suratKeluar],
                        backgroundColor: [
                            gradientStrokeRed,
                            gradientStrokeBlue,
                        ],
                        hoverBackgroundColor: [
                            gradientStrokeRed,
                            gradientStrokeBlue,
                        ],
                        borderColor: [gradientStrokeRed, gradientStrokeBlue],
                        legendColor: [gradientLegendRed, gradientLegendBlue],
                    },
                ],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: ["Surat Masuk", "Surat Keluar"],
            };
            var trafficChartOptions = {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true,
                },
                legend: false,
                legendCallback: function (chart) {
                    var text = [];
                    text.push("<ul>");
                    for (
                        var i = 0;
                        i < trafficChartData.datasets[0].data.length;
                        i++
                    ) {
                        text.push(
                            '<li><span class="legend-dots" style="background:' +
                                trafficChartData.datasets[0].legendColor[i] +
                                '"></span>'
                        );
                        if (trafficChartData.labels[i]) {
                            text.push(trafficChartData.labels[i]);
                        }
                        text.push(
                            '<span class="float-right">: ' +
                                trafficChartData.datasets[0].data[i] +
                                "</span>"
                        );
                        text.push("</li>");
                    }
                    text.push("</ul>");
                    return text.join("");
                },
            };
            var trafficChartCanvas = $("#traffic-chart")
                .get(0)
                .getContext("2d");
            var trafficChart = new Chart(trafficChartCanvas, {
                type: "doughnut",
                data: trafficChartData,
                options: trafficChartOptions,
            });
            $("#traffic-chart-legend").html(trafficChart.generateLegend());
        }

        if ($("#jenis-sm-chart").length) {
            var jenisName = document
                .getElementById("jenis-sm-chart")
                .getAttribute("data-jns-name");

            var jenis_name = JSON.parse(jenisName);
            // jumlah warna yang ingin digunakan pada gradient
            var num_colors = jenisName.length;

            // array kosong untuk menyimpan nilai warna gradient
            var gradientColors = [];

            // loop untuk mengisi array gradientColors dengan warna
            for (var i = 0; i < num_colors; i++) {
                var gradientStep = 1 / num_colors;
                var color =
                    "rgba(" + (210 - i * 50) + "," + 0 + "," + 50 + ", 1)";
                gradientColors.push(color);
            }

            // membuat gradient warna pada chart
            var gradientStroke = ctx.createLinearGradient(0, 0, 0, 50);
            for (var i = 0; i < num_colors; i++) {
                gradientStroke.addColorStop(
                    i * gradientStep,
                    gradientColors[i]
                );
            }

            var trafficChartData = {
                datasets: [
                    {
                        data: sm_jns_count,
                        backgroundColor: gradientColors.slice(
                            0,
                            jenisName.length
                        ),
                        hoverBackgroundColor: gradientColors.slice(
                            0,
                            jenisName.length
                        ),
                        borderColor: gradientColors.slice(0, jenisName.length),
                        legendColor: gradientColors.slice(0, jenisName.length),
                    },
                ],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: jenis_name,
            };
            var trafficChartOptions = {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true,
                },
                legend: false,
                legendCallback: function (chart) {
                    var text = [];
                    text.push("<ul>");
                    for (
                        var i = 0;
                        i < trafficChartData.datasets[0].data.length;
                        i++
                    ) {
                        text.push(
                            '<li><span class="legend-dots" style="background:' +
                                trafficChartData.datasets[0].legendColor[i] +
                                '"></span>'
                        );
                        if (trafficChartData.labels[i]) {
                            text.push(trafficChartData.labels[i]);
                        }
                        text.push(
                            '<span class="float-right">: ' +
                                trafficChartData.datasets[0].data[i] +
                                "</span>"
                        );
                        text.push("</li>");
                    }
                    text.push("</ul>");
                    return text.join("");
                },
            };
            var trafficChartCanvas = $("#jenis-sm-chart")
                .get(0)
                .getContext("2d");
            var trafficChart = new Chart(trafficChartCanvas, {
                type: "doughnut",
                data: trafficChartData,
                options: trafficChartOptions,
            });
            $("#jenis-sm-chart-legend").html(trafficChart.generateLegend());
        }
        if ($("#jenis-sk-chart").length) {
            var jenisName = document
                .getElementById("jenis-sk-chart")
                .getAttribute("data-jns-name");
            var jenis_name = JSON.parse(jenisName);
            // jumlah warna yang ingin digunakan pada gradient
            var num_colors = jenisName.length;

            // array kosong untuk menyimpan nilai warna gradient
            var gradientColors = [];

            // loop untuk mengisi array gradientColors dengan warna
            for (var i = 0; i < num_colors; i++) {
                var gradientStep = 1 / num_colors;
                var color =
                    "rgba(" + 50 + "," + 0 + "," + (210 - i * 50) + ", 1)";
                gradientColors.push(color);
            }

            // membuat gradient warna pada chart
            var gradientStroke = ctx.createLinearGradient(0, 0, 0, 50);
            for (var i = 0; i < num_colors; i++) {
                gradientStroke.addColorStop(
                    i * gradientStep,
                    gradientColors[i]
                );
            }

            var trafficChartData = {
                datasets: [
                    {
                        data: sk_jns_count,
                        backgroundColor: gradientColors.slice(
                            0,
                            jenisName.length
                        ),
                        hoverBackgroundColor: gradientColors.slice(
                            0,
                            jenisName.length
                        ),
                        borderColor: gradientColors.slice(0, jenisName.length),
                        legendColor: gradientColors.slice(0, jenisName.length),
                    },
                ],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: jenis_name,
            };
            var trafficChartOptions = {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true,
                },
                legend: false,
                legendCallback: function (chart) {
                    var text = [];
                    text.push("<ul>");
                    for (
                        var i = 0;
                        i < trafficChartData.datasets[0].data.length;
                        i++
                    ) {
                        text.push(
                            '<li><span class="legend-dots" style="background:' +
                                trafficChartData.datasets[0].legendColor[i] +
                                '"></span>'
                        );
                        if (trafficChartData.labels[i]) {
                            text.push(trafficChartData.labels[i]);
                        }
                        text.push(
                            '<span class="float-right">: ' +
                                trafficChartData.datasets[0].data[i] +
                                "</span>"
                        );
                        text.push("</li>");
                    }
                    text.push("</ul>");
                    return text.join("");
                },
            };
            var trafficChartCanvas = $("#jenis-sk-chart")
                .get(0)
                .getContext("2d");
            var trafficChart = new Chart(trafficChartCanvas, {
                type: "doughnut",
                data: trafficChartData,
                options: trafficChartOptions,
            });
            $("#jenis-sk-chart-legend").html(trafficChart.generateLegend());
        }
    });
})(jQuery);
