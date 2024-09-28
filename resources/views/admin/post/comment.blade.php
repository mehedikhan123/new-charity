@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Comments</h1>
            <div>
                {{-- <a href="{{ route('admin_faq_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a> --}}
            </div>
        </div>
        <div class="section-body">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Comments</th>
                                            <th>Blog</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comments as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $item->comment }}<br>
                                                <a href="" data-bs-toggle="modal" data-bs-target="#modal_reply_admin{{$loop->iteration}}">Reply</a>
                                            </td>
                                            <td>
                                                {{ isset($item->rPost) ? $item->rPost->title : '' }}<br>
                                                @if (isset($item->rPost))
                                                    <a href="{{ route('admin.admin_post_edit',$item->rPost->id) }}">See Post</a>
                                                @else
                                                    <span>---</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->status == "Active")
                                                    <a href="{{ route('admin.admin_comment_status_change',$item->id) }}"><span class="btn btn-success">Active</span></a>
                                                @else
                                                    <a href="{{ route('admin.admin_comment_status_change',$item->id) }}"><span class="btn btn-danger">Pending</span></a>
                                                @endif
                                            <td class="pt_10 pb_10">
                                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.admin_comment_delete', $item->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm" onClick="confirmDelete({{ $item->id }})"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal_reply_admin{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Reply</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.admin_reply_submit') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="comment_id" value="{{ $item->id }}">
                                                            <div class="mb-3">
                                                                <textarea name="reply" class="form-control h_100" cols="30" rows="10" placeholder="Reply"></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection