<div class="mt-5 pt-5">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="text-center">
                <h5 class="section-title bg-white text-start pe-3">Programs</h5>
                <h2 class="text-primary">Special Events</h2>
            </div>
            @foreach ($programs as $program)                
                <div class="col-lg-4 col-md-6">
                    <div class="item shadow p-4" style="height: 28vh;">
                        <div class="text">
                            <div style="height: 16vh;">
                                @php
                                    $startDate = \Carbon\Carbon::parse($program->start_date_time);
                                    $endDate = \Carbon\Carbon::parse($program->end_date_time);
                                @endphp

                                <span class="fw-bold text-primary">
                                    <i class="fa fa-calendar text-primary me-2"></i>
                                    <span>{{ $startDate->format('d') }} - {{ $endDate->format('d M Y') }}</span>
                                </span>
                                @php
                                    $maxLength = 24;
                                    $name = $program->name;
                                @endphp
                                @if(strlen($name) > $maxLength) 
                                    <h4 class="mb-2">
                                        {!! substr($name, 0, $maxLength) . '...' !!}
                                    </h4>
                                    @else
                                    <h4 class="mb-2">{!! $name !!}</h4>
                                @endif
                                {{-- <h4 class="mb-2">{{ $program->name }}</h4> --}}
                                <p><i class="fa fa-briefcase text-primary me-2"></i>{{ ucfirst($program->type) }} <br><span><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $program->location }}</span></p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('programs.show', $program->slug) }}" class="btn-style">Read More 
                                <!--<i class="fas fa-long-arrow-alt-right"></i>-->
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="text-center mt-4">
                <a href={{ route('programs.index') }} class="btn-style" style="border-radius: 30px 30px;">
                    Other Programs
                </a>
            </div>
        </div>
    </div>
</div>