@extends('cms.layouts.cms', ['title' => __('label.profile') , 'header' => __('label.profile')])

@include('includes.sweetalert_assets')

@push('after-styles')
    <style>
    </style>
@endpush

@section('content')


    <div class="row">
        <div class="col">
            <div class="tabs tabs-dark">

                {{--Start: Tab Contents--}}
                <div class="tab-content">
                    <div id="general" class="tab-pane active">

                        <div class = "row">
                            <div class="col-md-12">
                                <div class="pull-right">
                                        <a href="{{ route('cms.testimonial.edit',$client_testimonial->uuid) }}" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i> {{ __('label.crud.edit') }}</a>
                                    {{ $client_testimonial->change_status_button }}

                                    {!! HTML::decode(link_to_route('cms.testimonial.delete', trans('label.crud.delete'), [$client_testimonial->uuid], ['data-method' => 'delete', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.warning'), 'data-trans-text' => trans('alert.general.alert.delete'), 'class' => 'btn btn-danger btn-xs'])) !!}
                                    <a href="{{ route('cms.testimonial.index') }}" class="btn btn-xs btn-info"><i class="fas fa-closed-captioning"></i> {{ __('label.close') }}</a>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-9">
                                <legend style="background-color: lightgray; color: grey;"> {{ __('label.general_info') }}</legend>
                                <br/>
                                <table class="table table-striped table-bordered" id="sidebar_summary">
                                    <tbody>
                                    <tr>
                                        <th width="130px">{{ __('label.cms.client.client') }}</th>
                                        <td>{{ $client_testimonial->client->name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="130px">{{ __('label.designation') }}</th>
                                        <td>{{ $client_testimonial->designation->name }}  <b>({{ $client_testimonial->designation->short_name }})</b></td>
                                    </tr>
                                    <tr>
                                        <th width="130px">{{ __('label.company') }}</th>
                                        <td>{{ $client_testimonial->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="130px">{{ __('label.isactive') }}</th>
                                        <td>{{ ($client_testimonial->isactive)?trans('label.yes'):trans('label.no') }}</td>
                                    </tr>
                                    <tr>
                                        <th width="130px">{{ trans('label.created_at') }}</th>
                                        <td>{{ short_date_format($client_testimonial->created_at) }}</td>
                                    </tr>



                                    <tr>
                                        <th width="130px">{{ __('label.note') }}</th>
                                        <td>{{ (($client_testimonial->content)) }}</td>
                                    </tr>


                                    </tbody>
                                </table>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        $(function() {
        });
    </script>
@endpush
