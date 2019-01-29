@api @identity @individual @delete
Feature: Delete individual identities

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Delete a individual identity
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/individuals/9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted individual identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals/9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"

  Scenario: Delete a deleted individual identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals/9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
