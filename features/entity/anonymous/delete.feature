@app @entity @anonymous @delete
Feature: Delete anonymouses
  In order to delete anonymouses
  As a system identity
  I should be able to send api requests related to anonymouses

  Background:
    Given I am authenticated as the "system" identity

  @createSchema @loadFixtures
  Scenario: Delete an anonymous
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/anonymouses/73aab537-f174-4bf9-b986-afedbb23b7bc"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted anonymous
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses/73aab537-f174-4bf9-b986-afedbb23b7bc"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"

  @dropSchema
  Scenario: Delete a deleted anonymous
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses/73aab537-f174-4bf9-b986-afedbb23b7bc"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
