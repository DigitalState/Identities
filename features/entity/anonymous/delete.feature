@entity @anonymous @delete
Feature: Delete anonymouses
  In order to delete anonymouses
  As an admin identity
  I should be able to send api requests related to anonymouses

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Delete an anonymous
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/anonymouses/73aab537-f174-4bf9-b986-afedbb23b7bc"
    Then the response status code should be 204
    And the response should be empty
