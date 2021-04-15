<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_get(Request $request)
    {
        $key = $request->input('key');
        $sort_method = $request->input('sort_method');
        $master_data = Book::all();
        
        // ソートの指定がある時
        if ($sort_method == 'asc') {
            $book_data = $master_data->sortBy($key,SORT_NATURAL)->values()->toArray();
            
        } else if ($sort_method == 'desc') {
            $book_data = $master_data->sortByDesc($key,SORT_NATURAL)->values()->toArray();
        } else {
            // ソートの指定がない時
            $book_data = $master_data;
        }
        if (count($book_data) > 0) {
            return json_encode([
                'message' => 'ok',
                'data' => $book_data
            ], 200);
        } else {
            return json_encode([
                'message' => '本アプリに登録されている書籍はありません。',
                'data' => $book_data
            ], 200);
        };
    }
}