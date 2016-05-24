<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Client;

use Redirect;

class ClientController extends Controller
{
    /**
     * Display all client records.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'page_title' => 'View All Clients',
            'navi_group' => 'clients',
            'navi_submenu' => 'index',
            'clients' => Client::get()
        ];

        return view('clients.index', $data);
    }

    /**
     * Display create form.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'page_title' => 'Create New Client',
            'navi_group' => 'clients',
            'navi_submenu' => 'create'
        ];

        return view('clients.create', $data);
    }

    public function store(Requests\ClientRequest $request)
    {
        if (Client::storeRecord($request))
        {
            return back()->with('success', 'Client created.');
        }

        return back()->withInput()->with('error', 'Client not created.');
    }

    /**
     * Display edit form.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = [
            'page_title'        => 'Edit Client',
            'navi_group'        => 'clients',
            'navi_submenu'      => 'edit',
            'client'            => Client::find($id),
            'has_project'       => Client::hasProjects($id)
        ];

        return view('clients.edit', $data);
    }

    /**
     * Update client record.
     * @param Requests\ClientRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\ClientRequest $request)
    {
        if (Client::updateRecord($request))
        {
            return back()->with('success', 'Client updated.');
        }

        return back()->withInput()->with('error', 'Client failed to be updated.');
    }

    /**
     * Delete client record.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        if ($client->delete())
        {
            return redirect::action('ClientController@index')->with('success', 'Client Deleted.');
        }

        return back()->with('error', 'Client not deleted.');
    }
}
