<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feedback;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.feedbacks.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function getAllFeedbacksData()
    {
        $query = Feedback::with('user', 'feedbackCategory', 'feedbackComments')->withTrashed()
            ->orderBy('created_at', 'desc');
        return DataTables::eloquent($query)
            ->filterColumn('title', function ($query, $keyword) {
                $sql = "CONCAT(feedbacks.title) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->orderColumn('title', function ($query, $order) {
                $query->where('title', $order);
            })
            ->addColumn('title', function (Feedback $feedback) {
                return $feedback->title;
            })
            ->addColumn('category', function (Feedback $feedback) {
                return $feedback->feedbackCategory->title;
            })
            ->addColumn('feedback_comments', function (Feedback $feedback) {
                return $feedback->feedbackComments->count();
            })
            ->addColumn('user', function (Feedback $feedback) {
                return $feedback->user->name;
            })
            ->addColumn('votes', function (Feedback $feedback) {
                $total_votes = $feedback->vote != null ? $feedback->vote : "No Vote";
                return $total_votes;
            })->addColumn('comments', function (Feedback $feedback) {
                $comment_on_off = '';
                $disable = '';
                if (!is_null($feedback->deleted_at)) {
                    $disable = 'd-none';
                }
                $comment_on_off = '<div class="form-check form-switch">
                <input class="form-check-input ms-auto  mt-1 ' . $disable . ' ' . ($feedback->comments == 1 ? ' bg-primary ' : '') . '" type="checkbox" data-id="' . $feedback->id . '" id="status_update" ' . ($feedback->comments == 1 ? "checked" : "") . '>
                    </div>';
                return $comment_on_off;
            })
            ->addColumn('created_at', function (Feedback $feedback) {
                return $feedback->created_at->format('d-M-y, g:i A');
            })
            ->addColumn('action', function (Feedback $feedback) {
                $buttons = '';

                if (is_null($feedback->deleted_at)) {
                    $buttons = '<a href="' . route('feedback.details', "$feedback->id") . '" class="bi bi-ticket-detailed px-1" data-bs-toggle="tooltip" data-bs-placement="top" title="See Details">
                    </a>
                    <button type="button" class="bi bi-trash-fill delete_restore_data" data-id="' . $feedback->id . '"  data-action="delete"  data-bs-toggle="modal" data-bs-target="#delete_restore_modal" >
                    </button>';
                } else {
                    $buttons = '<button type="button" class="text-xl bi bi-arrow-counterclockwise btn-sm delete_restore_data" data-id="' . $feedback->id . '" data-action="restore" data-bs-toggle="modal" data-bs-target="#delete_restore_modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Restore"><i class="fa fa-history"></i>
                                </button>';
                }
                return $buttons;
            })

            ->only(['title', 'category', 'comments', 'feedback_comments', 'user', 'votes', 'created_at', 'updated_at', 'action'])->rawColumns(['comments', 'action'])
            ->addIndexColumn()
            ->toJson();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedbackRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $feedback = Feedback::where('id', $id)->with([
            'user',
            'feedbackCategory',
            'feedbackComments' => function ($query) {
                $query->take(5);
            },
            'upVotes',
            'downVotes', 'totalVotes.user'
        ])->first();


        return view('admin.feedbacks.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyOrRestore(Request $request)
    {
        $feedback = Feedback::withTrashed()->where('id', $request->id)->first();
        if (is_null($feedback->deleted_at)) {
            $success = $feedback->delete();
            $message = 'Deleted';
        } elseif (!is_null($feedback->deleted_at)) {
            $success = $feedback->restore();
            $message = 'Restored';
        }

        if ($success) {
            return JsonResponse(200, 'success', "Feedback Successfully $message !", '');
        } else {
            return JsonResponse(422, 'warning', 'Operation Failed, Try Again !', '');
        }
    }

    public function feedbackLoadMoreComments()
    {
        $request = json_decode(file_get_contents('php://input'), true);

        $more_comments = Comment::where('feedback_id', $request['feedback_id'])
            ->where('id', '>', $request['id'])
            ->with('user')
            ->take(5)
            ->get();

        if ($more_comments->count() > 0) {
            return response()->json(['status' => 200, 'data' => $more_comments]);
        } else {
            return JsonResponse(422, "error", "No more comments found.", '');
        }
    }


    public function feedbackchangeCommentsStatus()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $feedback = Feedback::findOrFail($request['id']);
        $is_changed = $feedback->update(['comments' => $request['comments']]);
        $action = '';
        if ($request['comments'] == 0) {
            $action = 'Off';
        } else {
            $action = 'On';
        }

        if ($is_changed == true) {
            return JsonResponse(200, 'success', "Comments Turn $action Successfully!", '');
        } else {
            return JsonResponse(422, 'error', 'Something Went Wrong !', '');
        }
    }
}
