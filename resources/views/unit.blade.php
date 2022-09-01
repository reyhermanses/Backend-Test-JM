@extends('layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-modal" data-target="#modal-form"><i class="mdi mdi-plus"></i>
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
                                            <tr>
                                                <td>1</td>
                                                <td>Information Technology Group</td>
                                                <td><span class="badge badge-success">Active</span></td>
                                                <td>10 December 2022, 19:08</td>
                                                <td>Superadmin</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-modal" data-target="#modal-form"><i
                                                            class="mdi mdi-pencil"></i> Edit</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Accounting & Tax</td>
                                                <td><span class="badge badge-danger">Inactive</span></td>
                                                <td>4 September 2022, 19:08</td>
                                                <td>Superadmin</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-modal" data-target="#modal-form"><i
                                                            class="mdi mdi-pencil"></i> Edit</a>
                                                </td>
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

        <div class="modal fade" id="modal-form" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
    @endsection

    @section('script')
        <script>
            let table = $('#table-data').DataTable();

            $('.btn-modal').on('click', function() {

                let modal = $(this).attr('data-target')

                $(modal).modal('show')

            })
        </script>
    @endsection
