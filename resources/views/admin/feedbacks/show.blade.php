@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow" style="border-radius: 0px">
                <div class="card-body row">
                    <div class="col-md-4">
                        <h5>Title</h5>
                        {{-- @dd($feedback) --}}
                    </div>
                    <div class="col-md-8">{{ $feedback->title }}</div>

                    <div class="col-md-4">
                        <h5>Submitted by</h5>
                    </div>
                    <div class="col-md-8">{{ $feedback->user->name }}</div>

                    <div class="col-md-4">
                        <h5>Date</h5>
                    </div>
                    <div class="col-md-8">{{ date('m/d/Y, H:i A', strtotime($feedback->created_at)) }}</div>

                    <div class="col-md-4">
                        <h5>Vote:</h5>
                    </div>
                    <div class="col-md-8" id="total_votes">
                        {{ $feedback->vote || $feedback->vote >= 0 ? $feedback->vote + $feedback->downVotes->count() : 'Not Voted yet' }}
                    </div>

                    <div class="col-md-4">
                        <h5>Description</h5>
                    </div>
                    <div class="col-md-12 mt-2">{{ $feedback->description }}</div>

                    <hr class="my-2">
                    <div class="col-md-12">
                        <div class="mb-2" id="show_comment">
                            @forelse ($feedback->feedbackComments as $comment)
                                <div class="comment mb-2">
                                    <h4>{{ $comment->user->name }}</h4>
                                    <h5>{{ date('m/d/Y, H:i A', strtotime($comment->created_at)) }}</h5>
                                    <p>{!! $comment->comment !!}</p>
                                </div>
                            @empty
                                <h5 id="no_comment">No Comments</h5>
                            @endforelse
                        </div>
                        <div id="loadMore">
                            <button type="button" id="load_more_btn" class="btn btn-outline-dark btn-sm"
                                data-feedback_id='{{ $feedback->id }}'
                                data-comment_id='{{ !empty($comment) ? $comment->id : '' }}'>
                                Load More
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    @forelse ($feedback->totalVotes as $vote)
                        <h5>User: {{ $vote->user->name }}</h5>
                        <h5>Vote Action: {{ $vote->vote_action }}</h5>
                        <br>
                    @empty
                        <h5>No Voted User</h5>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        function loadMore(feedback_id, last_comment_id) {
            var data = JSON.stringify({
                id: last_comment_id,
                feedback_id: feedback_id,
            });

            var url = "{{ route('feedback.loadMore') }}";

            SendAjaxRequestToServer('POST', url, data, 'json', updateLoadMore);
        }

        function updateLoadMore(response) {
            if (response.status == 200) {
                var new_comments = '';
                let last_comment_id = '';
                $.each(response.data, function(index, value) {
                    // Format the date
                    var formattedDate = new Date(value.created_at).toLocaleString();

                    new_comments += `<div class="comment mb-2">
                                <h4>${value.user.name}</h4>
                                <h5>${formattedDate}</h5>
                                <p>${value.comment}</p>
                            </div>`;
                    last_comment_id = value.id;
                });
                $('#show_comment').append(new_comments);
                $('#load_more_btn').data('comment_id', last_comment_id);
            }
        }

        $(document).on('click', '#load_more_btn', function(e) {
            let feedback_id = $(this).data('feedback_id');
            let last_comment_id = $(this).data('comment_id');
            if (last_comment_id != '') {
                loadMore(feedback_id, last_comment_id)

            }
        })
    </script>
@endpush
