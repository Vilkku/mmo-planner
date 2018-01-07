<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Raid;
use App\Role;
use App\Signup;
use App\Status;
use Auth;
use Illuminate\Http\Request;

class RaidController extends Controller
{
    public function index()
    {
        $raids = Raid::get();

        return view('raid.index')->with('raids', $raids);
    }

    public function show(Request $request)
    {
        $raid = Raid::with('comments.user', 'signups')
            ->findOrFail($request->raid);

        $characters = null;

        if (Auth::user()) {
            $characters = Auth::user()
                ->characters()
                ->with('charclass')
                ->whereDoesntHave('signups', function ($query) use ($raid) {
                    $query->where('raid_id', $raid->id);
                })
                ->orderBy('name')
                ->get();
        }

        $signups = $raid->signups()
            ->with('character.charclass', 'status', 'role')
            ->get()
            ->groupBy(function ($signup) {
                return $signup->status->name;
            });

        $statuses = Status::all();
        $roles = Role::all();

        return view('raid.show')
            ->with('characters', $characters)
            ->with('raid', $raid)
            ->with('signups', $signups)
            ->with('roles', $roles)
            ->with('statuses', $statuses)
            ->with('comments', $raid->comments);
    }

    public function signUp(Request $request)
    {
        $raid = Raid::findOrFail($request->raid);

        if (Auth::user()) {
            $character = Auth::user()
                ->characters()
                ->with('signups')
                ->findOrFail($request->character);

            $status = Status::findOrFail($request->status);
            $role = Role::findOrFail($request->role);

            if (!$character->signups->contains('raid_id', $raid->id)) {
                $signup = new Signup();

                $signup->raid()->associate($raid);
                $signup->character()->associate($character);
                $signup->status()->associate($status);
                $signup->role()->associate($role);

                // TODO Get actual role and status
                $signup->role_id = 1;

                $signup->save();
            }
        }

        return redirect()->route('raid', $request->raid);
    }

    public function comment(Request $request)
    {
        $raid = Raid::findOrFail($request->raid);

        if (Auth::user() && !empty($request->comment)) {
            $comment = new Comment();

            $comment->body = $request->comment;

            $comment->user()->associate(Auth::user());
            $comment->commentable()->associate($raid);

            $comment->save();
        }

        return redirect()->route('raid', $request->raid);
    }
}
