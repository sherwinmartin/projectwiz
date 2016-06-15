<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\TaskUser;

use Redirect;

class TaskUserController extends Controller
{
    public function store(Request $request)
    {
        $task_id = $request['task_id'];
        $user_id = $request['user_id'];

        if (TaskUser::add($user_id, $task_id))
        {
            return back()->with('success', 'User assigned to task.');
        }

        return back()->with('error', 'User was not assigned to task.');
    }

    /**
     * Delete task_user record.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $task_user = TaskUser::find($id);

        if ($task_user->delete())
        {
            return redirect::to('tasks/'.$task_user->task_id)->with('success', 'User unassigned.');
        }

        return back()->with('error', 'User failed to be unassigned to task.');
    }
}
