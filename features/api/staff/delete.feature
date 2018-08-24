@api @staff @delete
Feature: Delete staff identities
  In order to delete staff identities
  As a system identity
  I should be able to send api requests related to staff identities

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @upMigrations @loadFixtures
  Scenario: Delete an staff
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted staff
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"

  @downMigrations
  Scenario: Delete a deleted staff
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
