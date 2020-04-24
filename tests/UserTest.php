<?php
use App\models\User;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UserTest extends TestCase
{
    use WithoutMiddleware; //Doesn't need specific middleware (auth / role)

    private $id;
    /**
     * api/register
     *
     * @test
     */
    public function register()
    {
        $response = $this->call('POST', '/api/register', [
            'firstName' => 'testName',
            'lastName' => 'testLastName',
            'alias' => 'testAlias',
            'email' => 'testmail@test.fr',
            'password' => 'testPassword',
            'confirmPassword' => 'testPassword',
            'address' => '42 Rue du Test',
            'city' => 'testCity',
            'postalCode' => '75000',
            'birthday' => '2000-01-01',
            'sexe' => '1',
            'phone' => '0123456789',
        ]);
        $this->assertEquals(200, $response->status());
    }

    /**
     * api/login
     *
     * @test
     */
    public function login()
    {
        $response = $this->call('POST', '/api/login', [
            'email' => 'testmail@test.fr',
            'password' => 'testPassword',
        ]);
        $this->assertEquals(200, $response->status());
    }

    /**
     * api/show
     *
     * @test
     */
    // public function show()
    // {
    //     $response = $this->call('GET', '/api/user/'+$this->id);
    //     $this->assertEquals(200, $response->status());
    // }

    /**
     * api/editUser/:id
     *
     * @test
     */
    public function edit()
    {
        $user = User::where('email', 'testmail@test.fr')->first();
        $response = $this->call('PUT', '/api/editUser/'. $user->id, [
            'email' => 'testmail2@test.fr',
        ]);
        print_r($response->getContent());
        $this->assertEquals(200, $response->status());
    }

    /**
     * api/deleteUser/:id
     *
     * @test
     */
    public function deleteUser()
    {
        $user = User::where('email', 'testmail@test.fr')->first();
        $response = $this->call('GET', '/api/deleteUser/' . $user->id);
        $this->assertEquals(200, $response->status());
    }

    /**
     * api/allUser
     *
     * @test
     */
    public function GetAllUser()
    {
        $response = $this->call('get', '/api/allUser');
        $this->assertEquals(200, $response->status());
    }
}
