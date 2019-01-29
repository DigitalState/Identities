@api @identity @system @delete
Feature: Delete system identities

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Delete a system identity
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/systems/aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted system identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems/aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Delete a deleted system identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems/aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
