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
                <div class="log">
                    <h1 class="text-uppercase text-primary text-center">Add Product</h1>
                    <form method="post" action="{{url('/save_product')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <label for="name" class="col-sm-12 control-label">
                                    <b> Product Name </b>
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <input required type="text" class="form-control" id="name" name="name"
                                           placeholder="Type Product full Name">
                                </div>

                                <div class="col-sm-2">
                                    <button type="submit" class="form-control btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Products List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($all_product_info as $products) {
                            ?>
                            <tr>
                                <td><?php echo $products->product_name ?></td>
                                <td>
                                    <a data-toggle="modal" data-target="#myModal" class="btn btn-info"
                                       onclick="Edit('{{$products->id}}','{{$products->product_name}}')">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger" href="{{URL::to('/delete_product/'.$products->id)}}"
                                       onclick="return checkDelete();">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
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
    </div>
    {{--<div class="form-group">
        <label class="col-sm-4 control-label">
            <b> Product Unit </b>
        </label>
        <div class="col-sm-10">
            <select name="unit" class="form-control">
                <option> Kg </option>
                <option>Piece</option>
                <option>Litter</option>
                <option>Others</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4 control-label">
            <b> Product Size </b>
        </label>
        <div class="col-sm-10">
            <input required type="text" name="size" class="form-control"  placeholder="Product size">
        </div>
    </div>--}}

    {{--<div class="form-group">
        <label class="col-sm-4 control-label">
            <b> Product Purchase Price </b>
        </label>
        <div class="col-sm-10">
            <input required type="number" name="parchase_price" class="form-control" placeholder="Product Parchase Price">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">
            <b> Product Sale Price </b>
        </label>
        <div class="col-sm-10">
            <input required type="number" name="sale_price" class="form-control" placeholder="Product Sale Price">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4 control-label">
            <b> Product Initial Stock </b>
        </label>
        <div class="col-sm-10">
            <input required type="number" name="stock" class="form-control"  placeholder="Product Initial Stock">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4 control-label">
            <b> Product Expire Date </b>
        </label>
        <div class="col-sm-10">
            <input required type="date" name="expire" class="form-control">
        </div>
    </div>--}}


    <!-- /.container-fluid -->

    <!-- /Modal Part Start -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Product</h4>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{url('/update_product')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">
                                <b> Product Name </b>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" value="" class="form-control"
                                       id="productName" name="name" placeholder="Type Product full Name">
                                <input type="hidden" name="productId" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4">
                                <button type="submit" class="form-control btn btn-danger">Submit</button>
                            </div>
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

    <script>
        function Edit(id, name) {
            $("#productName").val(name);
            $("#productId").val(id);
        }
    </script>


@endsection
