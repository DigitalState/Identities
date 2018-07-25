@api @anonymous @read
Feature: Read anonymous identities
  In order to read anonymous identities
  As a system identity
  I should be able to send api requests related to anonymous identities

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @createSchema @loadFixtures @dropSchema
  Scenario: Read a anonymous
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses/ad1a4ee4-b707-4135-b8e9-498286d5830c"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should exist
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should exist
    And the JSON node "uuid" should be equal to the string "ad1a4ee4-b707-4135-b8e9-498286d5830c"
    And the JSON node "createdAt" should exist
    And the JSON node "updatedAt" should exist
    And the JSON node "deletedAt" should exist
    And the JSON node "deletedAt" should be null
    And the JSON node "owner" should exist
    And the JSON node "owner" should be equal to the string "System"
    And the JSON node "ownerUuid" should exist
    And the JSON node "ownerUuid" should be equal to the string "aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    And the JSON node "version" should exist
    And the JSON node "version" should be equal to the number 1
    And the JSON node "tenant" should exist
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
