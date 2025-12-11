<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check permission
        if (!auth()->user()->can('view subscribers')) {
            abort(403, 'Unauthorized action.');
        }

        // Subscribers are automatically filtered by tenant
        $subscribers = Subscriber::latest()->paginate(10);
        return view('admin.subscribers', compact('subscribers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        // tenant_id is automatically set via model boot
        Subscriber::create([
            'email' => $request->email,
        ]);

        return back()->with('success', 'Successfully subscribed to our newsletter!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscriber $subscriber)
    {
        return response()->json($subscriber);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscriber $subscriber)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email,' . $subscriber->id,
        ]);

        $subscriber->update([
            'email' => $request->input('email'),
        ]);

        return redirect()->route('subscribers.index')->with('success', 'Subscriber updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriber $subscriber)
    {
        // Check permission
        if (!auth()->user()->can('delete subscribers')) {
            abort(403, 'Unauthorized action.');
        }

        $subscriber->delete();

        return redirect()->route('subscribers.index')
            ->with('success', 'Subscriber deleted successfully!');
    }
}
