@api @access @delete
Feature: Delete accesses

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Delete an access
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/accesses/15239742-553e-4e56-9656-36f7c3dca7d4"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted access
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses/15239742-553e-4e56-9656-36f7c3dca7d4"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
