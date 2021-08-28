<?php

namespace tests\unit\models;

use app\models\Post;
use Codeception\Test\Unit;
use tests\fixtures\PostFixture;

class PostTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'post' => [
                'class' => PostFixture::className(),
                'dataFile' => codecept_data_dir() . 'post.php'
            ]
        ]);
    }

    public function test_title_and_body_notEmpty()
    {
        $model = new Post();
        expect('model should not validate', $model->validate())->false();
        expect('title has error', $model->errors)->hasKey('title');
        expect('title has error', $model->errors)->hasKey('body');
    }

    public function test_validate_title_and_body()
    {
        $model = new Post([
            'title' => 'about C++',
            'body' => 'useful programming language',
        ]);
        expect('model should validate', $model->validate())->true();
    }

    public function test_save_post()
    {
        $model = new Post([
            'author_id' => 1 ,
            'title' => 'about C++',
            'body' => 'useful programming language',
        ]);
        expect('model should save', $model->save())->true();
        expect('title is correct', $model->title)->equals('about C++');
        expect('body is correct', $model->body)->equals('useful programming language');
        expect('status is draft', $model->author_id)->equals(1);
        expect('created_at is generated', $model->created_at)->notEmpty();
    }
}
