google.charts.load('current', {'packages': ['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {
    drawCategoryWiseChart();
    drawDayWiseChart();
    drawHourWiseChart();
}

function drawHourWiseChart() {
    let dom = document.getElementById('hour-spent-chart');

    let hourWiseChartData = analyticsData.hourWiseSpentData.map(dayData => {
        return [
            new Date(dayData[0]),
            dayData[1],
        ]
    });

    let chartData = hourWiseChartData.map(hourData => {
        return [hourData[0], hourData[1], `Hour: ${hourData[0].getHours()}\nAmount: ₹ ${hourData[1]}`]
    });


    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('date', 'Date');
    data.addColumn('number', 'Amount');
    data.addColumn({type: 'string', role: 'tooltip'});
    data.addRows(chartData);
    // Set chart options
    var options = {
        'title': 'Daily Active Hours',
        curveType: 'function',
        legend: {position: 'none', maxLines: 3, alignment: 'center'},
        hAxis: {format: "hh:mm A"},
        vAxis: {minValue: 0},
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
        'title': 'Day Category Wise',
        curveType: 'function',
        legend: {position: 'none', maxLines: 3, alignment: 'center'},
        hAxis: {format: "d MMM"},
        vAxis: {minValue: 0},
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
        'title': 'Spent Category Wise',
        bar: {groupWidth: "80%"},
        // height: 400,
        legend: {position: 'none', maxLines: 3, alignment: 'center'},
        'chartArea': {'width': '80%', 'height': '70%'},
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(dom);
    chart.draw(data, options);
}


