<div class="mt-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full-section">
                    <div class="row d-flex align-items-center g-5 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="col-md-6">
                            <div class="">
                                <img src="{{ asset('storage/uploads/photo/'.$appeal->photo) }}" alt="about image" class="img-fluid" style="object-fit: contain;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text">
                                <div class="inner">
                                    <h5 class="section-title bg-white text-start pe-3">Donate For A</h5>
                                    <h2 class="text-primary">{{ $appeal->name }}</h2>
                                    @php
                                        $maxLength = 3000;
                                        $description = $appeal->description;
                                    @endphp
                                    @if(strlen($description) > $maxLength) 
                                        <p>
                                            {!! substr($description, 0, $maxLength) . '...' !!}
                                        </p>
                                        @else
                                        <p>{!! $appeal->description !!}</p>
                                    @endif
                                    <div class="d-flex mt-4">
                                        <div class="">
                                            <a href="{{ route('appeals.show', $appeal->id) }}" class="btn-style" style="border-radius: 30px 30px;">Donate</a>
                                            {{-- <i class="fas fa-long-arrow-alt-right"></i> --}}
                                        </div>
                                        <div class="">
                                            <a href="{{ route('appeals.show', $appeal->slug) }}" class="btn-style ms-3" style="border-radius: 30px 30px;">Read More</a>
                                            {{-- <i class="fas fa-long-arrow-alt-right"></i> --}}
                                        </div>
                                        <div class="">
                                            <a href="{{ route('appeals.index') }}" class="btn-style ms-3" style="border-radius: 30px 30px;">More Appeals</a>
                                            {{-- <i class="fas fa-long-arrow-alt-right"></i> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>