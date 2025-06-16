<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\UserInvitationMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ShortUrlRequest;
use App\Http\Requests\InvitationRequest;
use App\Jobs\SendUserInvitationMail;
use App\Models\User;
use App\Models\ShortUrl;
use DataTables;
use Exception;

class AdminController extends Controller
{
    public function InviteNewmemberCreate(){
        return view('admin.member.create');
    }
    public function InviteNewMemberStore(InvitationRequest $request){
        try {
                $token = Str::random(40);
                $password = Str::random(6);
                $user = User::create([
                    'name' => $request->name,
                    'role' => 3,
                    'password' => Hash::make($password),
                    'email' => $request->email,
                    'invitation_token' => $token,
                    'invited_by' => auth()->id(),
                ]);

            dispatch(new SendUserInvitationMail($request->email, $token));
            return response()->json([
                'status' => true,
                'url'=>route('admin.members.list'),
                'data' => [], 
                'message' => 'Created successfully!'
                ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' =>$e->getMessage()
            ]);
        }

    }

    public function shortUrlCreate(){
        return view('admin.short-url.create');
    }
    public function shortUrlStore(ShortUrlRequest $request){
        try {
                $shortCode = Str::random(6);
                $shortUrl = ShortUrl::create([
                    'original_url' => $request->long_url,
                    'short_code' => $shortCode,
                    'user_id' => auth()->id(),
                ]);
            return response()->json([
                'status' => true,
                'url'=>route(auth()->user()?->role.'.short-url.list'),
                'data' => [], 
                'message' => 'Created successfully!'
                ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' =>$e->getMessage()
            ]);
        }

    }

    public function resolve($short_code){
        $shortUrl = ShortUrl::where('short_code', $short_code)
            ->where('status', 1) // Only active ones
            ->first();

        if (!$shortUrl) {
            abort(404, 'Short URL not found or inactive.');
        }

        // Increment hit count
        $shortUrl->increment('hits');

        return redirect($shortUrl->original_url);
        
    }
}
