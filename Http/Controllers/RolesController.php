<?php

namespace AuthUser\Http\Controllers;

use AuthUser\Http\Requests\RolesRequest;
use AuthUser\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RolesController extends Controller
{

    /**
     * @var RoleRepository
     */
    private $repository;

    /**
     * RolesController constructor.
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {

        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $roles = $this->repository->paginate(10);
        return view('authuser::roles.index', compact('roles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authuser::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AuthUser\Http\Requests\RolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('authuser.roles.index'));
        $request->session()->flash('message', 'Regra cadastrada com sucesso.');
        return redirect()->to($url);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->repository->find($id);
        return view('authuser::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AuthUser\Http\Requests\RolesRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolesRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
        $url = $request->get('redirect_to', route('authuser.roles.index'));
        $request->session()->flash('message', 'Regra alterada com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Regra excluída com sucesso.');
        return redirect()->to(\URL::previous());
    }

}
