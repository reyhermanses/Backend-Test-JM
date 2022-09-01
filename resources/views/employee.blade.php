<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-modal" data-toggle="modal" data-target="#modal-form"><i class="mdi mdi-plus"></i> New Data</a>
                                <a href="javascript:void(0)" class="btn btn-sm btn-success btn-modal" data-toggle="modal" data-target="#modal-import"><i class="mdi mdi-download"></i> Import</a>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-stripde table-bordered table-data">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIK</th>
                                                <th>Employee Name</th>
                                                <th>Unit</th>
                                                <th>Position</th>
                                                <th>Date of Birth</th>
                                                <th>Place of Birth</th>
                                                <th>Status</th>
                                                <th>Last Updated Date</th>
                                                <th>Updated By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                            </tr>
                                            <tr>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
                        @csrf
                        <div class="form-group row">
                            <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="NIK" id="nik">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Name" id="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="unit" class="col-sm-3 col-form-label">Unit</label>
                            <div class="col-sm-9">
                                <select name="" id="unit" class="form-control form-control-lg select2" style="width: 100%">
                                    <option value="">Information Technology Group</option>
                                    <option value="">Accounting & Tax</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="position" class="col-sm-3 col-form-label">Position</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Position" id="position">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" placeholder="Date of Birth" id="dob">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="place_of_birth" class="col-sm-3 col-form-label">Place of Birth</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Place of Birth" id="place_of_birth">
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
                    <button type="button" class="btn btn-primary save">Save changes</button>
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
                url: 'http://localhost:8000/api/karyawan/',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    $.each(data['data'], function(key, row) {
                        i = key + 1;

                        updated_at = row.updated_at == null ? '-' : formatDate(row.updated_at);

                        $("table.table").append(
                            '<tr>' +
                            '<td>' + i + '</td>' +
                            '<td>' + row.nik + '</td>' +
                            '<td>' + row.has_unit_kerja.name + '</td>' +
                            '<td>' + row.name + '</td>' +
                            '<td>' + row.position_name + '</td>' +
                            '<td>' + row.date_of_birth + '</td>' +
                            '<td>' + row.place_of_birth + '</td>' +
                            '<td><span class="badge badge-success"> aktif </span> </td>' +
                            '<td>' + updated_at + '</td>' +
                            '<td>' + row.create_or_update_by.name + '</td>' +
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

    <div class="modal fade" id="modal-import" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                </div>
                <div class="modal-body">
                    <form class="forms-sample">
                        <div class="form-group row">
                            <label for="file" class="col-sm-3 col-form-label">Select File</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="file">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="progress" style="height: 15px">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let table = $('#table-data').DataTable();

        $('.btn-modal').on('click', function() {

            let modal = $(this).attr('data-target')

            $(modal).modal('show')

        })
    </script>