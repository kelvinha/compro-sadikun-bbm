"use strict";
function floatchart() {
    new ApexCharts(document.querySelector("#all-earnings-graph"), {
        chart: { type: "bar", height: 50, sparkline: { enabled: !0 } },
        colors: ["#1C582C"],
        plotOptions: { bar: { borderRadius: 2, columnWidth: "80%" } },
        series: [{ data: [10, 30, 40, 20, 60, 50, 20, 15, 20, 25, 30, 25] }],
        xaxis: { crosshairs: { width: 1 } },
        tooltip: {
            fixed: { enabled: !1 },
            x: { show: !1 },
            y: {
                title: {
                    formatter: function (e) {
                        return "";
                    },
                },
            },
            marker: { show: !1 },
        },
    }).render(),
        new ApexCharts(document.querySelector("#page-views-graph"), {
            chart: { type: "bar", height: 50, sparkline: { enabled: !0 } },
            colors: ["#E58A00"],
            plotOptions: { bar: { borderRadius: 2, columnWidth: "80%" } },
            series: [
                { data: [10, 30, 40, 20, 60, 50, 20, 15, 20, 25, 30, 25] },
            ],
            xaxis: { crosshairs: { width: 1 } },
            tooltip: {
                fixed: { enabled: !1 },
                x: { show: !1 },
                y: {
                    title: {
                        formatter: function (e) {
                            return "";
                        },
                    },
                },
                marker: { show: !1 },
            },
        }).render(),
        new ApexCharts(document.querySelector("#total-task-graph"), {
            chart: { type: "bar", height: 50, sparkline: { enabled: !0 } },
            colors: ["#2CA87F"],
            plotOptions: { bar: { borderRadius: 2, columnWidth: "80%" } },
            series: [
                { data: [10, 30, 40, 20, 60, 50, 20, 15, 20, 25, 30, 25] },
            ],
            xaxis: { crosshairs: { width: 1 } },
            tooltip: {
                fixed: { enabled: !1 },
                x: { show: !1 },
                y: {
                    title: {
                        formatter: function (e) {
                            return "";
                        },
                    },
                },
                marker: { show: !1 },
            },
        }).render(),
        new ApexCharts(document.querySelector("#download-graph"), {
            chart: { type: "bar", height: 50, sparkline: { enabled: !0 } },
            colors: ["#DC2626"],
            plotOptions: { bar: { borderRadius: 2, columnWidth: "80%" } },
            series: [
                { data: [10, 30, 40, 20, 60, 50, 20, 15, 20, 25, 30, 25] },
            ],
            xaxis: { crosshairs: { width: 1 } },
            tooltip: {
                fixed: { enabled: !1 },
                x: { show: !1 },
                y: {
                    title: {
                        formatter: function (e) {
                            return "";
                        },
                    },
                },
                marker: { show: !1 },
            },
        }).render(),
        new ApexCharts(document.querySelector("#customer-rate-graph"), {
            chart: { type: "area", height: 230, toolbar: { show: !1 } },
            colors: ["#1C582C"],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    type: "vertical",
                    inverseColors: !1,
                    opacityFrom: 0.5,
                    opacityTo: 0,
                },
            },
            dataLabels: { enabled: !1 },
            stroke: { width: 1 },
            plotOptions: { bar: { columnWidth: "45%", borderRadius: 4 } },
            grid: { strokeDashArray: 4 },
            series: [
                { data: [30, 60, 40, 70, 50, 90, 50, 55, 45, 60, 50, 65] },
            ],
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
            },
        }).render(),
        new ApexCharts(document.querySelector("#total-tasks-graph"), {
            chart: {
                type: "area",
                height: 60,
                stacked: !0,
                sparkline: { enabled: !0 },
            },
            colors: ["#1C582C"],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    type: "vertical",
                    inverseColors: !1,
                    opacityFrom: 0.5,
                    opacityTo: 0,
                },
            },
            stroke: { curve: "smooth", width: 2 },
            series: [{ data: [5, 25, 3, 10, 4, 50, 0] }],
        }).render(),
        new ApexCharts(document.querySelector("#pending-tasks-graph"), {
            chart: {
                type: "area",
                height: 60,
                stacked: !0,
                sparkline: { enabled: !0 },
            },
            colors: ["#DC2626"],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    type: "vertical",
                    inverseColors: !1,
                    opacityFrom: 0.5,
                    opacityTo: 0,
                },
            },
            stroke: { curve: "smooth", width: 2 },
            series: [{ data: [0, 50, 4, 10, 3, 25, 5] }],
        }).render(),
        new ApexCharts(document.querySelector("#total-income-graph"), {
            chart: { height: 320, type: "donut" },
            series: [27, 23, 20, 17],
            colors: ["#1C582C", "#E58A00", "#2CA87F", "#1C582C"],
            labels: ["Total income", "Total rent", "Download", "Views"],
            fill: { opacity: [1, 1, 1, 0.3] },
            legend: { show: !1 },
            plotOptions: {
                pie: {
                    donut: {
                        size: "65%",
                        labels: {
                            show: !0,
                            name: { show: !0 },
                            value: { show: !0 },
                        },
                    },
                },
            },
            dataLabels: { enabled: !1 },
            responsive: [
                {
                    breakpoint: 575,
                    options: {
                        chart: { height: 250 },
                        plotOptions: {
                            pie: {
                                donut: { size: "65%", labels: { show: !1 } },
                            },
                        },
                    },
                },
            ],
        }).render(),
        new ApexCharts(document.querySelector("#new-orders-graph"), {
            chart: { type: "bar", height: 80, sparkline: { enabled: !0 } },
            colors: ["#1C582C"],
            plotOptions: { bar: { borderRadius: 4, columnWidth: "80%" } },
            series: [
                { data: [10, 30, 40, 20, 60, 50, 20, 15, 20, 25, 30, 25] },
            ],
            xaxis: { crosshairs: { width: 1 } },
            tooltip: {
                fixed: { enabled: !1 },
                x: { show: !1 },
                y: {
                    title: {
                        formatter: function (e) {
                            return "";
                        },
                    },
                },
                marker: { show: !1 },
            },
        }).render(),
        new ApexCharts(document.querySelector("#new-users-graph"), {
            chart: { type: "area", height: 80, sparkline: { enabled: !0 } },
            colors: ["#2CA87F"],
            stroke: { width: 1 },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    type: "vertical",
                    inverseColors: !1,
                    opacityFrom: 0.5,
                    opacityTo: 0,
                },
            },
            dataLabels: { enabled: !1 },
            series: [{ data: [1, 1, 60, 1, 1, 50, 1, 1, 40, 1, 1, 25, 0] }],
            tooltip: {
                fixed: { enabled: !1 },
                x: { show: !1 },
                y: {
                    title: {
                        formatter: function (e) {
                            return "";
                        },
                    },
                },
                marker: { show: !1 },
            },
        }).render(),
        new ApexCharts(document.querySelector("#visitors-graph"), {
            series: [
                {
                    data: [
                        { x: "", y: [1, 6] },
                        { x: "", y: [3, 7] },
                        { x: "", y: [4, 8] },
                        { x: "", y: [5, 9] },
                        { x: "", y: [4, 8] },
                        { x: "", y: [4, 7] },
                        { x: "", y: [2, 5] },
                    ],
                },
            ],
            chart: {
                type: "rangeBar",
                height: 80,
                sparkline: { enabled: !0 },
                toolbar: { show: !1 },
            },
            colors: ["#E58A00"],
            plotOptions: {
                bar: { columnWidth: "30%", borderRadius: 5, horizontal: !1 },
            },
            yaxis: { tickAmount: 2, min: 0, max: 10 },
            grid: {
                show: !1,
                padding: { top: 0, right: 0, bottom: 0, left: 0 },
            },
            xaxis: {
                labels: { show: !1 },
                axisBorder: { show: !1 },
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
            },
            dataLabels: { enabled: !1 },
        }).render();
    var e = {
        chart: { height: 250, type: "bar", toolbar: { show: !1 } },
        plotOptions: {
            bar: {
                horizontal: !1,
                columnWidth: "55%",
                borderRadius: 4,
                borderRadiusApplication: "end",
            },
        },
        legend: { show: !0, position: "top", horizontalAlign: "left" },
        dataLabels: { enabled: !1 },
        colors: ["#1C582C", "#1C582C"],
        stroke: { show: !0, width: 3, colors: ["transparent"] },
        fill: { colors: ["#1C582C", "#1C582C"], opacity: [1, 0.5] },
        grid: { strokeDashArray: 4 },
        series: [
            { name: "Net Profit", data: [76, 85, 101, 98, 87, 105, 91] },
            { name: "Revenue", data: [44, 55, 57, 56, 61, 58, 63] },
        ],
        xaxis: {
            categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
        },
        tooltip: {
            y: {
                formatter: function (e) {
                    return "$ " + e + " thousands";
                },
            },
        },
    };
    new ApexCharts(document.querySelector("#overview-chart-1"), e).render(),
        new ApexCharts(document.querySelector("#overview-chart-3"), e).render(),
        (e = {
            chart: { height: 250, type: "bar", toolbar: { show: !1 } },
            plotOptions: {
                bar: {
                    horizontal: !1,
                    columnWidth: "55%",
                    borderRadius: 4,
                    borderRadiusApplication: "end",
                },
            },
            legend: { show: !0, position: "top", horizontalAlign: "left" },
            dataLabels: { enabled: !1 },
            colors: ["#1C582C", "#1C582C"],
            stroke: { show: !0, width: 3, colors: ["transparent"] },
            fill: { colors: ["#1C582C", "#1C582C"], opacity: [1, 0.5] },
            grid: { strokeDashArray: 4 },
            series: [
                { name: "Net Profit", data: [98, 87, 105, 91, 76, 85, 101] },
                { name: "Revenue", data: [56, 61, 58, 63, 44, 55, 57] },
            ],
            xaxis: {
                categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
            },
            tooltip: {
                y: {
                    formatter: function (e) {
                        return "$ " + e + " thousands";
                    },
                },
            },
        }),
        new ApexCharts(document.querySelector("#overview-chart-2"), e).render(),
        new ApexCharts(document.querySelector("#overview-chart-4"), e).render(),
        new ApexCharts(document.querySelector("#income-graph"), {
            chart: { type: "bar", height: 80, sparkline: { enabled: !0 } },
            colors: ["#2CA87F"],
            plotOptions: { bar: { columnWidth: "80%" } },
            series: [
                { data: [10, 30, 40, 20, 60, 50, 20, 15, 20, 25, 30, 25] },
            ],
            xaxis: { crosshairs: { width: 1 } },
            tooltip: {
                fixed: { enabled: !1 },
                x: { show: !1 },
                y: {
                    title: {
                        formatter: function (e) {
                            return "";
                        },
                    },
                },
                marker: { show: !1 },
            },
        }).render(),
        new ApexCharts(document.querySelector("#languages-graph"), {
            chart: { type: "area", height: 130, sparkline: { enabled: !0 } },
            colors: ["#1890ff"],
            plotOptions: { bar: { columnWidth: "80%" } },
            series: [
                {
                    data: [
                        100, 140, 100, 250, 115, 125, 90, 100, 140, 100, 230,
                        115, 215, 90, 190, 100, 120, 180,
                    ],
                },
            ],
            xaxis: { crosshairs: { width: 1 } },
            stroke: { width: 1.5 },
            tooltip: {
                fixed: { enabled: !1 },
                x: { show: !1 },
                y: {
                    title: {
                        formatter: function (e) {
                            return "";
                        },
                    },
                },
                marker: { show: !1 },
            },
        }).render(),
        new ApexCharts(document.querySelector("#overview-product-graph"), {
            chart: { height: 350, type: "pie" },
            labels: [
                "Components",
                "Widgets",
                "Pages",
                "Forms",
                "Other",
                "Apps",
            ],
            series: [40, 20, 10, 15, 5, 10],
            colors: [
                "#1C582C",
                "#1C582C",
                "#212529",
                "#212529",
                "#212529",
                "#212529",
            ],
            fill: { opacity: [1, 0.6, 0.4, 0.6, 0.8, 1] },
            legend: { show: !1 },
            dataLabels: { enabled: !0, dropShadow: { enabled: !1 } },
            responsive: [
                {
                    breakpoint: 575,
                    options: {
                        chart: { height: 250 },
                        dataLabels: { enabled: !1 },
                    },
                },
            ],
        }).render(),
        (e = {
            series: [30],
            chart: { height: 150, type: "radialBar" },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 0,
                        size: "60%",
                        background: "transparent",
                        imageOffsetX: 0,
                        imageOffsetY: 0,
                        position: "front",
                    },
                    track: { background: "#1C582C50", strokeWidth: "50%" },
                    dataLabels: {
                        show: !0,
                        name: { show: !1 },
                        value: {
                            formatter: function (e) {
                                return parseInt(e);
                            },
                            offsetY: 7,
                            color: "#1C582C",
                            fontSize: "20px",
                            fontWeight: "700",
                            show: !0,
                        },
                    },
                },
            },
            colors: ["#1C582C"],
            fill: { type: "solid" },
            stroke: { lineCap: "round" },
        }),
        new ApexCharts(
            document.querySelector("#total-earning-graph-1"),
            e
        ).render(),
        (e = {
            series: [30],
            chart: { height: 150, type: "radialBar" },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 0,
                        size: "60%",
                        background: "transparent",
                        imageOffsetX: 0,
                        imageOffsetY: 0,
                        position: "front",
                    },
                    track: { background: "#DC262650", strokeWidth: "50%" },
                    dataLabels: {
                        show: !0,
                        name: { show: !1 },
                        value: {
                            formatter: function (e) {
                                return parseInt(e);
                            },
                            offsetY: 7,
                            color: "#DC2626",
                            fontSize: "20px",
                            fontWeight: "700",
                            show: !0,
                        },
                    },
                },
            },
            colors: ["#DC2626"],
            fill: { type: "solid" },
            stroke: { lineCap: "round" },
        }),
        new ApexCharts(
            document.querySelector("#total-earning-graph-2"),
            e
        ).render(),
        new ApexCharts(document.querySelector("#monthly-report-graph"), {
            series: [
                {
                    name: "Deals",
                    data: [44, 55, 41, 67, 52, 53, 13, 23, 20, 8, 13, 27],
                },
                {
                    name: "Income Report",
                    data: [13, 23, 20, 8, 13, 27, 21, 7, 25, 13, 22, 8],
                },
                {
                    name: "Customer",
                    data: [11, 17, 15, 15, 21, 14, 11, 17, 15, 15, 21, 14],
                },
                {
                    name: "Profits",
                    data: [21, 7, 25, 13, 22, 3, 44, 55, 41, 67, 22, 12],
                },
            ],
            chart: {
                type: "bar",
                height: 350,
                stacked: !0,
                toolbar: { show: !1 },
            },
            colors: ["#1C582C", "#1C582C", "#1C582C", "#E58A00"],
            fill: { opacity: [1, 0.7, 0.4, 0.3] },
            grid: { strokeDashArray: 4 },
            dataLabels: { enabled: !1 },
            plotOptions: { bar: { horizontal: !1 } },
            xaxis: {
                categories: [
                    "1",
                    "2",
                    "3",
                    "4",
                    "5",
                    "6",
                    "7",
                    "8",
                    "9",
                    "10",
                    "11",
                    "12",
                ],
            },
            legend: { show: !1 },
        }).render(),
        (e = {
            chart: { type: "bar", height: 430, toolbar: { show: !1 } },
            plotOptions: { bar: { columnWidth: "40%", borderRadius: 4 } },
            stroke: { show: !0, width: 8, colors: ["transparent"] },
            dataLabels: { enabled: !1 },
            legend: {
                position: "top",
                horizontalAlign: "right",
                show: !0,
                fontFamily: "'Public Sans', sans-serif",
                offsetX: 10,
                offsetY: 10,
                labels: { useSeriesColors: !1 },
                markers: {
                    width: 10,
                    height: 10,
                    radius: "50%",
                    offsexX: 2,
                    offsexY: 2,
                },
                itemMargin: { horizontal: 15, vertical: 5 },
            },
            colors: ["#E58A00", "#1C582C"],
            series: [
                { name: "Net Profit", data: [180, 90, 135, 114, 120, 145] },
                { name: "Revenue", data: [120, 45, 78, 150, 168, 99] },
            ],
            xaxis: { categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"] },
        }),
        new ApexCharts(
            document.querySelector("#sales-report-chart"),
            e
        ).render(),
        new ApexCharts(document.querySelector("#acquisition-chart"), {
            chart: {
                type: "bar",
                height: 250,
                stacked: !0,
                toolbar: { show: !1 },
            },
            legend: {
                show: !0,
                position: "bottom",
                horizontalAlign: "left",
                offsetX: 10,
                markers: { width: 8, height: 8, radius: "50%" },
            },
            dataLabels: { enabled: !1 },
            grid: { show: !1 },
            stroke: { colors: ["transparent"], width: 1 },
            colors: ["#0F172A", "#1C582C", "#1C582C"],
            fill: { opacity: [1, 0.6, 1] },
            series: [
                {
                    name: "Direct",
                    data: [
                        21, 17, 15, 13, 15, 13, 16, 13, 8, 14, 11, 9, 7, 5, 3,
                        3, 7,
                    ],
                },
                {
                    name: "Referral",
                    data: [
                        28, 30, 20, 26, 18, 27, 22, 28, 20, 21, 15, 14, 12, 10,
                        8, 18, 16,
                    ],
                },
                {
                    name: "Social",
                    data: [
                        50, 51, 60, 54, 53, 48, 55, 40, 44, 42, 44, 44, 42, 40,
                        42, 32, 16,
                    ],
                },
            ],
            xaxis: {
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
                labels: { show: !1 },
            },
            yaxis: {
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
                labels: { show: !1 },
            },
        }).render();
}
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        floatchart();
    }, 500);
});
