@extends('admin_master')
@section('admin_content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->


            <!-- Icon Cards-->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-comments"></i>
                            </div>

                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">Today's Total Visit</span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list"></i>
                            </div>

                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">Today's Total Sale</span>
                        </a>
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

    </div>

@endsection