<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function store(Request $request)
    {

        ///validation inputs
        $request->validate([
            'email' => ['required', 'email'],
            'colocation_id' => ['required', 'exists:colocations,id'],
        ]);

        $user = auth()->user();

        // get colocation
        $colocation = $user->colocations()
            ->where('colocations.id', $request->colocation_id)
            ->wherePivot('role', 'owner')
            ->wherePivotNull('left_at')
            ->first();


        //check colocation if exist
        if (!$colocation) {
            return back()->withErrors([
                'email' => 'You are not authorized to invite members to this colocation.'
            ]);
        }

        //check if colocation is active
        if ($colocation->status !== 'active') {
            return back()->withErrors([
                'email' => 'This colocation is not active.'
            ]);
        }

        // trim and tolower the email
        $email = strtolower(trim($request->email));

        //prevent inviting yourself
        if ($email === $user->email) {
            return back()->withErrors([
                'email' => 'You cannot invite yourself.'
            ]);
        }

        ///check if already invited (pending)
        $alreadyInvitated = $colocation->invitations()
            ->where('email', $email)
            ->whereNull('accepted_at')
            ->exists();

        if ($alreadyInvitated) {
            return back()->withErrors([
                'email' => 'This email has already been invited.'
            ]);
        }

        //check if the invited email is already user
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {

            //Check if already member of this colocation
            $alreadyMember = $existingUser->colocations()
                ->where('colocation_id', $colocation->id)
                ->wherePivotNull('left_at')
                ->exists();

            if ($alreadyMember) {
                return back()->withErrors([
                    'email' => 'This user is already a member of this colocation.'
                ]);
            }

            //Check if user has another active colocation
            $hasActiveElsewhere = $existingUser->colocations()
                ->wherePivotNull('left_at')
                ->exists();

            if ($hasActiveElsewhere) {
                return back()->withErrors([
                    'email' => 'This user already belongs to another active colocation.'
                ]);
            }
        }

        //Create invitation
        $invitation = Invitation::create([
            'colocation_id' => $colocation->id,
            'invited_by'     => $user->id,
            'email'          => $email,
            'token'          => Str::random(40),
        ]);

        $inviteUrl = route('invitations.accept', $invitation->token);
        
        return back()->with([
            'success' => 'Invitation created successfully.',
            'invite_link' => $inviteUrl,
        ]);
    }

    public function showAccept($token)
    {
        $invitation = Invitation::where('token', $token)->first();
        dd($invitation);

        return view('colocations.invitationShow');
    }
}
