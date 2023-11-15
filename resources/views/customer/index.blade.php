@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @forelse ($feedbacks as $feedback)
                <div class="col-md-6 mt-4">
                    <div class="card shadow" style="border-radius: 0px">
                        <div class="card-body row">
                            <div class="col-md-4">
                                <h5>Title</h5>
                            </div>
                            <div class="col-md-8">{{ $feedback->title }}</div>

                            <div class="col-md-4">
                                <h5>Submitted by</h5>
                            </div>
                            <div class="col-md-8">{{ $feedback->user->name }}</div>

                            <div class="col-md-4">
                                <h5>Date</h5>
                            </div>
                            <div class="col-md-8">{{ $feedback->created_at }}</div>

                            <div class="col-md-4">
                                <h5>Vote:</h5>
                            </div>
                            <div class="col-md-8">{{ $feedback->vote ? $feedback->vote : 'Not Voted yet' }}</div>

                            <div class="col-md-4">
                                <h5>Description</h5>
                            </div>
                            <div class="col-md-12">{{ substr($feedback->description, 0, 50) }}</div>
                            <div class="col-md-12 mt-4">
                                <a href="{{ route('user.feedback_detail', $feedback->id) }}" class="submit_btn">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h1>No Feedback Found</h1>
            @endforelse
            <div class="col-md-12 my-5">
                {{ $feedbacks->links() }}
            </div>
        </div>
    </div>
@endsection
