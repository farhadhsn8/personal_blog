<?php

class PostTest extends \Codeception\Test\Unit
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;
    
    protected function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['post/index']);
    }

    protected function _after(\FunctionalTester $I)
    {

    }

    // tests
    public function openPostPage(\FunctionalTester $I)
    {
        $I->see('Posts','h1');
    }
}