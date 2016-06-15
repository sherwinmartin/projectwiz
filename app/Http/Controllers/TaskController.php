<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Milestone;
use App\Models\Task;
use App\Models\TaskUser;
use App\User;

use Redirect;

class TaskController extends Controller
{
    /**
     * Create array for completion_status values.
     * @return mixed
     */
    private function percentages()
    {
        for($i=100; $i>=0; $i-=10)
        {
            $result[$i] = $i.'%';
        }

        return $result;
    }

    /**
     * Display create task form.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $milestone = Milestone::find($request['milestone_id']);

        if (!$milestone)
        {
            return back()->with('warning', 'Milestone not found.');
        }

        $data = [
            'page_title'        => 'Create New Task',
            'navi_group'        => 'tasks',
            'navi_submenu'      => 'create',
            'milestone'         => $milestone,
            'percentages'       => $this->percentages(),
            'predecessor_tasks' => Task::where('milestone_id', $milestone->id)->lists('task_name', 'id')->toArray(),
        ];

        return view('tasks.create', $data);
    }

    /**
     * Create new task record.
     * @param Requests\TaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\TaskRequest $request)
    {
        if (Task::storeRecord($request))
        {
            return redirect::to('/milestones/'.$request['milestone_id'])->with('success', 'Task created.');
        }

        return back()->with('error', 'Task not created.');
    }

    /**
     * Display task details.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task)
        {
            return back()->with('warning', 'Task not found.');
        }

        $data = [
            'page_title'        => 'Task Details',
            'navi_group'        => 'tasks',
            'navi_submenu'      => 'show',
            'task'              => $task,
            'predecessor_task'  => Task::where('id', $task->predecessor_task_id)->first(),
            'allow_elevated_access' => User::hasRoles('admin|manager'),
            'available_users'   => TaskUser::getAvailableUser($task->id),
            'assigned_users'    => TaskUser::getAssignedUser($task->id)
        ];

        return view('tasks.show', $data);
    }

    /**
     * Edit task record.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $task = Task::find($id);

        if (!$task)
        {
            return back()->with('warning', 'Task not found.');
        }

        $data = [
            'page_title'        => 'Edit Task',
            'navi_group'        => 'tasks',
            'navi_submenu'      => 'edit',
            'task'              => $task,
            'milestones'        => Milestone::where('project_id', $task->milestone->project->id)->orderBy('milestone_name')->lists('milestone_name', 'id'),
            'predecessor_tasks' => Task::where('milestone_id', $task->milestone_id)->where('id', '!=', $id)->lists('task_name', 'id')->toArray(),
            'has_task_user'     => Task::hasTaskUser($id),
            'has_predecessor_task'  => Task::hasPredecessorTask($id),
            'percentages'       => $this->percentages()
        ];

        return view('tasks.edit', $data);
    }

    /**
     * Update task record.
     * @param Requests\TaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\TaskRequest $request)
    {
        if (Task::updateRecord($request))
        {
            return back()->with('success', 'Task updated.');
        }

        return back()->withInput()->with('error', 'Task not updated.');
    }

    /**
     * Delete task record.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if ($task->delete())
        {
            return redirect::to('/milestones/'.$task->milestone_id)->with('success', 'Task deleted.');
        }

        return back()->with('error', 'Task not deleted.');
    }
}
