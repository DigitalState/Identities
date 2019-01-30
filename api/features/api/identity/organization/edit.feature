@api @identity @organization @edit
Feature: Edit organization identities

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit an organization identity
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3" with body:
    """
    {
      "owner": "BusinessUnit",
      "ownerUuid": "e51aea66-ba28-4718-9644-e5fc35ad7a45",
      "roles": [],
      "version": 1
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should be equal to the string "e51aea66-ba28-4718-9644-e5fc35ad7a45"
    And the JSON node "roles" should exist
    And the JSON node "roles" should have 0 elements
    And the JSON node "version" should be equal to the number 2

  Scenario: Confirm the edited organization identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should be equal to the string "e51aea66-ba28-4718-9644-e5fc35ad7a45"
    And the JSON node "roles" should exist
    And the JSON node "roles" should have 0 elements
    And the JSON node "version" should be equal to the number 2

  Scenario: Edit an organization identity's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3" with body:
    """
    {
      "id": 9999,
      "uuid": "421aebbb-e62e-4b87-bced-42921456131b",
      "createdAt":"2000-01-01T12:00:00+00:00",
      "updatedAt":"2000-01-01T12:00:00+00:00",
      "version": 2,
      "tenant": "93377748-2abb-4e33-9027-5d8a5c281a41"
    }
    """
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Confirm the unedited organization identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit an organization identity with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3" with body:
    """
    {
      "ownerUuid": "8a1e280b-cd3b-4c1e-be62-f2e74b77e350",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
