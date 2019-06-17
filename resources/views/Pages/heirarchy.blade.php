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

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header"><h4 class="modal-title">Modal Header</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

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
    <script src="{{asset('js/d3-context-menu.js')}}"></script>

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
                        height = 1000 - margin.top - margin.bottom;

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
                        .attr("height", height + margin.top + margin.bottom).append("g").attr('data-toggle', 'modal')
                        .attr('data-target', '#myModal').style('cursor', 'pointer')
                        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                    /*var anchor = svg.append('a')
                     .attr('href', '#')
                     .attr('type', 'plants-family')
                     .attr('data-toggle', 'modal')
                     .attr('data-target', '#myModal').style('cursor', 'pointer');

                     anchor.append('rect').attr('width', 120).attr('height', 30).attr('x', 40).attr('y', 20).style('fill', '#ccc');

                     anchor.append('text').text('Sample modal!').attr('x', 50).attr('y', 40);*/

                    /*   var men = [
                     {
                     title: 'Rename node',

                     action: function(d, i) {
                     console.log('Item #1 clicked!');
                     console.log('The data for this circle is: ' + d);
                     }
                     /!*action: function(elm, d, i) {
                     console.log('Rename node');
                     $("#RenameNodeName").val(d.name);
                     rename_node_modal_active = true;
                     node_to_rename = d
                     $("#RenameNodeName").focus();
                     $('#RenameNodeModal').foundation('reveal', 'open');
                     }*!/
                     },
                     {
                     title: 'Delete node',

                     action: function(d, i) {
                     console.log('Item #1 clicked!');
                     console.log('The data for this circle is: ' + d);
                     }
                     /!* action: function(elm, d, i) {
                     console.log('Delete node');
                     delete_node(d);
                     }*!/
                     },
                     {
                     title: 'Create child node',

                     action: function(d, i) {
                     console.log('Item #1 clicked!');
                     console.log('The data for this circle is: ' + d);
                     }
                     /!*action: function(elm, d, i) {
                     console.log('Create child node');
                     create_node_parent = d;
                     create_node_modal_active = true;
                     $('#CreateNodeModal').foundation('reveal', 'open');
                     $('#CreateNodeName').focus();
                     }*!/
                     }
                     ]*/
                    /* svg.selectAll('circles')
                     .append('circle')
                     .attr('r', 30)
                     .attr('fill', 'steelblue')
                     .attr('cx', function(d) {
                     return 100;
                     })
                     .attr('cy', function(d) {
                     return d * 100;
                     })*/
                    // attach menu to element)
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
                        node.append("circle")
                            .attr('r', 10).attr("id", "nodeid");
                        node.append("text")
                            .attr("dy", ".60em")
                            .attr("y", function (d) {
                                return d.children ? -20 : 20;
                            })
                            .style("text-anchor", "middle")
                            .text(function (d) {
                                return d.data.name;
                            });
                        /*    node.append("g").attr('data-toggle', 'modal')
                         .attr('data-target', '#myModal').style('cursor', 'pointer');
                         */


                        function dragstarted(d) {
                            d3.select(this).raise().classed("active", true);
                            dragStarted = null;
                        }

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
                                var s = d.name;
                                return s;
                            })
                            .style("fill-opacity", 1e-6);
                        // d3.select('contextmenu', menu);
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


                        var create_node_modal_active = false;
                        var rename_node_modal_active = false;
                        var create_node_parent = null;
                        var node_to_rename = null;

                        function generateUUID() {
                            var d = new Date().getTime();
                            var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
                                var r = (d + Math.random() * 16) % 16 | 0;
                                d = Math.floor(d / 16);
                                return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
                            });
                            return uuid;
                        };

                        function create_node() {
                            if (create_node_parent && create_node_modal_active) {
                                if (create_node_parent._children != null) {
                                    create_node_parent.children = create_node_parent._children;
                                    create_node_parent._children = null;
                                }
                                if (create_node_parent.children == null) {
                                    create_node_parent.children = [];
                                }
                                id = generateUUID();
                                name = $('#CreateNodeName').val();
                                new_node = {
                                    'name': name,
                                    'id': id,
                                    'depth': create_node_parent.depth + 1,
                                    'children': [],
                                    '_children': null
                                };
                                console.log('Create Node name: ' + name);
                                create_node_parent.children.push(new_node);
                                create_node_modal_active = false;
                                $('#CreateNodeName').val('');

                            }
                            close_modal();
                            outer_update(create_node_parent);
                        }

                        function rename_node() {
                            if (node_to_rename && rename_node_modal_active) {
                                name = $('#RenameNodeName').val();
                                console.log('New Node name: ' + name);
                                node_to_rename.name = name;
                                rename_node_modal_active = false;

                            }
                            close_modal();
                            outer_update(node_to_rename);
                        }

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

                        // nodes.onclick("click", onUpdate(d))
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

                    function delete_node(node) {
                        visit(treeData, function (d) {
                                if (d.children) {
                                    for (var child of d.children) {
                                        if (child == node) {
                                            d.children = _.without(d.children, child);
                                            update(root);
                                            break;
                                        }
                                    }
                                }
                            },
                            function (d) {
                                return d.children && d.children.length > 0 ? d.children : null;
                            });
                    }
                },

                dataType: "json"
            })
        });


    </script>

@endsection