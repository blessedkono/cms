<div class="row">
    <div class="col-md-12">
        <section class="card card-primary mb-4">
            <header class="card-header card-header-custom">
                <div class="card-actions">
                    {{--Action Links--}}

                    <div class="row">
                        <div class="col-md-12" >
                            <div class="pull-right" >
                                <a href="#changePasswordModal" data-toggle="modal"   ><i class="fas fa-key"></i>&nbsp;{{ __('label.change_password') }}</a>&nbsp;&nbsp;
                                <a class =''  href="{{ route('user.edit', $user->uuid) }}"  ><i class="fas fa-user-edit"></i>&nbsp;{{ __('label.crud.edit') }}</a>&nbsp;&nbsp;

                                <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                            </div>
                        </div>
                    </div>

                </div>

                <h2 class="card-title">{{ __('label.user_registration.user_info') }}</h2>
            </header>
            <div class="card-body">

                {{--CONTENT--}}
                {{--1--}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">

                            {{--Left--}}
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4" >{{ __('label.username')}}:</label>
                                    <label class="col-lg-8 ">{{ $user->username }}</label>

                                </div>
                            </div>

                            {{--Right--}}
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4" >{{ __('label.firstname')}}:</label>
                                    <label class="col-lg-8 ">{{ $user->firstname }}</label>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                {{--2--}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">

                            {{--Left--}}
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4" >{{ __('label.middlename')}}:</label>
                                    <label class="col-lg-8 ">{{ $user->middlename }}</label>
                                </div>
                            </div>

                            {{--Right--}}
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4" >{{ __('label.lastname')}}:</label>
                                    <label class="col-lg-8 ">{{ $user->lastname }}</label>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>


                {{--3--}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">

                            {{--Left--}}
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4" >{{ __('label.mobile')}}:</label>
                                    <label class="col-lg-8">{{ $user->phone }}</label>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4" >{{ __('label.email')}}:</label>
                                    <label class="col-lg-8">{{ $user->email   }}</label>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                {{--4--}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">

                            {{--Left--}}
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4" >{{ __('label.registration_date')}}:</label>
                                    <label class="col-lg-8">{{ $user->created_at_formatted }}</label>

                                </div>
                            </div>

                            {{--Right--}}
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-4" >{{ __('label.last_login')}}:</label>
                                    <label class="col-lg-8 ">{{ $user->last_login }}</label>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>




            </div>
        </section>
    </div>



</div>



{{--Change Passwrod MODAL--}}
@include('cms.access.user.profile.modals.change_password', ['user' => $user])
