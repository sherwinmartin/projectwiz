<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Client;
use App\Models\Project;

use Redirect;

class ProjectController extends Controller
{
    /**
     * Display projects page.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'page_title'        => 'View All Projects',
            'navi_group'        => 'projects',
            'navi_submenu'      => 'index',
            'projects'          => Project::with('client')->get()
        ];

        return view('projects.index', $data);
    }

    /**
     * Display create form.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'page_title'        => 'Create New Project',
            'navi_group'        => 'projects',
            'navi_submenu'      => 'create',
            'clients'           => Client::orderBy('client_name', 'ASC')->lists('client_name', 'id')
        ];

        return view('projects.create', $data);
    }

    /**
     * Create new project record.
     * @param Requests\ProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\ProjectRequest $request)
    {
        if (Project::storeRecord($request))
        {
            return back()->with('success', 'Project created.');
        }

        return back()->withInput()->with('error', 'Project not created.');
    }

    /**
     * Display edit form.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'page_title'        => 'Edit Project',
            'navi_group'        => 'projects',
            'navi_submenu'      => 'edit',
            'project'           => Project::find($id),
            'clients'           => Client::orderBy('client_name', 'ASC')->lists('client_name', 'id'),
            'has_milestones'    => Project::hasMilestones($id)
        ];

        return view('projects.edit', $data);
    }

    /**
     * Update project record.
     * @param Requests\ProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\ProjectRequest $request)
    {
        if (Project::updateRecord($request))
        {
            return back()->with('success', 'Project updated.');
        }

        return back()->withInput()->with('error', 'Project not updated.');
    }

    /**
     * Delete project record.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if ($project->delete())
        {
            return redirect::action('ProjectController@index')->with('success', 'Project deleted.');
        }

        return back()->with('error', 'Project not deleted.');
    }
}
