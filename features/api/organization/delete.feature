@api @organization @delete
Feature: Delete organization identities
  In order to delete organization identities
  As a system identity
  I should be able to send api requests related to organization identities

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @createSchema @loadFixtures
  Scenario: Delete an organization
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted organization
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"

  @dropSchema
  Scenario: Delete a deleted organization
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
