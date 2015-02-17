<?php

date_default_timezone_set('Europe/Moscow');

include 'vendor/autoload.php';

$periodStart = Carbon\Carbon::parse('2014/08/01');
$periodEnd   = Carbon\Carbon::now();

$dataSources = [
    ['title' => 'Курс Евро/Руб.',   'source' => new \IlyaBazhenov\DashboardStat\CBREuroDataSource($periodStart, $periodEnd)],
    ['title' => 'Курс Доллар/Руб.', 'source' => new \IlyaBazhenov\DashboardStat\CBRDollarDataSource($periodStart, $periodEnd)],
];

?>
<html>
<head>
    <meta charset="utf-8">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['День', <?php foreach ($dataSources as $key => $dataSource): ?>'<?php echo $dataSource['title']; ?>' <?php if (isset($dataSources[$key + 1])): ?>,<?php endif; ?> <?php endforeach; ?>],

                <?php $diffDays = $periodStart->diffInDays($periodEnd); ?>

                <?php $date = $periodStart; ?>

                <?php for ($i = 0; $i <= $diffDays; $i++): ?>

                    <?php $data = ($i == 0) ? $date : $date->addDay(); ?>

                    ['<?php echo $date->format('Y.m.d') ?>', <?php foreach ($dataSources as $key => $dataSource): ?><?php $value = $dataSource['source']->getDataContainer()->getValueByDate($date); echo ($value === null) ? 'null' : 'parseFloat("' . $value . '")'; ?> <?php if (isset($dataSources[$key + 1])): ?>,<?php endif; ?> <?php endforeach; ?>],

                <?php endfor; ?>

            ]);

            var options = {
                hAxis: {title: 'Дата',  titleTextStyle: {color: '#333'}},
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div id="chart_div" style="height: 600px;"></div>
</body>
</html>