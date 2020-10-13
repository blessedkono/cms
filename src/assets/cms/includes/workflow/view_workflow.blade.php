@extends('layouts.main', ['title' => __("label.users"), 'header' => __("label.all_users")])

@push('after-styles')
    {{ Html::style(url('vendor/select2/css/select2.min.css')) }}
    {{ Html::style(url('vendor/jstree/themes/default/style.css')) }}
    {{ Html::style(url('js/duallistbox/bootstrap-duallistbox.css')) }}
    <style>

    </style>
@endpush

@section('content')

    <div class="row">


        <div class="col">

            <div class="row">
                <div class="col-lg-12">
                    <section class="card">
                        <header class="card-header">
                            <div class="card-actions">
                                <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                                <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                            </div>

                            <h2 class="card-title">Basic</h2>
                            <p class="card-subtitle">Interactive tree, basic sample.</p>
                        </header>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="treeBasic">
                                        <ul>
                                            <li data-jstree='{ "opened" : true }'>
                                                @lang('menu.workflow')                                <ul>
                                                    @foreach($wf_groups as $wf_group)
                                                        <li data-jstree='{ "opened" : true }'>

                                                            {{ $wf_group->name }}
                                                            <ul>

                                                                @foreach($wf_group->modules as $module)
                                                                    <li data-jstree='{ "opened" : true }'>
                                                                        {{ $module->name }}
                                                                        <ul>
                                                                            @foreach($module->definitions as $definition)
                                                                                <li data-jstree='{ "type" : "file" }' class="definition" id="{{ $definition->id }}">
                                                                                    {{$definition->level}}. {{ $definition->description }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            @endforeach
                                                        </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="demoform" action="#" method="post">
                                        <select multiple="multiple" size="10" name="duallistbox_demo1[]" title="duallistbox_demo1[]">
                                            <option value="option1">Option 1</option>
                                            <option value="option2">Option 2</option>
                                            <option value="option3" selected="selected">Option 3</option>
                                            <option value="option4">Option 4</option>
                                            <option value="option5">Option 5</option>
                                            <option value="option6" selected="selected">Option 6</option>
                                            <option value="option7">Option 7</option>
                                            <option value="option8">Option 8</option>
                                            <option value="option9">Option 9</option>
                                            <option value="option0">Option 10</option>
                                        </select>
                                        <br>
                                        <button type="submit" class="btn btn-default btn-block">Submit data</button>
                                    </form>


                                </div>
                            </div>


                        </div>
                    </section>
            </div>

            <div class="row">
                <div class="col-lg-12">



                </div>
            </div>




            <div class="col-lg-12" style="margin-left: -18px">
                {{--<section class="card">
                <h4 class="mb-3">Pvoc Applications</h4>
                <table class="table table-bordered" id="staff-workflow-definition">
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>Identity</th>
                        <th>Names</th>
                        <th>Email</th>
                        <th>Unit</th>
                        <th>Designation</th>
                        <th>Location</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
                </section>--}}






            </div>

        </div>

    </div>

@endsection


@push('after-scripts')

    {{ Html::script(url('vendor/jstree/jstree.js')) }}
    {{ Html::script(url('js/examples/examples.treeview.js')) }}
    {{ Html::script(url('js/duallistbox/jquery.bootstrap-duallistbox.js')) }}


    <script>
        $(function() {
            var id;
            $("#staff-workflow-definition").hide();
            $('.definition').on("click", function (e) {
                e.preventDefault();
                id = $(this).attr('id');
                $("#staff-workflow-definition").show();

            });
            $('#staff-workflow-definition').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('staff.workflow',1) }}",
                columns: [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                    /*{ data: 'staff_identity', name: 'staff_identity' },
                    { data: 'names', name: 'names' },
                    { data: 'email', name: 'email' },
                    { data: 'unit', name: 'unit' },
                    { data: 'designation', name: 'designation' },
                    { data: 'location', name: 'location' },
                    { data: 'role', name: 'role' },
                    { data: 'action', name: 'action', searchable: false }*/
                ]
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox({

            });

            $("#demoform").submit(function() {
                alert($('[name="duallistbox_demo1[]"]').val());
                return false;
            });

            /*$.ajax({
                url: '/api/Users/',
                method: "GET",
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, val) {
                        var opt  = "<option value=\'" + val.id + "\'>" + val.SomeText + "</option>";
                        $(".dual_select").append(opt);
                    });

                    $('.dual_select').bootstrapDualListbox({
                        moveOnSelect: false,
                        selectorMinimalHeight: 160
                    });
                }
            });*/

            //$('select[name="convocados[]"]').append(data);

            //$('select[name=convocados]').bootstrapDualListbox('refresh', true);


        })
    </script>


@endpush
