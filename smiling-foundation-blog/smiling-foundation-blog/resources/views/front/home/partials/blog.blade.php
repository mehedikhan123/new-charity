<div class="blog mt-5 pt-5">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="text-center">
                <h5 class="section-title bg-white text-start pe-3">Blogs</h5>
                <h2 class="text-primary">Latest Blogs</h2>
            </div>

            @foreach($posts as $item)
            @if ($item->rPostCategory->slug !== 'successful-stories')
                <div class="col-lg-4 col-md-6 shadow p-4">
                    <div class="item">
                        <div class="photo">
                            <img src="{{ asset('storage/uploads/photo/'.$item->photo) }}" alt="blog photo" style="object-fit: cover; width: 100%; height: 25vh;" />
                        </div>
                        <div class="text">
                            <h2>
                                <a href="{{ route('post.show',$item->slug) }}">{{ $item->title }}</a>
                            </h2>
                            <div class="short-des">
                                <p>
                                    {!! nl2br($item->short_description) !!}
                                </p>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('post.show',$item->slug) }}" class="btn-style">Read More 
                                    <!--<i class="fas fa-long-arrow-alt-right"></i>-->
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
            <div class="text-center mt-4">
                <a href={{ route('post.index') }} class="btn-style" style="border-radius: 30px 30px;">
                    Explore More
                </a>
            </div>
        </div>
    </div>
</div>