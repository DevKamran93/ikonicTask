@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-4">
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
                        <div class="col-md-8">{{ $feedback->created_at }}</div>

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
                        <div class="col-md-12 d-flex align-items-center mt-4 gap-2">
                            <h5>Vote:</h5>
                            <button type="button" class="btn btn-outline-success btn-sm"
                                onclick="feedbackVoting({{ $feedback->id }},'up')">
                                <i class="fa fa-arrow-up"></i>
                                <span id="up_count">{{ $feedback->vote ?? 0 }}</span>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                onclick="feedbackVoting({{ $feedback->id }},'down')">
                                <i class="fa fa-arrow-down"></i>
                                <span id="down_count">{{ $feedback->downVotes->count() }}</span>
                            </button>
                        </div>
                        {{-- @dd($feedback) --}}
                        <hr class="my-2">
                        <div class="col-md-12">
                            @php
                                $comments = $feedback->feedbackComments;
                            @endphp
                            {{-- @dd($comments) --}}
                            @if (empty($comments))
                                <h5>Be first to Comment!</h5>
                            @else
                                @forelse ($comments as $comment)
                                    <div class="mb-2">
                                        <h4>{{ $comment->user->name }}</h4>
                                        <h5>{{ $comment->created_at }}</h5>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                @empty
                                    <h5>No Comments</h5>
                                @endforelse
                                <div id="show_comment">

                                </div>
                            @endif

                            <textarea name="comment" id="comment" cols="30" rows="5" class="form-control my-2"></textarea>
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                onclick="submitComment({{ $feedback->id }})"> Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        function feedbackVoting(id, action) {

            var data = JSON.stringify({
                id: id,
                action: action,
            });

            var url = "{{ route('user.feedback.voting') }}";

            SendAjaxRequestToServer('POST', url, data, 'json', updateResponse);
        }

        function updateResponse(response) {

            if (response.status == 200) {
                $('#up_count').text(response.data[0]);
                $('#down_count').text(response.data[1]);
                $('#total_votes').text(response.data[2]);

                toastr[response.state](response.message, response.state);
            }
        }

        function submitComment(id) {
            var comment = document.getElementById('comment').value;
            console.log(id, comment.length);
            if (comment == '') {
                toastr.error('Please Write Comment');
                return false;
            } else if (comment.length <= 3) {
                toastr.error('Comment Must be Meaningful');
                return false;
            } else {

                var data = JSON.stringify({
                    id: id,
                    comment: comment,
                });

                var url = "{{ route('user.feedback.comment') }}";

                SendAjaxRequestToServer('POST', url, data, 'json', updateComment);
            }
        }

        function updateComment(response) {

            if (response.status == 200) {
                $('#comment').val('');
                const newComment = response.data;

                const newCommentElement = `
            <div class=" mb-2">
                <h4>${newComment.user.name}</h4>
                <h5>Date: ${newComment.created_at}</h5>
                <p>${newComment.comment}</p>
            </div>`;

                $('#show_comment').append(newCommentElement);

                toastr[response.state](response.message, response.state);
            }
        }
    </script>
@endpush
