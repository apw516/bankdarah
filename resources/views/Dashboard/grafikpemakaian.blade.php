<canvas id="myChart" height="80" style="height: 80px;"></canvas>
<script>
      $(document).ready(function() {
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober','November','Desember'],
                    datasets: [{
                        label: '# of Votes',
                        data: [<?= $DATA[0]->Januari; ?>, <?= $DATA[0]->Februari; ?>, <?= $DATA[0]->Maret; ?>, <?= $DATA[0]->April; ?>, <?= $DATA[0]->Mei; ?>, <?= $DATA[0]->Juni; ?>,<?= $DATA[0]->Juli; ?>,<?= $DATA[0]->Agustus; ?>,<?= $DATA[0]->September; ?>,<?= $DATA[0]->September; ?>,<?= $DATA[0]->Oktober; ?>,<?= $DATA[0]->November; ?>,<?= $DATA[0]->Desember; ?>],
                        borderWidth: 4,
                        backgroundColor: '#9BD0A5',
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
</script>
