<?php


namespace Kilobyteno\LaravelUserGuestLike\Tests;

use Kilobyteno\LaravelUserGuestLike\Tests\Models\TestAuthorModel;
use Kilobyteno\LaravelUserGuestLike\Tests\Models\TestModel;

class HasUserGuestLikeTest extends TestCase
{
    /** @var TestModel */
    protected TestModel $testModel;
    protected TestAuthorModel $author;

    public function setUp(): void
    {
        parent::setUp();

        $this->testModel = TestModel::create([
            'name' => 'Test Model',
        ]);

        $this->author = TestAuthorModel::create([
            'name' => 'Test Author',
        ]);
    }

    /** @test */
    public function it_can_be_liked_by_a_user()
    {
        $this->testModel->like($this->author);

        $this->assertEquals(1, $this->testModel->likes()->count());
    }

    /** @test */
    public function it_can_be_unliked_by_a_user()
    {
        $this->testModel->like($this->author);
        $this->testModel->dislike($this->author);

        $this->assertEquals(0, $this->testModel->likes()->count());
    }

}
