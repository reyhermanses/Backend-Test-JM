<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-modal" data-toggle="modal" data-target="#modal-form"><i class="mdi mdi-plus"></i>
                                    New Data</a>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <table class="table table-hover table-stripde table-bordered" id="table-data">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Unit Name</th>
                                            <th>Status</th>
                                            <th>Last Updated Date</th>
                                            <th>Updated By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-form" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add/Edit Data</h5>
                </div>
                <div class="modal-body">
                    <form class="forms-sample">
                        <div class="form-group row">
                            <label for="unit-name" class="col-sm-3 col-form-label">Unit Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Unit Name" id="unit-name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select name="" id="status" class="form-control form-control-lg select2" style="width: 100%">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2)
                    month = '0' + month;
                if (day.length < 2)
                    day = '0' + day;

                return [year, month, day].join('-');
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + localStorage.getItem('api_token')
                }
            });

            $.ajax({
                type: 'GET',
                url: 'http://localhost:8000/api/unit-kerja/',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    $.each(data['data'], function(key, row) {
                        i = key + 1;

                        created_at = row.created_at == null ? '-' : formatDate(row.created_at);
                        updated_at = row.updated_at == null ? '-' : formatDate(row.created_at);

                        $("table.table").append(
                            '<tr>' +
                            '<td>' + i + '</td>' +
                            '<td>' + row.name + '</td>' +
                            '<td> aktif </td>' +
                            '<td>' + updated_at + '</td>' +
                            '<td>' + row.belongs_to_karyawan.name + '</td>' +
                            '<td><a href="javascript:void(0)" class="btn btn-primary btn-sm btn-modal" data-toggle="modal" data-target="#modal-form"> Edit</a> ' +
                            '<a href="javascript:void(0)" class="btn btn-info btn-sm btn-modal" data-toggle="modal" data-target="#modal-form"> Delete</a></td>' +
                            '</tr>'
                        );
                    });
                },
                error: function(status, data) {
                    console.log('Error:', data);
                }
            })



            jQuery('body').on('click', '.save', function(e) {

                e.preventDefault(e);

                $.ajax({
                    type: 'GET',
                    url: 'http://localhost:8000/api/user/',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(status, data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
    </script>

    <script>
        let table = $('#table-data').DataTable();

        $('.btn-modal').on('click', function() {

            let modal = $(this).attr('data-target')

            $(modal).modal('show')

        })
    </script>