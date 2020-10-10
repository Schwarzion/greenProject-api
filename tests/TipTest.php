<?php
use app\models\tip;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\WithoutMiddleware;

class tipTest extends TestCase
{
    use WithoutMiddleware; //Doesn't need specific middleware (auth / role)
    use DatabaseTransactions; //Rollback database after each tests

    /**
     * api/addTip
     *
     * @test
     */
    public function addTip()
    {
        $response = $this->call('POST', '/api/addTip', [
            'name' => 'PhpUnit Testing',
            'desc' => 'test description',
        ]);

        $this->assertEquals('PhpUnit Testing', $response->getData()->tip->name);
        $this->assertEquals(200, $response->status());
    }

    /**
     * api/alltip
     *
     * @test
     */
    public function GetAll()
    {
        $response = $this->call('get', '/api/allTips');
        $this->assertEquals(200, $response->status());
        $this->tipId = $response->getData()->tips[0]->id;
        $this->assertEquals('testTip', $response->getData()->tips[0]->name);
    }

    /**
     * api/tip
     *
     * @test
     */
    public function show()
    {
        $tip = Tip::where('id', '1')->first();
        $response = $this->call('GET', '/api/tip/' . $tip->id);
        $this->assertEquals(200, $response->status());
        $this->assertEquals('testTip', $response->getData()->tip->name);
    }

    /**
     * api/editTip
     *
     * @test
     */
    public function edit()
    {
        $tip = Tip::where('id', '1')->first();
        $response = $this->call('POST', "/api/editTip/{$tip->id}", [
            'name' => 'new name',
            'desc' => 'testDesc',
        ]);
        $this->assertEquals(200, $response->status());
        $this->assertEquals("L'astuce 1 a été modifié", $response->getData()->msg);
    }

    /**
     * api/deletetip/:id
     *
     * @test
     */
    public function deletetip()
    {
        $tip = tip::where('id', 1)->first();
        $response = $this->call('GET', '/api/deleteTip/' . $tip->id);
        $this->assertEquals(200, $response->status());
    }
}
