<?php

class UsersController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $data = array(
            'field' => array('email', 'first_name', 'last_name', 'last_login'),
            'values' => Sentry::findAllUsers()
        );
        return Response::json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
        try {
            $data = array(
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'activated' => true,
            );
            // Create the user
            if (Sentry::createUser($data)) {
                return Response::json(array('success' => true, 'message' => 'User Baru Berhasil Ditambahkan'));
            }
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            return Response::json(array('success' => false, 'message' => 'Field Login diperlukan'));
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            return Response::json(array('success' => false, 'message' => 'Password diperlukan.'));
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            return Response::json(array('success' => false, 'message' => 'Email sudah Terdaftar'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
        $data = array(
            'value' => Sentry::findUserById($id),
        );
        return Response::json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
        $user = Sentry::findUserById($id);
        return Response::json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
        try {
            // Find the user using the user id
            $user = Sentry::findUserById($id);
            if (Input::has('old_password')) {
                if ($user->checkPassword(Input::get('old_password'))) {
                    $user->password = Input::get('new_password');
                } else {
                    return Response::json(array('success' => false, 'message' => 'Password does not match.'));
                }
            } else {
                $user->first_name = Input::get('first_name');
                $user->last_name = Input::get('last_name');
            }
            if ($user->save()) {
                return Response::json(array('success' => true, 'message' => 'Informasi User berhasil diupdate'));
            } else {
                return Response::json(array('success' => false, 'message' => 'Informasi User tidak berhasil diupdate'));
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
           return Response::json(array('success' => false, 'message' => 'User tidak diketemukan'));
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            return Response::json(array('success' => false, 'message' => 'Email sudah Terdaftar'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        try {
            // Find the user using the user id
            $user = Sentry::findUserById($id);
            // Delete the user
            if ($user->delete()) {
                return Response::json(array('success' => true));
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            echo 'User was not found.';
        }
    }

}
