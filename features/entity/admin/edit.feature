@app @entity @admin @edit
Feature: Edit admins
  In order to edit admins
  As an admin identity
  I should be able to send api requests related to admins

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures
  Scenario: Edit an admin
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/admins/b163571a-d4b9-4b72-9827-4178301a1a24" with body:
    """
    {
      "ownerUuid": "1de09611-726f-45d5-9302-0aa473e58def"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "1de09611-726f-45d5-9302-0aa473e58def"

  Scenario: Confirm the edited admin
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins/b163571a-d4b9-4b72-9827-4178301a1a24"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "1de09611-726f-45d5-9302-0aa473e58def"

  Scenario: Edit an admin's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/admins/b163571a-d4b9-4b72-9827-4178301a1a24" with body:
    """
    {
      "id": 9999,
      "uuid": "c4ec7c36-95de-4aba-8e9f-8bc1091f1d93",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "b163571a-d4b9-4b72-9827-4178301a1a24"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  Scenario: Confirm the unedited admin
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins/b163571a-d4b9-4b72-9827-4178301a1a24"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "b163571a-d4b9-4b72-9827-4178301a1a24"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  @dropSchema
  Scenario: Edit a admin with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/admins/b163571a-d4b9-4b72-9827-4178301a1a24" with body:
    """
    {
      "ownerUuid": "64998bb2-abc0-4466-aa1b-f443e9e5dc63",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the response should be in JSON
