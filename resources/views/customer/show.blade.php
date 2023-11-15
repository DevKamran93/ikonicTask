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
                                    <h5 id="no_comment">Be first to Comment!</h5>
                                @endforelse
                            </div>
                            <div id="loadMore">
                                <button type="button" id="load_more_btn" class="btn btn-outline-danger btn-sm"
                                    data-feedback_id='{{ $feedback->id }}'
                                    data-comment_id='{{ !empty($comment) ? $comment->id : '' }}'>
                                    Load More
                                </button>
                            </div>

                            @if ($feedback->comments != 0)
                                <textarea name="comment" id="comment" cols="30" rows="5" class="form-control my-4"></textarea>
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                    onclick="submitComment({{ $feedback->id }})"> Submit
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        $(document).ready(function() {
            $('#comment').summernote({
                placeholder: 'Please Write Here',
                tabsize: 2,
                height: 100
            });
        });

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
                var formattedDate = new Date(response.data.created_at).toLocaleString();

                const newCommentElement = `
                    <div class="comment mb-2">
                        <h4>${newComment.user.name}</h4>
                        <h5>${formattedDate}</h5>
                        <p>${newComment.comment}</p>
                    </div>`;

                $('#show_comment').append(newCommentElement);
                $('#no_comment').empty();
                $('.note-editable').text('');

                toastr[response.state](response.message, response.state);
            }
        }

        function loadMore(feedback_id, last_comment_id) {
            var data = JSON.stringify({
                id: last_comment_id,
                feedback_id: feedback_id,
            });

            var url = "{{ route('user.feedback.loadMore') }}";

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
