<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    public function getAllUsersData()
    {
        $query = User::where('type', '!=', 'admin')->withTrashed()
            ->orderBy('created_at', 'desc');

        return DataTables::eloquent($query)
            ->filterColumn('title', function ($query, $keyword) {
                $sql = "CONCAT(users.name) like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('name', function (User $user) {
                return $user->name;
            })
            ->addColumn('email', function (User $user) {
                return $user->email;
            })
            ->addColumn('type', function (User $user) {
                return $user->type;
            })
            ->addColumn('created_at', function (User $feedback) {
                return $feedback->created_at->format('d-M-y, g:i A');
            })
            ->addColumn('action', function (User $feedback) {
                $buttons = '';

                if (is_null($feedback->deleted_at)) {
                    $buttons = '<button type="button" class="bi bi-trash-fill delete_restore_data" data-id="' . $feedback->id . '"  data-action="delete"  data-bs-toggle="modal" data-bs-target="#delete_restore_modal" >
                    </button>';
                } else {
                    $buttons = '<button type="button" class="text-xl bi bi-arrow-counterclockwise btn-sm delete_restore_data" data-id="' . $feedback->id . '" data-action="restore" data-bs-toggle="modal" data-bs-target="#delete_restore_modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Restore"><i class="fa fa-history"></i>
                                </button>';
                }
                return $buttons;
            })

            ->only(['name', 'email', 'type', 'created_at', 'action'])
            ->rawColumns(['action'])
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyOrRestore(Request $request)
    {
        $user = User::withTrashed()->where('id', $request->id)->first();
        if (is_null($user->deleted_at)) {
            $success = $user->delete();
            $message = 'Deleted';
        } elseif (!is_null($user->deleted_at)) {
            $success = $user->restore();
            $message = 'Restored';
        }

        if ($success) {
            return JsonResponse(200, 'success', "User Successfully $message !", '');
        } else {
            return JsonResponse(422, 'warning', 'Operation Failed, Try Again !', '');
        }
    }
}
