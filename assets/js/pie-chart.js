$(document).ready(function () {

    getPie();

});


// Set new default font family and font color to mimic Bootstrap's default styling
// Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
// Chart.defaults.global.defaultFontColor = '#858796';


function getPie() {
    var base_url = 'getPie';
    $.ajax({
        type: 'POST',
        url: base_url,
        dataType: 'json',
        success: function (hasil) {
            $('#L').text(hasil.jmll);
            $('#P').text(hasil.jmlp);
            grafikPie(
                hasil.jmll,
                hasil.jmlp
            );
        }
    });

}

function grafikPie(L, P) {

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Laki-laki", "Perempuan"],
            datasets: [{
                data: [L, P],
                backgroundColor: ['#3CB371', '#FFA500'],
                hoverBackgroundColor: ['#008080', '#008080'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });

    return myPieChart;

}