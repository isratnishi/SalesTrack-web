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
                    <h1 class="text-uppercase text-primary text-center">Add a new User</h1>
                    <form method="post" action="{{url('/saveUser')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <label for="name" class="col-sm-12 control-label">
                                    <b> Sales Person Name </b>
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <input required type="text" class="form-control" id="name" name="name"
                                           placeholder="full Name">
                                </div>
                            </div>
                            <div class="row">
                                <label for="name" class="col-sm-12 control-label">
                                    <b> Email </b>
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <input required type="text" class="form-control" id="email" name="email"
                                           placeholder="Email">
                                </div>
                            </div>
                            <div class="row">
                                <label for="password" class="col-sm-12 control-label">
                                    <b> Password </b>
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <input required type="text" class="form-control" id="password" name="password"
                                           placeholder="Password">
                                </div>
                            </div>
                            <div class="col-sm-2">
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
                Products List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($all_user_info as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user->name ?></td>
                            <td><?php echo $user->email ?></td>
                            <td><?php echo $user->password ?></td>
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
