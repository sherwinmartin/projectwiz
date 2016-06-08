<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Milestone;

use App\Models\Project;

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
     * Display edit form.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $milestone = Milestone::join('projects', 'projects.id', '=', 'milestones.project_id')->find($id);

        if (!$milestone)
        {
            return back()->with('warning', 'Milestone not found.');
        }
        $data = [
            'page_title'        => 'Edit Milestone',
            'navi_group'        => 'milestones',
            'navi_submenu'      => 'edit',
            'milestone'         => $milestone
        ];

        return view('milestones.edit', $data);
    }
}
