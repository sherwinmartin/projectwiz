<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Milestone;

class MilestoneController extends Controller
{
    public function create()
    {

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
