<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    private $movies = [
        [
            'id' => 1,
            'title' => 'Toy Story',
            'genre' => 'Animation',
            'year' => 1995,
            'description' => 'A story about toys that come alive.'
        ],

        [
            'id' => 2,
            'title' => 'Frozen',
            'genre' => 'Fantasy',
            'year' => 2013,
            'description' => 'Two sisters discover the power of love.'
        ],

        [
            'id' => 3,
            'title' => 'Shrek',
            'genre' => 'Comedy',
            'year' => 2001,
            'description' => 'An ogre adventure story.'
        ],

        [
            'id' => 4,
            'title' => 'Cars',
            'genre' => 'Adventure',
            'year' => 2006,
            'description' => 'A racing car learns friendship.'
        ],

        [
            'id' => 5,
            'title' => 'Kung Fu Panda',
            'genre' => 'Action Comedy',
            'year' => 2008,
            'description' => 'A panda becomes a kung fu master.'
        ]
    ];

    public function index()
    {
        $items = $this->movies;

        return view('items.index', compact('items'));
    }

    public function show($id)
    {
        $item = collect($this->movies)->firstWhere('id', $id);

        return view('items.show', compact('item'));
    }
}