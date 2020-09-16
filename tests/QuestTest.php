<?php
use app\models\quest;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\WithoutMiddleware;

class questTest extends TestCase
{
    use WithoutMiddleware; //Doesn't need specific middleware (auth / role)
    use DatabaseTransactions; //Rollback database after each tests

    /**
     * api/addQuest
     *
     * @test
     */
    public function addQuest()
    {
        $response = $this->call('POST', '/api/addQuest', [
            'name' => 'PhpUnit Testing Quest',
            'desc' => 'test description',
            'expAmount' => 5,
            'minLevel' => 2, 
            'timeForQuest' => '100000',
            'endDate' => '2030-06-17'
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('PhpUnit Testing Quest', $response->getData()->quest->name);
        $this->assertEquals('test description', $response->getData()->quest->desc);
    }

    /**
     * api/allQuest
     *
     * @test
     */
    public function getAll()
    {
        $response = $this->call('get', '/api/allQuests');
        $this->assertEquals(200, $response->status());
        $this->questId = $response->getData()->quests[0]->id;
        $this->assertEquals('testQuest', $response->getData()->quests[0]->name);
    }

    /**
     * api/quest
     *
     * @test
     */
    public function show()
    {
        $quest = Quest::where('id', '1')->first();
        $response = $this->call('GET', '/api/quest/' . $quest->id);
        $this->assertEquals(200, $response->status());
        $this->assertEquals('testQuest', $response->getData()->quest->name);
    }

    /**
     * api/editQuest
     *
     * @test
     */
    public function edit()
    {
        $quest = Quest::where('id', '1')->first();
        $response = $this->call('POST', "/api/editQuest/{$quest->id}", [
          'name' => 'PhpUnit Testing Quest EDITED',
          'desc' => 'test description EDITED',
          'expAmount' => 2,
          'minLevel' => 1, 
          'timeForQuest' => '12360',
          'endDate' => '2035-01-01'
        ]);
        $this->assertEquals(200, $response->status());
        $this->assertEquals('quest 1 has been updated', $response->getData()->msg);
    }

    /**
     * api/deletequest/:id
     *
     * @test
     */
    public function deleteQuest()
    {
        $quest = Quest::where('id', 1)->first();
        $response = $this->call('GET', '/api/deleteQuest/' . $quest->id);
        $this->assertEquals(200, $response->status());
    }
}
