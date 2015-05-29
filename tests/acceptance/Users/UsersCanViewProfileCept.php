<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('view my own profile');
$I->amOnPage('/users/1');
$I->see('Name', '/html/body/div/div/div/div/div[2]/div[1]/h4');
$I->see('Email', '/html/body/div/div/div/div/div[2]/div[2]/h4');
