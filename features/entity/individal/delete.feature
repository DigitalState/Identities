@app @entity @individual @delete
Feature: Delete individuals
  In order to delete individuals
  As a system identity
  I should be able to send api requests related to individuals

  Background:
    Given I am authenticated as a "system" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Delete an individual
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/individuals/605289e0-9371-42d4-b9fe-5308c348a6a4"
    Then the response status code should be 204
    And the response should be empty
