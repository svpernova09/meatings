<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('see an index of all users');
$I->amOnPage('/users');
$I->see('Name', '/html/body/div/div/div/div/div[2]/ul/li[1]/div/div[1]/h4');
$I->see('Email', '/html/body/div/div/div/div/div[2]/ul/li[1]/div/div[2]/h4');
