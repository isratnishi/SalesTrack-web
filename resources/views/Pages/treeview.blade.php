@extends('admin_master')
@section('admin_content')
    <script src="{{asset('admin_assets/js/d3.v3.min.js')}}"></script>
    <script src="{{asset('admin_assets/dndTree.js')}}"></script>
    <script src="{{asset('admin_assets/js/underscore-min.js')}}"></script>
    <script src="{{asset('admin_assets/js/jquery.js')}}"></script>
    <script src="{{asset('admin_assets/js/fastclick.js')}}"></script>
    <script src="{{asset('admin_assets/js/foundation.min.js')}}"></script>

    <div id="content-wrapper">
        <div id="RenameNodeModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true"
             role="dialog">
            <h2 id="modalTitle">Rename Node</h2>
            <form id="RenameNodeForm">
                <div class="row">
                    <div class="large-12 columns">
                        <label>Node name
                            <input type="text" class="inputName" id='RenameNodeName' placeholder="node name"/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-8 columns">
                        &nbsp;
                    </div>
                    <div class="large-4 columns">
                        <a href="#" class="button info" onclick="close_rename_node_modal()">Cancel</a>
                        <a href="#" class="button success" onclick="rename_node()">Rename</a>
                    </div>
                </div>
            </form>
            <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>

        <div id="CreateNodeModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true"
             role="dialog">
            <h2 id="modalTitle">Create Node</h2>
            <form id="CreateNodeForm">
                <div class="row">
                    <div class="large-12 columns">
                        <label>Node name
                            <input type="text" class="inputName" id='CreateNodeName' placeholder="node name"/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-8 columns">
                        &nbsp;
                    </div>
                    <div class="large-4 columns">
                        <a href="#" class="button info" onclick="close_create_node_modal()">Cancel</a>
                        <a href="#" class="button success" onclick="create_node()">Create</a>
                    </div>
                </div>
            </form>
            <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>

        <div id="tree-container"></div>


        <script>
            // for the first initialization
            $('document').ready(function () {
                $(document).foundation();
                $(document).on('opened', '[data-reveal]', function () {
                    var element = $(".inputName:visible").first();
                    element.focus(function () {
                        this.selectionStart = this.selectionEnd = this.value.length;
                    });
                    element.focus();
                });
                $('#RenameNodeForm').submit(function (e) {
                    rename_node();
                    return false;
                });
                $('#CreateNodeForm').submit(function (e) {
                    create_node();
                    return false;
                });
                var treeJSON = d3.json("tree.json", draw_tree);
            });
        </script>
    </div>
@endsection