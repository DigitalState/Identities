@entity @individual @read
Feature: Read individuals
  In order to read individuals
  As an admin identity
  I should be able to send api requests related to individuals

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Read a individual
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals/605289e0-9371-42d4-b9fe-5308c348a6a4"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to the string "605289e0-9371-42d4-b9fe-5308c348a6a4"
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "14da4a8c-aee1-43b3-bbac-e3e81a853e0e"
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
