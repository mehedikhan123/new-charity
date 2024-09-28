@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-child"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orphans</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_orphans }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Causes</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_causes }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Appeals</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_appeals }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Programs</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_programs }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Testimonials</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_testimonials }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Users</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_users }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Executives</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_executives }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Volunteers</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_volunteers }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-blog"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Blogs</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_posts }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Photos</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_photos }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-film"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Videos</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_videos }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection