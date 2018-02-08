@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4 id="realtime_status">Realtime: Off</h4>
        <label class="switch">
            <input id="realtime" type="checkbox">
            <span class="slider round"></span>
        </label>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Requests</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div id="chart_div" class="col-md-6">
                
                    </div>
                    <div class="col-md-6">
                        <table class='table table-condensed'>
                            <tr>
                                <td>Requests Remaining</td>
                                <td id="requests_remaining"></td>
                            </tr>
                            <tr>
                                <td>Total Request</td>
                                <td id="total_requests"></td>
                            </tr>
                        </table>
                    </div>
                </div>
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
    var interval;
    $('#realtime').change(function() {
        if ($('#realtime').is(':checked')) {
            $("#realtime_status").text("Realtime: On")
            interval = setInterval(fetchdata,1000);
        }else{
            $("#realtime_status").text("Realtime: Off")
            fetchdata()
            clearInterval(interval);
        }      
    });

    

    function fetchdata(){
        $.ajax({
         url: "{{ route('fetch_data') }}",
         success: function(data){
            setRequestMeter(data.request_remaining,data.maximum_request);
            setApiKeys(data.keys); 
            $("#total_requests").text(data.total_requests)
            $("#requests_remaining").text(data.request_remaining)
         }
        });
       }
       
       $(document).ready(function(){
        
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
