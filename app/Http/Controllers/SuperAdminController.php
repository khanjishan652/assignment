<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\UserInvitationMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\InvitationRequest;
use App\Jobs\SendUserInvitationMail;
use App\Models\User;
use App\Models\ShortUrl;
use Carbon\Carbon;
use DataTables;
use Exception;

class SuperAdminController extends Controller
{
    public function ClientList(Request $request){
        if ($request->ajax()) {
            $query = User::whereRole(2);
            if ($request->filled('date_range')) {
                $now = Carbon::now();
        
                switch ($request->date_range) {
                    case 'this_month':
                        $query->whereMonth('created_at', $now->month)
                              ->whereYear('created_at', $now->year);
                        break;
                    case 'last_month':
                        $query->whereMonth('created_at', $now->subMonth()->month)
                              ->whereYear('created_at', $now->year);
                        break;
                    case 'last_week':
                        $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
                        break;
                    case 'today':
                        $query->whereDate('created_at', Carbon::today());
                        break;
                }
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    $text = $row->status=='1' ? "Accepted":"Pending";
                    $status = $row->status=='1' ? "success":"warning";
                    return "<label class='form-label label label-$status'>$text</label>";
                  })
                ->rawColumns(['status'])
                ->make(true);
        }
        return view('super-admin.client.index');
    }

    public function InviteNewClientCreate(){
        return view('super-admin.client.create');
    }
    public function InviteNewClientStore(InvitationRequest $request){
        try {
                $token = Str::random(40);
                $password = Str::random(6);
                $user = User::create([
                    'name' => $request->name,
                    'role' => 2,
                    'password' => Hash::make($password),
                    'email' => $request->email,
                    'invitation_token' => $token,
                    'invited_by' => auth()->id(),
                ]);

            dispatch(new SendUserInvitationMail($request->email, $token));
            return response()->json([
                'status' => true,
                'url'=>route('super-admin.client.list'),
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
    public function showAcceptForm($token)
    {
        $user = User::where('invitation_token', $token)->firstOrFail();
        $password = Str::random(6);
        $user->update(['status'=>1,'password'=>Hash::make($password)]);
        return view('thankyou',compact('password'));
    }
    public function MembersList(Request $request){
        if ($request->ajax()) {
            $query = User::whereRole(3);
            if(auth()->user()?->role=='admin'){
                $query->where(['invited_by'=>auth()->id()]);
             }
            if ($request->filled('date_range')) {
                $now = Carbon::now();
        
                switch ($request->date_range) {
                    case 'this_month':
                        $query->whereMonth('created_at', $now->month)
                              ->whereYear('created_at', $now->year);
                        break;
                    case 'last_month':
                        $query->whereMonth('created_at', $now->subMonth()->month)
                              ->whereYear('created_at', $now->year);
                        break;
                    case 'last_week':
                        $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
                        break;
                    case 'today':
                        $query->whereDate('created_at', Carbon::today());
                        break;
                }
            }
            
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    $text = $row->status=='1' ? "Accepted":"Pending";
                    $status = $row->status=='1' ? "success":"warning";
                    return "<label class='form-label label label-$status'>$text</label>";
                })
                ->addColumn('action', function ($row) {
                    return '<a href="#" class="btn btn-sm btn-primary">View</a>';
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('super-admin.members.index');
    }

    public function ShortUrlList(Request $request){
        if ($request->ajax()) {
            $query = ShortUrl::latest();
            if(in_array(auth()->user()?->role,['admin','member'])){
               $query->where(['user_id'=>auth()->id()]);
            }
            if ($request->filled('date_range')) {
                $now = Carbon::now();
        
                switch ($request->date_range) {
                    case 'this_month':
                        $query->whereMonth('created_at', $now->month)
                              ->whereYear('created_at', $now->year);
                        break;
                    case 'last_month':
                        $query->whereMonth('created_at', $now->subMonth()->month)
                              ->whereYear('created_at', $now->year);
                        break;
                    case 'last_week':
                        $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
                        break;
                    case 'today':
                        $query->whereDate('created_at', Carbon::today());
                        break;
                }
            }
            
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('short_code', function($row){
                    return '<a href="' . url('/s/' . $row->short_code) . '" target="_blank">'
                    . url('/s/' . $row->short_code) . '</a>';
                  })
                ->editColumn('user_id', function($row){
                    return $row->user->name??'N/A';
                })
                ->rawColumns(['short_code'])
                ->make(true);
        }
        return view('super-admin.short-url.index');
    }
}
