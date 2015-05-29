<?php namespace Meatings\Http\Controllers;

use Meatings\Http\Requests;
use Meatings\User;

class UserController extends Controller {

    protected $user;

    function __construct(User $user ) {
        $this->user = $user;
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index()
    {
        $users = $this->user->all();

        return view('users.index')->with('users', $users);
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = $this->user->find($id);

        return view('users.show')->with('user', $user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = $this->user->find($id);

        return view('users.edit')->with('user', $user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $user = $this->user->find($id);

        $input = Input::all();

        $user->name = array_get($input, 'name');

        $user->save();

        return redirect()->route('users.show', $user->id);
	}

}
