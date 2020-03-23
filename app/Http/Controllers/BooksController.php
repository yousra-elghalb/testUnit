<?php

namespace App\Http\Controllers;


use App\Book;

class BooksController extends Controller
{
    public function store(){

        $book = Book::create($this->validateRequest());

        //Book.php:
        return redirect($book->path());



    }

    public function update(Book $book){

        $book->update($this ->validateRequest());

        return redirect($book->path());
    }


    public function destroy(Book $book){
        $book->delete();

        return redirect('/books');

    }

    /**
     * @return mixed
     */

    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required',
        ]);

    }






    }
