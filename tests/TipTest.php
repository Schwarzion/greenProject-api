<?php
use App\models\Tip;
use App\Http\Services\TipService;
use Laravel\Lumen\Testing\WithoutMiddleware;
use Laravel\Lumen\Testing\DatabaseTransactions;

class tipTest extends TestCase
{
    use WithoutMiddleware; //Doesn't need specific middleware (auth / role)
    use DatabaseTransactions; //Rollback database after each tests


     /**
     * 
     * Tip Service dependancy injection (strong typed)
     *
     * @return void
     */
    public function __construct(TipService $service)
    {
        $this->tipService = $service;
    }
    /**
     * api/register
     *
     * @test
     */
    public function addTip()
    {
        $arr = [];
        $this->tipService->create($this->tipService->newTip());
        // $this->assertEquals(200, $response->status());
    }

    // /**
    //  * api/login
    //  *
    //  * @test
    //  */
    // public function login()
    // {
    //     $response = $this->call('POST', '/api/login', [
    //         'email' => 'testmail@test.fr',
    //         'password' => 'testPassword',
    //     ]);
    //     $this->assertEquals(200, $response->status());
    // }

    // /**
    //  * api/show
    //  *
    //  * @test
    //  */
    // public function show()
    // {
    //     $tip = tip::where('email', 'testmail@test.fr')->first();
    //     $response = $this->call('GET', '/api/tip/' . $tip->id);
    //     $this->assertEquals(200, $response->status());
    // }

    // /**
    //  * api/edittip/:id
    //  *
    //  * @test
    //  */
    // public function edit()
    // {
    //     $tip = tip::where('email', 'testmail@test.fr')->first();
    //     $response = $this->call('PUT', '/api/edittip/' . $tip->id, [
    //         'email' => 'testmail2@test.fr',
    //     ]);
    //     $this->assertEquals(200, $response->status());
    // }

    // /**
    //  * api/deletetip/:id
    //  *
    //  * @test
    //  */
    // public function deletetip()
    // {
    //     $tip = tip::where('email', 'testmail2@test.fr')->first();
    //     $response = $this->call('GET', '/api/deletetip/' . $tip->id);
    //     $this->assertEquals(200, $response->status());
    // }

    // /**
    //  * api/alltip
    //  *
    //  * @test
    //  */
    // public function GetAlltip()
    // {
    //     $response = $this->call('get', '/api/alltip');
    //     $this->assertEquals(200, $response->status());
    // }
}
