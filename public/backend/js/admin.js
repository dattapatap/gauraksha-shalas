
const body_styles = window.getComputedStyle(document.body);
const colors = {
    primary: $.trim(body_styles.getPropertyValue('--bs-primary')),
    secondary: $.trim(body_styles.getPropertyValue('--bs-secondary')),
    info: $.trim(body_styles.getPropertyValue('--bs-info')),
    success: $.trim(body_styles.getPropertyValue('--bs-success')),
    danger: $.trim(body_styles.getPropertyValue('--bs-danger')),
    warning: $.trim(body_styles.getPropertyValue('--bs-warning')),
    light: $.trim(body_styles.getPropertyValue('--bs-light')),
    dark: $.trim(body_styles.getPropertyValue('--bs-dark')),
    blue: $.trim(body_styles.getPropertyValue('--bs-blue')),
    indigo: $.trim(body_styles.getPropertyValue('--bs-indigo')),
    purple: $.trim(body_styles.getPropertyValue('--bs-purple')),
    pink: $.trim(body_styles.getPropertyValue('--bs-pink')),
    red: $.trim(body_styles.getPropertyValue('--bs-red')),
    orange: $.trim(body_styles.getPropertyValue('--bs-orange')),
    yellow: $.trim(body_styles.getPropertyValue('--bs-yellow')),
    green: $.trim(body_styles.getPropertyValue('--bs-green')),
    teal: $.trim(body_styles.getPropertyValue('--bs-teal')),
    cyan: $.trim(body_styles.getPropertyValue('--bs-cyan')),
    chartTextColor: $('body').hasClass('dark') ? '#6c6c6c' : '#b8b8b8',
    chartBorderColor: $('body').hasClass('dark') ? '#444444' : '#ededed',
};



function salesReport(){

    var options = {
        series: [
            {
                name: "Total Donation Collected",
                type: "bar",
                data: [23, 32, 27, 38, 27, 32, 27, 38, 22, 31, 21, 16],
            },
        ],
        labels: ["Jan", "Feb","Mar","Apr","May","Jun","Jul","Aug", "Sep","Oct","Nov","Dec",],
        chart: { type: 'bar', foreColor: colors.chartTextColor, height: 300,},
        stroke: { show: true, width: 2, colors: ['transparent']},
        plotOptions: { bar: { horizontal: !1, columnWidth: "60%", endingShape: 'rounded' } },
        dataLabels: { enabled: !1 },
        fill: { opacity: 1},
        theme: { mode: $('body').hasClass('dark') ? 'dark' : 'light', },
        // legend: { show: !1 },
        colors: [colors.primary, colors.secondary, colors.info],
        yaxis: {title: {   text: '₹ (thousands)' }},
        tooltip: { y: {
                formatter: function (val) {
                    return "₹ " + (val/1000 ) + " Thousands"
                }
            }
        },
        grid: { borderColor: colors.chartBorderColor, }

    },
    chart = new ApexCharts(
        document.querySelector("#sales-chart"),
        options
    );
    chart.render();

    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: base_url +'/admin/chartdata',
        success: function(response) {
            if(response.status == true){
                let RgisterFees = response.sales;
                var label = [];
                var totsale  = [];
                RgisterFees.forEach(element => {
                    totsale.push(parseInt(element.amount));
                    label.push(element.month);
                });
                setTimeout(() => {
                    chart.updateSeries([{ data : totsale }]);
                    chart.updateOptions({ labels: label });
                }, 500);
            }
        },
    });

}

salesReport();




