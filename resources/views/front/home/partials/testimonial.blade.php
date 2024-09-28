<div class="mt-5 pt-5">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="text-center">
                <h5 class="section-title bg-white text-center px-3">Feedback</h5>
                <h2 class="text-primary">What People Say</h2>
            </div>

            <div class="col">
                <div class="owl-carousel testimonial-carousel position-relative">
                    @foreach($testimonials as $testimonial)
                        <div class="testimonial-item text-center border p-4">
                            <img class="bg-white rounded-circle shadow p-1 mx-auto mb-3" src="{{ asset('storage/uploads/photo/'.$testimonial->photo) }}" alt="Testimonial photo" style="width: 80px; height: 80px;">
                            <h5 class="mb-0">{{ $testimonial->name }}</h5>
                            <p class="text-center">{{ $testimonial->designation }}</p>
                            <p class="mb-0">{!! $testimonial->comment !!}</p>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href={{ route('testimonials.index') }} class="btn-style" style="border-radius: 30px 30px;">
                        Other Testimonials
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>