<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{
    public function show($id)
    {
        return response()->json([
            'id' => 25,
            'title' => 'React',
            'description' => '',
            'text' => 'Some text ...',
            'created_at' => 'January 1, 2019 at 12:00 PM',
            'image' => 'https://icons-for-free.com/iconfiles/png/512/design+development+facebook+framework+mobile+react+icon-1320165723839064798.png'
        ]);
    }
}
