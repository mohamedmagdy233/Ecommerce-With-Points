@extends('admin/layouts/master')

@section('title')
    {{ config()->get('app.name') ?? ''}} | {{ trns('settings') }}
@endsection
@section('page_name')
    الاعدادات
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> {{ trns('settings') }} {{ config()->get('app.name') ?? ''}}</h3>
                </div>
                <div class="card-body">
                    <form id="updateForm" method="POST" enctype="multipart/form-data"
                          action="{{route('settingUpdate',1)}}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="logo" class="form-control-label">{{ trns('logo') }}</label>
                                    <input type="file" id="testDrop" class="dropify" name="logo"
                                           data-default-file="{{ isset($setting) ? getFile($setting->logo) : getFile(null)  }}"/>
                                </div>
                                <div class="col-6">
                                    <label for="favicon" class="form-control-label">{{ trns('favicon') }}</label>
                                    <input type="file" id="testDrop" class="dropify" name="favicon"
                                           data-default-file="{{ isset($setting) ? getFile($setting->favicon) : getFile(null) }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">

                                    <label for="title_ar" class="form-control-label">{{ trns('title_arabic') }}</label>
                                    <input type="text" class="form-control" name="title_ar" id="title_ar"
                                           value="{{isset($setting) ? $setting->title_ar : ''}}">
                                </div>
                                <div class="col-6">
                                    <label for="title_en" class="form-control-label">{{ trns('title_english') }}</label>
                                    <input type="text" class="form-control" name="title_en" id="title_en"
                                           value="{{isset($setting) ? $setting->title_en : ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">

                                    <label for="location_ar" class="form-control-label">{{ trns('location_arabic') }}</label>
                                    <input type="text" class="form-control" name="location_ar" id="location_ar"
                                           value="{{isset($setting) ? $setting->location_ar : ''}}">
                                </div>
                                <div class="col-6">
                                    <label for="location_en" class="form-control-label">{{ trns('location_english') }}</label>
                                    <input type="text" class="form-control" name="location_en" id="location_en"
                                           value="{{isset($setting) ? $setting->location_en : ''}}">
                                </div>

                                <div class="col-6">

                                    <label for="location_ar" class="form-control-label">{{ trns('footer_arabic') }}</label>
                                    <input type="text" class="form-control" name="footer_ar" id="footer_ar"
                                           value="{{isset($setting) ? $setting->location_ar : ''}}">
                                </div>
                                <div class="col-6">
                                    <label for="location_en" class="form-control-label">{{ trns('footer_english') }}</label>
                                    <input type="text" class="form-control" name="footer_en" id="footer_en"
                                           value="{{isset($setting) ? $setting->location_en : ''}}">
                                </div>


                                <div class="col-12">
                                    <label for="location_url" class="form-control-label">{{ trns('location_url') }}</label>
                                    <input type="url" class="form-control" name="location_url" id="location_url"
                                           value="{{isset($setting) ? $setting->location_url : ''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">

                                    <label for="email" class="form-control-label">{{ trns('email') }}</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           value="{{ isset($setting) ? $setting->email : ''}}">
                                </div>
                                <div class="col-4">
                                    <label for="phone" class="form-control-label"> {{ trns('phone') }}</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                           value="{{ isset($setting) ? $setting->phone : ''}}">
                                </div>
                                <div class="col-4">
                                    <label for="phone" class="form-control-label">{{ trns('working_hours') }}</label>
                                    <input type="text" class="form-control" name="working_hours" id="working_hours"
                                           value="{{ isset($setting) ? $setting->working_hours : ''}}">
                                </div>
                            </div>


                            <hr>
                            <h4 class="text-center">{{  trns('terms_and_conditions')}}</h4>
                            <div class="row">
                                <div class="col-12">
                                    <label for="terms" class="form-control-label"> {{ trns('terms') }}</label>
                                    <textarea class="form-control editor" rows="5" name="terms"
                                           id="terms">{{isset($setting) ? $setting->terms : ''}}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="privacy" class="form-control-label">{{ trns('privacy') }}</label>
                                    <textarea class="form-control editor" rows="10" name="privacy"
                                           id="privacy">{{isset($setting) ? $setting->privacy : ''}}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="faqs" class="form-control-label">{{ trns('faqs') }}</label>
                                    <textarea class="form-control editor" rows="10" name="faqs"
                                           id="faqs">{{isset($setting) ? $setting->faqs : ''}}</textarea>
                                </div>
                            </div>
                            <hr>
                            <h4 class="text-center">{{  trns('social_media')}}</h4>

                            <div class="row">
{{--                                <div class="col-6">--}}
{{--                                    <label for="facebook" class="form-control-label">{{ trns('facebook') }}</label>--}}
{{--                                    <input type="url" class="form-control" name="facebook"--}}
{{--                                           id="footer_ar" value="{{isset($setting) ? $setting->facebook : ''}}">--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="twitter" class="form-control-label"> {{ trns('twitter') }}</label>--}}
{{--                                    <input type="url" class="form-control" name="twitter"--}}
{{--                                           id="footer_ar" value="{{isset($setting) ? $setting->twitter : ''}}">--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="instagram" class="form-control-label"> {{ trns('instagram') }}</label>--}}
{{--                                    <input type="url" class="form-control" name="instagram"--}}
{{--                                           id="footer_ar" value="{{isset($setting) ? $setting->instagram : ''}}">--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="youtube" class="form-control-label"> {{ trns('youtube') }}</label>--}}
{{--                                    <input type="url" class="form-control" name="youtube"--}}
{{--                                           id="footer_ar" value="{{isset($setting) ? $setting->youtube : ''}}">--}}
{{--                                </div>--}}

                                <div class="col-6">
                                    <label for="youtube" class="form-control-label"> {{ trns('price_of_point') }}</label>
                                    <input type="number" class="form-control" name="price_of_point"
                                            value="{{isset($setting) ? $setting->price_of_point : ''}}" min="0" step="0.01">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="updateButton">{{ trns('update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    @include('admin/layouts/myAjaxHelper')
@endsection
@section('ajaxCalls')

    <script>
        editScript();
    </script>
@endsection


