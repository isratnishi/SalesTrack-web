@extends('admin_master')
@section('admin_content')


    <div id="content-wrapper">

        <center>
            <h4 style="color:red">
                <?php
                $exception = Session::get('exception');
                if ($exception) {
                    echo $exception;
                    Session::put('exception', null);
                }
                ?>
            </h4>
            <h4 style="color:green">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo $message;
                    Session::put('message', null);
                }
                ?>
            </h4>
        </center>

        <div class=" container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 log">
                        <h1 class="text-uppercase text-primary text-center">Add Site</h1>
                        <form method="post" action="{{url('/saveSite')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label">
                                    <b> Site Name </b>
                                </label>
                                <div class="col-sm-8">
                                    <input required type="text" class="form-control" id="name" name="name"
                                           placeholder="Type Product full Name">
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <b> Region </b>
                                    </label>
                                    <div class="col-sm-10">
                                        <select id="Region" name="Region" class="form-control">
                                            <option value="">Select any one</option>
                                            <?php
                                            foreach ($all_region_info as $region) {
                                            ?>
                                            <option value="<?php echo $region->id ?>">
                                                <?php echo $region->region_name ?>
                                            </option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <button type="submit" class="form-control btn btn-danger">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Site List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Region Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($all_site_info as $site) {
                            ?>
                            <tr>
                                <td><?php echo $site->site_name ?></td>
                                <td><?php echo $site->region_name ?></td>
                                <td>
                                    {{--<a class="btn btn-info" href="{{URL::to('/editSite/'.$site->id)}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger" href="{{URL::to('/deleteSite/'.$site->id)}}"
                                       onclick="return checkDelete();">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>--}}
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /Modal Part Start -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">
                            <b> Category Name </b>
                        </label>
                        <form method="post" action="{{url('/addCategory')}}">
                            {{ csrf_field() }}
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="addCategory" name="category"
                                       placeholder="Type Product Category Name">
                                <br><input type="submit" class="btn btn-danger">
                            </div>

                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright © Your Website 2018</span>
            </div>
        </div>
    </footer>


@endsection
