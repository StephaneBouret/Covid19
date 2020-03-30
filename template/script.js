// document.addEventListener("DOMContentLoaded", function () {

$(document).ready(() => {

    getCountryData('FR');





    // Filter Countries with search bar

    $('#countrySearchBar').on({

        "keyup": function (evt) {

            const searchedTxt = this.value;

            const rawCountryList = $('.countryItem');

            const countryToHide = [];

            for (const htmlItem of rawCountryList) {

                if (!htmlItem.innerHTML.toLowerCase().match(searchedTxt.toLowerCase())) {

                    htmlItem.classList.add("hidden");

                } else {

                    htmlItem.classList.remove("hidden");

                }

            }

        }

    })


    // On click on a country => request data from DB

    $(".countryItem").click(

        (evt) => {

            const countryCode = evt.target.dataset.code;

            getCountryData(countryCode);

        }

    )



    function getCountryData(countryCode = 'FR') {

        $.post("index.php?controller=DataController&action=getSingleCountryData", { "countryCode": countryCode }, (response) => {

            updloadHTMLContent(response);

        }, 'json')

}



    function exportToCSV(countryCode) {

        $.post('index.php?controller=DataController&action=exportToCSV', { "countryCode": countryCode });

    }



    function updloadHTMLContent(country) {

        let lastDataDay = Math.max.apply(null, (Object.keys(country.data)).map(x => +x));

        const lastData = country.data[lastDataDay];



        const deathRate = (lastData.death / lastData.infected * 100).toFixed(2);

        const recoveryRate = (lastData.recovered / lastData.infected * 100).toFixed(2);



        // Header info

        $('#countryInfo h2 img').attr("src", "public/images/flags/" + country.code.toLowerCase() + ".png");

        $('#countryInfo #countryName').html(country.name);

        $('#countryInfo #countryCode').html(country.code);

        $('#downloadPDFBtn').attr("href", "index.php?controller=dataController&action=exportToPDF&countryCode="+country.code);

        $('#downloadCSVBtn').attr("href", "index.php?controller=dataController&action=exportToCSV&countryCode="+country.code);





        // Footer info

        $('#totalPopulation').html(country.population);

        $('#totalInfected').html(lastData.infected);

        $('#totalDeath').html(lastData.death);

        $('#totalRecovered').html(lastData.recovered);

        $('#deathRate').html(deathRate + "%");

        $('#recoveryRate').html(recoveryRate + "%");



        let deathList = [];

        for (const time in country.data) {

            if (country.data.hasOwnProperty(time)) {

                // console.log(time)

                const element = country.data[time];

                deathList.push([time * 1000, parseInt(element.death)]);

            }

        }

        let infectedList = [];

        for (const time in country.data) {

            if (country.data.hasOwnProperty(time)) {

                const element = country.data[time];

                infectedList.push([time * 1000, parseInt(element.infected)]);

            }

        }

        let recoveredList = [];

        for (const time in country.data) {

            if (country.data.hasOwnProperty(time)) {

                const element = country.data[time];

                recoveredList.push([time * 1000, parseInt(element.recovered)]);

            }

        }





        var myChart = Highcharts.chart('chart', {

            chart: {

                type: 'line'

            },

            title: {

                text: ''

            },

            xAxis: {

                type: "datetime",

                title: "Date",

                dateTimeLabelFormats: { 

                    month: '%e. %b',

                    year: '%b'

                },

            },

            yAxis: {

                title: {

                    text: 'population'

                }

            },

            colors: ['#000000', '#800000', '#008000'],

            series: [

                {

                    name: 'Deaths',

                    data: deathList,

                },

                {

                    name: 'Infected',

                    data: infectedList,

                }, {

                    name: 'Recovered',

                    data: recoveredList,

                }

            ]

        });

    }

    



    Highcharts.theme = {

        colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066',

            '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],

        chart: {

            backgroundColor: {

                linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },

                stops: [

                    [0, '#2a2a2b'],

                    [1, '#3e3e40']

                ]

            },

            style: {

                fontFamily: '\'Unica One\', sans-serif'

            },

            plotBorderColor: '#606063'

        },

        title: {

            style: {

                color: '#E0E0E3',

                textTransform: 'uppercase',

                fontSize: '20px'

            }

        },

        subtitle: {

            style: {

                color: '#E0E0E3',

                textTransform: 'uppercase'

            }

        },

        xAxis: {

            gridLineColor: '#707073',

            labels: {

                style: {

                    color: '#E0E0E3'

                }

            },

            lineColor: '#707073',

            minorGridLineColor: '#505053',

            tickColor: '#707073',

            title: {

                style: {

                    color: '#A0A0A3'

                }

            }

        },

        yAxis: {

            gridLineColor: '#707073',

            labels: {

                style: {

                    color: '#E0E0E3'

                }

            },

            lineColor: '#707073',

            minorGridLineColor: '#505053',

            tickColor: '#707073',

            tickWidth: 1,

            title: {

                style: {

                    color: '#A0A0A3'

                }

            }

        },

        tooltip: {

            backgroundColor: 'rgba(0, 0, 0, 0.85)',

            style: {

                color: '#F0F0F0'

            }

        },

        plotOptions: {

            series: {

                dataLabels: {

                    color: '#F0F0F3',

                    style: {

                        fontSize: '13px'

                    }

                },

                marker: {

                    lineColor: '#333'

                }

            },

            boxplot: {

                fillColor: '#505053'

            },

            candlestick: {

                lineColor: 'white'

            },

            errorbar: {

                color: 'white'

            }

        },

        legend: {

            backgroundColor: 'rgba(0, 0, 0, 0.5)',

            itemStyle: {

                color: '#E0E0E3'

            },

            itemHoverStyle: {

                color: '#FFF'

            },

            itemHiddenStyle: {

                color: '#606063'

            },

            title: {

                style: {

                    color: '#C0C0C0'

                }

            }

        },

        credits: {

            style: {

                color: '#666'

            }

        },

        labels: {

            style: {

                color: '#707073'

            }

        },

        drilldown: {

            activeAxisLabelStyle: {

                color: '#F0F0F3'

            },

            activeDataLabelStyle: {

                color: '#F0F0F3'

            }

        },

        navigation: {

            buttonOptions: {

                symbolStroke: '#DDDDDD',

                theme: {

                    fill: '#505053'

                }

            }

        },

        // scroll charts

        rangeSelector: {

            buttonTheme: {

                fill: '#505053',

                stroke: '#000000',

                style: {

                    color: '#CCC'

                },

                states: {

                    hover: {

                        fill: '#707073',

                        stroke: '#000000',

                        style: {

                            color: 'white'

                        }

                    },

                    select: {

                        fill: '#000003',

                        stroke: '#000000',

                        style: {

                            color: 'white'

                        }

                    }

                }

            },

            inputBoxBorderColor: '#505053',

            inputStyle: {

                backgroundColor: '#333',

                color: 'silver'

            },

            labelStyle: {

                color: 'silver'

            }

        },

        navigator: {

            handles: {

                backgroundColor: '#666',

                borderColor: '#AAA'

            },

            outlineColor: '#CCC',

            maskFill: 'rgba(255,255,255,0.1)',

            series: {

                color: '#7798BF',

                lineColor: '#A6C7ED'

            },

            xAxis: {

                gridLineColor: '#505053'

            }

        },

        scrollbar: {

            barBackgroundColor: '#808083',

            barBorderColor: '#808083',

            buttonArrowColor: '#CCC',

            buttonBackgroundColor: '#606063',

            buttonBorderColor: '#606063',

            rifleColor: '#FFF',

            trackBackgroundColor: '#404043',

            trackBorderColor: '#404043'

        }

    };

    // Apply the theme

    Highcharts.setOptions(Highcharts.theme);







})





// })

