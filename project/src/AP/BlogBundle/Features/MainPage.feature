Feature: Blog main page

  I can visit blog main page

  Scenario: Blog index page is available
    Given I am on "/blog"
    And the response status code should be 200