<?php

namespace Controllers;

use App\Auth;
use App\Cookies;
use App\Session;
use App\Validation;
use App\Validatore;
use Models\UserModel;

class ChangeInfoController
{
    public function onlyMe($request)
    {
        UserModel::where(['id', '=', Auth::user()->id])->update([
            'only_me' => $request->only_me
        ]);

        if ($request->only_me == 'yes') {
            echo 'lock';
        } else {
            echo 'unlock';
        }
    }

    public function pio($request)
    {
        if (empty(trim($request->pio))) {
            $pio = null;
        } else {
            $pio = $request->pio;
        }
        UserModel::where(['id', '=', Auth::user()->id])->update([
            'about' => $pio
        ]);

        echo htmlspecialchars($request->pio);
    }

    public function name($request)
    {
        $valid = Validatore::make([
            'name' => 'required',
        ]);

        if ($valid) {
            UserModel::where(['id', '=', Auth::user()->id])->update([
                'name' => $request->name
            ]);
            Session::set('name', $request->name);
            if (!is_null(Cookies::get('name'))) {
                Cookies::set('name', $request->name, (86400 * 30));
            }
            echo json_encode([
                'response' => 'success',
                'name' => htmlspecialchars($request->name)
            ]);
        } else {
            echo json_encode([
                'response' => 'error',
                'msg' => errors('name')
            ]);
        }
    }

    public function email($request)
    {
        $valid = Validatore::make([
            'email' => "required|email|unique:UserModel"
        ]);

        if ($valid) {
            UserModel::where(['id', '=', Auth::user()->id])->update([
                'email' => $request->email
            ]);

            echo json_encode([
                'response' => 'success',
                'email' => htmlspecialchars($request->email)
            ]);
        } else {
            echo json_encode([
                'response' => 'error',
                'msg' => errors('email')
            ]);
        }
    }

    public function phone($request)
    {
        $valid = Validatore::make([
            'phone' => "required|num|unique:UserModel"
        ]);

        if ($valid) {
            UserModel::where(['id', '=', Auth::user()->id])->update([
                'phone' => $request->phone
            ]);

            echo json_encode([
                'response' => 'success',
                'phone' => htmlspecialchars($request->phone)
            ]);
        } else {
            echo json_encode([
                'response' => 'error',
                'msg' => errors('phone')
            ]);
        }
    }

    public function pass($request)
    {
        $valid = Validatore::make([
            'current_pass' => 'required',
            'new_pass' => 'required|same:repeat_password',
        ]);

        if ($valid) {
            $pass = UserModel::find(Auth::user()->id);
            if (password_verify($request->current_pass, $pass->password)) {
                if ($request->current_pass == $request->new_pass) {
                    Session::flash('error', 'New Password is same as Current Password');
                    return redirect('/my-profile');
                } else {
                    UserModel::where(['id', '=', Auth::user()->id])->update([
                        'password' => password_hash($request->new_pass, PASSWORD_DEFAULT)
                    ]);
                    Session::flash('success', 'Password Changed Successfully, Login Again');
                    Auth::logout();
                    return redirect('/login');
                }
            } else {
                Session::flash('error', 'Incorrect Current Password');
                return redirect('/my-profile');
            }
        } else {
            $user = UserModel::where(['id', '=', Auth::user()->id])->get(['image', 'phone', 'about', 'name', 'email'])[0];
            $userInfo = [
                'id' => Auth::user()->id,
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->image,
                'phone' => $user->phone,
                'about' => $user->about,
            ];

            return view('myprofile', $userInfo);
        }
    }

    public function changeImage($request)
    {
        if (!empty($request->file->name)) {

            $current_image = UserModel::where(['id', '=', Auth::user()->id])->get(['image'])[0];
            $allowEx = ['png', 'jpg', 'jpeg', 'webp'];
            $dir = 'assets/images/';
            $imgName = Validation::file("file", $allowEx, $dir, "user_profile");

            if ($imgName == 2) {
                echo json_encode([
                    'response' => 'error',
                    'msg' => 'Invalid extension, allowed is (png - jpg - jpeg - webp)'
                ]);
                exit;
            } elseif ($imgName == 3) {
                echo json_encode([
                    'response' => 'error',
                    'msg' => 'Error Uploading image try again'
                ]);
                exit;
            } else {

                $fileName = $dir . $imgName['name'];
                if ($imgName['ext'] != 'webp') {
                    $fun = "convert" . $imgName['ext'] . "ToWebp";
                    if (Validation::$fun($fileName)) {
                        unlink($fileName);
                        $imgName['name'] = str_ireplace($imgName['ext'], 'webp', $imgName['name']);
                    }
                }
                if ($current_image->image != 'Blank-Avatar.png') {
                    unlink('../public/assets/images/' . $current_image->image);
                }

                UserModel::where(['id', '=', Auth::user()->id])->update([
                    'image' => $imgName['name']
                ]);

                Session::set('image', $imgName['name']);
                if (!is_null(Cookies::get('image'))) {
                    Cookies::set('image', $imgName['name'], (86400 * 30));
                }
                echo json_encode([
                    'response' => 'success',
                    'image' => $imgName['name']
                ]);
            }
        }
    }

    public function removeImage($request)
    {
        if (!empty($request->image) && $request->image != '/assets/images/Blank-Avatar.png') {
            unlink('../public' . $request->image);
            UserModel::where(['id', '=', Auth::user()->id])->update([
                'image' => 'Blank-Avatar.png'
            ]);
            Session::set('image', 'Blank-Avatar.png');
            if (!is_null(Cookies::get('image'))) {
                Cookies::set('image', 'Blank-Avatar.png', (86400 * 30));
            }
            echo 'Blank-Avatar.png';
        } else {
            echo 'Blank-Avatar.png';
        }
    }
}
