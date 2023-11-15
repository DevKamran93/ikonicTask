<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Comment;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\FeedbackCategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFeedbackRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $feedbacks = Feedback::with('user', 'feedbackCategory')->paginate(10);
        // $feedbacks = 0;
        notify()->success('Feedback Successfully Submitted!', 'Success');

        return view('customer.index', get_defined_vars());
    }

    public function show($id)
    {
        $feedback = Feedback::where('id', $id)->with([
            'user',
            'feedbackCategory',
            'feedbackComments' => function ($query) {
                $query->take(10);
            },
            'upVotes',
            'downVotes'
        ])->first();


        return view('customer.show', get_defined_vars());
    }

    public function create()
    {
        $feedback_category = FeedbackCategory::get();
        return view('customer.create', get_defined_vars());
    }


    public function store(StoreFeedbackRequest $request)
    {
        $feedback = Feedback::create([
            'title' => $request->title,
            'feedback_category_id' => $request->category,
            'description' => $request->description,
            'user_id' => Auth::id()
        ]);

        if ($feedback) {
            notify()->success('Feedback Successfully Submitted!', 'Success');
            return redirect()->route('user.feedbacks');
        } else {
            notify()->error('Something Went Wrong, Try Again!', 'Error');;
            return redirect()->back();
        }
    }

    public function feedbackVoting()
    {
        $request = json_decode(file_get_contents('php://input'), true);

        $exist = Vote::where(['feedback_id' => $request['id'], 'user_id' => Auth::id()])->first();
        $feedback = Feedback::findOrFail($request['id']);
        $already = '';

        if ($exist) {
            if ($exist->vote_action == 'up' && $request['action'] == 'down') {
                $feedback->vote--;
            } elseif ($exist->vote_action == 'down' && $request['action'] == 'up') {
                $feedback->vote++;
            } else {
                $already = 'Already';
            }
        } else {
            if ($request['action'] == 'down') {
                $feedback->vote--;
            } elseif ($request['action'] == 'up') {
                $feedback->vote++;
            }
        }

        $feedback->save();

        $vote = Vote::updateOrCreate(
            ['feedback_id' => $request['id'], 'user_id' => Auth::id()],
            ['vote_action' => $request['action']]
        );

        $action = $request['action'] == 'up' ? $already . ' Up' : $already . ' Down';
        $existing_votes = $feedback->vote ?? 0;
        $total_votes = $feedback->vote + $feedback->downVotes->count();
        $down_votes = $feedback->downVotes->count();

        if ($feedback && $vote) {
            return JsonResponse(200, "success", "Feedback $action Voted Successfully !", [$existing_votes, $down_votes, $total_votes]);
        } else {
            return JsonResponse(422, "error", "Something Went Wrong !", '');
        }
    }

    public function feedbackComment()
    {
        $request = json_decode(file_get_contents('php://input'), true);

        $comment = Comment::create([
            'feedback_id' => $request['id'],
            'user_id' => Auth::id(),
            'comment' => $request['comment']
        ]);
        $new_comment = Comment::where('id', $comment->id)->with('user')->first();
        if ($comment) {
            return JsonResponse(200, "success", "Comment Successfully Added !", $new_comment);
        } else {
            return JsonResponse(422, "error", "Something Went Wrong !", '');
        }
    }


    public function welcome()
    {
        return view('welcome');
    }
}
