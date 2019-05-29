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
                        <h1 class="text-uppercase text-primary text-center">Add Visit Details</h1>
                        <form method="post" action="{{url('/saveVisitSite')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label">
                                    <b> Site Name </b>
                                </label>
                                <div class="col-sm-8">
                                    <select id="site" name="site_name" class="form-control">
                                        <option value="">Select any one</option>
                                        <?php
                                        foreach ($all_site_info as $site) {
                                        ?>
                                        <option value="<?php echo $site->id ?>">
                                            <?php echo $site->site_name ?>
                                        </option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    <b> Sales Person </b>
                                </label>
                                <div class="col-sm-10">
                                    <select id="salesperson" name="salesperson" class="form-control">
                                        <option value="">Select any one</option>
                                        <?php
                                        foreach ($all_salesperson_info as $salesperson) {
                                        ?>
                                        <option value="<?php echo $salesperson->id ?>">
                                            <?php echo $salesperson->name ?>
                                        </option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    <b> Product </b>
                                </label>
                                <div class="col-sm-10">
                                    <select id="product" name="product" class="form-control">
                                        <option value="">Select any one</option>
                                        <?php
                                        foreach ($all_product_info as $product) {
                                        ?>
                                        <option value="<?php echo $product->id ?>">
                                            <?php echo $product->product_name ?>
                                        </option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    <b> Location </b>
                                </label>
                                <div class="col-sm-10">
                                    <div class="col-sm-8">
                                        <input required type="text" class="form-control" id="location" name="location"
                                               placeholder="location">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    <b> Target </b>
                                </label>
                                <div class="col-sm-10">
                                    <div class="col-sm-8">
                                        <input required type="number" class="form-control" id="target" name="target">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <button type="submit" class="form-control btn btn-danger">Submit</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>


        </div>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Visit info
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Site Name</th>
                            <th>Sales Person Name</th>
                            <th>Product Name</th>
                            <th>Location</th>
                            <th>Target</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($all_visitsite_info as $visitsite) {
                        ?>
                        <tr>
                            <td><?php echo $visitsite->site_name ?></td>
                            <td><?php echo $visitsite->name ?></td>
                            <td><?php echo $visitsite->product_name ?></td>
                            <td><?php echo $visitsite->location ?></td>
                            <td><?php echo $visitsite->target ?></td>
                            <td>
                                action
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
