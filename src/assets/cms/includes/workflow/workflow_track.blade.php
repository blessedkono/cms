{{--@include('backend.includes.toastr_assets')--}}
@push('after-styles')
    {{--{{ Html::style(asset_url() . "/nextbyte/plugins/sweetalert/css/sweetalert.css") }}--}}
    {{--{{ Html::style(asset_url() . "/nextbyte/plugins/sweetalert/css/google.css") }}--}}
@endpush

<div id="workflow-content" >

</div>

@push('after-scripts')
    {{ Html::script(asset_url(). "/nextbyte/plugins/sweetalert/js/sweetalert.min.js") }}
    {{ Html::script(asset_url(). "/nextbyte/plugins/autosize/js/autosize.min.js") }}

    <script>
        $(function() {


            // initTable("completed_workflow");
            var $current_wf_track_id = '{!! $current_wf_track->id !!}';

            // // $("#modal-content").empty();
            load_workflow_modal($current_wf_track_id);

            function load_workflow_modal($wf_track_id) {
                     $.get("{!! route('workflow.workflow_content') !!}", {'wf_track_id': $current_wf_track_id}, function (data) {
                    $("#workflow-content").empty();
                    $(data).prependTo("#workflow-content");
                }, "html").done(function () {
                    /* $(".search-select").select2({}); */
                    let $body = $("body");
                    $body.off("change", ".workflow_status_select").on("change", ".workflow_status_select", function (e) {

                        let $status = $(this).val();
                        let $wf_track_id = $(this).attr("data-track_id");
                        let $next_level_designation = $(".next_level_designation");
                        let $reject_to_level = $(".reject_to_level");
                        let $reject_to_level_select = $(".reject_to_level_select");
                        let $selective = $(".selective");
                        let $selective_select = $(".selective_select");
                        let $next_level_designation_content = $(".next_level_designation_content");
                        let $assign_to_level = $(".assign_to_level");
                        // $assign_to_level.hide();
                        switch ($status) {
                            case '1':
                                                         $assign_to_level.show();
                                /*case '4':*/
                                if ($status === "1") {
                                    $selective.show();
                                    $selective_select.prop("disabled", false);

                                } else {
                                    $selective.hide();
                                    $selective_select.prop("disabled", true);
                                }
                                $reject_to_level.hide();
                                $.post(base_url + "/workflow/next_level_designation/" + $wf_track_id + "/" + $status, {}, function ($data) {
                                    /*alert($data.skip);*/
                                    if ($data.next_level_designation !== "") {
                                        $next_level_designation.show();
                                        $next_level_designation_content.empty();
                                        $next_level_designation_content.html($data.next_level_designation);
                                    } else {
                                        $next_level_designation.hide();
                                    }
                                }, "json").done(function ($data) {
                                });
                                break;
                            case '2':
                                $selective.hide();
                                $selective_select.prop("disabled", true);
                                $assign_to_level.hide();
                                $next_level_designation.hide();
                                $reject_to_level.show();
                                $reject_to_level_select.prop("disabled", false);
                                $(".assign_to_level_select").prop("disabled", true);
                                break;
                            case '4':
                                $assign_to_level.hide();
                                $reject_to_level.hide();
                                $(".reject_to_level_select").prop("disabled", true);
                                $(".assign_to_level_select").prop("disabled", true);
                                break;
                            default:
                                $selective.hide();
                                $selective_select.prop("disabled", true);
                                $next_level_designation.hide();
                                $reject_to_level.hide();
                                $reject_to_level_select.prop("disabled", true);
                                break;
                        }
                    });
                    $('.workflow_status_select').trigger('change');
                    autosize($("textarea.autosize"));

                }).fail(function () {

                }).always(function () {

                });
            }

            let $body = $("body");
            $body.off("submit", "#approval_form").on("submit", "#approval_form", function () {
                $body.find("#submit_approval_modal").hide()
                $body.find("#form_status").show()
                $body.find("#form_status").text("Please wait...")
            });


        });



    </script>
@endpush
