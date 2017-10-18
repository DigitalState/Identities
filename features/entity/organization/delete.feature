@app @entity @organization @delete
Feature: Delete organizations
  In order to delete organizations
  As a system identity
  I should be able to send api requests related to organizations

  Background:
    Given I am authenticated as a "system" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Delete an organization
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/organizations/a6b3a00b-e732-4aeb-8011-a1e58fc7b5e3"
    Then the response status code should be 204
    And the response should be empty
