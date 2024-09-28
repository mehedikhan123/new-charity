<div class= "mt-5 pt-5">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="text-center">
                <h5 class="section-title bg-white text-start pe-3">Members</h5>
                <h2 class="text-primary">Meet Our Executives</h2>
            </div>

            @foreach($executives as $executive)
                <div class="col-lg-4 col-md-6 shadow p-4">
                    <div class="item">
                        <div class="photo">
                            <img src="{{ asset('storage/uploads/photo/'.$executive->photo) }}" alt="Executive Photo" />
                        </div>
                        <div class="text">
                            <h4>
                                <a href="{{ route('executive.show',$executive->id) }}">{{ $executive->name }}</a>
                            </h4>
                            <p>{{ $executive->designation }}</p>
                            <div class="mt-4">
                                <a href="{{ route('executive.show',$executive->id) }}" class="btn-style">Read More 
                                    <!--<i class="fas fa-long-arrow-alt-right"></i>-->
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="text-center mt-4">
                <a href={{ route('executive.index') }} class="btn-style" style="border-radius: 30px 30px;">
                    Other Executives
                </a>
            </div>
        </div>
    </div>
</div>