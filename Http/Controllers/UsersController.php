<?php

namespace AuthUser\Http\Controllers;

use AuthUser\Http\Requests\UserDeleteRequest;
use AuthUser\Http\Requests\UserRequest;
use AuthUser\Repositories\UserRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
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
        $users = $this->repository->paginate(10);
        return view('authuser::users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authuser::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \AuthUser\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('authuser.users.index'));
        $request->session()->flash('message', 'Usuário cadastrado com sucesso.');
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
        $user = $this->repository->find($id);
        return view('authuser::users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AuthUser\Http\Requests\UserRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->except(['password']);
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Usuário alterado com sucesso.');
        return redirect()->route('authuser.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserDeleteRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDeleteRequest $request, $id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Usuário excluído com sucesso.');
        return redirect()->to(\URL::previous());
    }
}
