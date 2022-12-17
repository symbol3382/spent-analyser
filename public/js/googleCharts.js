google.charts.load('current', {'packages': ['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {
    drawCategoryWiseChart();
    drawDayWiseChart();
    drawHourWiseChart();
    drawExpensesChart();
}

function drawExpensesChart() {
    let dom = document.getElementById('expenses-saving-spent-chart');
    let chartData = analyticsData.expenseSavingData;

    // Create the data table.
    var data = new google.visualization.arrayToDataTable([
        ["Month",'Income', 'Saving', 'Expenses'],
        ...chartData.map(row => {
            row[0] = new Date(row[0]);
            return row;
        }),
    ]);
    // Set chart options
    var options = {
        legend: {position: 'none', maxLines: 3, alignment: 'center'},
        hAxis: {
            format: "MMMM",
            // gridlines: {interval: 1, multiple: 1}
        },
        vAxis: {minValue: 0},
        explorer: {
            axis: 'horizontal',
            actions: ['dragToPan','dragToZoom', "rightClickToReset"],
            // keepInBounds: true,
        },
        chartArea: {'width': '90%', 'height': '70%'},
        colors: [
            '#28B463', // Green
            '#3498DB', // Blue
            '#E74C3C', // Red
        ],
    };
    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.AreaChart(dom);
    chart.draw(data, options);
}

function drawHourWiseChart() {
    let dom = document.getElementById('hour-spent-chart');

    let today=  new Date();

    let hourWiseChartData = analyticsData.hourWiseSpentData.map(dayData => {
        let date = new Date(dayData[0]);
        date.setDate(today.getDate());
        date.setMonth(today.getMonth());
        date.setFullYear(today.getFullYear());
        console.log('dddd day data', date);
        return [
            date,
            dayData[1],
        ]
    });

    let chartData = hourWiseChartData.map(hourData => {
        return [
            hourData[0],
            hourData[1],
            `Hour: ${hourData[0].getHours()}\nAmount: ₹ ${hourData[1]}`
        ]
    });

    console.log('ddddd hcard', chartData);

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('date', 'Date');
    data.addColumn('number', 'Amount');
    data.addColumn({type: 'string', role: 'tooltip'});
    data.addRows(chartData);
    // Set chart options
    var options = {
        'title': 'Daily Active Hours',
        legend: {position: 'none', maxLines: 3, alignment: 'center'},
        hAxis: {format:  "hh a", gridlines: {interval: 1, multiple: 1}},
        vAxis: {minValue: 0},
        explorer: {
            axis: 'horizontal',
            actions: ['dragToPan', "rightClickToReset"],
            keepInBounds: true,
        },
        chartArea: {'width': '90%', 'height': '70%'},
        colors: ['#1B4F72'],
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(dom);
    chart.draw(data, options);
}

function drawDayWiseChart() {
    let dom = document.getElementById('day-spent-chart');

    let dayWiseSpentData = analyticsData.dayWiseSpentData.map(dayData => {
        return [
            new Date(dayData[0]),
            dayData[1],
        ]
    });

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('date', 'Date');
    data.addColumn('number', 'Amount');
    data.addRows(dayWiseSpentData);

    // Set chart options
    var options = {
        colors: ["#E74C3C"],
        curveType: 'function',
        legend: {position: 'none', maxLines: 3, alignment: 'center'},
        hAxis: {format: "d MMM"},
        vAxis: {minValue: 0},
        pointSize: 5,
        chartArea: {'width': '90%', 'height': '70%'},
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.AreaChart(dom);
    chart.draw(data, options);
}

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawCategoryWiseChart() {
    let dom = document.getElementById('category-spent-chart');

    let categoryWiseSpentData = analyticsData.categoryWiseSpentData;

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Category');
    data.addColumn('number', 'Amount');
    console.log('ddddddddddd data for a',
        categoryWiseSpentData,

        [
            ['Mushrooms', 3],
            ['Onions', 1],
            ['Olives', 1],
            ['Zucchini', 1],
            ['Pepperoni', 2]
        ]
    )
    data.addRows(categoryWiseSpentData);

    // Set chart options
    var options = {
        bar: {groupWidth: "80%"},
        height: 400,
        legend: {position: 'none', maxLines: 3, alignment: 'center'},
        chartArea: {'width': '80%', 'height': '70%'},
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(dom);
    chart.draw(data, options);
}


