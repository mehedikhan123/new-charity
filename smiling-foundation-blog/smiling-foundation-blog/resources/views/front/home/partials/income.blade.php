<div class="mt-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full-section">
                    <div class="row d-flex align-items-center g-5 wow fadeInUp" data-wow-delay="0.1s">
                        
                        <div class="col-md-6">
                            <div class="">
                                <div class="inner">
                                    <h5 class="section-title bg-white text-start pe-3">Income</h5>
                                    <h2 class="text-primary">{{ $income->heading }}</h2>
                                    @php
                                        $maxLength = 500;
                                        $text = $income->text;
                                    @endphp
                                    @if(strlen($text) > $maxLength) 
                                        <p>
                                            {!! substr($text, 0, $maxLength) . '...' !!}
                                        </p>
                                        @else
                                        <p>{!! $income->text !!}</p>
                                    @endif
                                    {{-- @if ($income->button_link)
                                        <div class="mt-4">
                                            <a href="{{ $income->button_link }}" class="btn-style">{{ $income->button_text }}</a>
                                        </div>
                                    @endif --}}
                                    <div class="mt-4">
                                        <a href="{{ route('about') }}" class="btn-style">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- @if(isset($income->video))
                                <div class="img-fluid" style="background-image: url('{{ asset('storage/uploads/photo/'.$income->photo) }}');" style="object-fit: contain;">
                                    <a class="video-button" href="https://www.youtube.com/watch?v={{ $income->video }}"><span></span></a>
                                </div>
                                @else --}}
                                <div class="">
                                    <img src="{{ asset('storage/uploads/photo/'.$income->photo) }}" alt="About image" class="img-fluid" style="object-fit: contain;">
                                </div>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>