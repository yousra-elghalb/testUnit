<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;


    /** @test */

    public function an_author_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/author',[
            'name' => 'Author Name',
            //this date need to be a carbon instance .. how we can cast it into a carbon instance
            'dob' => '01/02/1996',
        ]);

        //Collection
        $author = Author::all();


        $this->assertCount(1,$author);
        //to be sure that the date is a carbon instance .. parsing as date
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);

        $this->assertEquals('1996/02/01', $author->first()->dob->format('Y/d/m'));
    }
}
