<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-sm btn-primary btn-modal unit-create" data-value="unit-create" data-toggle="modal" data-target="#modal-form"><i class="mdi mdi-plus"></i>
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

    <div class="modal fade" id="modal-form" role="dialog" data-backdrop="false" data-dismiss="modal"  aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-primary" data-value="save-unit">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // class Unit {
        //     constructor(name) {

        //     }

        //     show_unit_kerja() {

        //         console.log('test class');
        //     }
        // }

        // unit = new Unit();



        // unit.show_unit_kerja();

        jQuery('body').ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + localStorage.getItem('api_token')
                }
            });

            var loadUnitKerja = $.ajax({
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
                            '<td>' + row.updated_by.name + '</td>' +
                            '<td><a href="#" class="btn btn-primary btn-sm btn-modal unit-edit" data-toggle="modal" data-target="#modal-form"> Edit</a> ' +
                            '<a href="#" class="btn btn-info btn-sm btn-modal unit-delete" data-toggle="modal" data-target="#modal-form"> Delete</a></td>' +
                            '</tr>'
                        );
                    });
                },
                error: function(status, data) {
                    console.log('Error:', data);
                }
            });

            loadUnitKerja.always(function() {
                console.log('finished');
            });

            // Jquery('body').on('.btn-modal')

            jQuery('body').on('click', '.unit-create', function(e) {
                // console.log('a');

                e.preventDefault();

                action = $(this).attr('data-value');

                title = $(".modal-title");

                // console.log(choice);

                // $(".modal-title").html('Create');
                switch (action) {
                    case "unit-create":
                        title.html('Buat data unit');
                        $(".btn").click(function(e) {
                            btn = $(this).attr('data-value');
                            name = $("#unit-name").val();
                            console.log(name);
                            if (btn == 'save-unit') {
                                $.ajax({
                                    type: 'POST',
                                    data: {
                                        name: name
                                    },
                                    url: 'http://localhost:8000/api/unit-kerja/',
                                    dataType: 'json',
                                    success: function(status, data) {

                                        $('#modal-form').modal('hide');

                                        console.log('success:', data);
                                        
                                        $(".modal").modal("hide");

                                        menu = localStorage.getItem('menu') == null ? null : localStorage.getItem('menu');

                                        $(".py-4").load(menu);

                                    },
                                    error: function(status, data) {
                                        console.log('Error:', data);
                                    
                                    }
                                });

                                // $("table").load(location.href + " table");
                            }
                        });
                        break;
                    default:
                        console.log('nothing');
                        break;
                }
            });


           
        });
    </script>