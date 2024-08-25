@extends("layouts.admin.master")
@section("title", $post->title)
@section("content")
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card-body">
                <h4 class="card-title" style="margin-bottom: 20px;">{{ $post->title }}</h4>

                <img src="{{ $post->image_url }}" alt="image" style="width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px;" />

                <p>{{ $post->body }}</p>
            </div>
        </div>
    </div>
@endsection
