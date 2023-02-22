@extends('layouts.app', [
    'class' => 'General Setting',
    'elementHead' => 'customization',
    'elementSub' => 'customization',
])

@section('content')
@php
    $logo = old('logo', @$data->logo);
    $favicon = old('favicon', @$data->favicon);
@endphp

<div class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title ">General Details</h4>
              <p class="card-category"> Here you can manage General Details (like: logo, links, contact details)</p>
            </div>
            <div class="card-body">
              <div id="GD-section">
                  <div class="row">
                    <div class="col-md-12">
                      <form method="post" action="{{route('staticPages.update','GD')}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="seotype-section pb-4">
                            <h5 class="card-title mb-3">Logo:</h5>
                            <div class="row justify-space-between" style="padding: 0 90px;">
                                <div class="col-md-4">
                                      <label class="">{{ __('logo Image') }}</label>
                                      <x-insert-img for='logo' :src=getImageById($logo) />
                                </div>
                              <div class="col-md-4">
                                    <label class="">{{ __('Site Logo') }}</label>
                                    <x-insert-img for='favicon' :src=getImageById($favicon) />
                                </div>
                            </div>
                          </div>
                        <div class="seotype-section pb-4">
                            <h5 class="card-title mb-3">Website:</h5>
                            <div class="row justify-space-between " style="padding: 0 90px;">
                                <div class="col-md-12 form-group">
                                    <label class="">{{ __('Name') }}</label>
                                    <input type="text" name="website_title" placeholder="website title" value="{{old('website_title',@$data->website_title)}}" class="form-control">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="">{{ __('short Description') }}</label>
                                    <textarea name="website_short_description" placeholder="website title" class="form-control">{{old('website_short_description',@$data->website_short_description)}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="seotype-section pb-4">
                          <h5 class="card-title mb-3">Contact Details:</h5>
                          <div class="row " style="padding: 0 90px;">
                              <div class="col-md-6 form-group">
                                    <label class="">{{ __('Official Email') }}</label>
                                    <input type="email" name="website_email_primary" placeholder="email@domain.com" value="{{old('website_email_primary',@$data->website_email_primary)}}" class="form-control">
                                </div>
                            <div class="col-md-6 form-group">
                                  <label class="">{{ __('Contact Number') }}</label>
                                  <input type="phone"  maxlength="15" name="website_phone_primary" placeholder="011256846" value="{{old('website_phone_primary',@$data->website_phone_primary)}}" class="form-control">
                              </div>
                              <div class="col-md-6 mt-4">
                                  <label class="" style="color:#2d2d2d">{{ __('Primary Address') }}</label>
                                  <textarea class="form-control" name="office_location" >{{old('office_location',@$data->office_location)}}</textarea>
                              </div>
                              <div class="col-md-6 mt-4">
                                  <label class="" style="color:#2d2d2d">{{ __('Google Share Link') }}</label>
                                  <textarea class="form-control" name="google_location" placeholder="Google Map -> Share -> Send a link">{{old('google_location',@$data->google_location)}}</textarea>
                              </div>
                            </div>
                        </div>
                        <div class="seotype-section pb-4">
                          <h5 class="card-title mb-3">App Links:</h5>
                          <div class="row" style="padding: 0 90px;">
                              <div class="col-md-6 form-group">
                                    <label class="">{{ __('Android App link') }}</label>
                                    <input type="text" name="android_link" value="{{old('android_link',@$data->android_link)}}"  placeholder="Android App" class="form-control">
                                </div>
                            <div class="col-md-6 form-group">
                                  <label class="">{{ __('iOS App link') }}</label>
                                  <input type="text" name="iOS_link" placeholder="iOS App"  value="{{old('iOS_link',@$data->iOS_link)}}" class="form-control">
                              </div>
                            </div>
                        </div>
                        <div class="seotype-section pb-4">
                          <h5 class="card-title mb-3">Social Media Links:</h5>
                          <div class="row" style="padding: 0 90px;">
                              <div class="col-md-6 form-group">
                                    <label class="">{{ __('Facebook') }}</label>
                                    <input type="text" name="facebook_link" placeholder="#Facebook Link"  value="{{old('facebook_link',@$data->facebook_link)}}" class="form-control">
                                </div>
                              <div class="col-md-6 form-group">
                                  <label class="">{{ __('Instagram') }}</label>
                                  <input type="text" name="instagram_link" placeholder="#Instagram Link"  value="{{old('instagram_link',@$data->instagram_link)}}" class="form-control">
                              </div>
                              <div class="col-md-6 form-group mt-4">
                                    <label class="">{{ __('Youtube') }}</label>
                                    <input type="text" name="youtube_link" placeholder="#Youtube Chanel Link"  value="{{old('youtube_link',@$data->youtube_link)}}" class="form-control">
                              </div>
                              <div class="col-md-6 form-group mt-4">
                                    <label class="">{{ __('twitter') }}</label>
                                    <input type="text" name="twitter_link" placeholder="#twitter Link"  value="{{old('twitter_link',@$data->twitter_link)}}" class="form-control">
                              </div>
                              <div class="col-md-6 form-group mt-4">
                                  <label class="">{{ __('Linkedin') }}</label>
                                  <input type="text" name="linkedin_link"  placeholder="#Linkedin Link"  value="{{old('linkedin_link',@$data->linkedin_link)}}" class="form-control">
                              </div>
                              <div class="col-md-6 form-group mt-4">
                                  <label class="">{{ __('pinterest') }}</label>
                                  <input type="text" name="pinterest_link"  placeholder="#pinterest Link"  value="{{old('pinterest_link',@$data->pinterest_link)}}" class="form-control">
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input name="submit" type="submit" class="btn btn-success" value="SUBMIT">
                        </div>
                      </form>
                    </div>
                  </div>
              </div>
            </div>
          </div>

      </div>
    </div>
  </div>
</div>

@endsection
