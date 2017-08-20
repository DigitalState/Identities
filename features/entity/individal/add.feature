@entity @individual @add
Feature: Add individuals
  In order to add individuals
  As an admin identity
  I should be able to send api requests related to individuals

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Add an individual
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/individuals" with body:
    """
    {
      "owner": "BusinessUnit",
      "ownerUuid": "a8357843-470d-4e3a-8014-5fec0306e017",
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
    And the JSON node "ownerUuid" should be equal to the string "a8357843-470d-4e3a-8014-5fec0306e017"
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
