@extends('admin_master')
@section('admin_content')
    <div id="content-wrapper">
        <div class=" container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 log">
                        <style type="text/css">

                            .node {
                                cursor: pointer;
                            }

                            .overlay {
                                background-color: #EEE;
                            }

                            .node circle {
                                fill: #fff;
                                stroke: steelblue;
                                stroke-width: 1.5px;
                            }

                            .node text {
                                font-size: 10px;
                                font-family: sans-serif;
                            }

                            .link {
                                fill: none;
                                stroke: #ccc;
                                stroke-width: 1.5px;
                            }

                            .templink {
                                fill: none;
                                stroke: red;
                                stroke-width: 3px;
                            }

                            .ghostCircle.show {
                                display: block;
                            }

                            .ghostCircle, .activeDrag .ghostCircle {
                                display: none;
                            }
                        </style>
                        <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
                        <script src="http://d3js.org/d3.v3.min.js"></script>


                        <script src="{{asset('admin_assets/js/dndtree.js')}}"></script>
                        <body>
                        <div id="tree-container"></div>
                        </body>

                    </div>
                </div>
            </div>
        </div>
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
    </div>

@endsection