@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Banner Images</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div>
                                    <!-- Logo, Favicon, Banner - Start -->
                                    <form action="{{ isset($pagesBanner) ? route('admin.banners.update', $pagesBanner->id) : route('admin.banners.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @isset($pagesBanner)
                                            @method('put')
                                        @endisset
                                        <div class="row">
                                            <div class="col-md-6">
                                                @isset($pagesBanner->appeal)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Appeal's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->appeal) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="appeal">{{ isset($pagesBanner->appeal) ? 'Change' : 'Upload' }} Appeal's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="appeal" id="appeal">
                                                        @if ($errors->has('appeal'))
                                                            <span class="text-danger">{{ $errors->first('appeal') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->about_history)
                                                    <div class="form-group mb-3">
                                                        <label>Existing History's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->about_history) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="about_history">{{ isset($pagesBanner->about_history) ? 'Change' : 'Upload' }} History's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="about_history" id="about_history">
                                                        @if ($errors->has('about_history'))
                                                            <span class="text-danger">{{ $errors->first('about_history') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->about_who)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Who we are's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->about_who) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="about_who">{{ isset($pagesBanner->about_who) ? 'Change' : 'Upload' }} Who we are's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="about_who" id="about_who">
                                                        @if ($errors->has('about_who'))
                                                            <span class="text-danger">{{ $errors->first('about_who') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->executive)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Executive's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->executive) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="executive">{{ isset($pagesBanner->executive) ? 'Change' : 'Upload' }} Executive's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="executive" id="executive">
                                                        @if ($errors->has('executive'))
                                                            <span class="text-danger">{{ $errors->first('executive') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->volunteer)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Volunteer's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->volunteer) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="volunteer">{{ isset($pagesBanner->volunteer) ? 'Change' : 'Upload' }} Volunteer's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="volunteer" id="volunteer">
                                                        @if ($errors->has('volunteer'))
                                                            <span class="text-danger">{{ $errors->first('volunteer') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->program)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Program's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->program) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="program">{{ isset($pagesBanner->program) ? 'Change' : 'Upload' }} Program's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="program" id="program">
                                                        @if ($errors->has('program'))
                                                            <span class="text-danger">{{ $errors->first('program') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->photo_gallery)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Photo Gallery's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->photo_gallery) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="photo_gallery">{{ isset($pagesBanner->photo_gallery) ? 'Change' : 'Upload' }} Photo Gallery's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="photo_gallery" id="photo_gallery">
                                                        @if ($errors->has('photo_gallery'))
                                                            <span class="text-danger">{{ $errors->first('photo_gallery') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->video_gallery)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Video Gallery's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->video_gallery) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="video_gallery">{{ isset($pagesBanner->video_gallery) ? 'Change' : 'Upload' }} Video Gallery's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="video_gallery" id="video_gallery">
                                                        @if ($errors->has('video_gallery'))
                                                            <span class="text-danger">{{ $errors->first('video_gallery') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->story)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Story's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->story) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="story">{{ isset($pagesBanner->story) ? 'Change' : 'Upload' }} Story's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="story" id="story">
                                                        @if ($errors->has('story'))
                                                            <span class="text-danger">{{ $errors->first('story') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->testimonial)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Testimonial's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->testimonial) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="testimonial">{{ isset($pagesBanner->testimonial) ? 'Change' : 'Upload' }} Testimonial's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="testimonial" id="testimonial">
                                                        @if ($errors->has('testimonial'))
                                                            <span class="text-danger">{{ $errors->first('testimonial') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->join_volunteer)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Join Volunteer's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->join_volunteer) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="join_volunteer">{{ isset($pagesBanner->join_volunteer) ? 'Change' : 'Upload' }} Join Volunteer's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="join_volunteer" id="join_volunteer">
                                                        @if ($errors->has('join_volunteer'))
                                                            <span class="text-danger">{{ $errors->first('join_volunteer') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->be_sponsor)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Be a sponsor's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->be_sponsor) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="be_sponsor">{{ isset($pagesBanner->be_sponsor) ? 'Change' : 'Upload' }} Be a sponsor's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="be_sponsor" id="be_sponsor">
                                                        @if ($errors->has('be_sponsor'))
                                                            <span class="text-danger">{{ $errors->first('be_sponsor') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->blog)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Blog's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->blog) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="blog">{{ isset($pagesBanner->blog) ? 'Change' : 'Upload' }} Blog's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="blog" id="blog">
                                                        @if ($errors->has('blog'))
                                                            <span class="text-danger">{{ $errors->first('blog') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->news)
                                                    <div class="form-group mb-3">
                                                        <label>Existing News's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->news) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="news">{{ isset($pagesBanner->news) ? 'Change' : 'Upload' }} News's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="news" id="news">
                                                        @if ($errors->has('news'))
                                                            <span class="text-danger">{{ $errors->first('news') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->contact)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Contact's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->contact) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="contact">{{ isset($pagesBanner->contact) ? 'Change' : 'Upload' }} Contact's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="contact" id="contact">
                                                        @if ($errors->has('contact'))
                                                            <span class="text-danger">{{ $errors->first('contact') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @isset($pagesBanner->donate)
                                                    <div class="form-group mb-3">
                                                        <label>Existing Donate's Banner</label>
                                                        <div>
                                                            <img src="{{ asset('storage/uploads/photo/'.$pagesBanner->donate) }}" alt="" class="w_200">
                                                        </div>
                                                    </div>
                                                @endisset

                                                <div class="form-group mb-3">
                                                    <label for="donate">{{ isset($pagesBanner->donate) ? 'Change' : 'Upload' }} Donate's Banner</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="donate" id="donate">
                                                        @if ($errors->has('donate'))
                                                            <span class="text-danger">{{ $errors->first('donate') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">{{  isset($pagesBanner) ? 'Update' : 'Submit'}}</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Logo, Favicon, Banner - End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection