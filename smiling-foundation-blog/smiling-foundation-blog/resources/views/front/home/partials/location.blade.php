<div class="my-5 pt-5">
    <!-- Location Start -->
    <div class="container">
        <div class="row gy-4 d-flex justify-content-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="text-center">
                <h5 class="section-title bg-white text-start pe-3">Location</h5>
                <h2 class="text-primary">Our Location</h2>
            </div>
            <div class="col-md-6">
                {!! $global_setting_data->map_1 !!}
                <div class="d-flex mt-4 mb-2 align-items-center justify-content-center">
                    <img src="{{ asset('storage/uploads/photo/' . $global_setting_data->map_1_country_photo) }}" alt="" class="img-fluid">
                </div>
                <h4 class="text-center">{{ $global_setting_data->map_1_country_name }}</h4>
            </div>
            <div class="col-md-6">
                {!! $global_setting_data->map_2 !!}
                <div class="d-flex mt-4 mb-2 align-items-center justify-content-center">
                    <img src="{{ asset('storage/uploads/photo/' . $global_setting_data->map_2_country_photo) }}" alt="" class="img-fluid">
                </div>
                <h4 class="text-center">{{ $global_setting_data->map_2_country_name }}</h4>
            </div>
        </div>
    </div>
</div>