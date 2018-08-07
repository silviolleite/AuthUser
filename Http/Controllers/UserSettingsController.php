<?php

namespace AuthUser\Http\Controllers;

use AuthUser\Http\Requests\UserSettingRequest;
use AuthUser\Repositories\UserRepository;

class UserSettingsController extends Controller
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
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = \Auth::user();
        return view('authuser::user-settings.setting', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \AuthUser\Http\Requests\UserRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserSettingRequest $request)
    {
        $user = \Auth::user();
        $this->repository->update($request->all(), $user->id);
        $url = $request->get('redirect_to', route('authuser.user_settings.edit'));
        $request->session()->flash('message', 'Usuário alterado com sucesso.');
        return redirect()->to($url);
    }


}
