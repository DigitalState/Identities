@api @anonymous @delete
Feature: Delete anonymous identities
  In order to delete anonymous identities
  As a system identity
  I should be able to send api requests related to anonymous identities

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @upMigrations @loadFixtures
  Scenario: Delete an anonymous
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/anonymouses/ad1a4ee4-b707-4135-b8e9-498286d5830c"
    Then the response status code should be 204
    And the response should be empty

  Scenario: Read the deleted anonymous
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses/ad1a4ee4-b707-4135-b8e9-498286d5830c"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"

  @downMigrations
  Scenario: Delete a deleted anonymous
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses/ad1a4ee4-b707-4135-b8e9-498286d5830c"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
