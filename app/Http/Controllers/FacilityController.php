<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Facility::class);
    
        $search = $request->input('search');
       
        $facilities = Facility::query()
            ->when($search, fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->paginate(10) 
            ->withQueryString();
    
        return view('facilities.index', ['facilities' => $facilities]);
    }
    
    public function show(Facility $facility)
    {
        $this->authorize('view', $facility);

        $startDate = now()->startOfDay();
        $endDate   = now()->addMonths(3)->endOfDay();        
        $days      = [];    
        foreach (CarbonPeriod::create($startDate, '1 day', $endDate) as $date) {
            $days[] = $date->format('Y-m-d');
        }
        
        $schedules = $facility->schedules()
            ->where('status', 'approved')
            ->get();
        $blocks = [];        
        foreach ($schedules as $sch) {
            $dayKey   = $sch->start_time->format('Y-m-d');
            $span     = $sch->start_time->diffInMinutes($sch->end_time) / 30;
            $startSlot = $sch->start_time->format('H:i');
            $blocks[$dayKey][$startSlot] = [
                'schedule'  => $sch,
                'span'      => (int) $span,
            ];
        }

        return view('facilities.show', compact('facility', 'days', 'blocks'));
    }

    public function create()
    {
        $this->authorize('create', Facility::class);
       
        return view('facilities.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Facility::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:1023',
        ]);
        
        Facility::create($validated);

        return redirect()->route('facilities.index')->with('success', 'Facility created.');
    }

    public function edit(Facility $facility)
    {
        $this->authorize('update', $facility);
        
        return view('facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $this->authorize('update', $facility);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:1023',
        ]);
        
        $facility->update($validated);

        return redirect()->route('facilities.index')->with('success', 'Facility updated.');
    }

    public function destroy(Facility $facility)
    {
        $this->authorize('delete', $facility);
        
        $facility->delete();

        return redirect()->route('facilities.index')->with('success', 'Facility deleted.');
    }
}

