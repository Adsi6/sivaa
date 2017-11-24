<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
        <script src="../vendor/graphics/grafica.js"></script>
        <script src="../js/highcharts.js"></script>
    <script src="../js/module/exporting.js"></script>
		<script type="text/javascript">
$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Grafica Estadisticas de: _____________'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Porcentaje',
                data: [
                    ['Centro',   45.0],
                    ['Ficha',       26.8],
                    {
                        name: 'Ambiente',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Sede',    8.5],
                    ['Jornada',     15.2],
                    ['Programa',   10.7]
                ]
            }]
        });
    });

});
		</script>
	</head>
	<body>
    

<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

	</body>
</html>
