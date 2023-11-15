<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\FeedbackCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackCategoryRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FeedbackCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    public function getAllCategoryData()
    {
        $query = FeedbackCategory::withTrashed()
            ->orderBy('created_at', 'desc');

        return DataTables::eloquent($query)
            ->filterColumn('title', function ($query, $keyword) {
                $sql = "CONCAT(feedback_categories.title) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->orderColumn('title', function ($query, $order) {
                $query->where('title', $order);
            })
            ->addColumn('title', function (FeedbackCategory $category) {
                return $category->title;
            })
            ->addColumn('created_at', function (FeedbackCategory $category) {
                return $category->created_at->format('d-M-y, g:i A');
            })
            ->addColumn('updated_at', function (FeedbackCategory $category) {
                return $category->updated_at->format('d-M-y, g:i A');
            })
            ->addColumn('action', function (FeedbackCategory $category) {
                $buttons = '';
                if (is_null($category->deleted_at)) {
                    $buttons = '<button type="button" class="bi bi-pen-fill edit_category px-1" id="edit_category" data-id="' . $category->id . '" data-title="' . $category->title . '" data-bs-toggle="modal" data-bs-target="#add_edit_category_modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                    </button>
                    <button type="button" class="bi bi-trash-fill delete_restore_data" data-id="' . $category->id . '"  data-action="delete"  data-bs-toggle="modal" data-bs-target="#delete_restore_modal" >
                    </button>';
                } else {
                    $buttons = '<button type="button" class="text-xl bi bi-arrow-counterclockwise btn-sm delete_restore_data" data-id="' . $category->id . '" data-action="restore" data-bs-toggle="modal" data-bs-target="#delete_restore_modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Restore"><i class="fa fa-history"></i>
                                </button>';
                }
                return $buttons;
            })

            ->only(['title', 'created_at', 'updated_at', 'action'])
            ->addIndexColumn()
            ->toJson();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeedbackCategoryRequest $request)
    {

        $category = FeedbackCategory::create([
            'title' => $request->title,
        ]);

        if ($category) {
            return JsonResponse(200, 'success', 'Category Successfully Added !', '');
        } else {
            return JsonResponse(422, 'warning', 'Something Went Wrong !', '');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FeedbackCategory $feedbackCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeedbackCategory $feedbackCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeedbackCategoryRequest $request, FeedbackCategory $feedbackCategory)
    {
        $category = FeedbackCategory::findOrFail($request->category_id);
        $category_data = $request->except(['_token', '_method']);

        if ($category->update($category_data)) {
            return JsonResponse(200, 'success', 'Category Successfully Updated !', '');
        } else {
            return JsonResponse(422, 'warning', 'Category Not Updated !', '');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyOrRestore(Request $request)
    {
        $category = FeedbackCategory::withTrashed()->where('id', $request->id)->first();
        if (is_null($category->deleted_at)) {
            $success = $category->delete();
            $message = 'Deleted';
        } elseif (!is_null($category->deleted_at)) {
            $success = $category->restore();
            $message = 'Restored';
        }

        if ($success) {
            return JsonResponse(200, 'success', "Category Successfully $message !", '');
        } else {
            return JsonResponse(422, 'warning', 'Operation Failed, Try Again !', '');
        }
    }
}
