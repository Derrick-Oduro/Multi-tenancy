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
        // Subscribers are automatically filtered by tenant
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscribers', compact('subscribers'));
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
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriber $subscriber)
    {
        // Check permission using Spatie
        if (!auth()->user()->can('delete subscribers')) {
            abort(403, 'Unauthorized action.');
        }

        $subscriber->delete();

        return redirect()->route('subscribers.index')
            ->with('success', 'Subscriber deleted successfully!');
    }
}
