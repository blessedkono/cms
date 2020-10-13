@extends('layouts.main', ['title' => trans('label.faqs'), 'header' => trans('label.faqs')])
@push('after-styles')
    {!! Html::style(url('vendor/sweetalert/sweetalert.css')) !!}
    <style>


    </style>

@endpush

@section('content')
    <div class="alert alert-default">
         {!! __('pagination.page_info.system.faq_search_intro_text') . ' - ' . '<b>'  . (!empty($category_name) ? $category_name : (__('label.all'))) . '</b>' !!}
    </div>
    <div class="row">
        <div class="col-md-2">
            <section class="card card-featured card-featured-primary mb-4">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                    </div>
                    <h2 class="card-title">@lang('label.system.faq.faq_categories')</h2>
                </header>
                <div class="card-body">

                    <div id='category-menu'>
                        <ul class='ul-category list-unstyled'>
                            <i class="fas fa-angle-right"></i>
                            <a href="{{ route('faq.search') }}" class="categories-links">
                                @lang('label.all')
                            </a>
                            <br/>
                            <i class="fas fa-angle-right"></i>
                            <a href="{{ route('faq.search.general') }}" class="categories-links">
                                @lang('label.general')
                            </a>

                            @foreach(code_value()->getCodeValues(2) as $category)

                                <li>
                                    <i class="fas fa-angle-right"></i>

                                    @if(count(code_value()->getCodeCategory($category->id)))
                                        <a href="#" class="categories-links" id="{!! $category->id !!}">
                                            {{ code_value()->name($category->id)}}
                                        </a>

                                    <ul class='ul-subcategory list-unstyled {!! $category->id !!}' style="margin-left:10px;">

                                            @foreach(code_value()->getCodeValues(code_value()->getCodeCategory($category->id)->id) as $subcategory)
                                                <li>
                                                    <i class="fas fa-caret-right "></i>
                                                    <a href="{{ route('faq.search.sub_category', $subcategory->reference) }}" class="categories-links" style="color: #4a4a4a;">
                                                        {{ code_value()->name($subcategory->id)}}
                                                    </a>
                                                </li>
                                            @endforeach


                                    </ul>
                                        @else  <a href="{{ route('faq.search.category', $category->reference) }}" class="categories-links" id="{!! $category->id !!}">
                                        {{ code_value()->name($category->id)}}
                                    </a>

                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-md-7">
            <section class="card card-featured card-featured-primary mb-4">
                <div class="card-body">
                    @if(($faqs->isNotEmpty()))
                        <div class="row">
                            <div class="container">
                                @foreach($faqs as $faq)

                                    <div class="accordion" id="accordionExample">
                                        <div class="">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-4">
                                                    <a class="accordion-toggle" type="" data-toggle="collapse" data-target="#{!! $faq->id !!}" aria-expanded="true" aria-controls="collapseOne">
                                                        {!!   (!empty($category_name) ? ($faq->rank  . '. ' ) : ' ') . $faq->title !!}
                                                    </a>
                                                </h5>
                                            </div>

                                            <div id="{!! $faq->id !!}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body" align="left">
                                                    {!! $faq->content !!}
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                    </div>

                            </div>
                            {!! $faqs->links() !!}
                            <p class="total-results text-muted pull-right">@lang('label.information.showing') {{ $faqs->firstItem() }} @lang('label.information.to') {{ $faqs->lastItem() }} @lang('label.information.of') {{ $faqs->total() }}  @lang('label.faqs')</p>

                            @else
                                <div class="alert alert-default">
                                    @lang('alert.system.faq.empty_faq_category'){!! (isset($category_) ? $category_->name : trans('label.faqs')) !!}
                                </div>
                            @endif
                        </div>
                        </div>
            </section>
        </div>
        <div class="col-md-3">
            @include("includes/ads/right_advert")
        </div>
    </div>



@endsection
@push('after-scripts')
    {!! Html::script(url('vendor/jquery-chained/jquery.chained.js')) !!}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script>
        $(function(){
            //using jquery to loop each li element and automatically add an arrow span if the element contains a child of ul list
            $('#category-menu ul li').each(function(){
                if ($(this).find('ul').length > 0)
                {
                    $(this).addClass("has-child");
                    // $(this).prepend("<span class='arrow'></span>");
                }
            });

            //bind an event to the li link that contains a child of ul list.
            $('#category-menu ul > li.has-child a').on("click", function(event){
                var currentArrow = $(this).parent().find(" > span");
                if($(currentArrow).length > 0){
                    if($(currentArrow).attr("class").indexOf("arrow-up") > 0){
                        $(currentArrow).removeClass("arrow-up");
                        $(currentArrow).parent().find(" > ul").slideUp();
                    }else{
                        $(currentArrow).addClass("arrow-up");
                        $(currentArrow).parent().find(" > ul").slideDown();
                    }
                }
            });


        });

    </script>
@endpush
