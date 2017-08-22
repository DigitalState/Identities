@app @entity @system @edit
Feature: Edit systems
  In order to edit systems
  As an admin identity
  I should be able to send api requests related to systems

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures
  Scenario: Edit a system
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/systems/5386e249-8ad0-45f1-a30e-d5a055cc5993" with body:
    """
    {
      "ownerUuid": "168fd323-44e1-4da0-9c38-8c44ba4ed691"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "168fd323-44e1-4da0-9c38-8c44ba4ed691"

  Scenario: Confirm the edited system
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems/5386e249-8ad0-45f1-a30e-d5a055cc5993"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "168fd323-44e1-4da0-9c38-8c44ba4ed691"

  Scenario: Edit a system's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/systems/5386e249-8ad0-45f1-a30e-d5a055cc5993" with body:
    """
    {
      "id": 9999,
      "uuid": "77924b83-abce-41ed-819e-314db52ed28b",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "5386e249-8ad0-45f1-a30e-d5a055cc5993"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  Scenario: Confirm the unedited system
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems/5386e249-8ad0-45f1-a30e-d5a055cc5993"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "5386e249-8ad0-45f1-a30e-d5a055cc5993"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  @dropSchema
  Scenario: Edit a system with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/systems/5386e249-8ad0-45f1-a30e-d5a055cc5993" with body:
    """
    {
      "ownerUuid": "ff2d3d39-158d-447f-a63f-58968dc91604",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the response should be in JSON
