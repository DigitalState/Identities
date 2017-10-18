@app @entity @organization @edit
Feature: Edit organizations
  In order to edit organizations
  As a system identity
  I should be able to send api requests related to organizations

  Background:
    Given I am authenticated as a "system" identity

  @createSchema @loadFixtures
  Scenario: Edit a organization
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3" with body:
    """
    {
      "ownerUuid": "8cdbf6e7-5f90-4ae1-b86e-57a3890a38fa"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "8cdbf6e7-5f90-4ae1-b86e-57a3890a38fa"

  Scenario: Confirm the edited organization
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "ownerUuid" should be equal to the string "8cdbf6e7-5f90-4ae1-b86e-57a3890a38fa"

  Scenario: Edit a organization's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3" with body:
    """
    {
      "id": 9999,
      "uuid": "95785846-61bc-4d0b-9f60-f0631c9cc987",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "deletedAt":"2000-01-01T12:00:00+00:00"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  Scenario: Confirm the unedited organization
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "deletedAt" should not contain "2000-01-01T12:00:00+00:00"

  @dropSchema
  Scenario: Edit a organization with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3" with body:
    """
    {
      "ownerUuid": "dc98a835-699a-4080-ba4c-7d028d19c7c3",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the response should be in JSON
