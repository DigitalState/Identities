@app @entity @admin @delete
Feature: Delete admins
  In order to delete admins
  As an admin identity
  I should be able to send api requests related to admins

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Delete an admin
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/admins/b163571a-d4b9-4b72-9827-4178301a1a24"
    Then the response status code should be 204
    And the response should be empty
