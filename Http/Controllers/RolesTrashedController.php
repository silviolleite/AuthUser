<?php

namespace AuthUser\Http\Controllers;

use AuthUser\Http\Requests\RolesRequest;
use AuthUser\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class RolesTrashedController extends Controller
{
    /**
     * @var \AuthUser\Repositories\RoleRepository
     */
    private $repository;

    public function __construct(RoleRepository $repository)
    {

        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesRequest $request)
    {
        $search = $request->get('search');
        $roles = $this->repository->onlyTrashed()->paginate(15);
        return view('authuser::trashed.roles.index', compact('roles', 'search'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Authuser\Http\Requests\RolesRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolesRequest $request, $id)
    {
        $this->repository->onlyTrashed();
        $this->repository->restore($id);

        $url = $request->get('redirect_to', route('trashed.roles.index'));
        $request->session()->flash('message', 'Regra restaurada com sucesso.');
        return redirect()->to($url);
    }
}
