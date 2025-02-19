//company-viewchart start //
var options = {
  series: [
    {
      name: "This Month ",
      data: [150, 170, 230, 190, 200, 110, 300, 110, 220, 130, 110],
    },
    {
      name: "This Month",
      data: [150, 230, 200, 160, 230, 240, 160, 260, 280, 120 ,110],
    },
  ],
  chart: {
    height: 223,
    type: "line",
    zoom: {
      enabled: false,
    },
    toolbar: {
      show: false,
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    width: [4, 3],
    curve: "smooth",
    dashArray: [0, 8],
  },
  colors: [EnzoAdminConfig.primary, EnzoAdminConfig.secondary],
  markers: {
    size: 0,
    colors: ["#fff"],
    strokeColor: EnzoAdminConfig.primary,
    strokeWidth: 0,
  },
  xaxis: {
    categories: [
      "0",
      "10",
      "20",
      "30",
      "40",
      "50",
      "60",
      "70",
      "80",
      "90",
      "100",
    ],
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  yaxis: [
    {
      labels: {
        formatter: function (value) {
          return value + "k";
        },
      },
      max: 300,
      min: 100,
      tickAmount: 2
    },
  ],
  responsive: [
    {
      breakpoint: 1470,
      options: {
        xaxis: {
          offsetY: 20,
        },
      },
    },
  ],
  grid: {
    borderColor: "#f1f1f1",
  },
};
var chart = new ApexCharts(
  document.querySelector("#company-viewchart"),
  options
);
chart.render();
// company-viewchart end //

// profit chart start
var options1 = {
  chart: {
    height: 370,
    type: "radar",
    toolbar: {
      show: false,
    },
  },
  series: [
    {
      name: "This Month Profit",
      data: [60, 60, 20, 5, 70, 70, 85, 80],
    },
    {
      name: "This Month Profit",
      data: [100, 100, 0, 0, 0, 0, 0, 100],
    },
    {
      name: "This Month Profit",
      data: [0, 0, 0, 100, 100, 100, 0, 0],
    },
  ],
  stroke: {
    width: 0,
    curve: "smooth",
  },
  legend: {
    show: false,
  },
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"],
  grid: {
    borderColor: "#d3dbf4",
  },
  colors: [EnzoAdminConfig.primary],
  markers: {
    size: [4, 0, 0],
    colors: "#fff",
    strokeColor: EnzoAdminConfig.primary,
    strokeWidth: 3,
  },
  yaxis: {
    tickAmount: 6,
    show: false,
  },
  responsive: [
    {
      breakpoint: 1741,
      options: {
        chart: {
          height: 300,
        },
      },
    },
    {
      breakpoint: 1661,
      options: {
        chart: {
          height: 245,
        },
      },
    },
    {
      breakpoint: 1200,
      options: {
        chart: {
          height: 310,
        },
        xaxis: {
          offsetX: -10
        }
      },
    },
    {
      breakpoint: 992,
      options: {
        chart: {
          height: 300,
        },
      },
    },
    {
      breakpoint: 768,
      options: {
        chart: {
          height: 300,
        },
      },
    },
    {
      breakpoint: 421,
      options: {
        chart: {
          height: 270,
        },
      },
    },
  ],
};

var chart1 = new ApexCharts(document.querySelector("#profit-view"), options1);

chart1.render();

// profit chart end

// administator start
$(".browser-used  li ").on("click", function (e) {
  $(".browser-used  li").removeClass("active");
  $(this).addClass("active");
});

// sell view chart start
var options = {
  series: [
    {
      name: "Selling",
      data: [25, 70, 50, 70, 55, 25, 40, 50],
    },
    {
      name: "Selling",
      data: [-30, -15, -40, -70, -50, -60, -25, -70],
    },
  ],
  chart: {
    type: "bar",
    height: 370,
    stacked: true,
    toolbar: {
      show: false,
    },
  },
  colors: [EnzoAdminConfig.primary, EnzoAdminConfig.secondary],
  plotOptions: {
    bar: {
      horizontal: true,
      barHeight: "20%",
    },
  },
  dataLabels: {
    enabled: false,
  },
  legend: {
    show: false,
  },
  stroke: {
    curve: "smooth",
  },
  grid: {
    show: true,
    borderColor: "#f0f0f0",
    xaxis: {
      lines: {
        show: true,
      },
    },
    yaxis: {
      lines: {
        show: false,
      },
    },
  },
  yaxis: {
    labels: {
      show: false,
    },
  },
  xaxis: {
    min: -99,
    max: 99,
    tickAmount: 8,
    labels: {
      formatter: function (val) {
        return Math.abs(Math.round(val)) + "k";
      },
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  responsive: [
    {
      breakpoint: 1741,
      options: {
        chart: {
          height: 275,
        },
      },
    },
    {
      breakpoint: 1551,
      options: {
        chart: {
          height: 260,
        },
      },
    },
    {
      breakpoint: 1366,
      options: {
        chart: {
          height: 260,
        },
      },
    },
    {
      breakpoint: 1200,
      options: {
        chart: {
          height: 280,
        },
      },
    },
    {
      breakpoint: 768,
      options: {
        chart: {
          height: 220,
        },
      },
    },
  ],
};
var chart = new ApexCharts(document.querySelector("#sell-view"), options);
chart.render();
// sell view chart end

// Items-Slider Slick Slider

$(document).ready(function () {
  $(".items-slider").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    infinite: true,
    autoplaySpeed: 1000,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 421,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
});