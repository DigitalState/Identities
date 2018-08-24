@api @staff @add
Feature: Add staff identities
  In order to add staff identities
  As a system identity
  I should be able to send api requests related to staff identities

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @upMigrations @loadFixtures
  Scenario: Add an staff
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/staffs" with body:
    """
    {
      "owner": "BusinessUnit",
      "ownerUuid": "83bf8f26-7181-4bed-92f3-3ce5e4c286d7",
      "version": 1
    }
    """
    Then the response status code should be 201
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 3
    And the JSON node "uuid" should exist
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
    And the JSON node "tenant" should exist
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @downMigrations
  Scenario: Read the added data
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?id=3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items
