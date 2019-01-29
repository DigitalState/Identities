@api @identity @staff @edit
Feature: Edit staff identities

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a staff identity
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82" with body:
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

  Scenario: Confirm the edited staff identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "owner" should be equal to the string "BusinessUnit"
    And the JSON node "ownerUuid" should be equal to the string "e51aea66-ba28-4718-9644-e5fc35ad7a45"
    And the JSON node "roles" should exist
    And the JSON node "roles" should have 0 elements
    And the JSON node "version" should be equal to the number 2

  Scenario: Edit a staff identity's read-only properties
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82" with body:
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
    And the JSON node "uuid" should be equal to the string "06f8bb0b-45e3-46af-94c7-ff917f720c82"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Confirm the unedited staff identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON node "id" should be equal to the number 1
    And the JSON node "uuid" should be equal to the string "06f8bb0b-45e3-46af-94c7-ff917f720c82"
    And the JSON node "createdAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "updatedAt" should not contain "2000-01-01T12:00:00+00:00"
    And the JSON node "tenant" should be equal to "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Edit a staff identity with an invalid optimistic lock
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82" with body:
    """
    {
      "ownerUuid": "8a1e280b-cd3b-4c1e-be62-f2e74b77e350",
      "version": 1
    }
    """
    Then the response status code should be 500
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
