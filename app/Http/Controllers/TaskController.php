<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(Request $request)
    {

        $categories = Category::all();

        $query = Auth::user()->tasks()->with('category');


        if ($request->has('trashed') && $request->trashed == 'on') {
            $query->onlyTrashed();
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('sort_by') && $request->sort_by != '') {
            $sortBy = $request->sort_by;
            if ($sortBy == 'status_asc') {
                $query->orderBy('status', 'asc');
            } elseif ($sortBy == 'status_desc') {
                $query->orderBy('status', 'desc');
            } elseif ($sortBy == 'due_asc') {
                $query->orderBy('due_date', 'asc');
            } elseif ($sortBy == 'due_desc') {
                $query->orderBy('due_date', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $tasks = $query->paginate(15)->withQueryString();

        return view('task', compact('categories', 'tasks'));
    }


    public function store(StoreTaskRequest $request)
    {
        $request->validated();
        Task::create([
            'title'        => $request->name,
            'user_id'     => Auth::id(),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status'      => $request->status,
            'due_date'    => $request->due_date,
        ]);

        toastr()->success('Task created Successfully');
        return back();
    }



    public function update(UpdateTaskRequest $request,  Task $task)
    {
        // return $request->all();
        $task->update($request->validated());
        toastr()->success('Task updated Successfully');
        return back();
    }

    public function destroy(Task $task)
    {
        $task->delete();
        toastr()->success('Task deleted Successfully');
        return back();
    }


    public function restore($id)
    {
        $task = Task::withTrashed()->findOrFail($id);
        $task->restore();
        toastr()->success('Task restored Successfully');
        return back();
    }

    public function forceDelete($task)
    {
        $task = Task::withTrashed()->findOrFail($task);
        $task->forceDelete();
        toastr()->success('Task deleted permanently');
        return back();
    }
}
