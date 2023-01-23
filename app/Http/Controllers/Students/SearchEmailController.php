<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchEmailController extends Controller
{
    public function search(Request $request)
    {
        $emailQuery = Message::query()->where('from', '=', auth()->user()->email);

        if ($request->search)
        {
            if ($request->search)
            {
                $emailQuery->where(function (Builder $query) use ($request)
                {
                    return $query->where('subject', 'like', "%" . $request->search . "%")
                        ->orWhere('message', 'like', "%" . $request->search . "%")
                        ->orWhere('send_date', 'like', "%" . $request->search . "%");
                });


            }
            $messages = $emailQuery->get();


            if (count($messages) > 0)
            {
                return view('student.search.messages', ['messages' => $messages]);
            } else
            {
                return view('student.search.messages', ['messages' => []]);
            }

        } else
        {
            return view('student.search.messages', ['messages' => []]);
        }

    }
}
