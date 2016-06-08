<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Milestone;
use App\Models\Project;

use Redirect;

class MilestoneController extends Controller
{
    public function create(Request $request)
    {
        $data = [
            'page_title'        => 'Create New Milestone',
            'navi_group'        => 'milestones',
            'navi_submenu'      => 'create',
            'project'        => Project::select('id', 'project_name')->find($request['project_id'])
        ];

        if (!$data['project'])
        {
            return back()->with('error', 'Project not found.');
        }

        return view('milestones.create', $data);
    }

    /**
     * Create new milestone record.
     * @param Requests\MilestoneRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\MilestoneRequest $request)
    {
        if (Milestone::storeRecord($request))
        {
            return redirect::to('/projects/'.$request['project_id'])->with('success', 'Milestone created.');
        }

        return back()->with('error', 'Milestone not created.');
    }

    /**
     * Display edit form.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $milestone = Milestone::find($id);

        if (!$milestone)
        {
            return back()->with('warning', 'Milestone not found.');
        }
        $data = [
            'page_title'        => 'Edit Milestone',
            'navi_group'        => 'milestones',
            'navi_submenu'      => 'edit',
            'milestone'         => $milestone,
            'has_tasks'         => Milestone::hasTask($id)
        ];

        return view('milestones.edit', $data);
    }


    public function update(Requests\MilestoneRequest $request)
    {
        if (Milestone::updateRecord($request))
        {
            return back()->with('success', 'Milestone updated.');
        }

        return back()->withInput()->with('error', 'Milestone not updated.');
    }

    public function destroy($id)
    {
        $milestone = Milestone::find($id);

        if ($milestone->delete())
        {
            return redirect::to('/projects/'.$milestone->project_id)->with('success', 'Milestone deleted.');
        }

        return back()->with('error', 'Project not deleted.');
    }
}
