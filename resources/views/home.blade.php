@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Request Remaining</h4>
            </div>
            <div id="chart_div" class="panel-body">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>API Keys</h4>
            </div>
            <div id="top_x_div" class="panel-body">
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    fetchdata()

    function fetchdata(){
        $.ajax({
         url: "{{ route('fetch_data') }}",
         success: function(data){
            setRequestMeter(data.request_remaining,data.maximum_request);
            setApiKeys(data.keys); 
         }
        });
       }
       
       $(document).ready(function(){
        setInterval(fetchdata,1000);
       });

       google.charts.load('current', {'packages':['gauge']});
       google.charts.setOnLoadCallback(setRequestMeter);
 
       function setRequestMeter(request,max) {
 
         var data = google.visualization.arrayToDataTable([
           ['Label', 'Value'],
           ['', request],
         ]);
 
         var options = {
           width: 600, height: 320,
           redFrom: 0, redTo: 10000,
           yellowFrom:10000, yellowTo: 30000,
           greenFrom:30000, greenTo: 100000,
           max: max,
           minorTicks: 5
         };
 
         var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
 
         chart.draw(data, options);
       }

        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(setApiKeys);

      function setApiKeys(keys) {
        var data = new google.visualization.arrayToDataTable(keys);
        var options = {
          width: 900,
          legend: { position: 'none' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'No of Request'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
</script>
@endsection
