//small chart-1
  new Chartist.Bar('.small-chart', {
      labels: ['Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7'],
      series: [
          [400, 900, 800, 1000, 700, 1200, 300],
          [1000, 500, 600, 400, 700, 200, 1100]
      ]
  }, {
      plugins: [
        Chartist.plugins.tooltip({
            appendToBody: false,
            className:"ct-tooltip"
        })
      ],
      stackBars: true,
      axisX: {
          showGrid: false,
          showLabel: false,
          offset: 0
      },
      axisY:{
          low: 0,
          showGrid: false,
          showLabel: false,
          offset: 0,
          labelInterpolationFnc: function (value) {
              return (value / 1000) + 'k';
          }
      }
  }).on('draw', function (data) {
      if (data.type === 'bar') {
          data.element.attr({
              style: 'stroke-width:5px'
          });
      }
  });


  //small-2
  new Chartist.Bar('.small-chart1',{
      labels:['Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7'],
      series:[
            [400, 600, 900, 800, 1000, 1200, 500],
            [1000, 800, 500, 600, 400, 200, 900]
        ]
    },{
      plugins: [
          Chartist.plugins.tooltip({
              appendToBody:false,
              className:"ct-tooltip"
          })
      ],
      stackBars:true,
      axisX: {
          showGrid:false,
          showLabel:false,
          offset: 0
      },
      axisY: {
          low: 0,
          showGrid:false,
          showLabel:false,
          offset:0,
          labelInterpolationFnc: function (value) {
              return (value / 1000) + 'k';
          }
      }
  }).on('draw', function (data) {
      if (data.type === 'bar') {
          data.element.attr({
              style: 'stroke-width: 5px'
          });
      }
  });


  // rounded chart start //
  (function($){
      "use strict";
      $(".knob1").knob({
          'width':76,
          'height':76,
          'max':100,
          change: function (value) {
            //console.log("change : " + value);
          },
          release: function (value) {
              //console.log(this.$.attr('value'));
              console.log("release : " + value);
          },
          cancel: function () {
              console.log("cancel : ", this);
          },
          format: function (value) {
              return value + '%';
          },
          draw: function () {
              // "tron" case
              if (this.$.data('skin') == 'tron') {
                  this.cursorExt = 1;
                  var a = this.arc(this.cv)  // Arc
                      , pa                   // Previous arc
                      , r = 1;
                  this.g.lineWidth = this.lineWidth;

                  if (this.o.displayPrevious) {
                      pa = this.arc(this.v);
                      this.g.beginPath();
                      this.g.strokeStyle = this.pColor;
                      this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                      this.g.stroke();
                  }
                  this.g.beginPath();
                  this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                  this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                  this.g.stroke();
                  this.g.lineWidth = 2;
                  this.g.beginPath();
                  this.g.strokeStyle = this.o.fgColor;
                  this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                  this.g.stroke();
                  return false;
              }
          }
      });
      // Example of infinite knob, iPod click wheel
      var v, up = 0, down = 0, i = 0
          , $idir = $("div.idir")
          , $ival = $("div.ival")
          , incr = function () { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
          , decr = function () { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
      $("input.infinite").knob(
          {
              min: 0
              , max: 20
              , stopper: false
              , change: function () {
                  if (v > this.cv) {
                      if (up) {
                          decr();
                          up = 0;
                      } else { up = 1; down = 0; }
                  } else {
                      if (v < this.cv) {
                          if (down) {
                              incr();
                              down = 0;
                          } else { down = 1; up = 0; }
                      }
                  }
                  v = this.cv;
              }
          });
  })(jQuery);
  // rounded chart end //


  // goal over view start //
  var options = {
          series:[{
          name: ' Our Goal ',
          type: 'area',
          data: [50,40, 48, 47,50]
        }, {
          name: ' Our Goal ',
          type: 'line',
          data: [40,50,35,42,45]
        }],
        chart: {
          height: 235,
          type: 'line',
          toolbar: {
            show:false,
          },
        },
        stroke:{
          curve:'smooth',
          width:[5, 2],
          dashArray:[0, 8]
        },
        fill: {
          type: 'solid',
          opacity: [0.35,1],         
        },       
        markers: {
          size: [7,0],         
          colors: ['#fff'],
          strokeColor:EnzoAdminConfig.primary,
          strokeWidth:[4,0],         
        },       
        yaxis: {
           show:false,
        },
        grid:{
          borderColor: '#ffffff',
        },
        xaxis: {
           show:false,
           labels:{
             show:false,
           },
           axisTicks:{
             show:false,
           },
        },    
        tooltip:{
          shared:true,
          intersect:false,
          y:{
            formatter: function (y) {
              if(typeof y !== "undefined") {
                return  y.toFixed(0) + " points";
              }
              return y;
            }
          }
        },       
        legend: {
            show:false,
        },
        responsive:[
            {
              breakpoint:1661,
              options:{
                chart:{
                  height:255,
                }
              },
            },
            {
              breakpoint:1441,
              options:{
                chart:{
                  height:235,
                }
              },
            },
            {
              breakpoint:1200,
              options:{
                chart:{
                  height:250,
                }
              },
            }              
        ],

         colors:[EnzoAdminConfig.primary]
        };
        var chart = new ApexCharts(document.querySelector("#goal-rview"), options);
        chart.render();
  // goal over view end //


  // Progress bar one start //
  var optionsProgress1 = {
      chart: {
          height:75,
          type: 'bar',
          stacked: true,
          fontFamily: "Rubik,sans-serif",
          sparkline: {
              enabled: true
          }
      },
      plotOptions: {
          bar: {
              horizontal: true,
              barHeight: '10px',
              colors: {
                  backgroundBarColors: ['#e2e7f8']
              }
          },
      },
      colors: [EnzoAdminConfig.primary],
      stroke: {
          width: 0,
      },
      fill: {
          colors:[EnzoAdminConfig.primary],
          type:'gradient',
          gradient: {
              gradientToColors: [EnzoAdminConfig.primary]
          }
      },
      series: [{
          name:'Google Chrome',
          data: [95]
      }],
      title: {
          floating: true,
          offsetX: -10,
          offsetY: 5,
          text: 'Google Chrome',
          style: {             
            fontWeight:'bold',             
          },
      },
      subtitle: {
        floating: true,
        align: 'right',
        offsetY: 0,
        text: '95%',
        style: {
            fontSize: '18px'
        }
      },
      tooltip: {
          enabled: false
      },
      xaxis: {
          categories: ['Google Chrome'],
      },
      yaxis: {
          max:100
      },
      fill: {
          opacity: 1
      }
  }

  var chartProgress1 = new ApexCharts(document.querySelector('#chromestatistics'), optionsProgress1);
  chartProgress1.render();
  // Progress bar one end //


  // Progress bar one start //
  var optionsProgress1 = {
      chart: {
          height:75,
          type: 'bar',
          stacked: true,
          fontFamily: "Rubik,sans-serif",
          sparkline: {
              enabled: true
          }
      },
      plotOptions: {
          bar: {
              horizontal: true,
              barHeight: '10px',
              colors: {
                  backgroundBarColors: ['#e2e7f8']
              }
          },
      },
      colors: [EnzoAdminConfig.primary],
      stroke: {
          width: 0,
      },
      fill: {
          colors:[EnzoAdminConfig.primary],
          type:'gradient',
          gradient: {
              gradientToColors: [EnzoAdminConfig.primary]
          }
      },
      series: [{
          name:'opera',
          data:[70]
      }],
      title: {
          floating: true,
          offsetX: -10,
          offsetY: 5,
          text: 'Opera',
          style: {             
            fontWeight:  'bold',             
          },
      },
      subtitle:{
          floating:true,
          align:'right',
          offsetY:0,
          text:'70%',
          style:{
            fontSize: '18px'
          }
      },
      tooltip: {
          enabled: false
      },
      xaxis: {
          categories: ['Google Chrome'],
      },
      yaxis: {
          max:100
      },
      fill: {
          opacity: 1
      }
  }

  var chartProgress1 = new ApexCharts(document.querySelector('#operastatistics'), optionsProgress1);
  chartProgress1.render();
  // Progress bar one end //


  // Progress bar one start //
  var optionsProgress1 = {
      chart: {
          height:75,
          type:'bar',
          stacked:true,
          fontFamily:"Rubik,sans-serif",
          sparkline:{
            enabled:true
          }
      },
      plotOptions: {
          bar: {
              horizontal:true,
              barHeight:'10px',
              colors:{
                backgroundBarColors: ['#e2e7f8']
              }
          },
      },
      colors: [EnzoAdminConfig.primary],
      stroke: {
          width: 0,
      },
      fill: {
          colors:[EnzoAdminConfig.primary],
          type:'gradient',
          gradient: {
              gradientToColors: [EnzoAdminConfig.primary]
          }
      },
      series: [{
          name:'Firefox',
          data:[55]
      }],
      title: {
          floating: true,
          offsetX: -10,
          offsetY: 5,
          text: 'Firefox',
          style: {             
            fontWeight:  'bold',             
          },
      },
      subtitle:{
          floating:true,
          align:'right',
          offsetY:0,
          text:'55%',
          style:{
            fontSize: '18px'
          }
      },
      tooltip: {
          enabled: false
      },
      xaxis: {
          categories: ['Firefox'],
      },
      yaxis: {
          max:100
      },
      fill: {
          opacity: 1
      }
  }

  var chartProgress1 = new ApexCharts(document.querySelector('#firefoxstatistics'), optionsProgress1);
  chartProgress1.render();
  // Progress bar one end //


  // Progress bar one start //
  var optionsProgress1 = {
      chart: {
          height:75,
          type:'bar',
          stacked:true,
          fontFamily:"Rubik,sans-serif",
          sparkline:{
            enabled:true
          }
      },
      plotOptions: {
        bar:{
            horizontal:true,
            barHeight:'10px',
            colors:{
              backgroundBarColors: ['#e2e7f8']
            }
        },
      },
      colors: [EnzoAdminConfig.primary],
      stroke: {
          width: 0,
      },
      fill: {
          colors:[EnzoAdminConfig.primary],
          type:'gradient',
          gradient: {
              gradientToColors: [EnzoAdminConfig.primary]
          }
      },
      series: [{
          name:'Internet Explorer',
          data:[80]
      }],
      title: {
          floating: true,
          offsetX: -10,
          offsetY: 5,
          text: 'Internet Explorer',
          style: {             
            fontWeight:'700',             
          },
      },
      subtitle:{
          floating:true,
          align:'right',
          offsetY:0,
          text:'56%',
          style:{
            fontSize: '18px'
          }
      },
      tooltip: {
          enabled: false
      },
      xaxis: {
          categories: ['Internet Explorer'],
      },
      yaxis: {
          max:100
      },
      fill: {
          opacity: 1
      }
  }

  var chartProgress1 = new ApexCharts(document.querySelector('#explorerstatistics'), optionsProgress1);
  chartProgress1.render();
  // Progress bar one end //


  // total profit start//
  var options55 = {
  series:[{
        name:'Total Profit',
        type:'column',              
        data:[20,20,40,30,60,50,35,25,50,45,55,60,20,45,20,20]
      },
      {
        name:'Total Profit',
        type:'area',              
        data: [50,50,45,55,50,60,56,58,50,65,60,50,60,52,55,55]
      }   
    ],   
    chart: {
      height:300,
      type: "bar",
      toolbar: {
        show:false,
      },
    },   
    plotOptions:{
      bar:{         
        horizontal:true,
        columnWidth:"20px",
        startingShape:"rounded",
        endingShape: "rounded",         
      },
    },
    fill:{        
      opacity:[1, 0.05],     
      gradient:{
        type:"vertical",       
        opacityFrom:0.5,
        opacityTo:0.1,
        stops: [100, 100, 100]       
      }
    },  
    stroke: {
      show:false,
    },
    legend:{
      show:false,
    },
    grid: {
      show: false,
      padding: {
        top: -35,
        right: -45,
        bottom: -20,
        left: -35
      },
    },
    dataLabels: {
      enabled:false
    },   
    xaxis: {     
      axisBorder: {
        show: false
      },
      labels:{
        show:false,
      },
      axisTicks:{
        show:false,
       },
    },
     yaxis: {
      labels: {
        show:false,
      }
    },
    responsive: [
        {
          breakpoint:1600,
          options:{
            chart:{
              height:250
            }
          }
        },
        {
          breakpoint:1470,
          options:{
            chart:{
              height:225
            }
          }
        },
        {
          breakpoint:1366,
          options:{
            chart:{
              height:200
            }
          }
        },
    ],
  colors:[EnzoAdminConfig.primary]
};

var chart55 = new ApexCharts(document.querySelector("#total-profit"),
 options55
 );
chart55.render();
//total profit end//
// time 
 function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var ampm = h >= 12 ? 'PM' : 'AM';
  h = h % 12;
  h = h ? h : 12;
  m = checkTime(m);
  document.getElementById('txt').innerHTML =
  h + ":" + m  + ' ' + ampm;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};
  return i;
}