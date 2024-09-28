<div class="mt-5">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            @foreach ($features as $feature)                
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item shadow p-4" style="height: 28vh;">
                        <div class="text">
                            <h3 class="mb-2">{{ $feature->heading }}</h3>
                            <div style="height: 10vh;">
                                @isset($feature->counter)
                                    <span>
                                        <span class="counter fs-4 fw-bold">
                                            {{ $feature->counter }}
                                        </span>
                                        {!! strip_tags(trim($feature->text)) !!}
                                    </span>
                                    @else
                                    {!! $feature->text !!}
                                @endisset
                            </div>

                            @isset($feature->button_link)
                                <div class="mt-4">
                                    <a href="{{ $feature->button_link }}" class="btn-style">{{ $feature->button_text }}</a>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>