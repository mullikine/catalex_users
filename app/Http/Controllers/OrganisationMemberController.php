<?php

namespace App\Http\Controllers;

use Auth;

class OrganisationMemberController extends Controller
{
    public function leave()
    {
        // Get the user
        $user = Auth::user();
        
        // Check user isn't an org admin
        if ($user->hasRole('organisation_admin')) {
            return redirect()->back()->withErrors('Organisation admins cannot leave their organisation.');
        }
        
        // Get the organisation while it is still linked to the user
        $organisation = $user->organisation;
        
        // Remove the user from their organisation
        $user->update(['organisation_id' => null]);
        
        // Redirect the user to the home page with a success message
        return redirect()->route('index')->with(['success' => 'You have left the organisation: ' . $organisation->name . '.']);
    }
}