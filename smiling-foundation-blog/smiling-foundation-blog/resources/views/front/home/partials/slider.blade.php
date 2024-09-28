<div class="slider">
    <div class="slide-carousel owl-carousel">

        @foreach($slider as $slide)
        <div class="item" style="background-image:url('{{ asset('storage/uploads/photo/'.$slide->photo) }}');">
            <div class="bg"></div>
            <div class="text">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="text-wrapper d-flex justify-content-center align-items-center">
                                <div class="text-content">
                                    <h2>{{ $slide->heading }}</h2>
                                    {!! $slide->text !!}
                                    @isset($slide->button_link)
                                        <div class="button-style-1 mt_20">
                                            <a href="{{ $slide->button_link }}">{{ $slide->button_text }} <i class="fas fa-long-arrow-alt-right"></i></a>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>