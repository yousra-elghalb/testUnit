<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;


class BookReservationTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_the_library(){

        //$this->withoutExceptionHandling();

        $response = $this->post('/books',[
            'title' => 'Homestead Test Title',
            'author' => 'Yousra',
        ]);

        $book = Book::first();

        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());

    }

    /** @test */

    // Si l'user ne saisie pas title .. validation
    public function a_title_is_required(){

        $response = $this->post('/books',[
            'title' => '',
            'author' => 'Youmna',
        ]);

        $response->assertSessionHasErrors('title');

    }

    /** @test */
    public function a_author_is_required()
    {

        $response = $this->post('/books', [
            'title' => 'Homestead Test Title',
            'author' => '',
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {

        //$this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Homestead Test Title',
            'author' => 'Yousra',
        ]);

        $book = Book::first();

        $response = $this->patch($book->path(),[
            'title' => 'New Title',
            'author' => 'New Author',

        ]);

        //compare between 'New Title' and the title in the DB
        $this->assertEquals('New Title' , Book::first()->title);
        $this->assertEquals('New Author' , Book::first()->author);

        $response->assertRedirect($book->fresh()->path());

    }


    /** @test */
    public function a_book_can_be_deleted()
    {

        //if we have already checked already that the method add book is working
        //  we dont't need to re-check it again

        //$this->withoutExceptionHandling();

        //inserer un nouveau book
        $this->post('/books', [
        'title' => 'Homestead Test Title',
        'author' => 'Yousra',
    ]);
        $book = Book::first();

        //s'assurer que le nbr au debut est 1 : book is insert
        $this->assertCount(1, Book::all());
        $response = $this->delete($book->path());


        //comparer 0 avec le nbr des books
        $this->assertCount(0, Book::all());

        //s'assurer que apres la supp la page se redirect to:
        $response->assertRedirect('/books');

    }
}
