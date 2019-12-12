<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Holiday;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,manager');
    }

    /**
     * Display holiday page.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'page_title'        => 'Holidays',
            'navi_group'        => 'holidays',
            'navi_submenu'      => 'holidays.index',
            'holidays'           => Holiday::get()
        ];

        return view('holidays.index', $data);
    }

    /**
     * Display create form.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'page_title'        => 'Create New Holiday',
            'navi_group'        => 'holidays',
            'navi_submenu'      => 'holidays.create',
            'holiday'           => new Holiday
        ];

        return view('holidays.create', $data);
    }

    /**
     * Create new holiday record.
     * @param Requests\HolidayRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\HolidayRequest $request)
    {
        if (Holiday::storeRecord($request))
        {
            return back()->with('success', 'Holiday created.');
        }

        return back()->withInput()->with('error', 'Holiday not created.');
    }

    /**
     * Display edit form.
     * @param Holiday $holiday
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Holiday $holiday)
    {
        $data = [
            'page_title'        => 'Edit Holiday',
            'navi_group'        => 'holidays',
            'navi_submenu'      => 'holidays.edit',
            'holiday'           => $holiday
        ];

        return view('holidays.edit', $data);
    }

    /**
     * Update holiday record.
     * @param Requests\HolidayRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\HolidayRequest $request)
    {
        if (Holiday::updateRecord($request))
        {
            return back()->with('success', 'Holiday updated.');
        }

        return back()->withInput()->with('error', 'Holiday not updated.');
    }

    /**
     * Delete record.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $holiday = Holiday::find($id);

        if ($holiday->delete())
        {
            return redirect()->action('HolidayController@index')->with('success', 'Holiday Deleted.');
        }

        return back()->with('error', 'Holiday not deleted.');
    }
}
