@entity @system @delete
Feature: Delete systems
  In order to delete systems
  As an system identity
  I should be able to send api requests related to systems

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Delete an system
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/systems/5386e249-8ad0-45f1-a30e-d5a055cc5993"
    Then the response status code should be 204
    And the response should be empty
