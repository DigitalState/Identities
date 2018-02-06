@app @entity @individual @delete
Feature: Delete individuals
  In order to delete individuals
  As a system identity
  I should be able to send api requests related to individuals

  Background:
    Given I am authenticated as the "system" identity

  @createSchema @loadFixtures
  Scenario: Delete an individual
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/individuals/9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted individual
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals/9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"

  @dropSchema
  Scenario: Delete a deleted individual
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals/9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
