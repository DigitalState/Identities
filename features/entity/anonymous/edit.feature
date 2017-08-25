@app @entity @anonymous @edit
Feature: Edit anonymouses
  In order to edit anonymouses
  As a system identity
  I should be able to send api requests related to anonymouses

  Background:
    Given I am authenticated as a "system" identity

  @createSchema @loadFixtures
  Scenario: Edit a anonymous
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/anonymouses/73aab537-f174-4bf9-b986-afedbb23b7bc" with body:
    """
    {
      "ownerUuid": "089b0cd7-b4cb-496c-b41f-e5522f5db526"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "089b0cd7-b4cb-496c-b41f-e5522f5db526"

  Scenario: Confirm the edited anonymous
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses/73aab537-f174-4bf9-b986-afedbb23b7bc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "089b0cd7-b4cb-496c-b41f-e5522f5db526"

  Scenario: Edit a anonymous's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/anonymouses/73aab537-f174-4bf9-b986-afedbb23b7bc" with body:
    """
    {
      "id": 9999,
      "uuid": "d13b1b3c-df34-40ab-96a7-bb8fe7e624a1",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "73aab537-f174-4bf9-b986-afedbb23b7bc"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  Scenario: Confirm the unedited anonymous
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses/73aab537-f174-4bf9-b986-afedbb23b7bc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "73aab537-f174-4bf9-b986-afedbb23b7bc"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  @dropSchema
  Scenario: Edit a anonymous with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/anonymouses/73aab537-f174-4bf9-b986-afedbb23b7bc" with body:
    """
    {
      "ownerUuid": "18c4b10a-d4ec-447b-8d0e-89bccfa00e0a",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the response should be in JSON
