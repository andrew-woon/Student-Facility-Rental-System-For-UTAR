<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $search = $request->input('search');
        $users = User::query()
            ->when($search, fn ($query) =>$query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
                })
            )->paginate(10)->withQueryString();
    
        return view('users.index', ['users' => $users]);
    }
    
    public function show(Request $request, User $user)
    {
        $this->authorize('view', $user);
    
        $facilitySearch = $request->input('facility_search');
        $statusFilter = $request->input('status', 'all');
        $dateFilter = $request->input('date');
    
        $schedules = $user->schedules()
            ->with('facility')
            ->when($facilitySearch, fn($query) => 
                $query->whereHas('facility', fn($q) =>
                    $q->where('name', 'like', '%' . $facilitySearch . '%')))
            ->when($statusFilter !== 'all', fn($query) => $query->where('status', $statusFilter))
            ->when($dateFilter, fn($query) => $query->whereDate('start_time', $dateFilter))
            ->orderBy('start_time', 'desc')
            ->paginate(10)
            ->withQueryString();
    
        return view('users.show', [
            'user' => $user,
            'schedules' => $schedules,
            'statusFilter' => $statusFilter,
            'facilitySearch' => $facilitySearch,
            'dateFilter' => $dateFilter,
        ]);
    }    

    public function create()
    {
        $this->authorize('create', User::class);

        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school_id' => 'required|string|min:7|max:15',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|digits_between:10,15',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => 'required|in:user,admin',
        ]);
    
        $validated['password'] = Hash::make($validated['password']);
    
        User::create($validated);
    
        return redirect()->route('users.index')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    } 

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school_id' => 'required|string|min:7|max:15',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|digits_between:10,15',
            'role' => 'required|in:user,admin',
        ]);
    
        $user->update($validated);
    
        return redirect()->back()->with('success', 'User updated.');
    }    

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
 
        $user->delete();
    
        return redirect()->route('users.index')->with('success', 'User deleted.');
    }   
    
    public function profile()
    {
        $user = Auth::user();

        $this->authorize('update', $user);

        return view('users.profile', compact('user'));
    }   
     
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $this->authorize('updatePassword', $user);

        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'New password must be different from the current password.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}




