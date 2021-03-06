@extends('admin_master')
@section('admin_content')
    <div id="content-wrapper">
        <div class=" container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 log">
                        <style>

                            .node {
                                cursor: pointer;
                            }

                            .node circle {
                                fill: #fff;
                                stroke: steelblue;
                                stroke-width: 3px;
                            }

                            .node text {
                                font: 12px sans-serif;
                            }

                            .link {
                                fill: none;
                                stroke: #ccc;
                                stroke-width: 2px;
                            }

                        </style>
                        <!-- load the d3.js library -->

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

        <div class=" container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 log">
                        <div class="card mb-3">
                            <div class="card-header">

                                <h1 class="text-uppercase text-primary text-center">Add Category</h1>
                            </div>
                            <div class="card-body">
                                <div class="col-sm-12 log">

                                    <form method="post" action="{{url('/saveCategory')}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label">
                                                <b> Category Name </b>
                                            </label>
                                            <div class="col-sm-8">
                                                <input required type="text" class="form-control" id="name" name="name"
                                                       placeholder="Type Name">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">
                                                    <b> Parent </b>
                                                </label>
                                                <div class="col-sm-8">
                                                    <select id="parent" name="parent" class="form-control">
                                                        <option value="">Select any one</option>
                                                        <?php

                                                        foreach ($all_category_info as $category) {
                                                        ?>
                                                        <option value="<?php echo $category->id ?>">
                                                            <?php echo $category->addcategory_name ?>
                                                        </option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <button type="submit" class="form-control btn btn-danger">Submit
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 log">
                        <div class="card mb-3">
                            <div class="card-header">

                                <h1 class="text-uppercase text-primary text-center">Edit Category</h1>
                            </div>
                            <div class="card-body">
                                <div class="col-sm-12 log">

                                    <form method="post" action="{{url('/editCategory')}}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label">
                                                <b> Category Name </b>
                                            </label>
                                            <div class="col-sm-8">


                                                <select id="name" name="name" class="form-control">
                                                    <option value="">Select any one</option>
                                                    <?php

                                                    foreach ($all_category_info as $category) {
                                                    ?>
                                                    <option value="<?php echo $category->id ?>">
                                                        <?php echo $category->addcategory_name ?>
                                                    </option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">
                                                    <b> Parent </b>
                                                </label>
                                                <div class="col-sm-8">
                                                    <select id="parent" name="parent" class="form-control">
                                                        <option value="">Select any one</option>
                                                        <?php

                                                        foreach ($all_category_info as $category) {
                                                        ?>
                                                        <option value="<?php echo $category->id ?>">
                                                            <?php echo $category->addcategory_name ?>
                                                        </option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <button type="submit" class="form-control btn btn-danger">Submit
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

@section('OuterJSInclude')
    <script src="http://d3js.org/d3.v3.min.js"></script>
    <script>
        var treeData;
        function ajaxCallBack(retString) {
            treeData = retString;
        }
        $(function () {
            $.ajax({
                url: '{{url("/addCategory")}}',
                type: "GET",
                success: function (msg) {
                    treeData = msg;
                    var margin = {top: 50, right: 120, bottom: 20, left: 120},
                        width = 960 - margin.right - margin.left,
                        height = 500 - margin.top - margin.bottom;

                    var i = 0,
                        duration = 750,
                        root;

                    var tree = d3.layout.tree()
                        .size([height, width]);

                    var diagonal = d3.svg.diagonal()
                        .projection(function (d) {
                            return [d.x, d.y];
                        });

                    var svg = d3.select("body").append("svg")
                        .attr("width", width + margin.right + margin.left)
                        .attr("height", height + margin.top + margin.bottom)
                        .append("g")
                        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                    root = msg[0];
                    root.x0 = height / 2;
                    root.y0 = 0;

                    update(root);

                    d3.select(self.frameElement).style("height", "500px");

                    function update(source) {

                        // Compute the new tree layout.
                        var nodes = tree.nodes(root).reverse(),
                            links = tree.links(nodes);

                        // Normalize for fixed-depth.
                        nodes.forEach(function (d) {
                            d.y = d.depth * 100;
                        });

                        // Update the nodes…
                        var node = svg.selectAll("g.node")
                            .data(nodes, function (d) {
                                return d.id || (d.id = ++i);
                            });

                        // Enter any new nodes at the parent's previous position.
                        var nodeEnter = node.enter().append("g")
                            .attr("class", "node")
                            .attr("transform", function (d) {
                                return "translate(" + d.x + "," + d.y + ")";
                            })
                            .on("click", click);

                        nodeEnter.append("circle")
                            .attr("r", 1e-6)
                            .style("fill", function (d) {
                                return d._children ? "lightsteelblue" : "#fff";
                            });

                        nodeEnter.append("text")
                            .attr("y", function (d) {
                                return d.children || d._children ? -13 : 13;
                            })
                            .attr("dy", ".35em")
                            .attr("text-anchor", function (d) {
                                return d.children || d._children ? "end" : "start";
                            })
                            .text(function (d) {
                                return d.name;
                            })
                            .style("fill-opacity", 1e-6);

                        // Transition nodes to their new position.
                        var nodeUpdate = node.transition()
                            .duration(duration)
                            .attr("transform", function (d) {
                                return "translate(" + d.x + "," + d.y + ")";
                            });

                        nodeUpdate.select("circle")
                            .attr("r", 10)
                            .style("fill", function (d) {
                                return d._children ? "lightsteelblue" : "#fff";
                            });

                        nodeUpdate.select("text")
                            .style("fill-opacity", 1);

                        // Transition exiting nodes to the parent's new position.
                        var nodeExit = node.exit().transition()
                            .duration(duration)
                            .attr("transform", function (d) {
                                return "translate(" + d.x + "," + d.y + ")";
                            })
                            .remove();

                        nodeExit.select("circle")
                            .attr("r", 1e-6);

                        nodeExit.select("text")
                            .style("fill-opacity", 1e-6);

                        // Update the links…
                        var link = svg.selectAll("path.link")
                            .data(links, function (d) {
                                return d.target.id;
                            });

                        // Enter any new links at the parent's previous position.
                        link.enter().insert("path", "g")
                            .attr("class", "link")
                            .attr("d", function (d) {
                                var o = {x: source.x0, y: source.y0};
                                return diagonal({source: o, target: o});
                            });

                        // Transition links to their new position.
                        link.transition()
                            .duration(duration)
                            .attr("d", diagonal);

                        // Transition exiting nodes to the parent's new position.
                        link.exit().transition()
                            .duration(duration)
                            .attr("d", function (d) {
                                var o = {x: source.x, y: source.y};
                                return diagonal({source: o, target: o});
                            })
                            .remove();

                        // Stash the old positions for transition.
                        nodes.forEach(function (d) {
                            d.x0 = d.x;
                            d.y0 = d.y;
                        });

                        nodes.onclick("click", onUpdate(d))
                    }

                    // Toggle children on click.
                    function click(d) {
                        if (d.children) {
                            d._children = d.children;
                            d.children = null;
                        } else {
                            d.children = d._children;
                            d._children = null;
                        }
                        update(d);
                    }
                },

                dataType: "json"
            })
        });


    </script>

@endsection