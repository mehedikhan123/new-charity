<div class="blog mt-5 pt-5">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="text-center">
                <h5 class="section-title bg-white text-start pe-3">Appeals</h5>
                <h2 class="text-primary">Our Appeals</h2>
            </div>
            @foreach ($appeals as $appeal)                
                <div class="col-lg-4 col-md-6 shadow p-4" style="height: 53vh;">
                    <div class="item">
                        <div class="photo">
                            <img src="{{ asset('storage/uploads/photo/'. $appeal->photo) }}" alt="appeal photo" class="img-fluid" style="object-fit: cover; width: 100%; height: 25vh;">
                        </div>
                        <div class="text">
                            @php
                                $maxLength = 25;
                                $name = $appeal->name;
                            @endphp
                            @if(strlen($name) > $maxLength) 
                                <h4 class="my-2">
                                    {!! substr($name, 0, $maxLength) . '...' !!}
                                </h4>
                                @else
                                <h4 class="my-2">{!! $appeal->name !!}</h4>
                            @endif
                            <div style="height: 10vh;">
                                @php
                                    $maxLength = 100;
                                    $description = $appeal->description;
                                @endphp
                                @if(strlen($description) > $maxLength) 
                                    <p>
                                        {!! substr($description, 0, $maxLength) . '...' !!}
                                    </p>
                                    @else
                                    <p>{!! $appeal->description !!}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('appeals.show', $appeal->slug) }}" class="btn-style">Read More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="text-center mt-4">
                <a href={{ route('appeals.index') }} class="btn-style" style="border-radius: 30px 30px;">
                    Other Appeals
                </a>
            </div>
        </div>
    </div>
</div>