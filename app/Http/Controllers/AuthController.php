<?php

namespace App\Http\Controllers;

use App\User;
use App\Charclass;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function login()
    {
        session(['bnet.region' => 'eu']);

        return Socialite::driver('battlenet')->scopes(['wow.profile'])->redirect();
    }

    public function return()
    {
        $errors = array();
        $info = Socialite::driver('battlenet')->user();

        if (!is_null($info)) {
            $user = User::firstOrNew(['bnetid' => $info->getId()]);

            if (!$user->exists) {
                $user->name = $info->getNickname();
                $user->bnetid = $info->getId();

                $user->save();
            } elseif ($user->name !== $info->getNickname()) {
                $user->name = $info->getNickname();

                $user->save();
            }

            $errors['login'] = 'Logged in successfully';

            Auth::login($user, true);

            $this->updateCharacters($info->accessTokenResponseBody['access_token']);
        } else {
            $errors['login'] = 'Error logging in!';
        }

        return redirect()->intended('/home')->withErrors($errors);
    }

    private function updateCharacters($token)
    {
        $client = new Client([
            'base_uri' => 'https://eu.api.battle.net'
        ]);

        $response = $client->request('GET', 'wow/user/characters', [
            'query' => [
                'access_token' => $token
            ]
        ]);

        $body = $response->getBody();
        $data = json_decode($body->getContents(), true);

        foreach ($data['characters'] as $characterData) {
            if ($characterData['level'] === 110 &&
                isset($characterData['guild']) && $characterData['guild'] === 'Prophecy' &&
                $characterData['guildRealm'] === 'Bloodscalp'
            ) {
                $character = Auth::user()->characters()->firstOrNew([
                    'name' => $characterData['name']
                ]);

                if (!$character->exists) {
                    $charclass = Charclass::findOrFail($characterData['class']);
                    $character->charclass()->associate($charclass);

                    $character->save();
                }
            }
        }
    }
}
