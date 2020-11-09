@extends('layouts.main', ['title' => __("label.contact_us"), 'header' => __("label.contact_us")])
@section("content")


    <!-- contact form start -->
    <div class="contact-form-area pd-top-112">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="section-title text-center w-100">
                        <h2 class="title">Testimonial <span></span></h2>
                        <div class="alert alert-success" id="success_alert" role="alert" style="display: none">

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-2">
                    {{--                    <img src="{{asset('cms/img/psms_logo.png')}}" alt="blog" style="margin-left: 100px">--}}
                </div>
                <div class="col-lg-8 offset-xl-1">
                    {!! Form::open(['route' => ['submit_testimonial',$client->uuid],'method'=>'post', 'autocomplete' => 'off',  'id' =>'contact_us', 'class' => 'form-horizontal needs-validation', 'novalidate','enctype'=>"multipart/form-data"]) !!}
                    <div class="row custom-gutters-16">
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                <input type="text" name="name" class="single-input" id="name">
                                <label>Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-input-wrap">
                                {{ Form::select('designation_id',$designations,null,['class'=>'single-input ', 'required', 'id' => 'designation_id','placeholder' => '', 'autocomplete' => 'off']) }}
                                <label>Position</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-input-wrap">
                                <input type="text" name="company" class="single-input" id="subject">
                                <label>Company</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="single-input-wrap">
                                <textarea class="single-input textarea" name="content" cols="20" id="message"></textarea>
                                <label class="single-input-label">Message</label>
                            </div>
                        </div>
                        <div class="col-6 offset-5">
                            <button type="submit" class="btn btn-red btn-xs mt-0 text-center" >Send</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-2">
                    {{--                    <img src="{{asset('cms/img/psms_logo.png')}}" alt="blog" style="margin-left: 100px">--}}
                </div>
            </div>
        </div>
    </div>



@endsection

@push('after-scripts')
    <script>
        function myFunction(e){
            var name = $('#name').val();
            var email  = $('#email').val();
            var subject  = $('#subject').val();
            var message  = $('#message').val();
            var data = {
                'name' :name,
                'email' : email,
                'subject' : subject,
                'message' : message,

            };
            if (name.length == 0 || email.length == 0 || subject.length == 0 || message.length == 0 )
            {

                return false;
            }
            var url = '{{route('general_information.contact_us.send')}}';
            $.ajax({
                type: 'post',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                cache: false,

                success: function (response) {
                    if (response) {
                        document.getElementById("contact_us").reset();
                        document.getElementById("success_alert").append('Successfully!! Thank you for contact us!');
                        document.getElementById("success_alert").style.display ="block";
                    }
                },
            }).done(

            );      }

        //va
    </script>



@endpush
