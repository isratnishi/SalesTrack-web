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


        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Visit info
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">Manage Category TreeView</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Category List</h3>
                            <ul id="tree1">
                                @foreach($categories as $category)
                                    <li>
                                        {{ $category->title }}
                                        @if(count($category->childs))
                                            @include('manageChild',['childs' => $category->childs])
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h3>Add New Category</h3>


                            {!! Form::open(['route'=>'add.category']) !!}


                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif


                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                {!! Form::label('Title:') !!}
                                {!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            </div>


                            <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                                {!! Form::label('Category:') !!}
                                {!! Form::select('parent_id',$allCategories, old('parent_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}
                                <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                            </div>


                            <div class="form-group">
                                <button class="btn btn-success">Add New</button>
                            </div>


                            {!! Form::close() !!}


                        </div>
                    </div>


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
    <script src="/js/treeview.js"></script>
    <!-- Sticky Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright © Your Website 2018</span>
            </div>
        </div>
    </footer>


@endsection
