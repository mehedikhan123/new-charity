@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Settings</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="i1-tab" data-bs-toggle="tab" data-bs-target="#i1" type="button" role="tab" aria-controls="i1" aria-selected="true">Logo, Favicon, Banner</button>

                                    <button class="nav-link" id="i2-tab" data-bs-toggle="tab" data-bs-target="#i2" type="button" role="tab" aria-controls="i2" aria-selected="true">Seo</button>
                                    
                                    <button class="nav-link" id="i3-tab" data-bs-toggle="tab" data-bs-target="#i3" type="button" role="tab" aria-controls="i3" aria-selected="false">Top Bar</button>
                                    
                                    <button class="nav-link" id="i4-tab" data-bs-toggle="tab" data-bs-target="#i4" type="button" role="tab" aria-controls="i4" aria-selected="false">Footer</button>

                                    <button class="nav-link" id="i5-tab" data-bs-toggle="tab" data-bs-target="#i5" type="button" role="tab" aria-controls="i5" aria-selected="false">Contact</button>
                                    
                                    <button class="nav-link" id="i6-tab" data-bs-toggle="tab" data-bs-target="#i6" type="button" role="tab" aria-controls="i6" aria-selected="false">Map</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="i1" role="tabpanel" aria-labelledby="i1-tab" tabindex="0">
                                    <!-- Logo, Favicon, Banner - Start -->
                                    <form action="{{ isset($settings) ? route('admin.settings.photo.update', $settings->id) : route('admin.settings.photo.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @isset($settings)
                                            @method('put')
                                        @endisset
                                        <div class="row">
                                            <div class="col-md-6">
                                                @isset($settings->logo_1)
                                                    <div class="form-group mb-3">
                                                        <label>Existing First Logo</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$settings->logo_1) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="logo_1">{{ isset($settings->logo_1) ? 'Change' : 'Upload' }} First Logo</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="logo_1" id="logo_1">
                                                        @if ($errors->has('logo_1'))
                                                            <span class="text-danger">{{ $errors->first('logo_1') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($settings->logo_2)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Second Logo</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$settings->logo_2) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="logo_2">{{ isset($settings->logo_2) ? 'Change' : 'Upload' }} Second Logo</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="logo_2" id="logo_2">
                                                        @if ($errors->has('logo_2'))
                                                            <span class="text-danger">{{ $errors->first('logo_2') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($settings->favicon)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Favicon</label>
                                                        <div>
                                                            <img src="{{ isset($settings->favicon) ? asset ('storage/uploads/photo/'.$settings->favicon) : '' }}" alt="" class="w_50">
                                                        </div>
                                                    </div>
                                                @endisset
                                                <div class="form-group mb-3">
                                                    <label for="favicon">{{ isset($settings->favicon) ? 'Change' : 'Upload' }} Favicon</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="favicon" id="favicon">
                                                        @if ($errors->has('favicon'))
                                                            <span class="text-danger">{{ $errors->first('favicon') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($settings->banner)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Banner</label>
                                                        <div>
                                                            <img src="{{ isset($settings->banner) ? asset( 'storage/uploads/photo/'.$settings->banner) : '' }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset
                                                <div class="form-group mb-3">
                                                    <label for="banner">{{ isset($settings->banner) ? 'Change' : 'Upload' }} Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="banner" id="banner">
                                                        @if ($errors->has('banner'))
                                                            <span class="text-danger">{{ $errors->first('banner') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">{{  isset($settings) ? 'Update' : 'Submit'}}</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Logo, Favicon, Banner - End -->
                                </div>
                                
                                @isset($settings)
                                    <div class="tab-pane fade" id="i2" role="tabpanel" aria-labelledby="i2-tab" tabindex="0">
                                        <!-- Seo - Start -->
                                        <form action="{{ route('admin.settings.seo', $settings->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="seo_company_name">Company Name</label>
                                                        <input type="text" name="seo_company_name" id="seo_company_name" placeholder="Please enter company name" class="form-control" value="{{ $settings->seo_company_name }}">
                                                        @if ($errors->has('seo_company_name'))
                                                            <span class="text-danger">{{ $errors->first('seo_company_name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="seo_title">Title</label>
                                                        <input type="text" name="seo_title" id="seo_title" placeholder="Please enter title" class="form-control" value="{{ $settings->seo_title }}">
                                                        @if ($errors->has('seo_title'))
                                                            <span class="text-danger">{{ $errors->first('seo_title') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="seo_short_description">Short Description</label>
                                                        <textarea name="seo_short_description" id="seo_short_description" placeholder="Please enter short description" class="form-control h_100" cols="30" rows="10">{{ $settings->seo_short_description }}</textarea>
                                                        @if ($errors->has('seo_short_description'))
                                                            <span class="text-danger">{{ $errors->first('seo_short_description') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="seo_keywords">Keywords</label>
                                                        <select name="seo_keywords[]" id="seo_keywords" placeholder="Please enter keywords" class="form-select select2_tags" multiple="multiple">
                                                            @if($settings->seo_keywords)
                                                                @foreach ($settings->seo_keywords as $keyword)
                                                                    <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('seo_keywords'))
                                                            <span class="text-danger">{{ $errors->first('seo_keywords') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- Seo - End -->
                                    </div>
                                    <div class="tab-pane fade" id="i3" role="tabpanel" aria-labelledby="i3-tab" tabindex="0">
                                        <!-- Top Bar - Start -->
                                        <form action="{{ route('admin.settings.topbar', $settings->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="top_address">Address</label>
                                                        <input type="text" name="top_address" id="top_address" placeholder="Please enter address" class="form-control" value="{{ $settings->top_address }}">
                                                        @if ($errors->has('top_address'))
                                                            <span class="text-danger">{{ $errors->first('top_address') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="top_phone">Phone</label>
                                                        <input type="text" name="top_phone" id="top_phone" placeholder="Please enter phone number" class="form-control" value="{{ $settings->top_phone }}">
                                                        @if ($errors->has('top_phone'))
                                                            <span class="text-danger">{{ $errors->first('top_phone') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="top_email">Email</label>
                                                        <input type="text" name="top_email" id="top_email" placeholder="Please enter email address" class="form-control" value="{{ $settings->top_email }}">
                                                        @if ($errors->has('top_email'))
                                                            <span class="text-danger">{{ $errors->first('top_email') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- Top Bar - End -->
                                    </div>
                                    <div class="tab-pane fade" id="i4" role="tabpanel" aria-labelledby="i4-tab" tabindex="0">
                                        <form action="{{ route('admin.settings.footer', $settings->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <!-- Footer - Start -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="footer_address">Address</label>
                                                        <input type="text" name="footer_address" id="footer_address" placeholder="Please enter address" class="form-control" value="{{ $settings->footer_address }}">
                                                        @if ($errors->has('footer_address'))
                                                            <span class="text-danger">{{ $errors->first('footer_address') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="footer_phone">Phone</label>
                                                        <input type="text" name="footer_phone" id="footer_phone" placeholder="Please enter phone number" class="form-control" value="{{ $settings->footer_phone }}">
                                                        @if ($errors->has('footer_phone'))
                                                            <span class="text-danger">{{ $errors->first('footer_phone') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="footer_email">Email</label>
                                                        <input type="text" name="footer_email" id="footer_email" placeholder="Please enter email address" class="form-control" value="{{ $settings->footer_email }}">
                                                        @if ($errors->has('footer_email'))
                                                            <span class="text-danger">{{ $errors->first('footer_email') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @isset($settings->footer_logo)
                                                        <div class="form-group mb-3">
                                                            <label>Existing Logo</label>
                                                            <div>
                                                                <img src="{{ asset('storage/uploads/photo/'.$settings->footer_logo) }}" alt="" class="w_200">
                                                            </div>
                                                        </div>
                                                    @endisset
    
                                                    <div class="form-group mb-3">
                                                        <label for="footer_logo">{{ isset($settings->footer_logo) ? 'Change' : 'Upload' }} Logo</label>
                                                        <div>
                                                            <input type="file" class="form-control" name="footer_logo" id="footer_logo">
                                                            @if ($errors->has('footer_logo'))
                                                                <span class="text-danger">{{ $errors->first('footer_logo') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="facebook">Facebook</label>
                                                        <input type="text" name="facebook" id="facebook" placeholder="Please enter facebook url" class="form-control" value="{{ $settings->facebook }}">
                                                        @if ($errors->has('facebook'))
                                                            <span class="text-danger">{{ $errors->first('facebook') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="twitter">Twitter</label>
                                                        <input type="text" name="twitter" id="twitter" placeholder="Please enter twitter url" class="form-control" value="{{ $settings->twitter }}">
                                                        @if ($errors->has('twitter'))
                                                            <span class="text-danger">{{ $errors->first('twitter') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="youtube">YouTube</label>
                                                        <input type="text" name="youtube" id="youtube" placeholder="Please enter youtube url" class="form-control" value="{{ $settings->youtube }}">
                                                        @if ($errors->has('youtube'))
                                                            <span class="text-danger">{{ $errors->first('youtube') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="linkedin">Linkedin</label>
                                                        <input type="text" name="linkedin" id="linkedin" placeholder="Please enter linkedin url" class="form-control" value="{{ $settings->linkedin }}">
                                                        @if ($errors->has('linkedin'))
                                                            <span class="text-danger">{{ $errors->first('linkedin') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="instagram">Instagram</label>
                                                        <input type="text" name="instagram" id="instagram" placeholder="Please enter instagram url" class="form-control" value="{{ $settings->instagram }}">
                                                        @if ($errors->has('instagram'))
                                                            <span class="text-danger">{{ $errors->first('instagram') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="copyright">Copyright</label>
                                                        <input type="text" name="copyright" id="copyright" placeholder="Please enter copyright" class="form-control" value="{{ $settings->copyright }}">
                                                        @if ($errors->has('copyright'))
                                                            <span class="text-danger">{{ $errors->first('copyright') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                            <!-- Footer - End -->
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="i5" role="tabpanel" aria-labelledby="i5-tab" tabindex="0">
                                        <form action="{{ route('admin.settings.contact', $settings->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <!-- Contact - Start -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="contact_address_1">First Address</label>
                                                        <input type="text" name="contact_address_1" id="contact_address_1" placeholder="Please enter first address" class="form-control" value="{{ $settings->contact_address_1 }}">
                                                        @if ($errors->has('contact_address_1'))
                                                            <span class="text-danger">{{ $errors->first('contact_address_1') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="contact_phone_1">First Phone</label>
                                                        <input type="text" name="contact_phone_1" id="contact_phone_1" placeholder="Please enter first phone number" class="form-control" value="{{ $settings->contact_phone_1 }}">
                                                        @if ($errors->has('contact_phone_1'))
                                                            <span class="text-danger">{{ $errors->first('contact_phone_1') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="contact_email_1">First Email</label>
                                                        <input type="text" name="contact_email_1" id="contact_email_1" placeholder="Please enter first email address" class="form-control" value="{{ $settings->contact_email_1 }}">
                                                        @if ($errors->has('contact_email_1'))
                                                            <span class="text-danger">{{ $errors->first('contact_email_1') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="contact_address_2">Second Address</label>
                                                        <input type="text" name="contact_address_2" id="contact_address_2" placeholder="Please enter second address" class="form-control" value="{{ $settings->contact_address_2 }}">
                                                        @if ($errors->has('contact_address_2'))
                                                            <span class="text-danger">{{ $errors->first('contact_address_2') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="contact_phone_2">Second Phone</label>
                                                        <input type="text" name="contact_phone_2" id="contact_phone_2" placeholder="Please enter second phone number" class="form-control" value="{{ $settings->contact_phone_2 }}">
                                                        @if ($errors->has('contact_phone_2'))
                                                            <span class="text-danger">{{ $errors->first('contact_phone_2') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="contact_email_2">Second Email</label>
                                                        <input type="text" name="contact_email_2" id="contact_email_2" placeholder="Please enter second email address" class="form-control" value="{{ $settings->contact_email_2 }}">
                                                        @if ($errors->has('contact_email_2'))
                                                            <span class="text-danger">{{ $errors->first('contact_email_2') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                            <!-- Contact - End -->
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="i6" role="tabpanel" aria-labelledby="i6-tab" tabindex="0">
                                        <form action="{{ route('admin.settings.map', $settings->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <!-- Map - Start -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="map_1_country_name">First Country Name</label>
                                                        <input type="text" class="form-control" name="map_1_country_name" id="map_1_country_name" placeholder="Please enter the first country name" value="{{ isset($settings) ? $settings->map_1_country_name : old('map_1_country_name') }}">
                    
                                                        @if ($errors->has('map_1_country_name'))
                                                            <span class="text-danger">{{ $errors->first('map_1_country_name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="map_2_country_name">Second Country Name</label>
                                                        <input type="text" class="form-control" name="map_2_country_name" id="map_2_country_name" placeholder="Please enter the second country name" value="{{ isset($settings) ? $settings->map_2_country_name : old('map_2_country_name') }}">
                    
                                                        @if ($errors->has('map_2_country_name'))
                                                            <span class="text-danger">{{ $errors->first('map_2_country_name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    @isset($settings->map_1_country_photo)
                                                        <div class="form-group mb-3">
                                                            <label>Existing first country's photo</label>
                                                            <div>
                                                                <img src="{{ asset('storage/uploads/photo/' .$settings->map_1_country_photo) }}" alt="" class="w_200">
                                                            </div>
                                                        </div>
                                                    @endisset
                                                    <div class="form-group mb-3">
                                                        <label for="map_1_country_photo">{{ isset($settings->map_1_country_photo) ? 'Change' : 'Upload' }} first country's photo</label>
                                                        <div>
                                                            <input type="file" class="form-control" name="map_1_country_photo" id="map_1_country_photo">
                                                            @if ($errors->has('map_1_country_photo'))
                                                                <span class="text-danger">{{ $errors->first('map_1_country_photo') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @isset($settings->map_2_country_photo)
                                                        <div class="form-group mb-3">
                                                            <label>Existing second country's photo</label>
                                                            <div>
                                                                <img src="{{ asset('storage/uploads/photo/' .$settings->map_2_country_photo) }}" alt="" class="w_50">
                                                            </div>
                                                        </div>
                                                    @endisset
                                                    <div class="form-group mb-3">
                                                        <label for="map_2_country_photo">{{ isset($settings->map_2_country_photo) ? 'Change' : 'Upload' }} second country's photo</label>
                                                        <div>
                                                            <input type="file" class="form-control" name="map_2_country_photo" id="map_2_country_photo">
                                                            @if ($errors->has('map_2_country_photo'))
                                                                <span class="text-danger">{{ $errors->first('map_2_country_photo') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="map_1">First Map (iFrame Code)</label>
                                                        <textarea name="map_1" id="map_1" placeholder="Please enter first map's iframe code" class="form-control h_150" cols="30" rows="10">{{ $settings->map_1 }}</textarea>
                                                        @if ($errors->has('map_1'))
                                                            <span class="text-danger">{{ $errors->first('map_1') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="map_2">Second Map (iFrame Code)</label>
                                                        <textarea name="map_2" id="map_2" placeholder="Please enter second map's iframe code" class="form-control h_150" cols="30" rows="10">{{ $settings->map_2 }}</textarea>
                                                        @if ($errors->has('map_2'))
                                                            <span class="text-danger">{{ $errors->first('map_2') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                            <!-- Map - End -->
                                        </form>
                                    </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection