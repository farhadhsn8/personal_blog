<?php

use tests\fixtures\PostFixture;

class PostsCest
{
    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => PostFixture::className(),
                'dataFile' => codecept_data_dir() . 'post.php'
            ]
        ]);
    }

    public function test_index_page(FunctionalTester $I)
    {
        $I->amOnPage(['posts/index']);
        $I->see('Posts', 'h1');
    }

    // tests
    public function test_creat_invalid_post(FunctionalTester $I) #empty fields
    {
        $I->amOnPage(['posts/create']);
        $I->see('Create', 'h1');
        $I->submitForm('#post-form', [
            'Post[title]' => '',
            'Post[body]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Title cannot be blank.', '.help-block');
        $I->see('Body cannot be blank.', '.help-block');
    }
}
