@entity @system @add
Feature: Add systems
  In order to add systems
  As an system identity
  I should be able to send api requests related to systems

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Add an system
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/systems" with body:
    """
    {
      "owner": "BusinessUnit",
      "ownerUuid": "d5de44e0-d727-4f69-a8b3-c3afbf75eda3",
      "version": 1
    }
    """
    Then the response status code should be 201
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 2
    And the JSON node "uuid" should exist
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "d5de44e0-d727-4f69-a8b3-c3afbf75eda3"
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
