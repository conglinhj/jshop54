<?php

namespace App\Http\Controllers\Auth;

use App\Events\MergeCart;
use Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Socialite authentication page.
     *
     * @return Response
     */
    public function redirectToProvider(Request $request)
    {
//        dd($request->social);
        return Socialite::driver($request->social)->redirect();
    }

    /**
     * Facebookkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk
     */
    public function handleProviderFaceBookCallback()
    {
        $user = Socialite::driver('facebook')->user();
//        dd($user);
        $authUser = $this->findOrCreateFacebookUser($user);
        Auth::login($authUser, true);
        event(new MergeCart($authUser));
        return redirect()->intended('/home');
    }

    /**
     * tìm hoặc tạo mới tài khoản
     * trả về user để login
     * đáng nhẽ gộp lại cho đúng chuẩn nhưng chưa có thời gian, hard core.
     */
    public function findOrCreateFacebookUser($user){

        $auth_jshop = User::orWhere('email', $user->getEmail())->first();
        // Email đã tồn tại tài khoản
        if ($auth_jshop){
            // Email đã tồn tại tài khoản và có facebook_id
            if ( !empty($auth_jshop->facebook_id) && $auth_jshop->facebook_id == $user->getId()){
                // Nếu tên facebook đã đổi thì
                return $auth_jshop;
            }
            // Email đã tồn tại tài khoản và nhưng không có facebook_id, update fb_id
            $auth_jshop->update([ 'facebook_id' => $user->getId(), ]);
            $user_saved = User::where( 'facebook_id', $user->getId() )->first();
            return $user_saved;
        }
        $gender = isset($user->user['gender']) ? $user->user['gender'] : '';
        // Email đã tồn tại tài khoản, tạo tài khoản mới, không có password
        return User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'avatar' => $user->getAvatar(),
            'render' => $gender,
            'facebook_id' => $user->getId(),
        ]);
    }

    /**
     * Googleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
     */
    public function handleProviderGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $authUser = $this->findOrCreateGoogleUser($user);
//        dd($authUser);
        Auth::login($authUser, true);
        event(new MergeCart($authUser));
        return redirect()->intended('/home');
    }

    public function findOrCreateGoogleUser($user){
        $auth_jshop = User::orWhere('email', $user->getEmail())->first();
        if ($auth_jshop){
            if ( !empty($auth_jshop->google_id) && $auth_jshop->google_id == $user->getId()){
                return $auth_jshop;
            }
            $auth_jshop->update([ 'google_id' => $user->getId(), ]);
            $user_saved = User::where( 'google_id', $user->getId() )->first();
            return $user_saved;
        }
        $gender = isset($user->user['gender']) ? $user->user['gender'] : '';
        return User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'avatar' => $user->getAvatar(),
            'render' => $gender,
            'google_id' => $user->getId(),
        ]);
    }
}