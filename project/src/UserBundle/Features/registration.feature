@user
Feature: Registration

  As a site visitor
  In order to become registered user
  I want to be able create new account

  @javascript
  Scenario: Registration from registration page
    Given I am on "/en_EN/user/registration"
    Then I should see "Create new account"

  @javascript
  Scenario: Test registration success
    Given I am on "/en_EN/user/registration"
    When I fill in the following:
      | email    | apobereznichenko@gmail.com |
      | password | 0956213666                 |