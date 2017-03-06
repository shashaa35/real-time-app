<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Request;
use Socialite;
use Session;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function redirectToProvider(Request $request)
    {
        return Socialite::driver('github')
            ->with(['redirect_uri' => env('GITHUB_CALLBACK_URL' ).'?redirect=notifications'])
            ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     * If a "redirect" query string is present, redirect
     * the user back to that page.
     *
     * @param Request $request
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('github')->user();

        Session::put('user', $user);
        Session::save();
        // Auth::login($user);
        // var_dump(Session::get('user'));
        // $redirect = $request->redirect;
        //  if($redirect)
        // {
        //      return redirect($redirect);
        //  }
        return 'GitHub auth successful. Now navigate to a demo.';
    }

}
