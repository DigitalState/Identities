@app @entity @staff @delete
Feature: Delete staffs
  In order to delete staffs
  As an admin identity
  I should be able to send api requests related to staffs

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures @dropSchema
  Scenario: Delete an staff
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82"
    Then the response status code should be 204
    And the response should be empty
