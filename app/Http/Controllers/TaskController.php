<?php

namespace App\Http\Controllers;

Use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
class TaskController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        Task::create($validated);

        return redirect()->back();
    }

    /**
     * @param Task $task
     * @return RedirectResponse
     */
    public function complete(Task $task): RedirectResponse
    {
        $task->completed_at = Carbon::now()->toDateTimeString();
        $task->save();
        return redirect()->back();
    }

    /**
     * @param Task $task
     * @return RedirectResponse
     */
    public function delete(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->back();
    }
}
