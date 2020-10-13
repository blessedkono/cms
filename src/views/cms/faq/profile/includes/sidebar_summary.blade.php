<div class="row">
    <div class="col-md-12">
        <section class="card card-primary mb-4">
            <header class="card-header card-header-custom">
                <div class="card-actions">
                    {{--Action Links--}}

                    <div class="row">
                        <div class="col-md-12" >
                            <div class="pull-right" >
                                <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                            </div>
                        </div>
                    </div>

                </div>

                <h2 class="card-title">{!! __('label.summary') !!}  </h2>
            </header>
            <div class="card-body">

                {{--<div class="row">--}}
                <table style="width:100%; ">


                    <tr>
                        <td style="padding:10px;"     width="120px">{!! __('label.business.posted_on') !!}:</td>
                        <th>{!! ($faq->created_at) !!}</th>
                    </tr>

                    {{--<tr>--}}
                        {{--<td style="padding:10px;"     width="120px">{!! __('label.views_count') !!}:</td>--}}
                        {{--<th>{!! $faq->getUniqueViews() !!}</th>--}}
                    {{--</tr>--}}

                </table>

                {{--</div>--}}


            </div>

        </section>
    </div>
</div>


