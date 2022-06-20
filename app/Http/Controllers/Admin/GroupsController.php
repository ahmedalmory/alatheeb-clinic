<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\GroupsDataTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Group;
use Validator;
use Set;
use Up;
use Form;

// Auto Controller Maker By Baboon Script
// Baboon Maker has been Created And Developed By  [It V 1.0 | https://it.phpanonymous.com]
// Copyright Reserved  [It V 1.0 | https://it.phpanonymous.com]
class GroupsController extends Controller
{

    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(GroupsDataTable $groups)
    {
        return $groups->render('admin.groups.index', ['title' => trans('admin.groups')]);
    }


    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.groups.create', ['title' => trans('admin.create')]);
    }

    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $r
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $rules = [
            'group_name' => 'required|string',
            'permissions' => '',
        ];
        $data = $this->validate(request(), $rules, [], [
            'group_name' => trans('admin.group_name'),

        ]);

        $data['admin_id'] = admin()->user()->id;
        Group::create($data);

        session()->flash('success', trans('admin.added'));
        return redirect(aurl('groups'));
    }

    /**
     * Display the specified resource.
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $groups = Group::find($id);
        return view('admin.groups.show', ['title' => trans('admin.show'), 'groups' => $groups]);
    }


    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * edit the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $groups = Group::find($id);
        return view('admin.groups.edit', ['title' => trans('admin.edit'), 'groups' => $groups]);
    }


    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * update a newly created resource in storage.
     * @param \Illuminate\Http\Request $r
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $rules = [
            'group_name' => 'required|string',
            'permissions' => '',
        ];

        $data = $this->validate(request(), $rules, [], [
            'group_name' => trans('admin.group_name'),
        ]);
        $data['admin_id'] = admin()->user()->id;
        $data['permissions'] = json_encode($data['permissions']);
        Group::where('id', $id)->update($data);

        session()->flash('success', trans('admin.updated'));
        return redirect(aurl('groups'));
    }

    /**
     * Baboon Script By [It V 1.0 | https://it.phpanonymous.com]
     * destroy a newly created resource in storage.
     * @param \Illuminate\Http\Request $r
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $groups = Group::find($id);


        @$groups->delete();
        session()->flash('success', trans('admin.deleted'));
        return back();
    }


    public function multi_delete(Request $r)
    {
        $data = $r->input('selected_data');
        if (is_array($data)) {
            foreach ($data as $id) {
                $groups = Group::find($id);

                @$groups->delete();
            }
            session()->flash('success', trans('admin.deleted'));
            return back();
        } else {
            $groups = Group::find($data);


            @$groups->delete();
            session()->flash('success', trans('admin.deleted'));
            return back();
        }
    }


}
