@auth
Feature: Membership

In order to give users access to the website
As an administrator
I need authentication and registration

Scenario: Successful Registration
	When I register "AlexCW" "alex@tester.test"
	Then I should have an account. 

Scenario: Failed Registration
	When I register with invalid credentials
	Then I should not have an account.

Scenario: Successful Authentication
	Given I have an account "AlexCW" "alex@tester.test"
	When I sign in
	Then I should be logged in

Scenario: Unsuccessful Authentication
	When I sign in with invalid credentials
	Then I should not be logged in

