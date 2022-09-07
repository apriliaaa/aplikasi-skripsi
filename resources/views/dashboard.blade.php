<x-app-layout>


    <div class="navbar navbar-expand navbar-light bg-primary mb-3">

        <h5 class="text-white mx-3">Grafik Mahasiswa Pelanggar Tata Tertib</h5>

    </div>

    <section class="section">

        <div class="card">
            <div class="card-header">
                <h4>Line Area Chart</h4>
            </div>
            <div class="card-body">
                <div id="area"></div>

            </div>
            
            <div class="card-body">
                <div class="p total-pelanggaran"></div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <script>
        const role = "{{(auth()->user()->role)}}"
        const prodi = "{{(auth()->user()->program_studi->nama_prodi)}}"

        let Prodi, getUrl

        if (role === "SuperAdmin") {
            getUrl = "/dashboard-chart"
        } else if (role === "Admin" || role === "Dosen") {
            getUrl = `/dashboard-chart/${prodi}`
        }

        $.ajax({
            type: "GET",
            url: getUrl,
            dataType: "json",
            success: function(data) {
                console.log(data)
                $('.total-pelanggaran').html(`
            Total pelanggaran pada bulan ini sebanyak ${data.total} mahasiswa
        `)

                data = data.prodi

                data.map((val, index) => {
                    Prodi = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                    val.daftar_pelanggaran.map((item, i) => {
                        Prodi[new Date(item.created_at).getMonth()] += 1
                        data[index].count = Prodi
                    })
                    data[index] = {
                        "name": val.nama_prodi,
                        "data": Prodi
                    }
                })

                // line area chart
                var areaOptions = {
                    series: data,
                    chart: {
                        height: 350,
                        type: "area",
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        curve: "smooth",
                    },
                    yaxis: [{
                        labels: {
                            formatter: function(val) {
                                return val.toFixed(0);
                            }
                        }
                    }],
                    xaxis: {
                        type: "string",
                        categories: [
                            //  "2018-09-19T00:00:00.000Z",
                            //  "2018-09-19T01:30:00.000Z",
                            //  "2018-09-19T02:30:00.000Z",
                            //  "2018-09-19T03:30:00.000Z",
                            //  "2018-09-19T04:30:00.000Z",
                            //  "2018-09-19T05:30:00.000Z",
                            //  "2018-09-19T06:30:00.000Z",
                            "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                        ],
                    },
                    tooltip: {
                        x: {
                            format: "dd/MM/yy HH:mm",
                        },
                    },
                };

                var area = new ApexCharts(document.querySelector("#area"), areaOptions);

                area.render();

            }
        });
    </script>

</x-app-layout>