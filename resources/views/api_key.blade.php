@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <button onclick='addKey()' class='btn btn-default pull-right bottom-margin-20'><i class="fas fa-plus"></i>&nbsp; ADD KEY</button>
                    <table id="keys_table" class="table table-hover table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>CREATION DATE</th>
                                <th>KEY</th>
                                <th>REQUESTS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody id='keys'>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="add_key" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <form method="POST" id="addKeyForm" accept-charset="utf-8">
                    {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Key</h4>
                </div>
                <div class="modal-body">
                    <div id='errors_container' class="alert alert-danger"><ul id='errors'></ul></div>
                    <div class="form-group">
                        <label>Key</label>
                        <input name="key" type="text" placeholder="API Key" class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" placeholder="Enter Name" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="createKey()">Add</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div id="edit_key" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <form method="POST" id="editKeyForm" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <input name="id" type="hidden" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Key</h4>
                </div>
                <div class="modal-body">
                    <div id='edit_errors_container' class="alert alert-danger"><ul id='errors'></ul></div>
                    <div class="form-group">
                        <label>Key</label>
                        <input name="key" type="text" placeholder="API Key" class="form-control" readonly />
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" placeholder="Enter Name" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveKey()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div id="delete_key" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <input name="delete_key_id" type="hidden" />
                    <div class='row'>
                        <div class='col-md-12'>
                            <h3 class='text-center' id="delete_message"></h3>
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='col-md-3 col-md-offset-3'>
                            <button type="button" class="btn btn-danger btn-block" onclick="deleteKeyAction()">Yes</button>
                        </div>
                        <div class='col-md-3'>
                            <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $.ajax({
            url: "{{ route('show_api_keys') }}",
            success:function(data) {
                $('#keys').html(data);
            }
        });

        function addKey(){
            $("#errors_container").hide();
            $('input[name="name"]').val("");
            $.ajax({
                url: "{{ route('gen_api_key') }}",
                success:function(data) {
                    $('#add_key').modal('show');
                    $('input[name="key"]').val(data.key);
                }
              });
        }

        function createKey(){
            $.ajax({
                url: "{{ route('create_api_key') }}",
                type: 'POST',
                dataType: 'json',
                data: $('#addKeyForm').serialize(),
                encode:true,
                success:function(data) {
                    if(data.success){
                        window.location.reload();
                    }else{
                        var errorOut = "";
                        jQuery.each( data.errors, function( i, error ) {
                            errorOut += "<li>"+error+"</li>"
                        });
                        $("#errors_container").fadeIn();
                        $("#errors").html(errorOut);
                    }
                }
            });
        }

        function editKey(id){
            $("#edit_errors_container").hide();
            $('#edit_key').modal('show');
            $.ajax({
                url: "{{ route('get_api_key') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id':id,
                    '_token': '{{ csrf_token() }}'
                },
                encode:true,
                success:function(data) {
                    $('input[name="key"]').val(data.key);
                    $('input[name="name"]').val(data.name);
                    $('input[name="id"]').val(data.id);
                }
            });
        }

        function saveKey(){
            $.ajax({
                url: "{{ route('update_api_key') }}",
                type: 'POST',
                dataType: 'json',
                data: $('#editKeyForm').serialize(),
                encode:true,
                success:function(data) {
                    window.location.reload();
                }
            });
        }

        function deleteKey(id){
            $('#delete_key').modal('show');
            $.ajax({
                url: "{{ route('get_api_key') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'id':id,
                    '_token': '{{ csrf_token() }}'
                },
                encode:true,
                success:function(data) {
                    $('#delete_message').text("Are you sure you want to delete "+data.name+" ?");
                    $('input[name="delete_key_id"]').val(id)
                }
            });
        }

        function deleteKeyAction(){
            $.ajax({
                url: "{{ route('delete_api_key') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'delete_key_id':$('input[name="delete_key_id"]').val(),
                    '_token': '{{ csrf_token() }}'
                },
                encode:true,
                success:function(data) {
                    window.location.reload();
                }
            });
        }
    </script>
@endsection
