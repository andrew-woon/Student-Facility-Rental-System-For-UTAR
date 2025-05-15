<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Schedule::class);

        $facilitySearch = $request->input('facility_search');
        
        $userSearch = $request->input('user_search');
        
        $statusFilter = $request->input('status', 'pending');
        
        $dateFilter = $request->input('date');

        $query = Schedule::with('facility', 'user');

        if ($facilitySearch) {
            $query->whereHas('facility', function ($q) use ($facilitySearch) {
                $q->where('name', 'like', '%' . $facilitySearch . '%');
            });
        }

        if ($userSearch) {
            $query->whereHas('user', function ($q) use ($userSearch) {
                $q->where('name', 'like', '%' . $userSearch . '%')
                ->orWhere('email', 'like', '%' . $userSearch . '%');
            });
        }

        if ($statusFilter && $statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }

        if ($dateFilter) {
            $query->whereDate('start_time', $dateFilter);
        }

        $query->orderBy(
            $statusFilter === 'pending' ? 'created_at' : 'updated_at',
            $statusFilter === 'pending' ? 'asc' : 'desc'
        );

        $schedules = $query->paginate(10)->withQueryString();

        return view('schedules.index', [
            'schedules' => $schedules,
            'statusFilter' => $statusFilter,
            'dateFilter' => $dateFilter
        ]);
    }

    public function show(Schedule $schedule)
    {
        $this->authorize('view', $schedule);
    
        return view('schedules.show', ['schedule' => $schedule]);
    }
    
    public function create(Facility $facility)
    {
        $this->authorize('create', Schedule::class);
  
        return view('schedules.create', ['facility' => $facility]);
    }

    public function store(Request $request, Facility $facility)
    {
        $this->authorize('create', Schedule::class);

        $request->validate([
            'booking_date' => 'required|date',
            'start_time'   => 'required',
            'end_time'     => 'required',
            'reasons'      => 'required|string',
        ]);

        $start = Carbon::parse("{$request->booking_date} {$request->start_time}");
      
        $end   = Carbon::parse("{$request->booking_date} {$request->end_time}");

        if ($start->isPast()) {
            return back()->withErrors(['start_time' => 'Start time must be in the future.']);
        }
        
        if ($end->lessThanOrEqualTo($start)) {
            return back()->withErrors(['end_time' => 'End time must be after start time.']);
        }

        $approvedConflict = $facility->schedules()
            ->where('status', 'approved')
            ->where('start_time', '<', $end)
            ->where('end_time', '>', $start)
            ->exists();
   
        if ($approvedConflict) {
            return back()->withErrors(['conflict' => 'This facility is already booked for the selected time.']);
        }

        $pendingConflict = $facility->schedules()
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->where('start_time', '<', $end)
            ->where('end_time', '>', $start)
            ->exists();
        
            if ($pendingConflict) {
                return back()->withErrors(['conflict' => 'You already have a pending request that overlaps this time slot.']);
        }

        Schedule::create([
            'user_id'     => Auth::id(),
            'facility_id' => $facility->id,
            'start_time'  => $start,
            'end_time'    => $end,
            'reasons'     => $request->reasons,
            'status'      => 'pending',
        ]);

        return redirect()->route('users.show')
            ->with('status', 'Booking request submitted successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $this->authorize('update', $schedule);
   
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $this->authorize('update', $schedule);
    
        $validated = $request->validate([
            'reasons' => 'required|string|max:255',
        ]);
    
        $schedule->update($validated);
    
        return redirect()->route('schedules.index')->with('success', 'Schedule updated.');
    }
    
    public function destroy(Schedule $schedule)
    {
        $this->authorize('delete', $schedule);
        
        $schedule->delete();
        
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted.');
    }
    
    public function approveReject(Request $request, Schedule $schedule)
    {
        $this->authorize('approveReject', $schedule);
    
        $data = $request->validate([
            'status'   => 'required|in:approved,rejected',
            'feedback' => 'required|string|max:255',
        ]);
    
        DB::transaction(function() use ($schedule, $data) {
            $schedule->update([
                'status'      => $data['status'],
                'feedback'    => $data['feedback'],
                'feedback_by' => Auth::id(),
            ]);
    
            if ($data['status'] === 'approved') {
                Schedule::where('facility_id', $schedule->facility_id)
                    ->where('status', 'pending')
                    ->where('start_time', '<',  $schedule->end_time)
                    ->where('end_time',   '>',  $schedule->start_time)
                    ->where('id',         '!=', $schedule->id)
                    ->update([
                        'status'      => 'rejected',
                        'feedback'    => 'Automatically rejected: time slot already taken. Please check again for latest facility schedule.',
                        'feedback_by' => Auth::id(),
                    ]);
            }
        });
    
        return redirect()->route('schedules.index')
            ->with('success', 'Schedule status updated, and conflicting requests auto rejected.');
    }    

    public function manualCleanup()
    {
        $cutoff = now()->subMonth();
        
        $deleted = Schedule::where('end_time', '<', $cutoff)->delete();
        
        return redirect()->back()->with('status', "$deleted old schedules deleted (older than one month).");
    }    
}

