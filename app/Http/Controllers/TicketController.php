<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function checkout($id)
    {
        $event = Event::findOrFail($id);
        return view('checkout', compact('event'));
    }

    public function ticket($id)
    {
        $event = Event::findOrFail($id);
        return view('ticket', compact('event'));
    }
}
