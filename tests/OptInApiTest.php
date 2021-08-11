<?php

use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\User;

class OptInApiTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var User
     */
    protected $user;

    public function setUp(): void
    {
        $this->user = app(User::class);
        parent::setUp();
    }

    public function testHomepage(): void
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }

    public function testShouldReturnAllUsers(): void
    {
        $this->get("users", []);
        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            '*' => [
                'id',
                'email',
                'first_name',
                'last_name',
                'opt_in',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    public function testShouldReturnSingleUser(): void
    {
        $this->get("users/1", []);
        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            'id',
            'email',
            'first_name',
            'last_name',
            'opt_in',
            'created_at',
            'updated_at',
        ]);
    }

    public function testShouldCreateUserRecord(): void
    {
        $params = [
            'email'         => 'abba.bryant@gmail.com',
            'first_name'    => 'Abba',
            'last_name'     => 'Bryant',
            'opt_in'        => true,
        ];

        $this->post("users", $params, []);
        $this->seeStatusCode(200);

        $this->seeJson([
            'email'         => 'abba.bryant@gmail.com',
            'first_name'    => 'Abba',
            'last_name'     => 'Bryant',
            'opt_in'        => true,
        ]);
    }

    public function testCantCreateEmptyRecords(): void
    {
        // no data sent
        $this->post('users', [], []);
        $this->seeJsonStructure([
           'email',
           'first_name',
           'last_name',
           'opt_in',
        ]);
    }

    public function testEmailMustBeUniqueToCreateRecord(): void
    {
        $userEmail = $this->user->findOrFail(1)->email;

        $this->post('users', [
            'email'         => $userEmail,
            'first_name'    => 'Abba',
            'last_name'     => 'Bryant',
            'opt_in'        => false,
        ]);

        $this->seeJsonEquals([
            "email" => [
                "The email has already been taken."
            ]
        ]);
    }
}
