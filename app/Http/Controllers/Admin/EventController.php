<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Event::with('category')->oldest();

        // Filter berdasarkan pencarian nama event
        if ($request->filled('search')) {
            $query->where('title', 'ilike', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori yang dipilih
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $events = $query->get();
        $categories = Category::all();

        return view('admin.events.index', compact('events', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:1',
            'description' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['poster', 'time']);
        $data['date'] = $request->date . ' ' . $request->time;

        if ($request->hasFile('poster')) {
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.event')->with('success', 'Event berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();

        return view('admin.events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:1',
            'description' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Judul wajib diisi.',
            'category_id.required' => 'Kategori wajib diisi.',
            'date.required' => 'Tanggal wajib diisi.',
            'time.required' => 'Waktu wajib diisi.',
            'location.required' => 'Lokasi wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'stock.required' => 'Stok wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'poster.required' => 'Poster wajib diisi.',
        ]);

        $event = Event::findOrFail($id);
        
        $data = $request->except(['poster', 'time']);
        $data['date'] = $request->date . ' ' . $request->time;

        if ($request->hasFile('poster')) {
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.event')->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $events = Event::findOrFail($id);
            $events->delete();

            return redirect()->route('admin.event')->with('success', 'Event berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.event')->with('error', 'Gagal menghapus event. Event mungkin masih memiliki event terkait.');
        }
    }
}
