<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Laracasts\Behat\Context\DatabaseTransactions;
use Laracasts\Behat\Context\Migrator;
use PHPUnit_Framework_Assert as PHPUnit;
use App\Storage\User\User;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    use DatabaseTransactions;
    use Migrator;

    protected $username;

    protected $email;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        User::boot();
    }

    /**
     * @When I register :username :email
     */
    public function iRegister($username, $email)
    {
        $this->username = $username;
        $this->email = $email;

        $this->visit('auth/register');
        $this->fillField('username', $username);
        $this->fillField('email', $email);
        $this->fillField('password', 'password');
        $this->fillField('password_confirmation', 'password');

        $this->pressButton('Register');
    }

    /**
     * @When I register with invalid credentials
     */
    public function iRegisterWithInvalidCredentials()
    {
        $this->iRegister('', '');
    }

    /**
     * @Then I should have an account.
     */
    public function iShouldHaveAnAccount()
    {
       $this->assertSignedIn();
    }

    /**
     * @Then I should not have an account.
     */
    public function iShouldNotHaveAnAccount()
    {
        $this->assertNotSignedIn('auth/register');
    }

    /**
     * @Given I have an account :arg1 :arg2
     */
    public function iHaveAnAccount($username, $email)
    {
        $this->iRegister($username, $email);
        $this->visit('auth/logout');
    }

    /**
     * @When I sign in
     */
    public function iSignIn()
    {      
        $this->visit('auth/login');
        $this->fillField('email', $this->email);
        $this->fillField('password', 'password');
        $this->pressButton('Login');
    }

    /**
     * @When I sign in with invalid credentials
    */
     
    public function iSignInWithInvalidCredentials()
    {
        $this->email = 'invalid@email.com';
        $this->iSignIn();
    }

    /**
     * @Then I should be logged in
     */
    public function iShouldBeLoggedIn()
    {
        $this->assertSignedIn();
    }

    /**
     * @Then I should not be logged in
     */
    public function iShouldNotBeLoggedIn()
    {
        PHPUnit::assertTrue( Auth::guest() );
        $this->assertPageAddress('auth/login');
        $this->assertPageContainsText('These credentials do not match our records.');
    }

    private function assertSignedIn()
    {
        PHPUnit::assertTrue( Auth::check() );
        $this->assertPageAddress('home');
    }

    private function assertNotSignedIn($redirect)
    {
        PHPUnit::assertFalse( Auth::check() );
        $this->assertPageAddress( $redirect );
    }
}
