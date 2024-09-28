<div class="mt-5 pt-5">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="text-center">
                <h5 class="section-title bg-white text-start pe-3">Services</h5>
                <h2 class="text-primary">How We Support Children</h2>
            </div>
            @foreach ($facilities as $facility)                
                <div class="col-lg-3 col-md-4">
                    <div class="service-item shadow p-4" style="height: 30vh;">
                        <div class="text">
                            <i class="{{ $facility->icon }} fs-1 mb-3 text-primary"></i>
                            <h3 class="mb-2">{{ $facility->heading }}</h3>
                            <div style="height: 10vh;">
                                {!! $facility->text !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>